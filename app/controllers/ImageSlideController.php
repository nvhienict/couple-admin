<?php

class ImageSlideController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function post_upload()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function post_addImage()
	{
		$photoslide=new PhotoSlide();
		$photoslide->vendor=Input::get('vendor');
		$photoslide->bigpic=Image::make(Input::file('bigpic_upload')->getRealPath())->resize(700, 300)->encode('jpg',80);
		$photoslide->smallpic=Image::make(Input::file('smallpic_upload')->getRealPath())->resize(80,80)->encode('jpg',80);
		$photoslide->save();
		return Redirect::route('imageslide');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showImageSlide()
	{	
		$imageslides=PhotoSlide::where('id','>',0)->paginate(7);;
		return View::make('imageslide')->with('imageslides',$imageslides);
	}
	public function showAdd()
	{
		return View::make('add-imageslide');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showUpdate()
	{
		return View::make('edit-imageslide');
	}
	public function edit($id)
	{
		$imageslide=PhotoSlide::where('id','=',$id)->get()->first();
		return View::make('edit-imageslide')->with('imageslide',$imageslide);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$photoslide=PhotoSlide::find($id);
		$photoslide->vendor=Input::get('vendor');
		if(Input::hasfile('bigpic_upload')) $photoslide->bigpic=Image::make(Input::file('bigpic_upload')->getRealPath())->resize(700, 300)->encode('jpg',80);
		if(Input::hasfile('smallpic_upload')) $photoslide->smallpic=Image::make(Input::file('smallpic_upload')->getRealPath())->resize(80, 80)->encode('jpg',80);
		$photoslide->save();

		return Redirect::route('imageslide');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		PhotoSlide::find($id)->delete();
		return Redirect::route('imageslide');
	}
	public function delSelectImages()
	{
		$ids=array();
		foreach(PhotoSlide::get() as $imageslide){
			if(Input::get('chk-'.$imageslide->id)==$imageslide->id){
				$ids[]=Input::get('chk-'.$imageslide->id);
			} //end if
		} //end foreach

		foreach ($ids as $id=>$key){
			foreach (PhotoSlide::get() as $imageslide){
				if($imageslide->id==$key){
					PhotoSlide::where("id", "=", $imageslide->id)->delete();
				}
			} // end foreach
		} //end foreach
		
		$msg="Delete User Success!";
		return Redirect::route("imageslide");
	}

}
