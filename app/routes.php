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

Route::get('/', function()
{
	return View::make('main');
});
Route::get("login",array("prefix" => "admin","as"=>"login","uses"=>"AdminController@get_login"));

Route::post("login",array("prefix" => "admin","as"=>"login","uses"=>"AdminController@post_login"));