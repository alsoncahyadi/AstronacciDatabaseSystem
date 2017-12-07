<!DOCTYPE html>
<html lang="en">

<!-- pc detail -->

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
                
    <div class="panel panel-default" style="margin:15px">
        <div class="panel-heading">
            <i class="fa fa-child fa-fw"></i> Basic Information 
			<button class="btn btn-default" id="hide" style="margin-left:30px"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
			<button class="btn btn-danger" id="show" style="margin-left:30px;display:none"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
            <form action="{{route('detail.deleteclient', ['id' => $client_master->master_id])}}" method="post" onsubmit="return del()">
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
                    
                        @foreach ($heads_master as $key => $value)
                            <div class="col-lg-2" style="height:30px">
                                <label>{{$key}}</label>
                            </div>
                            <div class="col-lg-10" style="height:30px">
                                : {{$client_master->$value}}<br>
                            </div>
                        @endforeach
				</div>

			</div>

             <div id="bod2" style="display:none">
                <form role="form" method="post" action="">
                    <div class="form-group">
                        <input name="user_id" type="hidden" value="{{$client_master->master_id}}">
                        @foreach ($ins_master as $key => $value)
                            <div style="height:60px">
                                <label>{{$key}}</label>
                                    <input class="form-control" value="{{$client_master->$value}}" name="{{$value}}">
                            </div>
                        @endforeach
                        
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                </form>
            </div> 
		</div>
    </div>

    <div class="panel panel-default" style="margin:15px">
        <div class="panel-heading">
            Profit Center
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-pills">
                @if($aclub)
                    <li><a href="#aclub-pills" class="btn btn-default" data-toggle="tab" onclick="load('{{route('AClub.detail', ['id' => $aclub->master_id])}}', 'tab')">AClub</a>
                    </li>
                @else
                    <li><a type="button" class="btn btn-default" style="color:red;" disabled>AClub</a>
                    </li>
                @endif
                @if($mrg)
                    <li><a href="#mrg-pills" class="btn btn-default" data-toggle="tab" onclick="load('{{route('MRG.detail', ['id' => $mrg->master_id])}}', 'tab2')">MRG</a>
                    </li>
                @else
                    <li><a type="button" class="btn btn-default" style="color:red;" disabled>MRG</a>
                    </li>
                @endif
                @if($cat)
                    <li><a href="#cat-pills" class="btn btn-default" data-toggle="tab">CAT</a>
                    </li>
                @else
                    <li><a type="button" class="btn btn-default" style="color:red;" disabled>CAT</a>
                    </li>
                @endif
                @if($uob)
                    <li><a href="#uob-pills" class="btn btn-default" data-toggle="tab">UOB</a>
                    </li>
                @else
                    <li><a type="button" class="btn btn-default" style="color:red;" disabled>UOB</a>
                    </li>
                @endif
            </ul>
            <br>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade" id="aclub-pills">
                    <h3>A Club</h3>
                    <div>
                        @foreach ($heads_aclub as $key => $value)
                            <div class="col-lg-2" style="height:30px">
                                <label>{{$key}}</label>
                            </div>
                            <div class="col-lg-10" style="height:30px">
                                : {{$client_aclub->$value}}<br>
                            </div>
                        @endforeach
                    </div><br><br><br><br><br>
                    <div>
                        <p>Search</p>
                        <input id="searchkey" type="text"/>    
                        <button type="button" onclick="load('{{route('AClub.detail', ['id' => $client_aclub->master_id])}}?q=' + document.getElementById('searchkey').value)" href="#">Search</button>
                    </div>
                    <div id="tab"></div>
                </div>
                <div class="tab-pane fade" id="mrg-pills">
                    <h3>MRG</h3>
                    <div>
                        @foreach ($heads_mrg as $key => $value)
                            <div class="col-lg-2" style="height:30px">
                                <label>{{$key}}</label>
                            </div>
                            <div class="col-lg-10" style="height:30px">
                                : {{$client_mrg->$value}}<br>
                            </div>
                        @endforeach
                    </div><br><br><br><br><br>
                    <div>
                    <p>Search</p>
                        <input id="searchkey2" type="text"/>    
                        <button type="button" onclick="load('{{route('MRG.detail', ['id' => $client_mrg->master_id])}}?q=' + document.getElementById('searchkey2').value, 'tab2')" href="#">Search</button>
                    </div>
                    <div id="tab2"></div>
                </div>
                <div class="tab-pane fade" id="cat-pills">
                    <div>
                        <h3>CAT</h3>
                        @foreach ($heads_cat as $key => $value)
                        <div class="col-lg-2" style="height:30px">
                            <label>{{$key}}</label>
                        </div>
                        <div class="col-lg-10" style="height:30px">
                            : {{$client_cat->$value}}<br>
                        </div>
                        @endforeach
                    </div>
                    <h4>Transaksi</h4>
                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#addcat">Update Transaction</a>
                    <div id="addcat" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form method="post" action="{{route('CAT.edit')}}">
                                <input name="user_id" type="hidden" value="{{$client_cat->user_id}}">
                                @foreach ($insreg_cat as $key => $value)
                                    <div style="height:60px">
                                        <label>{{$key}}</label>
                                            <input class="form-control" value="{{$client_cat->$value}}" name="{{$value}}">
                                    </div>
                                @endforeach
                              
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <input type="submit" class="btn btn-default" value="Insert">
                                <button type="reset" class="btn btn-default">Reset Form</button>
                            </form>
                        </div>
                        <br>
                    </div>
                    <br><br>
                    <div>
                        @foreach ($headsreg_cat as $key => $value)
                        <div class="col-lg-2" style="height:30px">
                            <label>{{$key}}</label>
                        </div>
                        <div class="col-lg-10" style="height:30px">
                            : {{$client_cat->$value}}<br>
                        </div>
                        @endforeach
                        <br>
                    </div>
                </div>
                <div class="tab-pane fade" id="uob-pills">
                    <h3>UOB</h3>
                    <div>
                        @foreach ($heads_uob as $key => $value)
                            <div class="col-lg-2" style="height:30px">
                                <label>{{$key}}</label>
                            </div>
                            <div class="col-lg-10" style="height:30px">
                                : {{$client_uob->$value}}<br>
                            </div>
                        @endforeach
                    </div>
                    <h4>Transaksi</h4>
                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#adduob">Update Transaction</a>
                    <div id="adduob" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form method="post" action="{{route('UOB.edit')}}">
                                <input name="user_id" type="hidden" value="{{$client_uob->user_id}}">
                                @foreach ($insreg_uob as $key => $value)
                                    <div style="height:60px">
                                        <label>{{$key}}</label>
                                            <input class="form-control" value="{{$client_uob->$value}}" name="{{$value}}">
                                    </div>
                                @endforeach
                              
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <input type="submit" class="btn btn-default" value="Insert">
                                <button type="reset" class="btn btn-default">Reset Form</button>
                            </form>
                        </div>
                        <br>
                    </div>
                    <div>
                        @foreach ($headsreg_uob as $key => $value)
                            <div class="col-lg-2" style="height:30px">
                                <label>{{$key}}</label>
                            </div>
                            <div class="col-lg-10" style="height:30px">
                                : {{$client_uob->$value}}<br>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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
