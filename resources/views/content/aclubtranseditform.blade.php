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
			<h1>AClub Transaction</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
    </div>

    <div class="panel panel-default" style="margin:15px">
        <div class="panel-heading">
            <i class="fa fa-child fa-fw"></i> Edit Transaction 
        </div>
        <div class="panel-body">
           
            <div class="panel-body">
                <form role="form" method="post" action="{{route($route . '.edittrans')}}">
                        <div class="form-group">
                            <!-- Menuliskan input untuk setiap judul (key) dan data saat ini (value) -->
                                    @foreach ($ins as $key => $value)
                                        <div style="height:60px">
                                            <label>{{$key}}</label>
                                            @if (($key == "Keterangan") || ($key == "Sumber Data") || ($key == "User ID") || ($key == "Sales"))
                                                <input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $key)).'_aclub'}}">

                                            @elseif ($key == "Kode")
                                                <select class="form-control" id="kode" name="{{strtolower(str_replace(' ', '_', $key))}}">
                                                    @if ($client->group == 'F' | $client->group == 'Future')
                                                        <option selected="selected">FS</option>
                                                        <option>FG</option>
                                                        <option>FP</option>                                    
                                                    @elseif ($client->group == 'S' | $client->group == 'Stock')
                                                        <option selected="selected">SS</option>
                                                        <option>SG</option>
                                                        <option>SP</option> 
                                                    @elseif ($client->group == 'RD')
                                                        <option selected="selected">RD</option>
                                                    @else
                                                        <option selected="selected">SS</option>
                                                        <option>FS</option>
                                                        <option>SG</option>
                                                        <option>FG</option>
                                                        <option>SP</option> 
                                                        <option>FP</option>
                                                        <option>RD</option>
                                                    @endif
                                                </select>
                                            @elseif ($key == "Status")
                                                <select class="form-control" name="{{strtolower(str_replace(' ', '_', $key)).'_aclub'}}">
                                                    <option selected="selected">Baru</option>
                                                    <option>Perpanjang</option>
                                                    <option>Tidak Aktif</option>
                                                </select>
                                            @elseif ($key == "Start Date")
                                                <input class="form-control no-spin" type="date" id="startdate" name="{{strtolower(str_replace(' ', '_', $key))}}">
                                            @elseif ($key == "Expired Date")
                                                <input class="form-control no-spin" type="date" id="expireddate" name="{{strtolower(str_replace(' ', '_', $key))}}" readonly>
                                            @elseif ($key == "Masa Tenggang")
                                                <input class="form-control no-spin" type="date" id="masatenggang" name="{{strtolower(str_replace(' ', '_', $key))}}">
                                            @elseif ($key == "Yellow Zone")
                                                <input class="form-control no-spin" type="date" id="yellowzone" name="{{strtolower(str_replace(' ', '_', $key))}}" readonly>
                                            @elseif ($key == "Red Zone")
                                                <input class="form-control no-spin" type="date" id="redzone" name="{{strtolower(str_replace(' ', '_', $key))}}" readonly>
                                            @else
                                                <input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $key))}}">
                                            @endif
                                        </div>
                                    @endforeach
                            
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                        <input type="hidden" name="user_id" value="{{$client->transaction_id}}">
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
    // ======================================================================================================
    // RUMUS ACLUB
    $( "#startdate" ).change(function() {
        document.getElementById("expireddate").value = document.getElementById("startdate").value;
        if (document.getElementById("kode").value == "SS" || document.getElementById("kode").value == "FS") {
            document.getElementById("expireddate").stepUp(30);
        } else if (document.getElementById("kode").value == "SG" || document.getElementById("kode").value == "FG"){
            document.getElementById("expireddate").stepUp(180);
        } else if (document.getElementById("kode").value == "SP" || document.getElementById("kode").value == "FP" || document.getElementById("kode").value == "RD"){
            document.getElementById("expireddate").stepUp(365);
        } 
        document.getElementById("masatenggang").value = document.getElementById("expireddate").value;
        document.getElementById("yellowzone").value = document.getElementById("masatenggang").value;
        document.getElementById("redzone").value = document.getElementById("masatenggang").value;
        document.getElementById("yellowzone").stepDown(3);
        document.getElementById("redzone").stepUp(3);
    });

    $( "#startdate" ).change(function() {
        document.getElementById("expireddate").value = document.getElementById("startdate").value;
        if (document.getElementById("kode").value == "SS" || document.getElementById("kode").value == "FS") {
            document.getElementById("expireddate").stepUp(30);
        } else if (document.getElementById("kode").value == "SG" || document.getElementById("kode").value == "FG"){
            document.getElementById("expireddate").stepUp(180);
        } else if (document.getElementById("kode").value == "SP" || document.getElementById("kode").value == "FP" || document.getElementById("kode").value == "RD"){
            document.getElementById("expireddate").stepUp(365);
        } 
        document.getElementById("masatenggang").value = document.getElementById("expireddate").value;
        document.getElementById("yellowzone").value = document.getElementById("masatenggang").value;
        document.getElementById("redzone").value = document.getElementById("masatenggang").value;
        document.getElementById("yellowzone").stepDown(3);
        document.getElementById("redzone").stepUp(3);
    });

    $( "#kode" ).change(function() {
        document.getElementById("expireddate").value = document.getElementById("startdate").value;
        if (document.getElementById("kode").value == "SS" || document.getElementById("kode").value == "FS") {
            document.getElementById("expireddate").stepUp(30);
        } else if (document.getElementById("kode").value == "SG" || document.getElementById("kode").value == "FG"){
            document.getElementById("expireddate").stepUp(180);
        } else if (document.getElementById("kode").value == "SP" || document.getElementById("kode").value == "FP" || document.getElementById("kode").value == "RD"){
            document.getElementById("expireddate").stepUp(365);
        } 
        document.getElementById("masatenggang").value = document.getElementById("expireddate").value;
        document.getElementById("yellowzone").value = document.getElementById("masatenggang").value;
        document.getElementById("redzone").value = document.getElementById("masatenggang").value;
        document.getElementById("yellowzone").stepDown(3);
        document.getElementById("redzone").stepUp(3);

        if (document.getElementById("kode").value == "SS" || document.getElementById("kode").value == "SG" || document.getElementById("kode").value == "SP") {
            document.getElementById("group").value = "Stock";
        } else if (document.getElementById("kode").value == "FS" || document.getElementById("kode").value == "FG" || document.getElementById("kode").value == "FP") {
            document.getElementById("group").value = "Future";
        } else if (document.getElementById("kode").value == "RD") {
            document.getElementById("group").value = "RD";
        }       
    });

    $( "#masatenggang" ).change(function() {
        document.getElementById("yellowzone").value = document.getElementById("masatenggang").value;
        document.getElementById("redzone").value = document.getElementById("masatenggang").value;
        document.getElementById("yellowzone").stepDown(3);
        document.getElementById("redzone").stepUp(3);
    });
    // ======================================================================================================
	</script>
</body>
</html>
