@extends('main')
@section('title')
	ImageSlide
@endsection
@section('content')
<div class="container location">
<div class="row">
    <div class="col-xs-12 col-md-8 col-lg-6">
        <h1>ImageSlide</h1>
    </div>
    <div class="col-xs-10 col-md-6 col-lg-4 search">
        <form id="search-vendor" role="form" action="" method="post">
            <div class="input-group">
              <input type="text" name="search_name" class="form-control">
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
                <i class="fa fa-dashboard"></i><a href="{{Asset('admin/main')}}">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i>ImageSlide
            </li>
        </ol>
    </div>
    
</div>
    <div class="row">
    	<div class="col-xs-10">
            <a href="{{URL::route('imageslide/add')}}"><button type="submit" class="btn btn-primary" >Upload Images</button></a>
            <button type="submit" class="btn btn-danger" id="del_images">Delete</button>
            <div class="table-imageslide">
                <form action="{{URL::route('delSelectImages')}}" method="POST" id="delSelectImages">
                    <table class="table table-striped table-image-slide">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Vendor</th>
                                <th>BigPhoto</th>
                                <th>SmallPhoto</th>
                            </tr>
                            
                        </thead>
                         <tbody>
                        @if(!empty($imageslides))
                        @foreach($imageslides as $i=>$imageslide)
                            <tr>
                                <td style="width:20px;">                                
                                    <input type="checkbox" class="checkbox" value="{{$imageslide->id}}">
                                    <input type="hidden" name="chk-{{$imageslide->id}}" value="" >
                                    
                                </td>
                                <td style="width:50px;">{{$i+1}}</td>
                                <td>{{PhotoSlide::find($imageslide->id)->vendor()->get()->first()->name}}
                                    <div class="menu-hidden " >
                                        <a  href="{{URL::route('edit',array($imageslide->id))}}">Edit</a>
                                        <a  href="{{URL::route('delete',array($imageslide->id))}}">Delete</a>
                                    </div>
                                    <script type="text/javascript">
                                    $(".confirm").click(function(){
                                        if(confirm("Are you sure you want to delete this?")){
                                            return true;
                                        }
                                        else{
                                            return false;
                                        }
                                    });
                                    </script>
                                </td>
                                <td>Big photo {{$i+1}}</td>
                                <td>Small photo {{$i+1}}</td>
                                
                                
                    
                            </tr>
                        @endforeach()
                        @else <p class="empty">Can't find the results</div>
                        @endif
                                       
                    </tbody>
                        </tbody>

                    </table>
                    
                </form>
                <div class="per_page">{{$imageslides->links()}}</div>
            </div>
            <script type="text/javascript">
        $(document).ready(function(){
            var $i=0;
            $('input[type="checkbox"]').click(function(){
                if($(this).is(':checked')) {
                    var id= $(this).val();
                    $(this).next().val(id);
                    $i++;
                }else{
                    $(this).next().val("");
                    $i--;
                }
            });
            $('#del_images').click(function(){
                if ($i<1) {
                    alert('You must check task need delete!');
                    return false;
                }else{
                    $("#delSelectImages").submit();
                }
            });
        });
</script>
@endsection
