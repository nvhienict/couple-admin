@extends('main')
@section('title')
	Locations
@endsection
@section('content')
<div class="container location">
<div class="row">
	<div class="col-xs-6">
		<h1>Locations <a class="add-location" href="{{Asset('admin/location/add-location')}}">Add Location</a></h1>
	</div>
	<div class="col-xs-4 search">
		<form action="" method="post">
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
                <i class="fa fa-dashboard"></i><a href="{{Asset('admin/main')}}">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Location
            </li>
        </ol>
    </div>
    
</div>
    <div class="row">
    	<div class="col-xs-10">
    		<div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th Style="width:30px;">Id</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($results))
                    	@foreach($results as $location)
                        <tr>
                            <td>{{$location->id}}
                            <td>{{$location->name}}
                                <ul class="menu list-unstyled" role="menu">
                                	<li ><a href="location/edit-location/{{$location->id}}">Edit</a></li>

                                	<li><a class="confirm" href="location/delete/{{$location->id}}">Delete</a></li>
                                </ul>
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
                            </td>
                           
                        </tr>
                        @endforeach
                        @else <p class="empty">Không tìm thấy kết quả</div>
                        @endif
                        
                      
                    </tbody>
                </table>
                {{$results->links()}}
            </div><!-- /.table-responsive -->
    	</div><!-- /.col-xs-10 -->
    	<div class="col-xs-2">
    	</div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
