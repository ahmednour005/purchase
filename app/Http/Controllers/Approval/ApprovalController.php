<?php

namespace App\Http\Controllers\Approval;

use App\Charts\Requests;
use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\StepApproval;
use App\Models\User_StepApproval;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users_count=  User::count();
        $approvals = Approval::all();
        $i=0;
        return view('pages.approvals.approvals',compact('i','users_count','users','approvals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=0;
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.approvals.add_approval',compact('users_count','users','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $approval = Approval::create([
            'approval_name' =>$request->approval_name,
        ]);

       $index = 0;
       $step_number =1;
        if($request->steps){
            foreach ($request->steps as $step){
                $step_approval = StepApproval::create([
                    'approval_id'=>$approval->id,
                    'step_name' => $step['step_name'],
                    'step_number'=>$step_number
                ]);

                   $index = count($step)-1;
                      for($i=0;$i<$index;$i++){
                            User_StepApproval::create([
                            'user_id' =>  $step[$i]['step_users'],
                            'step_approval_id' => $step_approval->id
                          ]);
                       }
                       $step_number++;
            }
        }

         Toastr::success(trans('Success Added'),trans('Success'));
         return redirect('/approvals');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users_count=  User::count();
        $approval = Approval::find($id);
        return view('pages.approvals.show_approval',compact('users_count','approval'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Approval::find($id);
        $users = User::all();
        $users_count=  $users->count();
        $i=0;
        $data_count= Approval::find($id)->count();
        return view('pages.approvals.add_approval',compact('users_count','data_count','i','users','data'));
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
        $approval = Approval::findOrFail($id);

        foreach($approval->stepapprovals as $app){
           User_StepApproval::where('step_approval_id', $app->id)->delete();
        }

        StepApproval::where('approval_id',$approval->id)->delete();

        $approval->update([
            'approval_name' =>$request->approval_name,
        ]);


       $index = 0;
       $step_number=1;
        if($request->steps){
            foreach ($request->steps as $step){
                $step_approval = StepApproval::create([
                    'approval_id'=>$approval->id,
                    'step_name' => $step['step_name'],
                    'step_number'=>$step_number
                ]);

                   $index = count($step)-1;
                      for($i=0;$i<$index;$i++){
                            User_StepApproval::create([
                            'user_id' =>  $step[$i]['step_users'],
                            'step_approval_id' => $step_approval->id
                          ]);
                       }
                       $step_number++;
            }
        }

         Toastr::success(trans('Success Added'),trans('Success'));
         return redirect('/approvals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Approval::findOrFail($request->approval_id);


        $check_approval = DB::table('main_groups')->where('approval_id', $request->approval_id)->value('approval_id');



        if($check_approval){
            Toastr::error('لا يمكن الحذف لإرتباطه بتصنيف ',trans("site.sorry"));
            return redirect('/approvals');
        }else
        {
            foreach($data->step_approvals as $app){
                User_StepApproval::where('step_approval_id', $app->id)->delete();
             }
             $data->delete();
            Toastr::success('تم حذف دورة الأعتماد بنجاح ',trans("site.success"));
            return redirect('/approvals');
        }

    }
}
