<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif


            <div class="content">
                <div class="title m-b-md">
                    List of user and roles
                </div>
            
			<!-- CORE CONTENT FOR LIST USER MANAGEMENT -->
			
			<script>
				function checkChange(idx) {
					var ashopcb = document.getElementById("ashop"+idx);
					var rolesel = document.getElementById("roles"+idx);
					if ((ashopcb.checked != ashopcb.defaultChecked)||(!rolesel.options[rolesel.selectedIndex].defaultSelected)) {
						document.getElementById("ischanged"+idx).checked = true;				
					}
					else {
						document.getElementById("ischanged"+idx).checked = false;
					}
				}
			</script>
			
            <table>
			<form action="{{ route('admin.assign') }}" method="post">
            <tr>            
            <th>Username</th>
			<th>Fullname</th>
            <th>Role</th>
            <th>A Shop</th>
            </tr>
			
			<?php $idx = 0; ?>
			
            @foreach ($users as $user)
            <tr>			
				<td style="color:black"><input id="ischanged{{ $idx }}" type="checkbox" style="display:none" name="ischanged{{ $idx }}"><b>{{ $user->username }}<input type="hidden" name="username{{ $idx }}" value="{{ $user->username }}"> </b></td>
				<td style="color:black"><b>{{ $user->fullname }}</b></td>
				<td><select id="roles{{ $idx }}" onchange="checkChange({{ $idx }})" name="roles{{ $idx }}">
					<option value="0" {{ $user->hasRole($user->username, '0') ? 'selected' : ''}} >Superadmin</option>
					<option value="1" {{ $user->hasRole($user->username, '1') ? 'selected' : ''}} >A-CLUB admin</option>
					<option value="2" {{ $user->hasRole($user->username, '2') ? 'selected' : ''}} >MRG admin</option>
					<option value="3" {{ $user->hasRole($user->username, '3') ? 'selected' : ''}} >CAT admin</option>
					<option value="4" {{ $user->hasRole($user->username, '4') ? 'selected' : ''}} >UOB admin</option>
					<option value="5" {{ $user->hasRole($user->username, '5') ? 'selected' : ''}} >Sales</option>
				</select></td>
				<td><input id="ashop{{ $idx }}" onchange="checkChange({{ $idx }})" type="checkbox" {{ $user->hasAShop($user->username) ? 'checked' : ''}} name="ashop{{ $idx }}"></td>
				<td><button type="submit" name="delbut" value="{{ $idx }}">Delete</button></td>
					{{ csrf_field() }}
				<br>				
            </tr>
			<?php $idx = $idx + 1; ?>
            @endforeach
			<tr>
			<input type="hidden" name="numusers" value="{{ $idx }}">
			<button type="submit" name="assbut">Assign Roles</button>
			</tr>
			</form>
            </table>
			
			<!-- ------------------------------------ -->
			
            </div>
        </div>

    </body>
</html>