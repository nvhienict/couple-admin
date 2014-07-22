@extends('main')
@section('title')
	Vendors
@endsection
@section('content')
<div class="container vendor">
<div class="row">
	<div class="col-xs-6">
		<h1>Vendors <a class="add-vendor" href="{{Asset('add-vendor')}}">Add Vendor</a></h1>
	</div>
	<div class="col-xs-4 search">
		<form action="{{URL::route('search')}}" method="post">
			<div class="input-group">
		      <input type="text" name="name" class="form-control">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="submit">Search!</button>
		      </span>
		    </div><!-- /input-group -->
		</form>
	</div>
</div>
<div class="row">
    <div class="col-xs-6">
    	<ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="{{Asset('main')}}">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Vendors
            </li>
        </ol>
    </div>
        @if(Session::has('messages')) <p class="alert alert-success">{{Session::get('messages')}}</p>
        @endif      
</div>
    <div class="row">
    	<div class="col-xs-10">
    		<div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Category</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($vendors as $vendor)
                        <tr>
                            <td>{{$vendor->name}}</td>
                            <ul class="menu list-unstyled" role="menu">
                            	<li><a href="">View</a></li>
                            	<li><a href="">Edit</a></li>
                            	<li><a href="">Delete</a></li>
                            </ul>
                            </td>
                            <td>{{$vendor->address}}</td>
                            <td>{{$vendor->phone}}</td>
                            <td>{{$vendor->email}}</td>
                            <td>{{Vendor::find($vendor->id)->category()->get()->first()->name}}</td>
                            <td>{{Vendor::find($vendor->id)->location()->get()->first()->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.table-responsive -->
    	</div><!-- /.col-xs-10 -->
    	<div class="col-xs-2">
    	</div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
