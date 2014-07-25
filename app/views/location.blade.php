@extends('main')
@section('title')
	Locations
@endsection
@section('content')
<div class="container location">
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
            <button type="submit" class="btn btn-danger" id="del_user">Delete Select</button>
            <a href="{{URL::route('location/add-location')}}"><button type="submit" class="btn btn-primary" >Add Location</button></a>
    		
            <div class="table-responsive">
              <form action="delSelect" method="post" id="delSelect">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th Style="width:30px">
                                
                                  <input type="checkbox" class="checkbox select-all">

                                  <script type="text/javascript">
                                        $('.select-all').click(function(event) {
                                              if(this.checked) {
                                                  // Iterate each checkbox
                                                  $(':checkbox').each(function() {
                                                      this.checked = true;
                                                  });
                                              }
                                              else {
                                                $(':checkbox').each(function() {
                                                      this.checked = false;
                                                  });
                                          }
                                        });

                                    </script><!-- -Script select all -->
                          </th>
                            <th Style="width:30px">Id</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($results))
                    	@foreach($results as $location)
                        <tr>
                            <td>                                
                                <input type="checkbox" class="checkbox" value="{{$location->id}}">
                                <input type="hidden" name="chk-{{$location->id}}" value="" >
                            </td>
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
            </form>
                {{$results->links()}}
            </div><!-- /.table-responsive -->
    	</div><!-- /.col-xs-10 -->
    	<div class="col-xs-2">
    	</div>
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

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
        $('#del_user').click(function(){
            if ($i<1) {
                alert('You must check user need delete!');
                return false;
            }else{
                $("#delSelect").submit();
            }
        });
    });
</script>
@endsection
