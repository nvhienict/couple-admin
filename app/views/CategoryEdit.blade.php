@extends('main')
@section('title')
	Category-edit
@endsection
@section('content')
	<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Category Edit</h1>
				</div>
				
			</div>
			<div class="row">
				<div>
					@if(!empty($category))
					<form action="{{ Asset('admin/UpdateCategory')}}" method="post">
					  <div class="form-group">
					    <input type="text" class="form-control" id="inputName" name="NameCategory" value="{{$category->name}}">
					    <input type="text" hidden  name="IdCategory" value="{{$category->id}}"> 
					  </div>
					  <button type="submit" class="btn btn-primary">Lưu</button>
					</form>
					@endif
				</div>
			</div>
		</div>

	</div>
@endsection