<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\MainGroup;
use App\Models\Service;
use App\Models\Service_Supplier;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainGroups = MainGroup::orderBy('id', 'DESC')->get();
        $data =null;
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.suppliers.main_group',compact('users_count','mainGroups','data'));
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
        MainGroup::create($input);
        Toastr::success(trans("site.mainGroup_success_add"),trans("site.success"));

       return redirect('/main_group');
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
        $data = MainGroup::findOrFail($id);
        $mainGroups = MainGroup::orderBy('id', 'DESC')->get();
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.suppliers.main_group',compact('mainGroups','data','users_count'));
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
        $mainGroup = MainGroup::findOrFail($id);
        $mainGroup->update($input);
        Toastr::success(trans("site.mainGroup_success_edit"),trans("site.success"));
        return redirect('/main_group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
            $data = MainGroup::findOrFail($request->mainGroup_id);
            $data->delete();
            Toastr::success(trans('site.mainGroup_success'),trans("site.success"));
            return redirect('/main_group');

    }
}
