@extends('layouts.logged')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header" style="color:red">Manage Users</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-child fa-fw"></i> Users
		<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="button turquoise" style="text-align: center; margin:0px; margin-left:50px"><span>+</span>New User</a>

	</div>
	<script>
		
		function checkChange(idx) {
			var ashopcb = document.getElementById("ashop"+idx);
			var greencb = document.getElementById("green"+idx);
			var rolesel = document.getElementById("roles"+idx);
			if ((ashopcb.checked != ashopcb.defaultChecked)||(greencb.checked != greencb.defaultChecked)||(!rolesel.options[rolesel.selectedIndex].defaultSelected)) {
				document.getElementById("ischanged"+idx).checked = true;
				if (!document.getElementById("isdel"+idx).checked) {
					document.getElementById(idx).style.backgroundColor = "yellow";
				}
			}
			else {
				document.getElementById("ischanged"+idx).checked = false;
				if (!document.getElementById("isdel"+idx).checked) {
					if (idx % 2 == 0){
						document.getElementById(idx).style.backgroundColor = "white";
					} else {
						document.getElementById(idx).style.backgroundColor = "#e7e7e7";
					}
				}
			}
		}
		function checkDel(idx) {
			var seldel = document.getElementById("isdel"+idx);
			var delbut = document.getElementById("delbut"+idx);
			if (seldel.checked) {				
				seldel.checked = false;
				delbut.innerHTML = "<i class='fa fa-times'></i>";
				if (document.getElementById("ischanged"+idx).checked == true){
					document.getElementById(idx).style.backgroundColor = "yellow";
				} else
				if (idx % 2 == 0){
					document.getElementById(idx).style.backgroundColor = "white";
				} else {
					document.getElementById(idx).style.backgroundColor = "#e7e7e7";
				}
				
			}
			else {
				seldel.checked = true;
				delbut.innerHTML = "Undo";
				document.getElementById(idx).style.backgroundColor = "red";
			}
		}
	</script>
	<div id="collapseOne" class="panel-collapse collapse">
		<div class="panel-body">
			<form role="form" method="POST" action="{{ url('/register') }}">
				{{ csrf_field() }}

				<div style="height:60px" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="control-label">Username</label>
					<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="control-label">E-Mail Address</label>
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="control-label">Password</label>
					<input id="password" type="password" class="form-control" name="password" required>

					@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label for="password-confirm" class="control-label">Confirm Password</label>
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
				</div>
				<div class="form-group">
					<label for="ashop" class="control-label">A Shop Auth</label>
					<input name="ashop" value="0" type="hidden">
					<input id="ashop" type="checkbox" name="ashop" >
				</div>
				<div class="form-group">
					<label for="green" class="control-label">Green Auth</label>
					<input name="green" value="0" type="hidden">
					<input id="green" type="checkbox" name="green" >
				</div>
				<div class="form-group">
					<label for="role" class="control-label">Role</label>							
					<select id="role" class="form-control" name="role" required>
						<option value="0">Superadmin</option>
						<option value="1">A-CLUB admin</option>
						<option value="2">MRG admin</option>
						<option value="3">CAT admin</option>
						<option value="4">UOB admin</option>
						<option value="5">Sales</option>
					</select>
				</div>
				<div class="form-group">
					<label for="fullname" class="control-label">Fullname</label>					
					<input id="fullname" type="text" class="form-control" name="fullname" required>
				</div>
				<div class="form-group">
					<label for="phonenum" class="control-label">Phone number</label>					
					<input id="phonenum" type="text" class="form-control" name="phonenum">
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<button type="submit" class="btn btn-primary">
							Add User
						</button>
					</div>
				</div>
			</form>					
		</div>
	</div>
	<!-- /.panel-body -->
	<div class="panel-body">
		<form action="{{ route('admin.assign') }}" method="post">
			<table class="responstable" >

				<tr>            
					<th style="text-align:center;">Username</th>
					<th style="text-align:center;">Fullname</th>
					<th style="text-align:center;">Role</th>
					<th style="text-align:center;">A Shop</th>
					<th style="text-align:center;">Green</th>
					<th style="text-align:center;">Delete</th>
				</tr>

				<?php $idx = 0; ?>

				@foreach ($users as $user)
				@if (Auth::user()->username != $user->username)
				<tr id="{{$idx}}">
					<td><input id="ischanged{{ $idx }}" type="checkbox" style="display:none" name="ischanged{{ $idx }}"><b>{{ $user->username }}<input type="hidden" name="username{{ $idx }}" value="{{ $user->username }}"> </b></td>
					<td style="text-align:center"><b>{{ $user->fullname }}</b></td>
					<td><select id="roles{{ $idx }}" onchange="checkChange({{ $idx }})" name="roles{{ $idx }}">
						<option value="0" {{ $user->hasRole($user->username, '0') ? 'selected' : ''}} >Superadmin</option>
						<option value="1" {{ $user->hasRole($user->username, '1') ? 'selected' : ''}} >A-CLUB admin</option>
						<option value="2" {{ $user->hasRole($user->username, '2') ? 'selected' : ''}} >MRG admin</option>
						<option value="3" {{ $user->hasRole($user->username, '3') ? 'selected' : ''}} >CAT admin</option>
						<option value="4" {{ $user->hasRole($user->username, '4') ? 'selected' : ''}} >UOB admin</option>
						<option value="5" {{ $user->hasRole($user->username, '5') ? 'selected' : ''}} >Sales</option>
					</select></td>
					<td style="text-align:center;"><input id="ashop{{ $idx }}" onchange="checkChange({{ $idx }})" type="checkbox" {{ $user->hasAShop($user->username) ? 'checked' : ''}} name="ashop{{ $idx }}"></td>
					<td style="text-align:center;"><input id="green{{ $idx }}" onchange="checkChange({{ $idx }})" type="checkbox" {{ $user->hasGreen($user->username) ? 'checked' : ''}} name="green{{ $idx }}"></td>
					<td style="text-align:center;"><input id="isdel{{ $idx }}" type="checkbox" style="display:none" name="isdel{{ $idx }}"><button type="button" onclick="checkDel({{ $idx }})" id="delbut{{ $idx }}"><i class="fa fa-times"></i></button></td></td>
					{{ csrf_field() }}
				</tr>
				<?php $idx = $idx + 1; ?>
				@endif
				@endforeach
			</table>
			<br><br>
			<input type="hidden" name="numusers" value="{{ $idx }}">
			<button class="button turquoise" style="border: 0;" type="submit" name="assbut"><span>✎</span>Save</button>
		</form>
	</div>
	<!-- /.panel-body -->

</div>

@endsection
</html>
