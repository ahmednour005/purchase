<?php

namespace App\Http\Controllers;

use App\Models\MainGroup;
use App\Models\PrRequest;
use App\Models\RequestItem;
use App\Models\Product;
use App\Models\Service;
use App\Models\Approval;
use App\Models\StepApproval;
use Brian2694\Toastr\Facades\Toastr;
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
        $defaultStatus = Approval::where('approval_name','Pending')->first();
        $approvals = Approval::all();
        $stepapprovals = StepApproval::all();
        $user = auth()->user();
        $users = User::all();
        $users_count=  $users->count();
        // dd($defaultStatus);
        // $currentapproval = array();
        // $currentstep = array();
        // foreach($prrequests as $prrequest) {
        //     $currentapproval []= Approval::find($prrequest->approval_id); 
        //     $currentstep []= $currentapproval->stepapprovals->find($currentapproval); 
        
            // // Next ID 
            // $next_id = $currentapproval->stepapprovals->where('id','>',$currentstep->id)->min('id');
            // $nextstep = $currentapproval->stepapprovals->find($next_id); 

            // // Previous ID
            // $prev_id = $currentapproval->stepapprovals->where('id','<',$currentstep->id)->max('id');
            // $prevstep = $currentapproval->stepapprovals->find($prev_id); 
            // // Last Step
            // $laststep = $currentapproval->stepapprovals->last();  
        // }

        return view('pages.requests.index', compact('prrequests', 'approvals', 'currentstep','stepapprovals','defaultStatus', 'user','users_count'));
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


        $processingStatus = Approval::where('approval_name','Pending')->first();


        $prrequest = PrRequest::create([
            'date' => $request->date,
            'main_group_id' => $request->main_group_id,
            'request_number' => $requestnumber,
            'department' => $request->department,
            'project' => $request->project,
            'site' => $request->site,
            'user_location' => $request->user_location,
            'user_id' => Auth::id(),
            'userstep_id' => Auth::id(),
            'approval_id' => $processingStatus,
            'stepapproval_id' => 1,
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

        return redirect()->route('requests.index')->with('message', 'Request created Successfully');

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
        // $step_id = PrRequest::find($id)->mainGroup->approval->stepapprovals->first();
        $stepname = PrRequest::find($id)->mainGroup->approval->stepapprovals->pluck('step_name')->first();
        // $laststepnumber = PrRequest::find($id)->mainGroup->approval->stepapprovals->pluck('step_number')->last();
        // $users = $step_id->users;
        // $arr = array();
        // $index = 0;
        // foreach($users as $st){
            // echo "<pre>";
            // $arr[] = $st->id;
            // print_r($st->name);
            // echo "</pre>";
            // $index++;
        // }

        // dd($stepname);
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
        // dd($laststepnumber);

        $defaultStatus = Approval::where('approval_name','Pending')->first();

        $users = User::all();
        $users_count=  $users->count();
        $user = auth()->user();
        // dd($user);

        $indexCount =1;

        // $currentapproval_id = $prrequest->approval_id;
        // $currentstep_id = $prrequest->stepapproval_id;
        $currentapproval = Approval::find($prrequest->approval_id); 
        $currentstep = $currentapproval->stepapprovals->find($currentapproval); 
        
        // Next ID 
        $next_id = $prrequest->approval->stepapprovals->where('id','>',$currentstep->id)->min('id');
        $nextstep = $prrequest->approval->stepapprovals->find($next_id); 

        // Previous ID
        $prev_id = $currentapproval->stepapprovals->where('id','<',$currentstep->id)->max('id');
        $prevstep = $currentapproval->stepapprovals->find($prev_id); 
        // Last Step
        $laststep = $currentapproval->stepapprovals->last();  
        
        // $nextid = $prrequest->approval->stepapprovals->where('id','>',$prrequest->stepapproval_id)->min('id');
        // $nextstep2 = $prrequest->approval->find($prrequest->approval_id)->stepapprovals->find($nextid)->step_name;
        // dd($nextstep2);
        // dd($currentapproval);
            

        return view('pages.requests.show', compact('prrequest', 'requestitems', 'nextstep','defaultStatus', 'user','indexCount','users_count'));
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
        // abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($prrequest->approval_id == 1) {
            $stepname = $prrequest->mainGroup->approval->stepapprovals->pluck('step_name')->first();
            $step = $prrequest->mainGroup->approval->stepapprovals->first();
            $users = $step->users;
            // $column = 'user_id';
            // $user_id = array();
            // $user_name = array();
            // $user_jobtitle = array();
            // foreach($users as $user) {
            //     $user_id[] = $user->id;
            //     $user_name[] = $user->name;
            //     $user_jobtitle[] = $user->job_title;
            // }

            // $users = $prrequest->mainGroup->approval->stepapprovals->users->pluck('name', 'id', 'job_title');
        // } else if (!in_array($prrequest->approval_id, [3,4])) {
        //     // $role = 'CFO';
        //     // $users = Role::find(4)->users->pluck('name', 'id');
        //     $users = $prrequest->mainGroup->approval->stepapprovals->users->pluck('name', 'id', 'job_title');
        // } else {
        //     abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        

        return view('pages.requests.send', compact('prrequest', 'stepname', 'users','user_id','user_name','job_title'));
    }

    public function send(Request $request, PrRequest $prrequest)
    {
        // abort_if(!auth()->user()->is_admin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $status = Approval::where('approval_name','Pending')->first();
        $approval_id = $prrequest->mainGroup->approval->id;

        $currentapproval = Approval::find($prrequest->approval_id); 
        $currentstep = $currentapproval->stepapprovals->find($currentapproval);
        // Next ID 
        $next_id = $currentapproval->stepapprovals->where('id','>',$currentstep->id)->min('id');
        $nextstep = $currentapproval->stepapprovals->find($next_id); 

        // Previous ID
        $prev_id = $currentapproval->stepapprovals->where('id','<',$currentstep->id)->max('id');
        $prevstep = $currentapproval->stepapprovals->find($prev_id); 
        // Last Step
        $laststep = $currentapproval->stepapprovals->last();

        if ($prrequest->approval_id == 1) {
            $stepname = $prrequest->mainGroup->approval->stepapprovals->pluck('step_name')->first();
            $step_id = $prrequest->mainGroup->approval->stepapprovals->pluck('id')->first();
            $step = $prrequest->mainGroup->approval->stepapprovals->first();
            $users = $step->users;
            $column = 'userstep_id';
            // $user_id = array();
            // $user_name = array();
            // $user_jobtitle = array();
            // foreach($users as $user) {
            //     $user_id[] = $user->id; 
            //     $user_name[] = $user->name; 
            //     $user_jobtitle[] = $user->job_title;
            
        }
         else if (!in_array($prrequest->approval_id, [1]) && !$laststep) {
            $column = 'userstep_id';
            $step_id = $next_id;
            $users  = $nextstep->users->pluck('id');
            // $status = ;
        } 
        // else {
        //     abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        // }

        // $request->validate([
        //     'user_id' => 'required|in:' . $users->implode(',')
        // ]);

        $prrequest->update([
            $column => $request->user_id,
            'approval_id' => $approval_id,
            'stepapproval_id' => $step_id,
        ]);

        Toastr::success('sucess','Purchase Request has been sent for'.$stepname);

        return redirect()->route('requests.index');
    }

    public function showAnalyze(PrRequest $prrequest)
    {
        $user = auth()->user();
        $approval_id = $prrequest->mainGroup->approval->id;
        $currentapproval = Approval::find($prrequest->approval_id); 
        $currentstep = $currentapproval->stepapprovals->find($currentapproval);
        $users = $currentstep->users;
        // abort_if(
        //     (!$user->is_analyst || $loanApplication->status_id != 2) && (!$user->is_cfo || $loanApplication->status_id != 5),
        //     Response::HTTP_FORBIDDEN,
        //     '403 Forbidden'
        // );

        return view('requests.analyze', compact('prrequest'));
    }

    public function analyze(Request $request, PrRequest $prrequest)
    {
        $user = auth()->user();

        // if ($prrequest->approval_id != 1) {
        //     $currentapproval_id = $prrequest->approval_id;
        //     $currentstep_id = $prrequest->stepapproval_id;
        //     $currentstep_name = $prrequest->approval->stepapprovals->find($currentstep_id)->step_name;
        // if ($user->is_analyst && $prrequest->status_id != 1) {
        //     $status = $request->has('approve') ? 3 : 4;
        //     }
        // }
        // else if ($user->is_cfo && $loanApplication->status_id == 5) {
        //     $status = $request->has('approve') ? 6 : 7;
        // }
        // else {
        //     abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        // }

        // $request->validate([
        //     'comment_text' => 'required'
        // ]);

        // $prrequest->comments()->create([
        //     'comment_text' => $request->comment_text,
        //     'user_id'      => $user->id
        // ]);

        // $prrequest->update([
        //     'approval_id' => $status,
        //     'stepapproval_id' => $status,
        // ]);

        // return redirect()->route('requests.index')->with('message', 'Analysis has been submitted');
    }

}
