<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Astronacci Database System</title>
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost:8000/images/favicon.png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="GLEvbF0GdlrKlaSMHDllsN2dyeLovZtbs4mJJvVd">

    <title>Laravel</title>

    <!-- Styles -->
    <link href="http://localhost:8000/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {"csrfToken":"GLEvbF0GdlrKlaSMHDllsN2dyeLovZtbs4mJJvVd"}    </script>
</head>
<body>
    <div style="margin-left: 200px;margin-right: 200px">
        <div>
    		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="color:red">Change Password</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>	
    	
    	<form method="post" action="{{route('insertpass')}}" style="margin-left: 50px;margin-right: 100px">
    		
    	
    		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Old Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="oldpassword" required>

                    @if ($errors->has('oldpassword'))
                        <span class="help-block">
                            <strong>{{ $errors->first('oldpassword') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
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
    		
    		{{ csrf_field() }}
    		
    		<input type="submit" class="btn btn-default" value="Confirm">
    	</form>
    </div>
</body>