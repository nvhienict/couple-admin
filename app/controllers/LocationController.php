<?php

class LocationController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function addLocation()
	{
		$rules = array(
			"locationname"=>"required|min:3"
		);
		if(!Validator::make(Input::all(),$rules)->fails())
		{
			$location=new Location();
			$location->name=Input::get('locationname');
			$location->save();
			$location = Location::get();
			return Redirect::to("admin/location");
		}
		else
		{
			return View::make("add-location");
		}
	}

	public function check_location(){
		return (Location::where("name",Input::get('locationname'))->count()==0? "true": "false");
	}
	public function edit_check_location($id){
		
		if(Input::get('NameLocation')==Location::where('id',$id)->get()->first()->name){
			return "true";
		}
		else{
			if(Location::where("name",Input::get('NameLocation'))->count()==0){
				return "true";
			}
			else return "false";
		} 
	}
	
	public function showAdd()
	{
		return View::make('add-location');
	}
	public function showEdit()
	{
		return View::make('edit-location');
	}
	
	public function listLocation(){
		$results= Location::where('id',">",0)->paginate(10);
		return View::make('location')->with("results",$results);
	}
	public function editLocation($id)
	{	
		return View::make('edit-location')->with('location',Location::find($id));
	}
	public function updateLocation($id){
		$rules = array(
			"NameLocation"=>"required|min:3"
		);
		if(!Validator::make(Input::all(),$rules)->fails())
		{
			$id=Input::get('IdLocation');
			$name = Input::get('NameLocation');
			Location::where('id',$id)->update(array('name' => $name));
			return Redirect::to("admin/location");
		}
		else
		{	
			 return View::make("edit-location")->with('location',Location::find($id));
		}
	}
	public function deleteLocation($id)
	{
		$check=Vendor::where('location',$id)->get()->count();
		if($check>0)
		{
			$id_vendor=Vendor::where('location',$id)->get()->first()->id;		
			ImageSlideController::deleteImageVendorLocation($id_vendor);
			VendorController::deleteVendorLocation($id);		
			Location::find($id)->delete();
		}	
		else{
			Location::find($id)->delete();
		}
		
		

		return Redirect::to("admin/location");
	}
	public function delSelect(){

		foreach(Location::get() as $location){
			if(Input::get('chk-'.$location->id)==$location->id)
			{

				$check=Vendor::where('location',$location->id)->get()->count();
				if($check>0)
				{			
					$id_vendor=Vendor::where('location',$location->id)->get()->first()->id;		
					ImageSlideController::deleteImageVendorLocation($id_vendor);
					VendorController::deleteVendorLocation($location->id);					
					Location::find($location->id)->delete();
				}
				else
				{
					Location::find($location->id)->delete();
				}						
				
			}
		}
		
		$msg="Delete User Success!";
		return Redirect::route("location");
	} //end function
	public function search(){
		$name=Input::get('search_name');
		$locations=Location::where('name', 'LIKE', "%$name%")->paginate(5);
		return View::make('location')->with('results',$locations);
	}
}
