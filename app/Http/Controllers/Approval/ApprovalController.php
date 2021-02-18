<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\StepApproval;
use App\Models\User_StepApproval;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=0;
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.approvals.approvals',compact('users_count','data','users'));
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



        // $approval = Approval::create([
        //     'approval_name' =>$request->approval_name,
        // ]);


       // $persons = $request->persons;
        // foreach($persons as $person) {

        //     Person_Supplier::create([
        //         'supplier_id' =>   $sup->id,
        //         'job_title' => $person['job_title'],
        //         'responsible_person' => $person['responsible_person'],
        //         'mobile' => $person['mobile'],
        //         'whatsapp' => $person['whatsapp'],
        //         'person_email' => $person['person_email']

        //     ]);
        // }

// dd($request->steps[0][0]);
        $index = 0;
        if($request->steps){
            foreach ($request->steps as $steps){
                // $step_approval = StepApproval::create([
                //     'approval_id'=>$approval->id,
                //     'step_name' => $steps['step_name'],
                // ]);

                // if($request->step_users[$index]){
                    foreach ($steps[$index] as $users){

                           print_r($steps[$index]);
                        //  User_StepApproval::create([
                        //     'user_id' => $users,
                        //     'step_approval_id' => $step_approval->id
                        //  ]);

                            //  dd($users);
                        // echo $users .'<br>';
                        // }
                    }

                    $index++;
            }
        }



        // Toastr::success(trans('site.supplier_success_add'),trans('site.success'));
        // return redirect('/approvals');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
