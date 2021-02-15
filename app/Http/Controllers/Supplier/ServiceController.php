<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\MainGroup;
use App\Models\Service_Supplier;
use App\Models\Service;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{

    public function index(){
        $services = Service::orderBy('id', 'DESC')->get();
        $mainGroups = MainGroup::orderBy('id', 'DESC')->get();
        $data =null;
        $sup_service = Service_Supplier::all();
        $users = User::all();
        $users_count=  $users->count();
        return view('pages.suppliers.services',compact('users_count','mainGroups','services','data','sup_service'));
    }

    public function store(Request  $request){
        $input = $request->all();
        Service::create($input);
        Toastr::success(trans("site.service_success_add"),trans("site.success"));

       return redirect('/service');
    }

    public function destroy(Request $request)
    {
       $data = Service::findOrFail($request->service_id);
       $check_service = DB::table('service__suppliers')->where('service_id', $request->service_id)->value('supplier_id');

        if($check_service){
            Toastr::error(trans('site.service_fail'),trans("site.sorry"));
            return redirect('/service');
        }else
        {
            $data->delete();
            Toastr::success(trans('site.service_success'),trans("site.success"));
            return redirect('/service');
        }

    }

    public function edit($id)
    {
        $data = Service::findOrFail($id);
        $services = Service::orderBy('id', 'DESC')->get();
        $sup_service = Service_Supplier::all();
        $users = User::all();
        $mainGroups = MainGroup::orderBy('id', 'DESC')->get();
        $users_count=  $users->count();
        return view('pages.suppliers.services',compact('services','data','mainGroups','sup_service','users_count'));
    }

    public function update(Request $request,$id)
    {
        $input = $request->all();
        $service = Service::findOrFail($id);
        $service->update($input);
        Toastr::success(trans("site.service_success_edit"),trans("site.success"));
        return redirect('/service');
    }
}
