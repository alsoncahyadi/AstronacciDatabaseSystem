@extends('layouts.prelog')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ashop" class="col-md-4 control-label">A Shop Auth</label>

                            <div class="col-md-6">
								<input name="ashop" value="0" type="hidden">
                                <input id="ashop" type="checkbox" class="form-control" name="ashop" style="width:25px; height:25px;">
                            </div>
                         </div>

                         <div class="form-group">
                            <label for="green" class="col-md-4 control-label">Green Auth</label>

                            <div class="col-md-6">
                                <input name="green" value="0" type="hidden">
                                <input id="green" type="checkbox" class="form-control" name="green" style="width:25px; height:25px;">
                            </div>
                         </div>

						<div class="form-group">
                            <label for="role" class="col-md-4 control-label">Role</label>

                            <div class="col-md-6">								
                                <input id="role" type="text" class="form-control" value="5" name="role" required>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="fullname" class="col-md-4 control-label">Fullname</label>

                            <div class="col-md-6">								
                                <input id="fullname" type="text" class="form-control" name="fullname" required>
                            </div>
                        </div>
						
						<div class="form-group">
								<label for="phonenum" class="col-md-4 control-label">Phone number</label>	
								<div class="col-md-6">								
									<input id="phonenum" type="text" class="form-control" name="phonenum">
								</div>
						</div>
						
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
