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

    <script src="{{ URL::asset('js/astronacci.js') }}"></script>

</head>
<body style="overflow-x:hidden;  background-image: url('{{ URL::asset('images/swirl_pattern1.png') }}') ;">
    <div id="wrapper" style="margin:15px">

	<div class="row">
		<div class="col-lg-12">
			<h1>Add Transaction</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
    </div>

    @if(($route == "CAT") || ($route == "AClub"))
    <div class="panel panel-default" style="margin:15px">
        <div class="panel-heading">
            <i class="fa fa-money fa-fw"></i> Transactions
        </div>
        <div class="panel-body">
           
           <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#addcli">Add New Transaction</a>
           <div id="addcli" class="panel-collapse collapse">
            <div class="panel-body">
                <form method="post" action="{{route($route . '.inserttrans')}}">
                    @if ($route == "CAT")
                        <input name="user_id" type="hidden" value="{{$client->cat_user_id}}">
                    @elseif ($route == "AClub")
                        <input name="user_id" type="hidden" value="{{$client->user_id}}">
                    @endif
                    @foreach ($insreg as $atr)
                    <div class="form-group">
                        <label>{{$atr}}</label>
                        <input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                    </div>
                    @endforeach
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                    <input type="submit" class="btn btn-default" value="Insert">
                    <button type="reset" class="btn btn-default">Reset Form</button>
                </form>
            </div>
        </div>

        <br>
        <br>

    </div>
    </div>
    @endif
	<br><br>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <h4>{{$error}}</h4>
        @endforeach
    @endif
	
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
		$("delete").click(function(){
			$("#delete").hide();
			$("#condel").show();
			
		});
	});
	function del(){
		if (confirm('Data will be lost permanently. Are you sure you want to delete this client?'))
			window.location.replace("{{route($route . '.deleteclient', ['id' => $client->$userid])}}");

	}
	</script>
</body>
</html>
