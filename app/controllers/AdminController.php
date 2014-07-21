<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function get_login()
	{
		return View::make("login");
	}
	public function post_login()
	{

	($remember=Input::has('remember')) ? true: false;
		$auth=Auth::attempt(array(
				"email"=> Input::get('inputEmail'),
				"password"=> Input::get('inputPassword'),
				"role_id"=> 1
				),$remember);
		if($auth)
		{
			Session::put("email",Input::get('inputEmail'));
			return Redirect::to("main");
		}	 
		
		else return View::make('login')->with("messages","Tên tài khoản hay mật khẩu không đúng hoặc bạn ko phải là admin");	
	}
	public function get_logout()
	{
		Session::flush();
		return Redirect::to("login");
	}

}
