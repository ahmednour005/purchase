<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\MainGroup;
use App\Models\Prod_Supplier;
use App\Models\Product;
use App\Models\Service;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('id', 'DESC')->get();
        $services = Service::orderBy('id', 'DESC')->get();
        $prod_supplier = Prod_Supplier::all();
        $data = null;
        $users = User::all();
        $users_count=  $users->count();
        $mainGroups = MainGroup::orderBy('id', 'DESC')->get();
        return view('pages.suppliers.products',compact('users_count','mainGroups','services','products','data','prod_supplier'));
    }

    public function store(Request  $request){
        $input = $request->all();
        Product::create($input);
        Toastr::success(trans("site.product_success_add"),trans("site.success"));
        return redirect('/product');
    }

    public function destroy(Request  $request)
    {
        $data = Product::findOrFail($request->prod_id);

        $check_product = DB::table('prod__suppliers')->where('product_id', $request->prod_id)->value('supplier_id');
        if($check_product){
            Toastr::error(trans('site.product_fail'),trans("site.sorry"));
            return redirect('/product');
        }else
        {
            $data->delete();
            Toastr::success(trans('site.product_success'),trans("site.success"));
            return redirect('/product');
        }
    }

    public function edit($id)
    {
        $products = Product::orderBy('id', 'DESC')->get();
        $services = Service::orderBy('id', 'DESC')->get();
        $data = Product::findOrFail($id);
        $prod_supplier = Prod_Supplier::all();
        $users = User::all();
        $users_count=  $users->count();
        $mainGroups = MainGroup::orderBy('id', 'DESC')->get();
        return view('pages.suppliers.products',compact('prod_supplier','mainGroups','services','products','data','users_count'));
    }

    public function update(Request $request,$id)
    {
        $input = $request->all();
        $product = Product::findOrFail($id);
        $product->update($input);
        Toastr::success(trans("site.product_success_edit"),trans("site.success"));
        return redirect('/product');
    }

    public function GetSubGroup($id){
        echo json_encode(DB::table('services')->where('main_group_id',$id)->get());
    }

    public function editGetSubGroup(Request $request){
        $id = $request->select_id;
        echo json_encode(DB::table('services')->where('main_group_id',$id)->get());
    }


}
