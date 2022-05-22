<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

include_once(resource_path()."/build/contacts_entries.php");
include_once(resource_path()."/build/login.php");
include_once(resource_path()."/build/comments_update.php");


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/',function(){
    $token = csrf_token();
    return view('login',["token"=>$token]);
});

Route::get('/cache-status/',function(){
    $token = csrf_token();
    return view('cacheStatus',["token"=>$token]);
});

Route::post("/loginRequest/",function(Request $request){
    $data = Array();
    $contentData = parse_str($request->getContent(),$data);
    $loginHandler = new \login_handler\Login($data);
    return response()->json($loginHandler);
});

Route::get('/cachedItems/',function(){
    $contacts = new \Contacts_Entries\GetContactsList();

    return response()->json($contacts);
});

Route::post('/cachedSet/',function(Request $request){
    $data = Array();
    $contentData = parse_str($request->getContent(),$data);
    #echo "Cached Data...\n ".var_export($data,true)."\n";

    $updateData = new \Contacts_Entries\UpdateContactsList($data);
    return response()->json($updateData);
});
Route::post('/addComment/',function(Request $request){
    $data = Array();
    $contentData = parse_str($request->getContent(),$data);

    $comments = new \comments\update($data);
    return response()->json($comments);
});
