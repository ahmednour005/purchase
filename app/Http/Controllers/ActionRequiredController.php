<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\PrRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionRequiredController extends Controller
{
    public function index(){

        $prrequests = PrRequest::with('requestitems', 'approval')->where('user_id',Auth::id())->get();
        //dd($prrequests);
        // dd($prrequests);
        // $totalBudget = PrRequest::prrequest()->requestitems->totalbudget;
        $defaultStatus = Approval::where('approval_name','Pending')->first();
        $user = auth()->user();
        $users = User::all();
        $users_count=  $users->count();
        // dd($defaultStatus);
        return view('pages.requests.actions', compact('prrequests', 'defaultStatus', 'user','users_count'));
    }
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
        return view('pages.requests.view_action', compact('prrequest', 'requestitems', 'defaultStatus', 'user','indexCount','users_count'));
    }
}
