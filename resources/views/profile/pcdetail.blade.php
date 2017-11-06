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
	
<!--	<script src="{{ URL::asset('js/loader.js') }}"></script>	-->

    <script src="{{ URL::asset('js/astronacci.js') }}"></script>

</head>
<body style="overflow-x:hidden;  background-image: url('{{ URL::asset('images/swirl_pattern1.png') }}') ;">
    <div id="wrapper" style="margin:15px">
    	<div class="row">
    		<div class="col-lg-12">
    			<h1>Profile</h1>
    		</div>
    		<!-- /.col-lg-12 -->
    	</div>
    </div>
	               <?php
                    if($route == "CAT") $userid = "cat_user_id";
                    else if ($route == "AClub") $userid = "user_id";
                    else if ($route == "MRG") $userid = "account";
                    else if ($route == "UOB") $userid = "client_id";
                    else if ($route == "green") $userid = "green_id";
                    else if ($route == "grow") $userid = "grow_id";
                    else if ($route == "RedClub") $userid = "username";
                    else if ($route == "assigngreen") $userid = "green_assign_id";
                    else if ($route == "assigngrow") $userid = "grow_assign_id";
                    else if ($route == "assignredclub") $userid = "redclub_assign_id";
                    else if ($route == "detail") $userid = "master_id";
                ?>
                
    <div class="panel panel-default" style="margin:15px">
        <div class="panel-heading">
            <i class="fa fa-child fa-fw"></i> Basic Information 
			<button class="btn btn-default" id="hide" style="margin-left:30px"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
			<button class="btn btn-danger" id="show" style="margin-left:30px;display:none"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
            <button class="btn btn-default" onclick="del()" style="margin:10px;" href="{{route($route . '.deleteclient', ['id' => $client->$userid])}}"> Delete Client </button>
        </div>
		
        <div class="panel-body">
			<div id="bod1">
				<div class="form-group">
                    <!-- Menuliskan tiap Judul atribut (key) dan isinya (value) -->
                    
                        @foreach ($heads as $key => $value)
                            <div class="col-lg-2" style="height:30px">
                                <label>{{$key}}</label>
                            </div>
                            <div class="col-lg-10" style="height:30px">
                                : {{$client->$value}}<br>
                            </div>
                        @endforeach
				</div>

			</div>

             <div id="bod2" style="display:none">
                <form role="form" method="post" action="{{route($route . '.edit')}}">
                    <div class="form-group">
                        <input name="user_id" type="hidden" value="{{$client->$userid}}">
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
                    @if (($route != "green") and ($route != 'assigngreen') and ($route != 'assigngrow') and ($route != 'assignredclub'))
                        <input type="hidden" name="all_pc_id" value="{{$client->all_pc_id}}">
                    @elseif ($route == 'assigngrow')
                        <input type="hidden" name="grow_assign_id" value="{{$client->grow_assign_id}}">
                        <input type="hidden" name="grow_assign_id" value="{{$client->grow_id}}">
                    @elseif ($route == 'assigngreen')
                        <input type="hidden" name="green_assign_id" value="{{$client->green_assign_id}}">
                        <input type="hidden" name="green_assign_id" value="{{$client->green_id}}">
                    @elseif ($route == 'assignredclub')
                        <input type="hidden" name="redclub_assign_id" value="{{$client->redclub_assign_id}}">
                    @endif
                </form>
            </div> 
			
		</div>
        @if($aclub)
            <a class="btn btn-default" style="margin:10px;" href="{{route('AClub.detail', ['id' => $aclub->master_id])}}" target="_blank"> AClub </a>
        @endif
        @if($mrg)
        <a class="btn btn-default" style="margin:10px;" href="{{route('MRG.detail', ['id' => $mrg->master_id])}}" target="_blank"> MRG </a>
        @endif
        @if($cat)
        <a class="btn btn-default" style="margin:10px;" href="{{route('CAT.detail', ['id' => $cat->user_id])}}" target="_blank"> CAT </a>
        @endif
        @if($uob)
        <a class="btn btn-default" style="margin:10px;" href="{{route('UOB.detail', ['id' => $uob->client_id])}}" target="_blank"> UOB </a>
        @endif 
    </div>

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
