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
                    <label for="">BigPhoto:</label>
                    <input name="bigpic_upload" id="bigpic_upload" type="file" >

                </div>
                 <div class="form-group">
                    <label for="">SmallPhoto:</label>
                    <input name="smallpic_upload" id="smallpic_upload" type="file" >                 
                </div>

                <div class="row form-group">
                    <div class="col-xs-6">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-primary" id="submit_upload">Upload</button>
                    </div>
                </div>           
                <div class="row form-group">
                    <div class="col-xs-10"> 
                        <p>
                            <b>Kích cỡ Ảnh lớn dài 700px; rộng:300px.</b><br>
                            <b>Kích cỡ Ảnh nhỏ dài 80px; rộng: 80px.</b><br>
                            <b>Slide ảnh của mỗi Vendor có 7 ảnh lớn và 7 ảnh nhỏ.</b><br>
                        </p>
                    </div>
                </div>
            
                
            </form>
        </div>
    </div>

</div>
@endsection