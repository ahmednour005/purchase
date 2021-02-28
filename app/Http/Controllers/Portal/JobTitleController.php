<?php

namespace App\Http\Controllers\Portal;

use App\Charts\Requests;
use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\JobTitle;
use App\Models\MainGroup;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_titles = JobTitle::orderBy('id', 'DESC')->get();
        $data =null;
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.portal.job_title',compact('users_count','job_titles', 'approvals','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        JobTitle::create($input);
        Toastr::success('تم إضافة المسمى الوظيفى بنجاح',trans("site.success"));
        return redirect('/portal/job_titles');
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
        $data = JobTitle::findOrFail($id);
        $job_titles = JobTitle::orderBy('id', 'DESC')->get();
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.portal.job_title',compact('job_titles','data','users_count'));
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
        $input = $request->all();
        $job_title = JobTitle::findOrFail($id);
        $job_title->update($input);
        Toastr::success('تم تعديل المسمى الوظيفى',trans("site.success"));
        return redirect('/portal/job_titles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = JobTitle::findOrFail($request->jobtitle_id);
        $data->delete();
        Toastr::success('تم حذف المسمى الوظيفى بنجاح',trans("site.success"));
        return redirect('/portal/job_titles');
    }

}
