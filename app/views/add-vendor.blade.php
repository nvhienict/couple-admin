@extends('main')
@section('title')
	Add Vendor
@endsection
@section('content')
<div class="container">
<div class="row">
<div class="col-xs-8">
	<h1>Add New Vendor</h1>
    @if(isset($messages)) <p class="alert alert-danger">{{$messages}}</p>
    @endif
</div>
</div>
	<div class="row">
		<div class="col-xs-8">
			<form class="register-vendor" method="post" action="{{URL::route('add-vendor')}}" accept-charset="UTF-8" enctype="multipart/form-data" role="form">

                            <div class="form-group">
                                <label>Name</label>
                                <input name='name' class="form-control">
                                @foreach ($errors->get('name') as $message)
                                <p class="text-left alert alert-danger">{{$message}}</p>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input name='address' placeholder="Enter text" class="form-control">
                                @foreach ($errors->get('address') as $message)
                                <p class="text-left alert alert-danger">{{$message}}</p>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name='email' placeholder="Enter text" class="form-control">
                                @foreach ($errors->get('email') as $message)
                                <p class="text-left alert alert-danger">{{$message}}</p>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input name='phone' placeholder="Enter text" class="form-control">
                                @foreach ($errors->get('phone') as $message)
                                <p class="text-left alert alert-danger">{{$message}}</p>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>Website</label>
                                <input name='website' placeholder="Enter text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control">
	                            	@foreach(Category::get() as $category)
	                                <option value="{{$category->id}}">{{$category->name}}</option>
	                                @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Location</label>
                                <select name="location" class="form-control">
                                	@foreach(@Location::get() as $location)
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                	@endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Avatar</label>
                                <input name="avatar" type="file">
                                @foreach ($errors->get('avatar') as $message)
                                <p class="text-left alert alert-danger">{{$message}}</p>
                                @endforeach
                            </div>

                             <textarea id="input" name="input"></textarea>
                             @foreach ($errors->get('input') as $message)
                                <p class="text-left alert alert-danger">{{$message}}</p>
                                @endforeach
                            <button class="btn btn-default" type="submit">Create Vendor</button>
                            
                        </form>
		</div>
		<div class="col-xs-4"></div>
	</div>
</div>
@endsection