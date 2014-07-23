<?php

class CategoriesController extends \BaseController {

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
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('CategoryEdit')->with('category',Category::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
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
	public function UpdateCategory(){
		$id=Input::get('IdCategory');
		$name = Input::get('NameCategory');
		Category::where('id',$id)->update(array('name' => $name));
		return Redirect::to("admin/categories")->with('message','Đã lưu thành công');
	}
	public function ListCategory(){
		$results= Category::where('id',">",0)->get();
		return View::make('categories')->with("results",$results);
	}
	public function AddCategory(){
		return View::make('AddCategory');

	}
	public function NewCategory(){
		$name = Input::get('NameCategory');
		$count=Category::where('name','=',$name)->count();
		if($count>0){
			return Redirect::to("admin/category/add")->with('message','Đã tồn tại Category '.$name);
		}
		else
		{
			Category::insert(array('name' => $name));
		return Redirect::to("admin/categories")->with('message','Đã thêm thành công');
		}
		
	}
	public function DeleteCategory($id){
		Category::find($id)->delete();
		return Redirect::to("admin/categories")->with('message','Đã xoá thành công');
	}

}
