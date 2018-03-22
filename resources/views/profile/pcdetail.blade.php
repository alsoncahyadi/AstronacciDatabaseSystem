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
            <form action="{{route('detail.deleteclient', ['id' => $client_master->master_id])}}" method="post" onsubmit="return del()" style="display: inline-block">
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
                <form role="form" method="post" action="{{route('detail.edit')}}">
                    <div class="form-group">
                        <input name="user_id" type="hidden" value="{{$client_master->master_id}}">
                        @foreach ($ins_master as $key => $value)
                            <div style="height:60px">
                                <label>{{$key}}</label>
                                @if ($key == "Tanggal Lahir")
                                    <input class="form-control no-spin" type="date" name="{{$value}}" value="{{$client_master->$value}}"> 
                                @elseif ($key == "Gender")
                                    <select class="form-control" name="{{$value}}" value="{{$client_master->$value}}">
                                        <option>M</option>
                                        <option>F</option>
                                    </select>
                                @elseif ($key == 'Provinsi')
                                    <input type="hidden" name="prov" id="currentProv" value="{{$client_master->$value}}">
                                    <select class="form-control" name="{{$value}}" id="prov" value="{{$client_master->$value}}">

                                    </select>
                                @elseif ($key == 'Kota') 
                                    <input type="hidden" name="kota" id="currentCity" value="{{$client_master->$value}}">
                                    <select class="form-control" name="{{$value}}" id="kota" value="{{$client_master->$value}}">

                                    </select>
                                @else
                                    <input class="form-control" value="{{$client_master->$value}}" name="{{$value}}">
                                @endif
                            </div>
                        @endforeach
                        
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
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
                    <li><a href="#aclub-pills" class="btn btn-default" data-toggle="tab" onclick="load('{{route('AClub.detail', ['id' => $aclub->master_id])}}', 'tab')">A-CLUB</a>
                    </li>
                @else
                    <li><a type="button" class="btn btn-default" style="color:red;" disabled>A-CLUB</a>
                    </li>
                @endif
                @if($mrg)
                    <li><a href="#mrg-pills" class="btn btn-default" data-toggle="tab" onclick="load('{{route('MRG.detail', ['id' => $mrg->master_id])}}', 'tab2');document.getElementById('page_count').innerHTML = document.getElementById('hidden_page_count').value;">MRG</a>
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
                    <h3>A-CLUB</h3>

                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#editaclub">Edit</a>
                    <form action="{{route('AClub.deleteclient', ['id' => $client_aclub->master_id])}}" method="post" onsubmit="return del()" style="display: inline-block">
                        <input type="hidden" name="_method" value="DELETE" >
                        <input class="btn btn-primary" type="submit" value="Delete Client" >
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                    </form>
                    <div id="editaclub" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form method="post" action="{{route('AClub.edit')}}">
                                <input name="master_id" type="hidden" value="{{$client_aclub->master_id}}">
                                @foreach ($ins_aclub as $atr => $value)
                                <div class="form-group">
                                    <label>{{$atr}}</label>
                                    <input class="form-control" type="text" value="{{$client_aclub->$value}}" name="{{$value}}">
                                </div>
                                @endforeach
                                <br>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <input type="submit" class="btn btn-primary" value="Edit">
                                <button type="reset" class="btn btn-default">Reset Form</button>
                            </form>
                        </div>
                        <br>
                    </div>

                    <div>
                        @foreach ($heads_aclub as $key => $value)
                            <div class="col-lg-2" style="height:30px">
                                <label>{{$key}}</label>
                            </div>
                            <div class="col-lg-10" style="height:30px">
                                : {{$client_aclub->$value}}<br>
                            </div>
                        @endforeach
                    </div><br>

                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#addaclubtrans">Add New Transaction</a>
                    <div id="addaclubtrans" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form method="post" action="{{route('AClub.inserttrans')}}">
                                <input name="user_id" type="hidden" value="{{$client_aclub->user_id}}">
                                @foreach ($insreg_aclub as $atr => $value)
                                <div class="form-group">
                                    <label>{{$atr}}</label>
                                    @if ($atr == "Account Type")
                                        <select class="form-control" id="accounttype" name="{{$value}}" >
                                            <option selected="selected">Recreation</option>
                                            <option>Basic</option>
                                            <option>Syariah</option>
                                            <option>Signature</option>
                                        </select>
                                    @elseif ($atr == "Group")
                                        <input class="form-control no-spin" type="text" id="group" name="{{strtolower(str_replace(' ', '_', $atr))}}" value="Stock"readonly>


                                    @elseif ($atr == "Kode")
                                        <select class="form-control" id="kode" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                                            <option selected="selected">SS</option>
                                            <option>FS</option>
                                            <option>SG</option>
                                            <option>FG</option>
                                            <option>SP</option> 
                                            <option>FP</option>
                                            <option>RD</option>
                                        </select>
                                    @elseif ($atr == "Status")
                                        <select class="form-control" name="{{strtolower(str_replace(' ', '_', $atr)).'_aclub'}}">
                                            <option selected="selected">Baru</option>
                                            <option>Perpanjang</option>
                                            <option>Tidak Aktif</option>
                                        </select>
                                    @elseif ($atr == "Payment Date")
                                        <input class="form-control no-spin" type="date" name="{{strtolower(str_replace(' ', '_', $atr))}}">    
                                    @elseif ($atr == "Start Date")
                                        <input class="form-control no-spin" type="date" id="startdate" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                                    @elseif ($atr == "Expired Date")
                                        <input class="form-control no-spin" type="date" id="expireddate" name="{{strtolower(str_replace(' ', '_', $atr))}}" readonly>
                                    @elseif ($atr == "Masa Tenggang")
                                        <input class="form-control no-spin" type="date" id="masatenggang" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                                    @elseif ($atr == "Yellow Zone")
                                        <input class="form-control no-spin" type="date" id="yellowzone" name="{{strtolower(str_replace(' ', '_', $atr))}}" readonly>
                                    @elseif ($atr == "Red Zone")
                                        <input class="form-control no-spin" type="date" id="redzone" name="{{strtolower(str_replace(' ', '_', $atr))}}" readonly>                                      
                                    @else
                                        <input class="form-control" type="text" name="{{$value}}">
                                    @endif
                                </div>
                                @endforeach
                                <br>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <input type="submit" class="btn btn-primary" value="Add">
                                <button type="reset" class="btn btn-default">Reset Form</button>
                            </form>
                        </div>
                        <br>
                    </div>
                    <br><br>

                    <div>
                        <p>Search</p>
                        <input id="searchkey" type="text"/>    
                        <button type="button" onclick="load('{{route('AClub.detail', ['id' => $client_aclub->master_id])}}?q=' + document.getElementById('searchkey').value)" href="#">Search</button>
                    </div>
                    <div id="tab"></div>
                    <div id="pageControllerA" style="margin-left: 2px; margin-top: 12px;">
                        Page
                        <input id="pagenumA" type="number" name="pagenumA" value="1" min="1" >
                        /<label id="page_countA">{{ (isset($count) ? $count : "" )}}</label>
                        <button id="page_numberA" onclick="gotoPageA()" href="#">Go</button>
                    </div>

                </div>
                <div class="tab-pane fade" id="mrg-pills">
                    <h3>MRG</h3>
                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#editmrg">Edit</a>
                    <form action="{{route('MRG.deleteclient', ['id' => $client_mrg->master_id])}}" method="post" onsubmit="return del()" style="display: inline-block">
                        <input type="hidden" name="_method" value="DELETE" >
                        <input class="btn btn-primary" type="submit" value="Delete Client" >
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                    </form>
                    <div id="editmrg" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form method="post" action="{{route('MRG.edit')}}">
                                <input name="master_id" type="hidden" value="{{$client_mrg->master_id}}">
                                @foreach ($heads_mrg as $atr => $value)
                                <div class="form-group">
                                    <label>{{$atr}}</label>
                                    @if ($atr == "Join Date MRG")
                                        <input class="form-control no-spin" type="date" value="{{$client_mrg->$value}}" name="{{strtolower(str_replace(' ', '_', $atr))}}">
                                    @else
                                        <input class="form-control" type="text" value="{{$client_mrg->$value}}" name="{{$value}}">
                                    @endif
                                </div>
                                @endforeach
                                <br>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <input type="submit" class="btn btn-primary" value="Edit">
                                <button type="reset" class="btn btn-default">Reset Form</button>
                            </form>
                        </div>
                        <br>
                    </div>
                    <div>
                        @foreach ($heads_mrg as $key => $value)
                            <div class="col-lg-2" style="height:30px">
                                <label>{{$key}}</label>
                            </div>
                            <div class="col-lg-10" style="height:30px">
                                : {{$client_mrg->$value}}<br>
                            </div>
                        @endforeach
                    </div>
                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#addmrgtrans">Add New Transaction</a>
                    <div id="addmrgtrans" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form method="post" action="{{route('MRG.inserttrans')}}">
                                <input name="user_id" type="hidden" value="{{$client_mrg->master_id}}">
                                @foreach ($insreg_mrg as $atr => $value)
                                <div class="form-group">
                                    <label>{{$atr}}</label>
                                    @if ($atr == "Account Type")
                                        <select class="form-control" id="accounttype" name="{{$value}}">
                                            <option selected="selected">Recreation</option>
                                            <option>Basic</option>
                                            <option>Syariah</option>
                                            <option>Signature</option>
                                        </select>
                                    @else
                                        <input class="form-control" type="text" name="{{$value}}">
                                    @endif
                                </div>
                                @endforeach
                                <br>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <input type="submit" class="btn btn-primary" value="Add">
                                <button type="reset" class="btn btn-default">Reset Form</button>
                            </form>
                        </div>
                        <br>
                    </div>
                    <br><br>
                    <div>
                    <p>Search</p>
                        <input id="searchkey2" type="text"/>
                        <button type="button" onclick="searchPage()" href="#">Search</button>
                    </div>
                    <div id="tab2"></div>
                    <div id="pageController" style="margin-left: 2px; margin-top: 12px;">
                        Page
                        <input id="pagenum" type="number" name="pagenum" value="1" min="1" >
                        /<label id="page_count">{{ (isset($count) ? $count : "" )}}</label>
                        <button id="page_number" onclick="gotoPage()" href="#">Go</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="cat-pills">
                    <div>
                        <h3>CAT</h3>
                        <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#editcat">Edit</a>
                        <form action="{{route('CAT.deleteclient', ['id' => $client_cat->user_id])}}" method="post" onsubmit="return del()" style="display: inline-block">
                            <input type="hidden" name="_method" value="DELETE" >
                            <input class="btn btn-primary" type="submit" value="Delete Client" >
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                        </form>
                        <br>
                        <div id="editcat" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form method="post" action="{{route('CAT.edit')}}">
                                    <input name="user_id" type="hidden" value="{{$client_cat->user_id}}">
                                    @foreach ($heads_cat as $atr => $value)
                                    <div class="form-group">
                                        <label>{{$atr}}</label>
                                        <input class="form-control" type="text" value="{{$client_cat->$value}}"" name="{{$value}}">
                                    </div>
                                    @endforeach
                                    <br>
                                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                    <input type="submit" class="btn btn-primary" value="Edit">
                                    <button type="reset" class="btn btn-default">Reset Form</button>
                                </form>
                            </div>
                            <br>
                        </div>
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
                            <form method="post" action="{{route('CAT.inserttrans')}}">
                                <input name="user_id" type="hidden" value="{{$client_cat->user_id}}">
                                @foreach ($insreg_cat as $key => $value)
                                    <div style="height:60px">
                                        <label>{{$key}}</label>
                                            @if (($key == "DP Date") || ($key == "Payment Date") || ($key == "Opening Class")|| ($key == "End Class")|| ($key == "Ujian"))
                                                <input class="form-control no-spin" type="date" name="{{$value}}" value="{{$client_cat->$value}}"> 
                                            @else
                                                <input class="form-control" value="{{$client_cat->$value}}" name="{{$value}}">
                                            @endif
                                    </div>
                                @endforeach
                                <br>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <input type="submit" class="btn btn-primary" value="Update">
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
                    <a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#edituob">Edit</a>
                    <form action="{{route('UOB.deleteclient', ['id' => $client_uob->client_id])}}" method="post" onsubmit="return del()" style="display: inline-block">
                        <input type="hidden" name="_method" value="DELETE" >
                        <input class="btn btn-primary" type="submit" value="Delete Client" >
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                    </form>
                    <div id="edituob" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form method="post" action="{{route('UOB.edit')}}">
                                <input name="client_id" type="hidden" value="{{$client_uob->client_id}}">
                                @foreach ($heads_uob as $atr => $value)
                                <div class="form-group">
                                    <label>{{$atr}}</label>
                                    <input class="form-control" type="text" value="{{$client_uob->$value}}" name="{{$value}}">
                                </div>
                                @endforeach
                                <br>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <input type="submit" class="btn btn-primary" value="Edit">
                                <button type="reset" class="btn btn-default">Reset Form</button>
                            </form>
                        </div>
                        <br>
                    </div>
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
                            <form method="post" action="{{route('UOB.inserttrans')}}">
                                <input name="user_id" type="hidden" value="{{$client_uob->client_id}}">
                                @foreach ($insreg_uob as $key => $value)
                                    <div style="height:60px">
                                        <label>{{$key}}</label>
                                            @if (($key == "Tanggal RDI Done") || ($key == "Tanggal Top Up") || ($key == "Tanggal Trading"))
                                                <input class="form-control no-spin" type="date" name="{{$value}}" value="{{$client_uob->$value}}">
                                            @else   
                                            <input class="form-control" value="{{$client_uob->$value}}" name="{{$value}}">
                                            @endif
                                    </div>
                                @endforeach
                                <br>
                                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                                <input type="submit" class="btn btn-primary" value="Update">
                                <button type="reset" class="btn btn-default">Reset Form</button>
                            </form>
                        </div>
                        <br>
                    </div>
                    <br><br>
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
<script type="text/javascript">
    var updateInterval = window.setInterval(function(){
    updateMax()
    }, 500);
    var updateIntervalA = window.setInterval(function(){
    updateMaxA()
    }, 500);
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
    function updateMax() {
        try {
            var page = document.getElementById('hidden_page_count').value;
            document.getElementById('page_count').innerHTML = page;
            document.getElementById('pagenum').max = page;
        }
        catch(err) {
            //clearInterval(updateInterval);
        }
    }
    function updateMaxA() {
        try {
            var page = document.getElementById('hidden_page_countA').value;
            document.getElementById('page_countA').innerHTML = page;
            document.getElementById('pagenumA').max = page;
        }
        catch(err) {
            //clearInterval(updateIntervalA);
        }
    }

    function searchPage() {
        load('{{route('MRG.detail', ['id' => $client_mrg->master_id])}}?q=' + document.getElementById('searchkey2').value, 'tab2');
        updateMax()
        document.getElementById('pagenum').value='1';
    }
    function gotoPage() {
        load('{{route('MRG.detail', ['id' => $client_mrg->master_id])}}?page=' + document.getElementById('pagenum').value + '&q=' + document.getElementById('searchkey2').value, 'tab2'); 
        updateMax()        
    }
    function gotoPageA() {
        load('{{route('AClub.detail', ['id' => $client_aclub->master_id])}}?page=' + document.getElementById('pagenumA').value + '&q=' + document.getElementById('searchkey').value)
        updateMaxA()
    }
    // ======================================================================================================

    function del(){
        if (confirm('Data will be lost permanently. Are you sure you want to delete this PC?'))
            return true;
        else
            return false;
    }

    var prov = {
        "Aceh" : ["Banda Aceh", "Langsa", "Lhokseumawe", "Meulaboh", "Sabang", "Subulussalam"],
        "Bali" : ["Denpasar"],
        "Bangka Belitung" : ["Pangkalpinang"],
        "Banten" : ["Cilegon", "Serang", "Tangerang Selatan", "Tangerang"],
        "Bengkulu" : ["Bengkulu"],
        "Gorontalo" : ["Gorontalo"],
        "Jakarta" : ["Jakarta Barat", "Jakarta Pusat", "Jakarta Selatan", "Jakarta Timur", "Jakarta Utara"],
        "Jambi" : ["Sungai Penuh", "Jambi"],
        "Jawa Barat" : ["Bandung", "Bekasi", "Bogor", "Cimahi", "Cirebon", "Depok", "Sukabumi", "Tasikmalaya", "Banjar"],
        "Jawa Tengah" : ["Magelang", "Pekalongan", "Purwokerto", "Salatiga", "Semarang", "Surakarta", "Tegal"],
        "Jawa Timur" : ["Batu", "Blitar", "Kediri", "Madiun", "Malang", "Mojokerto", "Pasuruan", "Probolinggo", "Surabaya"],
        "Kalimantan Barat" : ["Pontianak", "Singkawang"],
        "Kalimantan Selatan" : ["Banjarbaru", "Banjarmasin"],
        "Kalimantan Tengah" : ["Palangkaraya"],
        "Kalimatan Timur" : ["Balikpapan", "Bontang", "Samarinda"],
        "Kalimantan Utara" : ["Tarakan"],
        "Kepulauan Riau" : ["Batam", "Tanjungpinang"],
        "Lampung" : ["Bandar Lampung", "Metro"],
        "Maluku Utara" : ["Ternate", "Kepulauan Tidore"],
        "Maluku" : ["Ambon", "Tual"],
        "Nusa Tenggara Barat" : ["Bima", "Mataram"],
        "Nusa Tenggara Timur" : ["Kupang"],
        "Papua Barat" : ["Sorong"],
        "Papua" : ["Jayapura"],
        "Riau" : ["Dumai", "Pekanbaru"],
        "Sulawesi Selatan" : ["Makassar", "Palopo", "Parepare"],
        "Sulawesi Tengah" : ["Palu"],
        "Sulawesi Tenggara" : ["Bau-Bau", "Kendari"],
        "Sulawesi Utara" : ["Bitung", "Kotamobagu", "Manado", "Tomohon"],
        "Sumatera Barat" : ["Bukittinggi", "Padang", "Padangpanjang", "Pariaman", "Payakumbuh", "Sawahlunto", "Solok"],
        "Sumatera Selatan" : ["Lubuklinggau", "Pagaralam", "Palembang", "Prabumulih"],
        "Sumatera Utara" : ["Binjai", "Medan", "Padang Sidempuan", "Pematangsiantar", "Sibolga", "Tanjungbalai", "Tebingtinggi"],
        "Yogyakarta" : ["Yogyakarta"],
    };
    var provKeys = Object.keys(prov);
    var select = document.getElementById('prov');
    var selectKota = document.getElementById('kota');
    var currentProv = document.getElementById('currentProv').value;
    var currentCity = document.getElementById('currentCity').value;
    select.options[0] = new Option(currentProv, currentProv);
    selectKota.options[0] = new Option(currentCity, currentCity);
    for(var i=1; i<=provKeys.length; i++)
    {
      select.options[i] = new Option(provKeys[i], provKeys[i]);  //new Option("Text", "Value")
    }
    if ( provKeys.includes(currentProv) ){
        for(var i=1; i<=prov[currentProv].length; i++)
            {
              selectKota.options[i] = new Option(prov[currentProv][i], prov[currentProv][i]);  //new Option("Text", "Value")
            }
    }
    document.getElementById("prov").value = currentProv;
    document.getElementById("kota").value = currentCity;
    $('#prov').on('click', function() {
      $("#kota").empty();
      var temp = this.value;
      for(var i=0; i< prov[temp].length; i++)
        {
          selectKota.options[i] = new Option(prov[temp][i], prov[temp][i]);  //new Option("Text", "Value")
        }
    })
	</script>
</body>
</html>
