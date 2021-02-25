<?php

namespace App\Http\Controllers;

use App\Models\MainGroup;
use App\Models\PrRequest;
use App\Models\RequestItem;
use App\Models\Product;
use App\Models\Service;
use App\Models\Approval;
use App\Models\StepApproval;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class PrRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prrequests = PrRequest::with('requestitems', 'approval')->get();
        // dd($prrequests);
        // $totalBudget = PrRequest::prrequest()->requestitems->totalbudget;
        $defaultStatus = Approval::find(0);
        $user = auth()->user();
        $users = User::all();
        $users_count=  $users->count();
        // dd($defaultStatus);
        return view('pages.requests.index', compact('prrequests', 'defaultStatus', 'user','users_count'));
    }


    public function getSubGroup($id){
        echo json_encode(MainGroup::find($id)->services);
    }


    public function getItems($id){
        echo json_encode(Service::find($id)->products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mytime = Carbon::now()->format('d-m-Y');
        $subGroups = Service::all();
        $groups = MainGroup::all();
        $products = Product::all();
        $getuser = Auth::user();
        $users = User::all();
        $users_count=  $users->count();


        return view('pages.requests.create',compact('groups','products','mytime', 'getuser','users_count',
    'subGroups','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $countprrequestlocation =  PrRequest::where('user_location',$request->user_location)->get();

        $newRow = count($countprrequestlocation)+1;

        if ($newRow < 10) {
            $requestnumber = $request->user_location.'-'.date('Y').'-'."00".$newRow;
        }
        elseif ($newRow >= 10 && $newRow <=99) {
            $requestnumber = $request->user_location.'-'.date('Y').'-'."0".$newRow;
        }elseif ($newRow<=100) {
            $requestnumber = $request->user_location.'-'.date('Y').'-'.$newRow;
        }


        $prrequest = PrRequest::create([
            'date' => $request->date,
            'main_group_id' => $request->main_group_id,
            'request_number' => $requestnumber,
            'department' => $request->department,
            'project' => $request->project,
            'site' => $request->site,
            'user_location' => $request->user_location,
            'user_id' => Auth::id(),
        ]);


        foreach ($request->items as $key => $item) {
            $prrequest->requestitems()->create([
                'service_id' => $request->service_id[$key],
                'product_id' => $request->product_id[$key],
                'item' => $item,
                'specification' => $request->specifications[$key],
                'piroirty' => $request->piroirtys[$key],
                'qtreqtopur' => $request->qtreqtopurs[$key],
                'qtonstore' => $request->qtonstores[$key],
                'acqtreqtopur' => $request->acqtreqtopurs[$key],
                'currency' => $request->currencys[$key],
                'unit' => $request->units[$key],
                'budget' => $request->budgets[$key],
                'rowbudget' => $request->rowbudgets[$key],
                // 'sumoftotalrowbudget' => $request->sumoftotalrowbudget,
                // 'request_id' => $prrequest->id,
            ]);
        }

        // For Test Relationship Purpose
        // $status = MainGroup::find($request->main_group_id)->approval->id;
        
        // dd($main_group);


        // $status = MainGroup->approval->id;
        
        // dd($status);

        // $stepapprovals = Approval::find($status)->stepapprovals->all();

        // foreach($stepapprovals as $stepapproval){
        //     print_r ($stepapproval->step_name.'<br>');
        //     dd($stepapproval->step_name);
        // }
        
        // dd($stepapproval);

        // return redirect()->route('requests.index')->with('message', 'Request created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prrequest = PrRequest::find($id);

        $requestitems = $prrequest->requestitems()->get();
        $step_id = PrRequest::find($id)->mainGroup->approval->stepapprovals->first();
        $stepnumber = PrRequest::find($id)->mainGroup->approval->stepapprovals->pluck('step_number')->first();
        $laststepnumber = PrRequest::find($id)->mainGroup->approval->stepapprovals->pluck('step_number')->last();
        $users = $step_id->users;
        $arr = array();
        // $index = 0; 
        foreach($users as $st){
            // echo "<pre>";
            $arr[] = $st->id;
            // print_r($st->name);
            // echo "</pre>";
            // $index++;
        }

        dd($step_id);
        // for ($i=0; $i < count($arr) ; $i++) { 
        //     echo "<pre>";
        //         $arr[$i];
        //     // print_r($st->name);
        //     echo "</pre>";
        // }
        // $stepapproval = StepApproval::find($stepnumber)->get();
        // dd($stepapproval);

        // foreach($stepapproval as $approv){
            // foreach($prrequest->mainGroup->approval->stepapprovals as $approv){
        //     foreach ($approv->users as $user) {
        //         echo $user->name;
        //     }$
        // }
        dd($laststepnumber);


        $users = User::all();
        $users_count=  $users->count();
        $indexCount =1;
        return view('pages.requests.show', compact('prrequest', 'requestitems','indexCount','users_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showSend(PrRequest $prrequest)
    {
        abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($prrequest->approval_id == 1) {
            $stepname = PrRequest::find($id)->mainGroup->approval->stepapprovals->pluck('step_name')->first();
            $step = PrRequest::find($id)->mainGroup->approval->stepapprovals->first();
            $users = $step->users;
            $user_id = array();
            $user_name = array();
            $user_jobtitle = array();
            foreach($users as $user) {
                $user_id[] = $user->id; 
                $user_name[] = $user->name; 
                $user_jobtitle[] = $user->job_title; 
            } 
            
            // $users = $prrequest->mainGroup->approval->stepapprovals->users->pluck('name', 'id', 'job_title');
        // } else if (!in_array($prrequest->approval_id, [3,4])) {
        //     // $role = 'CFO';
        //     // $users = Role::find(4)->users->pluck('name', 'id');
        //     $users = $prrequest->mainGroup->approval->stepapprovals->users->pluck('name', 'id', 'job_title');
        // } else {
        //     abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        return view('requests.send', compact('prrequest', 'stepname', 'user_id','user_name','job_title'));
    }

    public function send(Request $request, PrRequest $prrequest)
    {
        abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // $status = Approval::where('approval_name','Pending')->first();

        if ($prrequest->approval_id == 1) {
            $stepname = PrRequest::find($id)->mainGroup->approval->stepapprovals->pluck('step_name')->first();
            $step = PrRequest::find($id)->mainGroup->approval->stepapprovals->first();
            $users = $step->users;
            $user_id = array();
            $user_name = array();
            $user_jobtitle = array();
            foreach($users as $user) {
                $user_id[] = $user->id; 
                $user_name[] = $user->name; 
                $user_jobtitle[] = $user->job_title;
        }
         //else if (in_array($prrequest->approval_id, [3,4])) {
        //     $column = 'cfo_id';
        //     $users  = Role::find(4)->users->pluck('id');
        //     $status = 5;
        // } else {
        //     abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        // $request->validate([
        //     'user_id' => 'required|in:' . $users->implode(',')
        // ]);

        $prrequest->update([
            // $stepnumber => $request->user_id,
            'approval_id' => $stepname
        ]);

        return redirect()->route('requests.index')->with('message', 'Purchase Request has been sent for step_name');
    }



}
