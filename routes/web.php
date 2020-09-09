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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/',function (){
   return 'Home Page' ;
});
