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
			<form id="register-vendor" method="post" action="{{URL::route('add-vendor')}}" accept-charset="UTF-8" enctype="multipart/form-data" role="form">

                <div class="form-group">
                    <label>Name</label>
                    <input name='name' id='name' class="form-control">
                    @foreach ($errors->get('name') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input name='address' id='address' placeholder="Enter text" class="form-control">
                    @foreach ($errors->get('address') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name='email' id='email' placeholder="Enter text" class="form-control">
                    @foreach ($errors->get('email') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input name='phone' id='phone' placeholder="Enter text" class="form-control">
                    @foreach ($errors->get('phone') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Website</label>
                    <input name='website' id='website' placeholder="Enter text" class="form-control">
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
                    <label>Map</label>
                    <input name='map' id='map' placeholder="Enter text" class="form-control">
                    @foreach ($errors->get('map') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Video</label>
                    <input name='video' id='video' placeholder="Enter text" class="form-control">
                   
                </div>

                <div class="form-group">
                    <label>Avatar</label>
                    <input name="avatar" id='avatar' type="file">
                    @foreach ($errors->get('avatar') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>
                 <div class="form-group">
                    <label>About Us</label>
                    <textarea name="editor4" class="ckeditor form-control" cols="80" id="editor4" rows="10" tabindex="1"></textarea>
                    @foreach ($errors->get('editor4') as $message)
                    <p class="text-left alert alert-danger">{{$message}}</p>
                    @endforeach
                </div>
                <button class="btn btn-default" type="submit">Create Vendor</button>
            </form>
            <script type="text/javascript">
                $('#register-vendor').validate({
                rules:{
                    name:{
                    required:true,
                    minlength:3,
                    remote:{
                                url:'{{URL::route('check-vendor')}}',
                                type:"POST"
                            }
                    },
                    address:{
                        required:true,
                        minlength:5
                    },
                    email:{
                        required:true,
                        email:true,
                        remote:{
                                url:'{{URL::route('check-vendor-email')}}',
                                type:"POST"
                            }
                    },
                    phone:{
                        required:true,
                        minlength:9
                    },
                    map:{
                        required:true
                        
                    },
                    avatar:{
                        required:true,
                        accept:"image/*"
                    },
                    editor4:{
                        required:true,
                        minlength:10
                    }
                },
                messages:{
                    name:{
                        required:"Chưa điền thông tin",
                        minlength: "Yêu cầu nhập trên 3 kí tự",
                        remote:"Tên Vendor đã tồn tại"
                    },
                    address:{
                        required:"Chưa điền thông tin",
                        minlength:"Yêu cầu nhập trên 5 kí tự"
                    },
                    email:{
                        required:"Chưa điền thông tin",
                        email:"Không đúng định dạng email",
                        remote:"Email đã tồn tại"
                    },
                    phone:{
                        required:"Chưa điền thông tin",
                        minlength:"Yêu cầu nhập trên 9 kí tự"
                    },
                    map:{
                        required:"Chưa điền thông tin",
                    },
                    avatar:{
                        required:"Chưa upload file",
                        accept:"Không đúng định dạng ảnh"
                    },
                    editor4:{
                        required:"Chưa điền thông tin",
                        minlength:"Yêu cầu nhập trên 10 kí tự"
                    }
                }
            })
            </script>
		</div>
		<div class="col-xs-4"></div>
	</div>
</div>
@endsection