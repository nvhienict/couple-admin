<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array("prefix" => "admin"),function()
{
	Route::get("main",array("as"=>"main","uses"=>"AdminController@index"));

	Route::get("login",array("as"=>"login","uses"=>"AdminController@get_login"));

	Route::post("login",array("as"=>"login","uses"=>"AdminController@post_login"));

	Route::get("vendors",array("as"=>"vendor",function(){
		return View::make('vendors')->with("vendors",Vendor::get());
	}));
	Route::get("vendors/create",array("as"=>"add-vendor",function(){
		return View::make('add-vendor');
	}));
	Route::post("vendors/create",array("as"=>"add-vendor","uses"=>"VendorController@store"));

	Route::get("vendors/{id}",array("as"=>"delete-vendor","uses"=>"VendorController@destroy"));
	
	Route::get("vendors/{id}/edit",array("as"=>"edit-vendor","uses"=>"VendorController@edit"));

	Route::post("vendors/{id}",array("as"=>"update-vendor","uses"=>"VendorController@update"));

	Route::post("vendors/search",array("as"=>"search","uses"=>"AdminController@search"));
});


