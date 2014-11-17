<?php

class VendorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('vendors')->with("vendors",Vendor::paginate(10));
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

			$category=Input::get('category');
			$category_name = Str::slug(Category::where("id", $category)->get()->first()->name);

			$vendor=Str::slug(Input::get('name'));

			File::makeDirectory(saveimages_path('images_vendor/'.$category_name),$mode = 0775,true,true);
			$image = Input::file('avatar');
			$filename = $vendor. '.' .$image->getClientOriginalExtension();
			$path = saveimages_path('images_vendor/'.$category_name.'/'.$filename);
			$pathsave = 'images_vendor/'.$category_name.'/'.$filename;
			Image::make($image->getRealPath())->resize(300, 300)->save($path);

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
			$vendor->photo=$pathsave;
        	$vendor->about=strip_tags(Input::get('editor4'));
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
			
			$category=Input::get('category');
			$category_name = Str::slug(Category::where("id", $category)->get()->first()->name);

			$vendor=Str::slug(Input::get('name'));

			$photo_vendor = Vendor::where('id', $id)->get()->first()->photo;
			$path_delete=saveimages_path($photo_vendor);
			File::delete($path_delete);

			File::makeDirectory(saveimages_path('images_vendor/'.$category_name),$mode = 0775,true,true);
			$image = Input::file('avatar');
			$filename = $vendor. '.' .$image->getClientOriginalExtension();
			$path = saveimages_path('images_vendor/'.$category_name.'/'.$filename);
			$pathsave = 'images_vendor/'.$category_name.'/'.$filename;
			Image::make($image->getRealPath())->resize(300, 300)->save($path);

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
			
			if(Input::hasFile('avatar')) 
			{
				$vendor->photo=$pathsave;
			} else {
				$photo_vendor = Vendor::where('id', $id)->get()->first()->photo;
				$vendor->photo=$photo_vendor;
			}

			
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
		$vendors=Vendor::where('name', 'LIKE', "%$name%")->get();
		return View::make('search_vendors')->with('vendors',$vendors);
	}


}
