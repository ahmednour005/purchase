<?php

namespace App\Http\Controllers;

use App\Models\MainGroup;
use App\Models\PrRequest;
use App\Models\RequestItem;
use App\Models\Product;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class PrRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prrequests = PrRequest::with('requestitems')->get();
        // dd($prrequests);
        // $totalBudget = PrRequest::prrequest()->requestitems->totalbudget;
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.requests.index', compact('prrequests','users_count'));
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


}
