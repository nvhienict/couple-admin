@extends('main')
@section('title')
	Category
@endsection
@section('content')
<div class="row">
		<div class="col-xs-10 col-md-offset-1">
			<div class="row">
				<div class="col-xs-6 ">
					<h1>Category</h1>
					<a href="{{Asset("admin/category/add")}}">Thêm Category</a>
				</div>
				<div class="col-xs-6 ">
					
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-xs-4"> 
					<a href=""> Tấc cả</a>
					<a href=""> Drafs</a>
				</div>
				<div class="col-xs-8">
					<input type="text" name="search" value="Hue">
					<button>Search posts</button>
				</div>
			</div> -->
			<!-- <div class="row">
				<div class="col-xs-3">
					<form class="form-inline" role="form" action="" method="post">
		    			<div class="input-group"> 
							<div class="form-group">
					            <select class="form-control" name="category">
					                <option value="1">Xoá</option>
									<option>Sửa</option>
									<option>Bulk</option>
					            </select>           
				        	</div>
				        	<button type="submit" class="btn btn-primary">Áp dụng</button>
						</div>
					</form>
				</div>

				<div class="col-xs-7">
					<form class="form-inline" role="form"  action="" method="post">
		    			<div class="input-group"> 
							<div class="form-group">
					            <select class="form-control" name="category">
					                <option value="1">Tấc cả các ngày</option>
									<option> Tháng 7, 2014</option>
					            </select>
					            <select class="form-control" name="category">
					                <option value="1">Loại</option>
									<option> không phải </option>
								</select>        
					            <button type="submit" class="btn btn-primary">Lọc</button>   
				        	</div>
				        	
						</div>
					</form>
				</div>
				<div class="col-xs-2">
					bỏ 2 tab vào đây
				</div>
			</div> -->
			@if(Session::has("message"))
				<p>{{ Session::get('message')}}</p>
			@endif
			<div style="clear:both;"></div>
				<div class="table-responsive">
					<table class="table table-hover ">
						<thead>
						<tr>
							<th> <input type="checkbox" class="checkbox select-all" > </th>
							<th> ID </th>
							<th> Tên </th>
						</tr>
					</thead>
						<tbody>
						@if(!empty($results))
						@foreach($results as $category)
							<tr>
								<td><input type="checkbox" class="checkbox"></td>
								<td>{{$category->id}}</td>
								<td>{{$category->name}}
									<ul class="menu list-unstyled" role="menu">
                            			<li><a href="category/{{$category->id}}/edit">Edit</a></li>
                            			<li><a href="category/{{$category->id}}/delete">Delete</a></li>
                            		</ul>
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
				</div>
				
		</div>
	</div>
@endsection