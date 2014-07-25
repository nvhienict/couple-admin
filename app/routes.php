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

	Route::get("logout",array("as"=>"logout","uses"=>"AdminController@get_logout"));

	Route::post("login",array("as"=>"login","uses"=>"AdminController@post_login"));

	Route::get("vendors",array("as"=>"vendors","before"=>"check_login","uses"=>"VendorController@index"));
	Route::get("vendors/create",array("as"=>"add-vendor","before"=>"check_login",function(){
		return View::make('add-vendor');
	}));
	Route::post("vendors/create",array("as"=>"add-vendor","uses"=>"VendorController@store"));

	Route::get("vendors/{id}",array("as"=>"delete-vendor","before"=>"check_login","uses"=>"VendorController@destroy"));
	
	Route::post("vendors/delete-vendors",array("as"=>"delete-vendors","uses"=>"VendorController@delete_vendors"));

	Route::get("vendors/{id}/edit",array("as"=>"edit-vendor","before"=>"check_login","uses"=>"VendorController@edit"));

	Route::post("vendors/{id}",array("as"=>"update-vendor","uses"=>"VendorController@update"));

	Route::post("search",array("as"=>"search","uses"=>"VendorController@search"));

	Route::post("check-vendor",array("as"=>"check-vendor","uses"=>"VendorController@check_vendor"));

	Route::post("check-vendor-email",array("as"=>"check-vendor-email","uses"=>"VendorController@check_vendor_email"));

	Route::post("edit-check-vendor/{id}",array("as"=>"edit-check-vendor","uses"=>"VendorController@edit_check_vendor"));

	Route::post("edit-check-vendor-email/{id}",array("as"=>"edit-check-vendor-email","uses"=>"VendorController@edit_check_vendor_email"));
	// Thuy-category
	Route::get('categories', array('as' => 'categories', 'uses'=>'CategoriesController@ListCategory' ));

	Route::get('category/{id}/edit', array('uses'=>'CategoriesController@edit'));

	Route::get('category/add', array('as'=>'category/add','uses'=>'CategoriesController@AddCategory'));

	Route::post('NewCategory', array('uses'=>'CategoriesController@NewCategory'));

	Route::post('UpdateCategory', array('uses'=>'CategoriesController@UpdateCategory'));
	
	Route::post('check_category/{id}', array('uses'=>'CategoriesController@check_category'));

	Route::post('check_Categories', array('as' => 'check_Categories','uses'=>'CategoriesController@check_Categories'));
	
	Route::get('category/{id}/delete', array('uses'=>'CategoriesController@DeleteCategory'));

	Route::post('dels_category',array("as"=>"dels_category", "uses"=>"CategoriesController@dels_category"));
	
// --Location
	Route::get("location", array("as"=>"location","uses"=>"LocationController@listLocation"));
	
	Route::get("location/add-location", array("as"=>"location/add-location","uses"=>"LocationController@showAdd"));
	
	Route::get("location/edit-location", array("as"=>"location/edit-location","uses"=>"LocationController@showEdit"));
	
	Route::post("location/add", array( "uses"=>"LocationController@addLocation"));
	
	Route::get("location/edit-location/{id}", array( "uses"=>"LocationController@editLocation"));
	
	Route::post("location/update/{id}", array("as"=>"update","uses"=>"LocationController@updateLocation"));
	
	Route::get("location/delete/{id}",array("uses"=>"LocationController@deleteLocation"));
	
	Route::post('delSelect',array("as"=>"'delSelect", "uses"=>"LocationController@delSelect"));
	Route::post("check-location",array("as"=>"check-location","uses"=>"LocationController@check_location"));
	
	Route::post("edit-check-location/{id}",array("as"=>"edit-check-location","uses"=>"LocationController@edit_check_location"));

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


