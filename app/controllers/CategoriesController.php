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
		$rules=array(
			"NameCategory"=>"required|min:3",
			"editor4"=>"required|min:15"
			);
		$validator=Validator::make(Input::all(),$rules);
		$id=Input::get('IdCategory');
		$name = Input::get('NameCategory');
		$descreption=Input::get('editor4');
		if($validator->passes()){
			Category::where('id',$id)->update(array('name' => $name,'description'=>$descreption));
		return Redirect::to("admin/categories")->with('message','Đã lưu thành công');
		}
		else
		{
			$category=Category::where("id","=",$id)->get()->first();
			$errors=$validator->messages();
			return View::make('CategoryEdit')->with('category',$category)->with("errors",$errors);
		}
		
	}
	public function ListCategory(){
		$results= Category::where('id',">",0)->paginate(10);
		return View::make('categories')->with("results",$results);
	}
	public function AddCategory(){
		return View::make('AddCategory');

	}
	public function NewCategory(){
		$name = Input::get('NameCategory');
		$description = Input::get('editor4');
		$rules=array(
			"NameCategory"=>"required|min:3",
			"editor4"=>"required|min:15"
			);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->passes()){
		Category::insert(array('name' => $name,'description'=>$description));
		return Redirect::to("admin/categories")->with('message','Đã thêm thành công');
		}
		else
		{
			$errors=$validator->messages();
			return View::make('AddCategory')->with("errors",$errors);
		}
	}
	public function DeleteCategory($id){
		Category::find($id)->delete();
		return Redirect::to("admin/categories")->with('message','Đã xoá thành công');
	}
	public function check_Categories(){
		return (Category::where("name",Input::get('NameCategory'))->count()==0? "true": "false");
	}
	public function dels_category(){
		$ids=array();
		foreach(Category::get() as $category){
			if(Input::get('chk-'.$category->id)==$category->id){
				$ids[]=Input::get('chk-'.$category->id);
			} //end if
		} //end foreach

		foreach ($ids as $id=>$key){
			foreach (Category::get() as $category){
				if($category->id==$key){
					Category::where("id", "=", $category->id)->delete();
				}
			} // end foreach
		} //end foreach
		
		$msg="Delete Categry Success!";
		return Redirect::route("categories")->with('message',$msg);
	} //end function
}
