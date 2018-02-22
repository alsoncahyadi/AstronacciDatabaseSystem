<!DOCTYPE html>
<html lang="en">


<!-- profile -->
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body style="overflow-x:hidden;  background-image: url('{{ URL::asset('images/swirl_pattern1.png') }}') ;">
    <div id="wrapper" style="margin:15px">

	<div class="row">
		<div class="col-lg-12">
			<h1>{{$route}} Profile</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
    </div>
    <?php
    if($route == "CAT") $userid = "user_id";
    else if ($route == "AClub") $userid = "master_id";
    else if ($route == "MRG") $userid = "master_id";
    else if ($route == "UOB") $userid = "client_id";
    else if ($route == "Green") $userid = "green_id";
    else if ($route == "grow") $userid = "grow_id";
    else if ($route == "RedClub") $userid = "username";
    else if ($route == "assigngreen") $userid = "green_assign_id";
    else if ($route == "assigngrow") $userid = "grow_assign_id";
    else if ($route == "assignredclub") $userid = "redclub_assign_id";
    else if ($route == "AShop") $userid = "master_id";
    ?>
    <div class="panel panel-default" style="margin:15px">
        <div class="panel-heading">
            <i class="fa fa-child fa-fw"></i> Basic Information 
			<button class="btn btn-default" id="hide" style="margin-left:30px"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
			<button class="btn btn-danger" id="show" style="margin-left:30px;display:none"><i class="fa fa-pencil-square-o"></i> Edit </a></button>

                <form action="{{route($route . '.deleteclient', ['id' => $client->$userid])}}" method="post" onsubmit="return del()" style="display: inline-block">
                    <input type="hidden" name="_method" value="DELETE" >
                    <input class="btn btn-default" type="submit" value="Delete Client" >
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                </form>

                <a href="{{route('home')}}"><button type="button" class="btn btn-default">Back</button></a>
                
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
                        <input name="user_id" type="hidden" value="{{$client->$userid}}">
                        @if ($route == "CAT")
                            <input name="user_id" type="hidden" value="{{$client->cat_user_id}}">
                        @elseif ($route == "AClub")
                            <input name="user_id" type="hidden" value="{{$client->user_id}}">
                        @elseif ($route == "MRG")
                            <input name="user_id" type="hidden" value="{{$client->master_id}}">
                        @endif
                        <div class="form-group">
                            <!-- Menuliskan input untuk setiap judul (key) dan data saat ini (value) -->
                            
                                    @foreach ($ins as $key => $value)
                                        <div style="height:60px">
                                            <label>{{$key}}</label>
                                            @if ($key == "Tanggal Lahir")
                                                <input class="form-control no-spin" type="date" name="{{$value}}" value="{{$client->$value}}"> 
                                            @elseif ($key == "Jenis Kelamin")
                                                <select class="form-control" name="{{$value}}" value="{{$client->$value}}">
                                                    <option>M</option>
                                                    <option>F</option>
                                                </select>
                                            @else
                                                <input class="form-control" value="{{$client->$value}}" name="{{$value}}">
                                            @endif
                                        </div>
                                    @endforeach
                            
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                        @if (($route != "Green") and ($route != 'assigngreen') and ($route != 'assigngrow') and ($route != 'assignredclub'))
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

     </div>

     <div class="panel panel-default" style="margin:15px">
        @if ($route == 'Green')
            <div class="panel-heading">
                <i class="fa fa-money fa-fw"></i> Progresses
            </div>
        @else
            <div class="panel-heading">
                <i class="fa fa-money fa-fw"></i> Transactions
            </div>
        @endif
        <div class="panel-body">
            @if ($route == 'Green')
                <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#addcli">Add New Progress</a>
            @else
                <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#addcli">Add New Transaction</a>
            @endif
            <div id="addcli" class="panel-collapse collapse">
                <div class="panel-body">
                    <form method="post" action="{{route($route . '.inserttrans')}}">
                        <input name="user_id" type="hidden" value="{{$client->$userid}}">
                        @foreach ($insreg as $atr)
                        <div class="form-group">
                            <label>{{$atr}}</label>
                            @if ($atr == "Product Type")
                            <select class="form-control" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                                <option>Video</option>
                                <option>E-Book</option>
                                <option>Seasonal Report</option>
                                <option>Event</option>
                                <option>Other</option>
                            </select>
                            @elseif ($atr == "Status")
                            <select class="form-control" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                                <option>GOAL - BUY</option>
                                <option>GOAL - JOIN</option>
                                <option>NO ANSWER</option>
                                <option>TIDAK GOAL</option>
                                <option>DALAM PROSES</option>
                            </select>
                            @elseif (($atr == "Nama Product") and ($route == 'Green'))
                            <select class="form-control" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                                <option>A-Club</option>
                                <option>UOB</option>
                                <option>MRG</option>
                                <option>CAT</option>
                            </select>
                            @elseif ($atr == "Date")
                                <input class="form-control no-spin" type="date" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                            @else
                                <input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                            @endif
                        </div>
                        @endforeach
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                        <input type="submit" class="btn btn-primary" value="Insert">
                        <button type="reset" class="btn btn-default">Reset Form</button>
                    </form>
                </div>
                <br>
            </div>
            <br><br>
            <table width="100%" class="table table-striped table-bordered table-hover" id="trans">
                <thead>
                    <tr>
                        @foreach ($headsreg as $headreg)
                        <th> {{$headreg}} </th>
                        @endforeach
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientsreg as $clientreg)
                    
                    <tr class="gradeA">
                        <?php $count_temp = 1 ; ?>
                        @foreach ($attsreg as $attreg)
                        @if ($route == 'AClub')
                        <td> <a target="_blank" href="{{route('AClub.member',['id' => $client->master_id, 'package' => $clientreg->user_id])}}">{{$clientreg->$attreg}} </a></td>
                        @elseif ($route == 'Green')
                        <td> <a target="_blank" href="{{route('Green.trans',['id' => $client->green_id, 'progress' => $clientreg->progress_id])}}">{{$clientreg->$attreg}} </a>
                            @if ($count_temp == 1)
                            <div class="btn-hvr-container">
                                <a href="{{route('Greentrans.edit', ['id' => $clientreg->progress_id])}}" class="btn btn-primary hvr-btn">edit</a>
                                <form action="{{route('Green.deletetrans', ['id' => $clientreg->progress_id])}}" method="post" onsubmit="return delTrans()">
                                    <input type="hidden" name="_method" value="DELETE" >
                                    <input class="btn btn-primary hvr-btn" type="submit" value="delete" >
                                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                </form>
                            </div>
                        </td>
                        <?php $count_temp++ ; ?>
                        @else
                    </td>
                    @endif
                    @elseif ($route == 'MRG')
                    <td> <a target="_blank" href="{{route('MRG.account',['id' => $client->master_id, 'account' => $clientreg->accounts_number])}}">{{$clientreg->$attreg}} </a></td>
                    @else
                    <td> <a target="_blank" href="{{route('AShop.trans',['id' => $client->master_id, 'transaction' => $clientreg->transaction_id])}}">{{$clientreg->$attreg}} </a>
                        @if ($count_temp == 1)
                        <div class="btn-hvr-container">
                            <a href="{{route('AShoptrans.edit', ['id' => $clientreg->transaction_id])}}" class="btn btn-primary hvr-btn">edit</a>
                            <form action="{{route('AShop.deletetrans', ['id' => $clientreg->transaction_id])}}" method="post" onsubmit="return delTrans()">
                                <input type="hidden" name="_method" value="DELETE" >
                                <input class="btn btn-primary hvr-btn" type="submit" value="delete" >
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                            </form>
                        </div>
                    </td>
                    <?php $count_temp++ ; ?>
                    @else
                </td>
                @endif
            </td>
            @endif

            @endforeach

        </tr>
        @endforeach
    </tbody>
</table>
<div id="pageController" style="margin-left: 2px; margin-top: 12px;">
    Page
    <input id="pagenum" type="number" name="pagenum" value="{{ (isset($page) ? $page : 1 )}}" min="1" max="{{ (isset($count) ? $count : "" )}}">
    /<label id="page_count">{{ (isset($count) ? $count : "" )}}</label>
    <button id="page_number" onclick="window.location.href = window.location.pathname + '?page=' + document.getElementById('pagenum').value">Go</button>
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
        if (confirm('Data will be lost permanently. Are you sure you want to delete this client?')) {
            return true;
        } else {
            return false;
        }
    }
	function delTrans(){
        if (confirm('Data will be lost permanently. Are you sure you want to delete this transaction?')) {
            return true;
        } else {
            return false;
        }
	}
</script>



</body>
</html>
