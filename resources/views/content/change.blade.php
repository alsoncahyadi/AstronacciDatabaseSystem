@extends('layouts.logged')
@section('content')
	<div>
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:red">Change Password</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>	
	
	<form method="post" action="{{route('insertpass')}}">
		
	
		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Old Password</label>

            <div class="col-md-6">
                <input id="oldpassword" type="password" class="form-control" name="oldpassword" required>

                @if ($errors->has('oldpassword'))
                    <span class="help-block">
                        <strong>{{ $errors->first('oldpassword') }}</strong>
                    </span>
                @endif

            </div>
            <br><br>
            <br>
    		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">New Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
        </div>
		
		{{ csrf_field() }}
		
		<input type="submit" class="btn btn-default" value="Confirm">
	</form>

@endsection
