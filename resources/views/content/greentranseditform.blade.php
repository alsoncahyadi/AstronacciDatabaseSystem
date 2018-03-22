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
			<h1>Green Progress</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
    </div>

    <div class="panel panel-default" style="margin:15px">
        <div class="panel-heading">
            <i class="fa fa-child fa-fw"></i> Edit Progress
        </div>
        <div class="panel-body">
           
            <div class="panel-body">
                <form role="form" method="post" action="{{route($route . '.edittrans')}}">
                        <div class="form-group">
                            <!-- Menuliskan input untuk setiap judul (key) dan data saat ini (value) -->
                            
                                    @foreach ($ins as $key => $value)
                                        <div style="height:60px">
                                            <label>{{$key}}</label>
                                            @if ($key == "Product Type")
                                                <select class="form-control" value="{{$client->$value}}" name="{{$value}}">
                                                    <option>Video</option>
                                                    <option>E-Book</option>
                                                    <option>Seasonal Report</option>
                                                    <option>Event</option>
                                                    <option>Other</option>
                                                </select>
                                            @elseif ($key == "Status")
                                                <select class="form-control" value="{{$client->$value}}" name="{{$value}}">
                                                    @if ($client->$value == "GOAL - BUY")
                                                        <option selected="selected">GOAL - BUY</option>
                                                        <option>GOAL - JOIN</option>
                                                        <option>NO ANSWER</option>
                                                        <option>TIDAK GOAL</option>
                                                        <option>DALAM PROSES</option>
                                                    @elseif ($client->$value == "GOAL - JOIN")
                                                        <option>GOAL - BUY</option>
                                                        <option selected="selected">GOAL - JOIN</option>
                                                        <option>NO ANSWER</option>
                                                        <option>TIDAK GOAL</option>
                                                        <option>DALAM PROSES</option>
                                                    @elseif ($client->$value == "NO ANSWER")
                                                        <option>GOAL - BUY</option>
                                                        <option>GOAL - JOIN</option>
                                                        <option selected="selected">NO ANSWER</option>
                                                        <option>TIDAK GOAL</option>
                                                        <option>DALAM PROSES</option>
                                                    @elseif ($client->$value == "TIDAK GOAL")
                                                        <option>GOAL - BUY</option>
                                                        <option>GOAL - JOIN</option>
                                                        <option>NO ANSWER</option>
                                                        <option selected="selected">TIDAK GOAL</option>
                                                        <option>DALAM PROSES</option>
                                                    @elseif ($client->$value == "DALAM PROSES")
                                                        <option>GOAL - BUY</option>
                                                        <option>GOAL - JOIN</option>
                                                        <option>NO ANSWER</option>
                                                        <option>TIDAK GOAL</option>
                                                        <option selected="selected">DALAM PROSES</option>
                                                    @endif
                                                </select>
                                            @elseif ($key == "Nama Product")
                                                <select class="form-control" value="{{$client->$value}}" name="{{$value}}">
                                                @if ($client->$value == "A-Club")
                                                        <option selected="selected">A-CLUB</option>
                                                        <option>UOB</option>
                                                        <option>MRG</option>
                                                        <option>CAT</option>
                                                    @elseif ($client->$value == "UOB")
                                                        <option>A-CLUB</option>
                                                        <option selected="selected">UOB</option>
                                                        <option>MRG</option>
                                                        <option>CAT</option>
                                                    @elseif ($client->$value == "MRG")
                                                        <option>A-CLUB</option>
                                                        <option>UOB</option>
                                                        <option selected="selected">MRG</option>
                                                        <option>CAT</option>
                                                    @elseif ($client->$value == "CAT")
                                                        <option>A-CLUB</option>
                                                        <option>UOB</option>
                                                        <option>MRG</option>
                                                        <option selected="selected">CAT</option>
                                                    @endif
                                                </select>
                                            @elseif ($key == "Date")
                                                <input class="form-control no-spin" value="{{$client->$value}}" type="date" name="{{$value}}">
                                            @else
                                               <input class="form-control" value="{{$client->$value}}" name="{{$value}}">
                                            @endif
                                        </div>
                                    @endforeach
                            
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                        <input type="hidden" name="user_id" value="{{$client->progress_id}}">
                    </form>
            </div>

        <br>
        <br>

    </div>
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
	</script>
</body>
</html>
