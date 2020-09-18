<?php

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

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

//Route::get('/', function () {
//   // How To Pass Data To View
//    //1- ->with('data',50);
//    //2- ->with(['data'=>50,'name'=>'mahmmod']);
//    //3-
////    $data = [];
////    $data['id'] = 50 ;
////    $data['name'] = 'Ahmed' ;
////    $data['age'] = 60 ;
//
//    return view('welcome');
//});

// < To Display A normal Route > //

//Route::get('/test1',function (){
//   return 'Welcome In Test1 Page';
//});


// < To Display A normal Route With Necessary Parameter > //

//Route::get('/show_number/{id}',function ($id){
//    return 'Welcome In Test1 Page And Id Is : ' . $id;
//})->name('show.number');

// < To Display A normal Route With Optional Parameter > //

//Route::get('/show_string/{id?}',function (){
//    return 'Welcome In Test1 Page And Id Is : ';
//})->name('show.string');


// < To Display A normal Route With Namespace (Folder Inside The Controller Folder) > //

//Route::namespace('Front')->group(function (){
//    // all route are only access from Front Folder Inside Controller Folder
//    Route::get('/users','UserController@showUsername');
//});

// < To Display A normal Route With Middleware > //

//Route::group(['prefix'=>'users','middleware'=>'auth'],function (){
//    Route::get('/',function (){
//      return 'work';
//    });
//});


// < To Display A normal Route With All HTTP Methods(get , post , put , delete , patch , options) > //

//Route::resource('news','NewsController');


//Route::get('/index','Front\\UserController@getIndex');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Start Develop Template

//Route::get('/landing',function (){
//   return view('landing');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/',function (){
   return 'Home Page' ;
});

Route::get('/redirect/{service}','SocialController@redirectToProvider')->name('loginFB');
Route::get('/login/{service}/callback','SocialController@handleProviderCallback');

Route::get('fallible','CrudController@getOffer');

Route::group(['prefix'=>LaravelLocalization::setLocale(),'middleware'=>['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],function (){
    Route::group(['prefix'=>'offer'],function (){
        //Route::get('store','CrudController@store');
        Route::get('create','CrudController@create');
        Route::post('store','CrudController@store')->name('offer.store');
        Route::get('edit/{offer_id}','CrudController@edit');
        Route::post('update/{offer_id}','CrudController@update')->name('offer.update');
        Route::get('delete/{offer_id}','CrudController@delete')->name('offer.delete');
        Route::get('all','CrudController@getAllOffer')->name('offer.all');
    });

    Route::get('youtube','CrudController@getVideo')->middleware('auth');
});

Route::get('test',function (){
    $offer = \App\Models\Offer::get();
    return $offer;
});

Route::group(['prefix'=>'ajax-offer'],function (){
    Route::get('create','OfferController@create')->name('ajax.offer.create');
    Route::post('store','OfferController@store')->name('ajax.offer.store');
    Route::get('all','OfferController@all')->name('ajax.offer.all');
    Route::post('delete','OfferController@delete')->name('ajax.offer.delete');
    Route::get('edit/{offer_id}','OfferController@edit')->name('ajax.offer.edit');
    Route::post('update','OfferController@update')->name('ajax.offer.update');
});

Route::group(['namespace'=>'Auth','middleware'=>['checkAge','auth']],function (){
    Route::get('adult','customAuthController@adult')->name('adult');

});

Route::get('site','Auth\customAuthController@site')->name('site')->middleware('auth:web');
Route::get('admin','Auth\customAuthController@admin')->name('admin')->middleware('auth:admin');
Route::get('admin/login','Auth\customAuthController@adminLogin')->name('adminLogin');
Route::post('admin/login','Auth\customAuthController@CheckAdminLogin')->name('CheckAdminLogin');

Route::get('test',function (){
   return 'You are not allowed to visit route';
})->name('test');


#################### Start Relation #########################
Route::get('has-one','Relation\RelationController@getHasOne');
#################### End Relation ###########################

