@extends('main')

@section('title')
Admin > User | Thuna.vn
@endsection
@section('content')
<div class="row">
	<div class="col-xs-4">
		<a href="#" class="btn btn-info" data-toggle="modal" data-target="#myModalCreatUser">Create User</a>
		<button id="del_user" class="btn btn-danger" type="submit">Delete User</button>
	</div>
	<div class="col-xs-8">
		<form action="{{URL::to('admin/users/search')}}" method="post">
			<input type="text" class="form-control" name="key" placeholder="Enter user need search">
		</form>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		@if(isset($msg))
			<!-- <label class="error">{{$msg}}</label> -->
			<h3><span class="label label-success">{{$msg}}</span></h3>
		@endif
	</div>
</div>
<form action="dels" method="post" id="dels">
<table class="table table-striped">
	<thead>
		<th></th>
		<th>#</th>
		<th>Email</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Weddingdate</th>
		<th>Role</th>
	</thead>
	<tbody>
	@foreach($users as $index =>$user)
		<tr>
			<td>
				<input type="checkbox" value="{{$user->id}}">
				<input type="hidden" name="chk-{{$user->id}}" value="" >
			</td>
			<td>{{$index+1}}</td>
			<td id="email-user">{{$user->email}}
				<p>
					{{HTML::linkRoute('users/edit', 'Edit', $user->id)}}
					 | 
					<a href="#" data-toggle="modal" data-target="#myModalDeleteUser{{$index}}">Delete</a>
				</p>
			</td>
			<td>{{$user->firstname}}</td>
			<td>{{$user->lastname}}</td>
			<td>{{$user['weddingdate']}}</td>
			<td>{{$user['role_id']}}</td>

			<!-- Modal Delete User -->
			<div class="modal fade" id="myModalDeleteUser{{$index}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			        <h3 class="modal-title" id="myModalLabel">Delete User</h3>
			      </div>
			      <div class="modal-body">
			      	{{$user->email}}
			      </div>
			      <div class="modal-footer">
			      	<a href="{{URL::to('admin/users/delete', array('id'=>$user->id))}}">
			      		<button type="button" class="btn btn-primary">OK</button>
			      	</a>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- end modal delete user -->

		</tr>
	@endforeach()
	</tbody>
</table>
</form>
<div class="per_page">{{ $users->links() }}</div>

<!-- Modal Creat User -->

<div class="modal fade" id="myModalCreatUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myModalLabel">Creat User</h3>
      </div>
      <div class="modal-body">
        <form id="form_addUser" action="{{Asset('admin/users')}}" method="post">
		    <div class="row form-group">
				<div class="col-xs-6">
				   	<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name">
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-6">
				    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name">
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-6">
				    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
				    @if(isset($msg_check_email))
				    	<label class="error">{{$msg_check_email}}</label>
				    @endif
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-6">
				    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
				<div class="col-xs-6">
				    <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirm Password">
				</div>
				<div class="col-xs-6"></div>
			</div>
			<div class="row form-group">
		        <div class='col-sm-6'>
		            <div class='input-group date' id='datetimepicker5' data-date-format="YYYY/MM/DD">
		                <input type='date' class="form-control" name="weddingdate" id="weddingdate" placeholder="Weddingdate" />
		                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
		                </span>
		            </div>
		        </div>
		    </div>
		  	<div class="row form-group">
				<div class="col-xs-6">
				    <input type="number" class="form-control" name="role" placeholder="Role">
				    <p><h5>1: admin, 2: user, 3: guess</h5></p>
				</div>
			</div>
		  	<div class="row form-group">
		  		<div class="col-xs-6">
		  			<button type="reset" class="btn btn-default">Reset</button>
			    	<button type="submit" class="btn btn-primary" id="submit_add">OK</button>
		  		</div>
		  	</div>

		</form>
    </div> <!-- end modal body -->
</div> <!-- end modal content -->
</div> <!-- end modal dialog -->
</div> <!-- end modal fade -->
<!-- end modal creat user -->

<!-- script of validate -->
<script type="text/javascript">
	$("#form_addUser").validate({
		rules:{
			email:{
				required:true,
				email:true,
				remote:{
					url:"{{URL::route('check_email')}}",
					type:"post"
				}
			},
			password:{
				required:true,
				minlength:3
			},
			password_confirm:{
				equalTo:"#password"
			},
			role:{
				required:true
			}
		},
		messages:{
			email:{
				required: "Please, enter email of user!",
				email: "Format email not true!",
				remote: "Email had!"
			},
			password:{
				required:"Please, enter password for user!",
				minlength:"Length than 3 word!"
			},
			password_confirm:{
				equalTo:"Confirm password not true!"
			},
			role:{
				required:"Please, choosse role for user!"
			}
		}
	});
</script>

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
		$('#del_user').click(function(){
			if ($i<1) {
				alert('You must check user need delete!');
				return false;
			}else{
				$("#dels").submit();
			}
		});
	});
</script>

@endsection