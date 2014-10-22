@extends('main')
@section('title')
    Add Image Slide
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-8">
            <h1>Upload Image Slide</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <form action="{{URL::route('upload')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" role="form">
              
                <div class="form-group">
                    <label for="">Vendor</label>
                    <select name="vendor" id="vendor" class="form-control" >
                        @foreach(Vendor::get() as $vendor)
                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Photo:</label>
                    <input name="bigpic_upload" id="bigpic_upload" type="file" accept="image/*" required >

                </div>
                 

                <div class="row form-group">
                    <div class="col-xs-6">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-primary" id="submit_upload">Upload</button>
                    </div>
                </div>
                 <div class="row form-group">
                    <div class="col-xs-12">
                       <b style="color:red">Mỗi vendor upload nhiều nhất 7 ảnh.</b>
                    </div>
                </div>                 
                
            
                
            </form>
        </div>
    </div>

</div>
@endsection