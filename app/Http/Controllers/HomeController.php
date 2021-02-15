<?php

namespace App\Http\Controllers;

use App\Models\MainGroup;
use App\Models\Product;
use App\Models\PrRequest;
use App\Models\Service;
use App\Models\Supplier;
use App\User;
use Illuminate\Http\Request;
use App\Charts\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $suppliers = Supplier::all();
        $count = $suppliers->count();

        $groups = MainGroup::all();
        $group_count = $groups->count();

        $sevices = Service::all();
        $ser_count = $sevices->count();

        $products = Product::all();
        $pros_count = $products->count();

        $users = User::all();
        $users_count=  $users->count();

        $request = PrRequest::all();
        $request_count=  $request->count();


        $dateNow = Carbon::now()->format('Y');
        $request = PrRequest::whereYear('created_at', '=', $dateNow)->get();
        $arr =[];
        foreach($request as $key=> $req){
            $myDate = $req->created_at;
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $myDate)->format('F');
            if(!in_array(trans('site.'.$date),$arr)){
                $arr[] = trans('site.'.$date);
            }
        }

        $users = PrRequest::select('id', 'created_at')->whereYear('created_at', '=', $dateNow)
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }
        for($i = 1; $i <= count($arr) ; $i++){
            if(!empty($usermcount[$i])){
                $userArr[] = $usermcount[$i];
            }else{
                $userArr[$i] = 0;
            }
        }

         return view('index',compact('count','ser_count','pros_count','arr','userArr','dateNow','request_count','users_count','group_count'));

    }
}
