@extends('main')
@section('title')
	Category-Thuna.vn
@endsection
@section('content')
<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Category</h1>
				</div>
				<div class="col-xs-6 ">
					
				</div>
			</div>
			<div class="row">
				<div class="col-xs-8"> 
					<a href="{{URL::route('category/add')}}"><button type="button" class="btn btn-primary" onclick="PageAdd">Thêm mới</button></a>
					<button id="del_category" class="btn btn-danger" type="submit"> Xoá </button>
				</div>
				<div class="col-xs-4">
					<div class="input-group">
						<input type="text" class="form-control" name="search" >
						<div class="input-group-btn">
							<button class="btn btn-primary"> Tìm kiếm </button>
						</div>
					</div>
				</div>
			</div>
			
			@if(Session::has("message"))				
				<h3><span class="label label-success">{{ Session::get('message')}}</span></h3>
			@endif
			<div style="clear:both;"></div>
				<div class="table-responsive">
					<form action="dels_category" method="post" id="dels_category">
					<table class="table table-hover ">
						<thead>
						<tr>
							<th> <input type="checkbox" class="checkbox select-all " > </th>
							<th> ID </th>
							<th> Tên </th>
							<th> Mô tả </th>
						</tr>
					</thead>
						<tbody>
						@if(!empty($results))
						@foreach($results as $category)

							<tr>
								<td>
									<input type="checkbox" value="{{$category->id}}">
									<input type="hidden" name="chk-{{$category->id}}" value="" >
								<td>{{$category->id}}</td>
								<td>{{$category->name}}
									<ul class="menu list-unstyled" role="menu">
                            			<li><a href="category/{{$category->id}}/edit">Edit</a></li>
                            			<li><a class="confirm" href="category/{{$category->id}}/delete">Delete</a></li>
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
                            	<td>
                            		{{$category->description}}
                            	</td>
                        		
							</tr>
						@endforeach

						@else <p class="empty">Không tìm thấy kết quả</div>
						@endif
					</tbody>
						<tr>
							<th> <input type="checkbox" class="checkbox select-all" > </th>
							<th> ID </th>
							<th> Tên </th>
							<th> Mô tả </th>

						</tr>
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
					</table>
				</form>
				{{$results->links()}}	
				</div>

		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		var mybtn = document.getElementById('edit_user');
		var $i=0;
		$('input[type="checkbox"]').click(function(){
			if($(this).is(':checked')) {
				var id= $(this).val();
			 	$(this).next().val(id);
				$i++;
				if($i>1){
					mybtn.style.display = 'none';
				}
			}else{
				$(this).next().val("");
				$i--;
				if($i<=1){
					mybtn.style.display = 'inline-block';
				}
			}
		});
		$('#del_category').click(function(){
			if ($i<1) {
				alert('You must check user need delete!');
				return false;
			}else{
				$("#dels_category").submit();
			}
		});
	});
</script>
@endsection