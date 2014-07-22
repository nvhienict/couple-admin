@extends('main')
@section('title')
	Vendors
@endsection
@section('content')
<div class="container vendor">
<div class="row">
	<div class="col-xs-6">
		<h1>Vendors <a class="add-vendor" href="{{URL::route('add-vendor')}}">Add Vendor</a></h1>
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
    <div class="col-xs-10">
    	<ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="{{URL::route('main')}}">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Vendors
            </li>
        </ol>
    </div>      
</div>
<div class="row">
    <div class="col-xs-10">
        @if(Session::has('messages')) <p class="alert alert-success">{{Session::get('messages')}}</p> 
        @endif    
    </div>
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
                            <td>{{$vendor->name}}
                            <ul class="menu list-unstyled" role="menu">
                            	<li><a href="">View</a></li>
                            	<li><a href="{{URL::route('edit-vendor',array($vendor->id))}}">Edit</a></li>
                            	<li><a class="confirm" href="{{URL::route('delete-vendor',array($vendor->id))}}">Delete</a></li>
                                <script>
                                $(".confirm").click(function(){
                                    if(confirm("Are you sure you want to delete this?")){
                                        return true;
                                    }
                                    else{
                                        return false;
                                    }
                                });
                                </script>
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
