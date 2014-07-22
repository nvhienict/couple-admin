<?php

class VendorController extends \BaseController {

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
		$rules=array(
			"name"=>"required|min:3",
			"address"=>"required|min:5",
			"email"=>"required|email",
			"phone"=>"required|min:9",
			"avatar"=>"required|image",
			"input"=>"required|min:10"
			);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->passes())
		{
			if(Vendor::where("name",Input::get('name'))->count()==1)
			{
				return View::make('vendors/create')->with('messages',"Vendor da ton tai");
			}
			else
			{
				$vendor=new Vendor();
				$vendor->name=Input::get('name');
				$vendor->address=Input::get('address');
				$vendor->email=Input::get('email');
				$vendor->phone=Input::get('phone');
				$vendor->website=Input::get('website');
				$vendor->category=Input::get('category');
				$vendor->location=Input::get('location');
				$vendor->avatar=Image::make(Input::file('avatar')->getRealPath())->encode('jpg',80);
            	$vendor->about=Input::get('input');
            	$vendor->save();
            	return Redirect::to('admin/vendors')->with('messages',"Tao Vendor thanh cong");
			}
		}
		else
		{
			$errors=$validator->messages();
			return View::make('vendors/create')
			->with("errors",$errors);
		}
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
		$vendor=Vendor::where("id","=",$id)->get()->first();
		return View::make('edit-vendor')->with("vendor",$vendor);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules=array(
			"name"=>"required|min:3",
			"address"=>"required|min:5",
			"email"=>"required|email",
			"phone"=>"required|min:9",
			"input"=>"required|min:10"
			);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->passes())
		{
			if(Vendor::where("name",Input::get('name'))->count()==1&&Input::get('name')!=Input::get('name_old'))
			{
				return View::make('edit-vendor')->with('messages',"Vendor da ton tai");
			}
			else
			{
				$vendor=Vendor::find($id);
				$vendor->name=Input::get('name');
				$vendor->address=Input::get('address');
				$vendor->email=Input::get('email');
				$vendor->phone=Input::get('phone');
				$vendor->website=Input::get('website');
				$vendor->category=Input::get('category');
				$vendor->location=Input::get('location');
				if(Input::hasFile('avatar')) $vendor->avatar=Image::make(Input::file('avatar')->getRealPath())->encode('jpg',80);
            	$vendor->about=Input::get('input');
            	$vendor->save();
            	return Redirect::to('admin/vendors')->with('messages',"Edit Vendor thanh cong");
			}
		}
		else
		{
			$vendor=Vendor::where("id","=",$id)->get()->first();
			$errors=$validator->messages();
			return View::make('edit-vendor')
			->with("errors",$errors)->with("vendor",$vendor);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Vendor::find($id)->delete();
		return Redirect::to('admin/vendors')->with('messages',"Xoa vendor thanh cong");
	}


}
