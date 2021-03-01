<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $data =null;
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.portal.department',compact('users_count','departments', 'approvals','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        Department::create($input);
        Toastr::success('تم إضافة القسم بنجاح',trans("site.success"));
        return redirect('/portal/department');
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
        $data = Department::findOrFail($id);
        $departments = Department::orderBy('id', 'DESC')->get();
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.portal.department',compact('departments','data','users_count'));
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
        $job_title = Department::findOrFail($id);
        $job_title->update($input);
        Toastr::success('تم تعديل القسم',trans("site.success"));
        return redirect('/portal/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Department::findOrFail($request->department_id);
        $data->delete();
        Toastr::success('تم حذف القسم بنجاح',trans("site.success"));
        return redirect('/portal/department');
    }
}
