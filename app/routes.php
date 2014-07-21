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
		return View::make('vendors');
	}));
});


