<?php

class ItemController extends \BaseController {

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
	public function addItem()
	{

		$id=Input::get('id');
		$item_last=Budget::where('category',$id)->get()->last();
		$budget=new Budget();
		$budget->item="New Item";
		$budget->category=$id;
		$budget->range1="0.00";
		$budget->range2="0.00";
		$budget->range3="0.00";
		$budget->range4="0.00";
		$budget->range5="0.00";
		$budget->save(); 
		$item=Budget::get()->last();
		$html = '';
		$html .= '<tr id="budget_item_cat'.$item->id.'" class="budget_item_cat'.$item->category.'">
			
			<td>
				<div>
			 <a onclick="cl('.$item->id.')" class="'.$item->id.'_show_hide">'.$item->item.'</a> 
			 	
			    <input id="'.$item->id.'" onchange="v_fChange('.$item->id.')"  ondblclick="db('.$item->id.')"  type="text"  value="" name="item" class="'.$item->id.'_slidingDiv" style="width:150px;display:none;" >
				<input type="hidden" value="'.$item->id.'" name="'.$item->id.'">
			 </div>
			</td>
			<td>
			     <div>
			 <a onclick="cl1('.$item->id.')" class="'.$item->id.'_show_hide1">'.$item->range1.'</a> 
			 	
			    <input id="'.$item->id.'" onchange="v_fChange1(this)" ondblclick="db1('.$item->id.')"  type="text" value="" name="range1" class="'.$item->id.'_slidingDiv1" style="width:150px;display:none;" >
				<input type="hidden" value="'.$item->id.'" name="'.$item->id.'">
			 </div>
			</td>
			<td>
			    <div>
			 	<a onclick="cl2('.$item->id.')" class="'.$item->id.'_show_hide2">'.$item->range2.'</a> 
			 	
			    <input  id="'.$item->id.'" onchange="v_fChange2(this)" ondblclick="db2('.$item->id.')"  type="text" value="" name="range2" class="'.$item->id.'_slidingDiv2" style="width:150px;display:none;">
				<input type="hidden" value="'.$item->id.'" name="'.$item->id.'">
			 </div>
			<td>
			<td>
			    <div>
				 <a onclick="cl3('.$item->id.')" class="'.$item->id.'_show_hide3">'.$item->range3.'</a> 
			 	
			    <input  id="'.$item->id.'" onchange="v_fChange3(this)" ondblclick="db3('.$item->id.')"  type="text" value="" name="range3" class="'.$item->id.'_slidingDiv3" style="width:150px;display:none;">
				<input type="hidden" value="'.$item->id.'" name="'.$item->id.'">
			 </div>
			<td>
				<div>
				<a onclick="cl4('.$item->id.')" class="'.$item->id.'_show_hide4">'.$item->range4.'</a> 
				 	
				    <input  id="'.$item->id.'" onchange="v_fChange4(this)" ondblclick="db4('.$item->id.')"  type="text" value="" name="range4" class="'.$item->id.'_slidingDiv4" style="width:150px;display:none;">
					<input type="hidden" value="'.$item->id.'" name="'.$item->id.'">
				 </div>
			</td>
			<td>
				<div>
				<a onclick="cl5('.$item->id.')" class="'.$item->id.'_show_hide5">'.$item->range5.'</a> 
				 	
				    <input  id="'.$item->id.'" onchange="v_fChange5(this)" ondblclick="db5('.$item->id.')"  type="text" value="" name="range5" class="'.$item->id.'_slidingDiv5" style="width:150px;display:none;">
					<input type="hidden" value="'.$item->id.'" name="'.$item->id.'">
				 </div>
			</td>	 
			<td>
            
                <a class="budget_icon_trash" class="confirm" id="delete-item{{$budget->id}}" href="{{URL::route("item_delete",array($budget->id))}}"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
		</tr>';
		echo json_encode(array('catid'=>$item->category,'item_last'=>$item_last->id,'iditem'=>$item->id,'html'=>$html));die();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$budget=Budget::where('id','>',0)->get();
		return View::make('item')->with('budget',$budget);
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
	public function updateItem()
	{	
		$id=Input::get('id');
		$item=Input::get('item');
		$budget=Budget::find($id);
		$budget->item=$item;
		$budget->save();
	}
	public function updateRange1()
	{
		$id=Input::get('id');
		$range1=Input::get('range1');
		$budget=Budget::find($id);
		$budget->range1=$range1;
		$budget->save();
	}
	public function updateRange2()
	{
		$id=Input::get('id');
		$range2=Input::get('range2');
		$budget=Budget::find($id);
		$budget->range2=$range2;
		$budget->save();
	}
	public function updateRange3()
	{
		$id=Input::get('id');
		$range3=Input::get('range3');
		$budget=Budget::find($id);
		$budget->range3=$range3;
		$budget->save();
	}

	public function updateRange4()
	{
		$id=Input::get('id');
		$range4=Input::get('range4');
		$budget=Budget::find($id);
		$budget->range4=$range4;
		$budget->save();
	}

	public function updateRange5()
	{
		$id=Input::get('id');
		$range5=Input::get('range5');
		$budget=Budget::find($id);
		$budget->range5=$range5;
		$budget->save();
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteItem()
	{	
		$id=Input::get('id');
		Budget::find($id)->delete();
		
	}


}
