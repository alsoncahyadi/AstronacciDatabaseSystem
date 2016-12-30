<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Astronacci Database System</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ URL::asset('css/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/select.dataTables.min.css') }}" rel="stylesheet">
	    <!-- Scripts -->
	<!-- jQuery -->

    <script src="{{ URL::asset('js/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('js/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ URL::asset('js/metisMenu/metisMenu.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ URL::asset('js/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::asset('js/morrisjs/morris.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ URL::asset('js/sb-admin-2.js') }}"></script>
	<script src="{{ URL::asset('js/datatables/js/jquery.dataTables.min.js') }}"></script>
	
<!--	<script src="{{ URL::asset('js/loader.js') }}"></script>	-->

    <script src="{{ URL::asset('js/astronacci.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body style="overflow-x:hidden">
    <div id="wrapper" style="margin:15px">

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Profile</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<script>
	$(document).ready(function(){
		$("#hide").click(function(){
			$("#bod1").hide();
			$("#bod2").show();
			$("#hide").hide();
			$("#show").show();
			
		});
		$("#show").click(function(){
			$("#bod2").hide();
			$("#bod1").show();
			$("#show").hide();
			$("#hide").show();
		});
	});
	</script>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-child fa-fw"></i> Basic Information 
			<button class="btn btn-default" id="hide" style="margin-left:30px"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
			<button class="btn btn-danger" id="show" style="margin-left:30px;display:none"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
        </div>
		
        <div class="panel-body" >
			<div id="bod1">
				<div class="form-group">
                    @foreach ($heads as $key => $value)
                        <div class="col-lg-2" style="height:30px">
                            <label>{{$key}}</label>
                        </div>
						<div class="col-lg-10" style="height:30px">
							: {{$client->$value}}<br>
						</div>
                    @endforeach
                    @if(($route == "CAT") || ($route == "AClub"))
                        <hr>
                        <H3>REGISTRASI</H3><br>
                        @foreach ($insreg as $keyreg => $value)
							<div class="col-lg-2" style="height:30px">
								<label>{{$keyreg}}</label>
							</div>
							<div class="col-lg-10" style="height:30px">
								: {{$clientreg->$value}}<br>
							</div>
                        @endforeach
                    @endif
				</div>
			</div>
			<div id="bod2" style="display:none">
				<form role="form" method="post" action="{{route($route . '.edit')}}">
					<div class="form-group">
						
                        @foreach ($ins as $key => $value)
                            <div style="height:60px">
                                <label>{{$key}}</label>
                                <input class="form-control" value="{{$client->$value}}" name="{{$value}}">
                            </div>
                        @endforeach
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                    @if ($route != "green")
                        <input type="hidden" name="all_pc_id" value="{{$client->all_pc_id}}">
                    @endif
				</form>
			</div> 
		</div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-money fa-fw"></i> Transactions
        </div>
        <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="trans">
            <thead>
				<tr>
				
					<th> head </th>
					<th> head2</th>
					<th> head3</th>
				
					
				</tr>
            </thead>
			<tbody>
			
				<tr class="gradeA">
				
                    
                        <td> tes </td>
                        <td> tes2 </td>
                        <td> tes3 </td>
                    
				
				</tr>
			
			</tbody>
		</table>
        </div>
        <!-- /.panel-body -->
    </div>
    

	<br><br>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <h4>{{$error}}</h4>
        @endforeach
    @endif
	
</div>

</body>
</html>
