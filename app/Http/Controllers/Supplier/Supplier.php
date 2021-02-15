<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Person_Supplier;
use App\Models\Prod_Supplier;
use App\Models\Service_Supplier;
use App\Models\Product;
use App\Models\Service;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Supplier extends Controller
{
   public function index(){
       $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
       if (strpos($url,'archive') !== false){
           $suppliers = \App\Models\Supplier::where('archive',1)->orderBy('id', 'DESC')->get();
           $archive = true;
       }else{
           $suppliers = \App\Models\Supplier::where('archive',0)->orderBy('id', 'DESC')->get();
           $archive = false;
       }
       $services = Service::orderBy('id', 'DESC')->get();
       $products = Product::orderBy('id', 'DESC')->get();
       $prod_supplier = Prod_Supplier::all();
       $persons = Person_Supplier::all();
       $service_supplier = Service_Supplier::all();
       $users = User::all();
       $users_count=  $users->count();
        return view('pages.suppliers.supplier_request',compact('users_count','suppliers','services','products',
        'prod_supplier','service_supplier','persons','archive'));

   }

    public function  returnCat($id){
        echo json_encode(DB::table('Products')->where('service_id',$id)->get());
    }

    public function get_profile($id)
    {
        $supplier = \App\Models\Supplier::where('id', $id)->get();
        $services = Service::orderBy('id', 'DESC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        $prod_supplier = Prod_Supplier::all();
        $service_supplier = Service_Supplier::all();
        $serv_count = Service_Supplier::where('supplier_id', $id)->count();
        $prod_count = Prod_Supplier::where('supplier_id', $id)->count();
        $archive = \App\Models\Supplier::select('archive')->where('id', $id)->get();



        $persons = \App\Models\Supplier::find($id)->persons;
        $preson_count = \App\Models\Supplier::find($id)->persons->count();

        $users = User::all();
        $users_count=  $users->count();

        return view('pages.suppliers.profile',compact('supplier','products','services','prod_supplier',
        'service_supplier','serv_count','prod_count','persons','preson_count','archive','users_count'));

    }

   public  function create(){
       $products = Product::orderBy('id', 'DESC')->get();
       $services = Service::orderBy('id', 'DESC')->get();
       $data =null;
       $users = User::all();
       $users_count=  $users->count();
       return view('pages.suppliers.supplier_form',compact('services','products','data','users_count'));
   }

   public function company_search(Request $request)
   {

    $search_content = $_GET['search_content'];

        // $result = \Illuminate\Support\Str::of($search_content)->split('/[\s]+/')->toArray();
           // $pp =preg_replace('/\s+/'," ", $search_content);
        // $result = preg_split('/\s+/', $pp);
        $result = explode(" ", $search_content);

        $realResult = collect(array_diff($result,[""]));

        $supplier = DB::Table('suppliers')
            ->Where(function ($query) use ($realResult) {
                $size = count($realResult);
                for ($i =0; $i < $size; $i++){
                    $query->orwhere('company', 'like',  '%' .$realResult[$i].'%');
                }
            })->get();

           $output = '';
           foreach ($supplier as $sup) {
               if($sup->archive == 0){
               $output .= '<tr>
                                    <td>' . $sup->id . '</td>
                                    <td>' . $sup->company . '</td>
                                    <td>' . $sup->country . '</td>
                                    <td> '. $sup->city .'</td>
                                    <td> '. $sup->address .'</td>
                                    <td> '.  \Carbon\Carbon::parse($sup->created_at)->format('d/m/Y') .'</td>
                                    <td class="options_suppliers">
                                      <a  href="/supplier/profile/'.$sup->id.'" class="btn btn-success"><i class="fa fa-eye"></i>&ensp;'.trans("site.show").' </a>
                                      <a href="/supplier/edit/'.$sup->id.'"  class="btn btn-warning"> <i class="fa fa-edit "></i>&ensp;'.trans("site.edit").'  </a>
                                      <a  class="btn btn-danger" data-sup_id="'.$sup->id.'" data-toggle="modal" data-target="#delete"> <i class="fa fa-trash-alt "></i> &ensp;'.trans("site.archive_this").' </a>
                                    </td>
                                </tr>';
                     }else{
                            $output .= '<tr style="background: #ffe0e0">
                                    <td>' . $sup->id . '</td>
                                    <td>' . $sup->company . '</td>
                                    <td>' . $sup->country . '</td>
                                    <td> '. $sup->city .'</td>
                                    <td> '. $sup->address .'</td>
                                    <td> '.  \Carbon\Carbon::parse($sup->created_at)->format('d/m/Y') .'</td>
                                    <td class="options_suppliers">
                                      <a href="/supplier/profile/'.$sup->id.'" class="btn btn-success"><i class="fa fa-eye"></i>&ensp;'.trans("site.show").' </a>
                                      <a  class="btn btn-danger" data-sup_id="'.$sup->id.'" data-toggle="modal" data-target="#restore"> <i class="fa fa-trash-restore-alt "></i> &ensp;'.trans("site.take_back").' </a>
                                    </td>
                                </tr>';
               }


           }



           return $data= array(
               'row_result'=>$output,
           );


   }

    public function store(Request $request){

        $input['profile_image'] =null;
        if($request->hasFile('profile_image')) {
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $input['profile_image']=$timestamp.'_'.$request->profile_image->getClientOriginalName();
            $request->profile_image->move(public_path('/Images/Profile/'), $input['profile_image']);
        }
        $input['tax_card_image'] =null;
        if($request->hasFile('tax_card_image')) {
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $input['tax_card_image']=$timestamp.'_'.$request->tax_card_image->getClientOriginalName();
            $request->tax_card_image->move(public_path('/Images/Tax_Card/'), $input['tax_card_image']);
        }
        $input['commercial_register_image'] =null;
        if($request->hasFile('commercial_register_image')) {
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $input['commercial_register_image']=$timestamp.'_'.$request->commercial_register_image->getClientOriginalName();
            $request->commercial_register_image->move(public_path('/Images/Commercial_Register/'), $input['commercial_register_image']);
        }
        if($request->hasFile('tax_card_pdf')) {
            $tax_card_pdf = $request->file('tax_card_pdf');
            $tax_card_pdf_new_name = time() . trim(Str::slug($request->company)) . '.' . $tax_card_pdf->getClientOriginalExtension();
            $tax_card_pdf->move('uploads/Tax_card', $tax_card_pdf_new_name);
        }else{
            $tax_card_pdf_new_name = null;
        }
        if($request->hasFile('commercial_register_pdf')) {
            $commercial_register_pdf = $request->file('commercial_register_pdf');
            $commercial_register_pdf_new_name = time() . trim(Str::slug($request->company)) . '.' . $commercial_register_pdf->getClientOriginalExtension();
            $commercial_register_pdf->move('uploads/Commercial_Register', $commercial_register_pdf_new_name);
        }else {
            $commercial_register_pdf_new_name = null;
        }

        if(($input['tax_card_image'] != null &&   $input['commercial_register_image']!= null ) ||
            ( $input['tax_card_image'] !=null && $commercial_register_pdf_new_name !=null ) ||
            ($input['commercial_register_image'] != null && $tax_card_pdf_new_name != null) ||
            ($commercial_register_pdf_new_name !=null && $tax_card_pdf_new_name != null)){

            $accredite = "site.approval_this";
        }else{
            $accredite = "site.not_approval";
        }



        $sup = \App\Models\Supplier::create([
            'company' =>$request->company,
            'phone' =>$request->phone,
            'company_mobile' =>$request->company_mobile,
            'archive' =>0,
            'fax' =>$request->fax,
            'supplier_email' =>$request->supplier_email,
            'supplier_password' =>bcrypt($request->supplier_password),
            'address' =>$request->address,
            'country' =>$request->country,
            'city' =>$request->city,
            'address_link' =>$request->address_link,
            'website' =>$request->website,
            'accredite' =>$accredite,
            'service_note' =>$request->service_note,
            'person_note' =>$request->person_note,
            'accredite_note' =>$request->accredite_note,
            'profile_image' => $input['profile_image'],
            'tax_card_image' => $input['tax_card_image'],
            'commercial_register_image' => $input['commercial_register_image'],
            'tax_card_pdf' => $tax_card_pdf_new_name,
            'commercial_register_pdf' => $commercial_register_pdf_new_name,
        ]);


        $persons = $request->persons;
        foreach($persons as $person) {

            Person_Supplier::create([
                'supplier_id' =>   $sup->id,
                'job_title' => $person['job_title'],
                'responsible_person' => $person['responsible_person'],
                'mobile' => $person['mobile'],
                'whatsapp' => $person['whatsapp'],
                'person_email' => $person['person_email']

            ]);
        }


        if($request->products){
            foreach ($request->products as $product){
                Prod_Supplier::create([
                    'product_id' => $product,
                    'supplier_id' => $sup->id
                ]);
            }
        }

        if($request->Sup_services){
            foreach ($request->Sup_services as $Sup_service){
                Service_Supplier::create([
                    'service_id' => $Sup_service,
                    'supplier_id' => $sup->id
                ]);
            }
        }

        Toastr::success(trans('site.supplier_success_add'),trans('site.success'));
        return redirect('/supplier');
    }

    public function edit($id){

        $suppliers = \App\Models\Supplier::orderBy('id', 'DESC')->get();
        $services = Service::orderBy('id', 'DESC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        $prod_supplier = Prod_Supplier::all();
        $service_supplier = Service_Supplier::all();
        $persons = Person_Supplier::all();
        $per_i = 0;
        $data = \App\Models\Supplier::findOrFail($id);
        $serv_count  =  Service_Supplier::where('supplier_id', $id)->count();
        $person_count  =  Person_Supplier::where('supplier_id', $id)->count();

        $i=1;
        $users = User::all();
         $users_count=  $users->count();
        return view('pages.suppliers.supplier_form',compact('users_count','services','products','data','prod_supplier','service_supplier','serv_count','i','persons','per_i','person_count'));
    }

    public  function  update(Request $request , $id){
        $sup = \App\Models\Supplier::findOrFail($id);


        if($request->has('profile_image')) {
            $input['profile_image'] = null;
            if ($request->hasFile('profile_image')) {
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $p_image= $timestamp . '_' . $request->profile_image->getClientOriginalName();
                $request->profile_image->move(public_path('/Images/Profile/'), $p_image);
                // update new Photo
                $sup->update([
                    'profile_image' => $p_image
                ]);
                // $imagePath = asset('Images/Profile/'.$sup->profile_image);
                // // dd($imagePath);
                // if (file_exists($imagePath)) {
                //     unlink($imagePath);
                // }
            }
        }

        if($request->has('tax_card_image')) {
            $input['tax_card_image'] = null;
            if ($request->hasFile('tax_card_image')) {
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $tax_image= $timestamp . '_' . $request->tax_card_image->getClientOriginalName();
                $request->tax_card_image->move(public_path('/Images/Tax_Card/'), $tax_image);
                // update new Photo
                $sup->update([
                    'tax_card_image' => $tax_image
                ]);
            }
        }

        if($request->has('commercial_register_image')) {
            $input['commercial_register_image'] = null;
            if ($request->hasFile('commercial_register_image')) {
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $commercial_image= $timestamp . '_' . $request->commercial_register_image->getClientOriginalName();
                $request->commercial_register_image->move(public_path('/Images/Commercial_Register/'), $commercial_image);
                // update new Photo
                $sup->update([
                    'commercial_register_image' => $commercial_image
                ]);
            }
        }

        if($request->has('tax_card_pdf')) {
            if ($request->hasFile('tax_card_pdf')) {
                $tax_card_pdf = $request->file('tax_card_pdf');
                $tax_card_pdf_new_name = time() . trim(Str::slug($request->company)) . '.' . $tax_card_pdf->getClientOriginalExtension();
                $tax_card_pdf->move('uploads/Tax_card', $tax_card_pdf_new_name);
                // update new pdf
                $sup->update([
                    'tax_card_pdf' => $tax_card_pdf_new_name
                ]);
            }
        }

        if($request->has('commercial_register_pdf')) {
            if ($request->hasFile('commercial_register_pdf')) {
                $commercial_register_pdf = $request->file('commercial_register_pdf');
                $commercial_register_pdf_new_name = time() . trim(Str::slug($request->company)) . '.' . $commercial_register_pdf->getClientOriginalExtension();
                $commercial_register_pdf->move('uploads/Commercial_Register', $commercial_register_pdf_new_name);
                // update new pdf
                $sup->update([
                    'commercial_register_pdf' => $commercial_register_pdf_new_name
                ]);
            }
        }



        if(($sup->tax_card_image != null &&  $sup->commercial_register_image != null ) ||
            ($sup->tax_card_image !=null && $sup->commercial_register_pdf !=null ) ||
            ($sup->commercial_register_image != null && $sup->tax_card_pdf != null) ||
            ($sup->commercial_register_pdf !=null && $sup->tax_card_pdf != null)){

                 $accredite = "site.approval_this";
        }else{
            $accredite = "site.not_approval";
        }

        $sup->update([
            'company' =>$request->company,
            'phone' =>$request->phone,
            'company_mobile' =>$request->company_mobile,
            'fax' =>$request->fax,
            'supplier_email' =>$request->supplier_email,
            'supplier_password' =>bcrypt($request->supplier_password),
            'address' =>$request->address,
            'country' =>$request->country,
            'city' =>$request->city,
            'address_link' =>$request->address_link,
            'website' =>$request->website,
            'accredite' =>$accredite,
            'service_note' =>$request->service_note,
            'accredite_note' =>$request->accredite_note,
            'person_note' =>$request->person_note,
        ]);



        $prod = Prod_Supplier::where('supplier_id', $sup->id);
        $prod->delete();

        $service = Service_Supplier::where('supplier_id', $sup->id);
        $service->delete();


        $per_sup = Person_Supplier::where('supplier_id', $sup->id);
        $per_sup->delete();


        foreach($request->persons as $person) {
            Person_Supplier::create([
                'supplier_id' =>   $sup->id,
                'job_title' => $person['job_title'],
                'responsible_person' => $person['responsible_person'],
                'mobile' => $person['mobile'],
                'whatsapp' => $person['whatsapp'],
                'person_email' => $person['person_email']

            ]);
        }

        if($request->products){
            foreach ($request->products as $product){
                Prod_Supplier::create([
                    'product_id' => $product,
                    'supplier_id' => $sup->id
                ]);
            }
        }
        if($request->Sup_services){
            foreach ($request->Sup_services as $Sup_service){
                Service_Supplier::create([
                    'service_id' => $Sup_service,
                    'supplier_id' => $sup->id
                ]);
            }
        }
        Toastr::success(trans('site.supplier_success_edit'),trans('site.success'));
        return redirect('/supplier');
    }

    public function sup_archive(Request  $request){
        $supplier = \App\Models\Supplier::find($request->sup_id);
        $val = 1;
        $supplier->update([
            'archive' => $val,
        ]);
        Toastr::success(trans('site.supplier_archive_success'),trans('site.success'));
        return back();
    }
    public function sup_restore(Request  $request){

        $supplier = \App\Models\Supplier::find($request->sup_id);
        $val = 0;
        $supplier->update([
            'archive' => $val,
        ]);

        $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
       if (strpos($url,'profile') !== false) {
           Toastr::success(trans('site.supplier_restore_success'),trans('site.success'));
           return back();
       }else{
           Toastr::success(trans('site.supplier_restore_success'),trans('site.success'));
           return redirect()->route('supplier');
       }

    }


}
