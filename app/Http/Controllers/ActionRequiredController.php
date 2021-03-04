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

        $prrequests = PrRequest::with('requestitems', 'approval')->get();
        //dd($prrequests);
        // dd($prrequests);
        // $totalBudget = PrRequest::prrequest()->requestitems->totalbudget;
        $defaultStatus = Approval::where('approval_name','Pending')->first();
        $approvals = Approval::all();
        $user = auth()->user();
        $users = User::all();
        $users_count=  $users->count();
        // dd($defaultStatus);
        return view('pages.requests.actions', compact('prrequests', 'approvals','defaultStatus', 'user','users_count'));
    }
    public function show($id)
    {
        $prrequest = PrRequest::find($id);

        $requestitems = $prrequest->requestitems()->get();
        // $step_id = PrRequest::find($id)->mainGroup->approval->stepapprovals->first();
        $stepname = PrRequest::find($id)->mainGroup->approval->stepapprovals->pluck('step_name')->first();
        
        $defaultStatus = Approval::where('approval_name','Pending')->first();

        $users = User::all();
        $users_count=  $users->count();
        $user = auth()->user();

        $indexCount =1;
        return view('pages.requests.view_action', compact('prrequest', 'requestitems', 'defaultStatus', 'user','indexCount','users_count'));
    }
}
