@extends('main')
@section('title')
	CategoryAdd
@endsection
@section('content')
			@if(Session::has("message"))
				<p>{{ Session::get('message')}}</p>
			@endif

	<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Category Add</h1>
				</div>
				
			</div>
			<div class="row">
				<div>
					<form action="{{ Asset("admin/NewCategory")}}" method="post" >
					  <div class="form-group">
					    <input type="text" class="form-control" id="inputName" name="NameCategory" >
					  </div>
					  <button type="submit" class="btn btn-default">Lưu</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection