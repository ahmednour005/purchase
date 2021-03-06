<?php

// use App\Http\Controllers\Supplier\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


Route::group(['namespace'=>'Supplier','middleware'=>'auth'],function(){
    Route::group(['prefix' => 'supplier'],function(){
            // Supplier
            Route::get('/', 'Supplier@index')->name('supplier');
            Route::get('archive', 'Supplier@index')->name('archive_suppliers');
            Route::get('profile/{id}', 'Supplier@get_profile')->name('profile');
            Route::get('add', 'Supplier@create')->name('supplier.add');
            Route::post('store', 'Supplier@store')->name('supplier.store');

            Route::get('edit/{id}', 'Supplier@edit')->name('supplier.edit');
            Route::post('update/{id}', 'Supplier@update')->name('supplier.update');

            Route::delete('sup_archive/{id}', 'Supplier@sup_archive')->name('supplier.sup_archive');
            Route::delete('sup_restore/{id}', 'Supplier@sup_restore')->name('supplier.sup_restore');

            Route::get('company_search', 'Supplier@company_search')->name('supplier.search');

            // ajax select box
            Route::get('getProductsFromService/{id}', 'Supplier@returnCat');
            Route::get('edit/getProductsFromService/{id}', 'Supplier@returnCat');
    });

    Route::resource('/main_group', 'MainGroupController');
    Route::resource('/service', 'ServiceController');
    Route::resource('/product', 'ProductController');
    Route::get('getSubGroupFromMainGroup/{id}', 'ProductController@GetSubGroup');

    Route::get('product/{product_id}/editgetSubGroupFromMainGroup/{select_id}', 'ProductController@editGetSubGroup');

});

Auth::routes();
Route::get('/login/{email?}',function ($email){
    if(Auth::check()){
        return redirect('/');
    }else{
            $i=0;
            $users = \App\User::where('email', $email)->get();
            foreach ($users as $u){
                if( $u->vaild == 1){
                    $i =1;
                }
            }
            if($i){
                $validUser = 2;
                return view('auth.login',compact('validUser'));
            }else{
                $validUser = 1;
                return view('auth.login',compact('validUser'));
            }
    }
});


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index');

    // users

    Route::resource('/users', 'User\UserController')->middleware('auth');
    Route::get('/users/profile/{id}','User\UserController@getProfile')->name('users.profile')->middleware('auth');


     // Purchase Request
   Route::resource('requests', 'PrRequestsController')->middleware('auth');
   Route::get('requests/getSubGroupFromGroup/{id}','PrRequestsController@getSubGroup')->middleware('auth');
   Route::get('requests/getItemFromSubGroup/{id}','PrRequestsController@getItems')->middleware('auth');
    // Loan Applications
    // Route::delete('requests/destroy', 'LoanApplicationsController@massDestroy')->name('requests.massDestroy');
    Route::get('requests/{prrequest}/analyze', 'PrRequestsController@showAnalyze')->name('requests.showAnalyze');
    Route::post('requests/{prrequest}/analyze', 'PrRequestsController@analyze')->name('requests.analyze');
    Route::get('requests/{prrequest}/send', 'PrRequestsController@showSend')->name('requests.showSend');
    // Route::get('requests/{pr_request}/send', 'PrRequestsController@test')->name('requests.showSend');
    Route::post('requests/{prrequest}/send', 'PrRequestsController@send')->name('requests.send');


   Route::get('export', 'DemoController@export')->name('export')->middleware('auth');
   Route::get('importExportView', 'DemoController@importExportView')->middleware('auth');
   Route::post('import', 'DemoController@import')->name('import')->middleware('auth');

    //    approval
   Route::resource('approvals', 'Approval\ApprovalController')->middleware('auth');
    Route::get('actions','ActionRequiredController@index')->name('actions.index');
    Route::get('view_action/{id}','ActionRequiredController@show')->name('actions.show');



// portal
Route::resource('portal/job_titles', 'Portal\JobTitleController');
Route::resource('portal/department', 'Portal\DepartmentController');
Route::resource('portal/workgroup', 'Portal\WorkGroupController');



});


Route::resource('/test', 'Approval\ApprovalController');
// Route::get('/test{pr_request}/send', 'PrRequestsController@test');
