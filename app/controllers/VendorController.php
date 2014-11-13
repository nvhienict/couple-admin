<?php

class VendorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('vendors')->with("vendors",Vendor::paginate(5));
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
			$vendor=new Vendor();
			$vendor->name=Input::get('name');
			$vendor->address=Input::get('address');
			$vendor->email=Input::get('email');
			$vendor->phone=Input::get('phone');
			$vendor->website=Input::get('website');
			$vendor->map=Input::get('map');
			$vendor->video=Input::get('video');
			$vendor->category=Input::get('category');
			$vendor->location=Input::get('location');
			$vendor->avatar=Image::make(Input::file('avatar')->getRealPath())->encode('jpg',80);
        	$vendor->about=Input::get('editor4');
        	$vendor->slug=Str::slug(Input::get('name'));
        	$vendor->save();
        	return Redirect::to('admin/vendors')->with('messages',"Tao Vendor thanh cong");
		
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

	public static function deleteVendorLocation($id)
	{
		Vendor::where('location',$id)->delete();
	}
	public static function deleteVendorCategory($id)
	{
		Vendor::where('category',$id)->delete();
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
		
			$vendor=Vendor::find($id);
			$vendor->name=Input::get('name');
			$vendor->address=Input::get('address');
			$vendor->email=Input::get('email');
			$vendor->phone=Input::get('phone');
			$vendor->website=Input::get('website');
			$vendor->map=Input::get('map');
			$vendor->video=Input::get('video');
			$vendor->category=Input::get('category');
			$vendor->location=Input::get('location');
			if(Input::hasFile('avatar')) $vendor->avatar=Image::make(Input::file('avatar')->getRealPath())->encode('jpg',80);
        	$vendor->about=Input::get('editor4');
        	 $vendor->slug=Str::slug(Input::get('name'));
        	$vendor->save();
        	return Redirect::to('admin/vendors')->with('messages',"Edit Vendor thanh cong");
	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$counts=PhotoSlide::where('vendor',$id)->get()->count();		
		if($counts>0)
		{
			ImageSlideController::deleteImageVendor($id);
			Vendor::find($id)->delete();
			return Redirect::to('admin/vendors')->with('messages',"Xoa vendor thanh cong");
		}
		else
		{
			Vendor::find($id)->delete();
			return Redirect::to('admin/vendors')->with('messages',"Xoa vendor thanh cong");

		}
		

		
	}
	public function delete_vendors(){
		foreach(Vendor::get() as $vendor){
			if(Input::get('checkbox-'.$vendor->id)==$vendor->id){				
				ImageSlideController::deleteImageVendor($vendor->id);					
				Vendor::find($vendor->id)->delete();					
				
			}
		}
		return Redirect::to('admin/vendors')->with('messages',"Xoa vendor thanh cong");
		
	}
	public function check_vendor(){
		return (Vendor::where("name",Input::get('name'))->count()==0? "true": "false");
	}
	public function edit_check_vendor($id){
		//return (Vendor::where("name",Input::get('name'))->count()==0&&Input::get('name')==Input::get('name_old'))? "true": "false";
		if(Input::get('name')==Vendor::where("id",$id)->get()->first()->name){
			return "true";
		}
		else{
			if(Vendor::where("name",Input::get('name'))->count()==0){
				return "true";
			}
			else return "false";
		} 
	}
	public function check_vendor_email(){
		return (Vendor::where("email",Input::get('email'))->count()==0? "true": "false");
	}

	public function edit_check_vendor_email($id){
		if(Input::get('email')==Vendor::where("id",$id)->get()->first()->email){
			return "true";
		}
		else{
			if(Vendor::where("email",Input::get('email'))->count()==0){
				return "true";
			}
			else return "false";
		} 
	}
	public function search(){
		$name=Input::get('search_name');
		$vendors=Vendor::where('name', 'LIKE', "%$name%")->paginate(5);
		return View::make('vendors')->with('vendors',$vendors);
	}


}
