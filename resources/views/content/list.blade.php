@extends('layouts.logged')
@section('content')
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Setting</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<link href="{{ URL::asset('css/styling.css') }}" rel="stylesheet">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-child fa-fw"></i> Users
                </div>
                <div class="panel-body">
				
					<table class="responstable">
						<tr>            
						<th>Username</th>
						<th>Fullname</th>
						<th>Role</th>
						<th>A Shop</th>
						<th>Assign</th>
						</tr>
						@foreach ($users as $user)
						<tr>
						<form action="{{ route('admin.assign') }}" method="post">
							<td style="color:black"><b>{{ $user->username }}<input type="hidden" name="username" value="{{ $user->username }}"> </b></td>
							<td style="color:black"><b>{{ $user->fullname }}</b></td>
							<td><select name="roles">
								<option value="0" {{ $user->hasRole($user->username, '0') ? 'selected' : ''}} >Superadmin</option>
								<option value="1" {{ $user->hasRole($user->username, '1') ? 'selected' : ''}} >A-Club admin</option>
								<option value="2" {{ $user->hasRole($user->username, '2') ? 'selected' : ''}} >MRG admin</option>
								<option value="3" {{ $user->hasRole($user->username, '3') ? 'selected' : ''}} >CAT admin</option>
								<option value="4" {{ $user->hasRole($user->username, '4') ? 'selected' : ''}} >UOB admin</option>
								<option value="5" {{ $user->hasRole($user->username, '5') ? 'selected' : ''}} >Sales</option>
							</select></td>
							<td><input type="checkbox" {{ $user->hasAShop($user->username) ? 'checked' : ''}} name="ashop"></td>
								{{ csrf_field() }}
							<td><button type="submit">Assign Roles</button></td>
							<br>
						</form>
						</tr>
						@endforeach
					</table>
                    <br><br>
                    <a href="#" class="button turquoise" style="text-align: center"><span>✎</span>Edit</a>
                    <a href="#" class="button turquoise" style="text-align: center"><span>✗</span>Delete</a>
                    <a href="/adduser" class="button turquoise" style="text-align: center"><span>+</span>New User</a>
                </div>
                <!-- /.panel-body -->
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-gears fa-fw"></i> Other Settings
                </div>
                <div class="panel-body">
                    
                </div>
                <!-- /.panel-body -->
            </div>
	
	
@endsection
</html>
