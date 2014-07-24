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


	

	
	public function listLocation(){
		$results= Location::where('id',">",0)->paginate(2);
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
		Location::find($id)->delete();

		return Redirect::to("admin/location");
	}
}
