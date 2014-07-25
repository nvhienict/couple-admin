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

	// Giang
	Route::filter("check_login", function(){
		if(!Session::has("email"))
			return Redirect::to("admin/login");
	});

	Route::get("main",array("before"=>"check_login", "as"=>"main","uses"=>"AdminController@index"));
	//Cuong
	Route::get("login",array("as"=>"login","uses"=>"AdminController@get_login"));

	Route::post("login",array("as"=>"login","uses"=>"AdminController@post_login"));

	Route::get("vendors",array("as"=>"vendors",function(){
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

	Route::post("check-vendor",array("as"=>"check-vendor","uses"=>"VendorController@check_vendor"));

	Route::post("check-vendor-email",array("as"=>"check-vendor-email","uses"=>"VendorController@check_vendor_email"));

	Route::post("edit-check-vendor/{id}",array("as"=>"edit-check-vendor","uses"=>"VendorController@edit_check_vendor"));

	Route::post("edit-check-vendor-email/{id}",array("as"=>"edit-check-vendor-email","uses"=>"VendorController@edit_check_vendor_email"));
	// Thuy-category
	Route::get('categories', array('as' => 'categories', 'uses'=>'CategoriesController@ListCategory' ));

	Route::get('category/{id}/edit', array('uses'=>'CategoriesController@edit'));

	Route::get('category/add', array('uses'=>'CategoriesController@AddCategory'));

	Route::post('NewCategory', array('uses'=>'CategoriesController@NewCategory'));

	Route::post('UpdateCategory', array('uses'=>'CategoriesController@UpdateCategory'));
	
	Route::get('category/{id}/delete', array('uses'=>'CategoriesController@DeleteCategory'));
	
// --Location
	Route::get("location", array("as"=>"location","uses"=>"LocationController@listLocation"));
	
	Route::get("location/add-location",function(){
		return View::make("add-location");
	});
	Route::get("location/edit-location",function(){
		return View::make("edit-location");
	});
	
	Route::post("location/add", array( "uses"=>"LocationController@addLocation"));
	
	Route::get("location/edit-location/{id}", array( "uses"=>"LocationController@editLocation"));
	
	Route::post("location/update/{id}", array("as"=>"update","uses"=>"LocationController@updateLocation"));
	Route::get("location/delete/{id}",array("uses"=>"LocationController@deleteLocation"));


	// Giang -----User
	Route::post("users/search",array("as"=>"SearchUser","uses"=>"AdminController@postSearchUser"));

	Route::get("users",array("before"=>"check_login","as"=>"users","uses"=>"AdminController@get_users"));
	// ---add user
	Route::post("users", array("as"=>"users","uses"=>"AdminController@post_users"));
	
	Route::post('check_email', array("as"=>"check_email", "uses"=>"AdminController@check_email"));

	// ----delete user
	Route::get("users/delete/{id}", array("as"=>"users/delete","uses"=>"AdminController@del_users"))
				->where(array('id'=>'[0-9]+'));
	Route::post('dels',array("as"=>"dels", "uses"=>"AdminController@dels"));

	// -----edit user
	Route::get("users/edit/{id}", array("as"=>"users/edit","uses"=>"AdminController@get_edit_users"))
				->where(array('id'=>'[0-9]+'));
	Route::post("users/edit/{id}", array("as"=>"users/edit","uses"=>"AdminController@post_edit_users"))
				->where(array('id'=>'[0-9]+'));

});


