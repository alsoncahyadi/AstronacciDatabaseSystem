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
	<script src="{{ URL::asset('js/jquery/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('js/metisMenu/metisMenu.min.js') }}"></script>
	<script src="{{ URL::asset('js/raphael/raphael.min.js') }}"></script>
	<script src="{{ URL::asset('js/morrisjs/morris.min.js') }}"></script>
	<script src="{{ URL::asset('js/sb-admin-2.js') }}"></script>
	<script src="{{ URL::asset('js/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('js/astronacci.js') }}"></script>
	<style type="text/css">
		.vpchead{
			line-height: 32px;
		}
		.custtable {
			float: left !important;
<<<<<<< HEAD
			position: relative;
		} th { 
=======
		} th {
>>>>>>> 795c316e6d35973bc262a4fa975bc25393265d96
			max-height: 40px;
		} td {
			overflow: hidden;
			max-width: 100px;
		}
		.filter {
			height: 210px;
			width: 150px;
			padding: 5px;
			overflow-x: hidden;
			overflow-y: hidden;
			position: absolute;
			z-index: 1;
		} .checkbox {
			margin-top: 3px;
			margin-bottom: 3px;
		}
		.filter-selection{
			overflow-y: scroll;
			height: 140px;
			padding: 5px;
			margin-bottom: 5px;
		}
		.dd{
			float: right;
		}
		.table-scroll {
			position:relative;
			margin:auto;
			overflow:hidden;
		}
		.table-wrap {
			overflow:auto;
		}
		.table-scroll table {
			margin:auto;
			border-collapse:separate;
			border-spacing:0;
		}
		.table-scroll th, .table-scroll td {
			white-space:nowrap;
			vertical-align:top;
		}
		.table-scroll thead, .table-scroll tfoot {
		}
		.clone {
			position:absolute;
			top:0;
			left:0;
			pointer-events: none;
		}
		.clone .collumn-select {
			pointer-events: auto !important;
		}
		.clone th, .clone td {
			visibility:hidden
		}
		.clone td, .clone th {
			border-color:transparent
		}
		.clone tbody th {
			visibility:visible;
			color:red;
		}
		.clone .fixed-side {
			visibility:visible;
			background: inherit;
		}
		.clone thead, .clone tfoot{background:transparent;}

		.clone>tbody>tr:nth-of-type(even) {
		    background-color: #fff !important;
		}

		th.fixed-side {
			background-color: #fff !important;
		}
	</style>
</head>
<body style="overflow-x:hidden;  background-image: url('{{ URL::asset('images/swirl_pattern1.png') }}'); padding:15px;">
	<div id="wrapper" >

		<div class="row">
			<div class="col-lg-12">
				<h1>A-CLUB Members</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading vpchead">
			<div class="row">
				<div class="col-md-4">
					<i class="fa fa-child fa-fw"></i> Members
					<button class="btn btn-default" style="margin-left:30px"><i class="fa fa-download"></i> &nbsp Download </a></button>
					<a href="{{route('home')}}"><button type="button" class="btn btn-default">Back</button></a>
				</div>
				<div class="col-md-2">
					<div class="form-group input-group" style="margin-bottom: 0px">
						<input type="number" class="form-control" placeholder="Add Bonus Days" id="bonus-days">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="add-bonus"> <i class="fa fa-plus"></i>
							</button>
						</span>
					</div>
				</div>
				<div class="col-md-6 row">
					<div class="col-md-1"></div>
					<div class="col-md-1" style="white-space: nowrap;">Sort by:</div>
					<!--SORT PARAMS -->
					<div class="col-md-3">
						<select class="form-control no-spin" name="sort1">
							<option selected="selected">SS</option>
							<option>SS</option>
						</select>
					</div>
					<div class="col-md-3">
						<select class="form-control no-spin" name="sort2">
							<option selected="selected">SS2</option>
						</select>
					</div>
					<div class="col-md-3">
						<select class="form-control no-spin" name="sort3">
							<option selected="selected">SS3</option>
						</select>
					</div>
					<div class="col-md-1">
						<button class="btn btn-default">Sort</button>
					</div>
				</div>
			</div>
		</div>

		<div class="panel-body">
			<div id="bod1">
				<div id="table-scroll" class="table-scroll">
				  <div class="table-wrap">
				  	<div class="col-xs-12" style="margin:0px;padding: 0px;">
				    <table id="tablebase" class="table table-condensed table-striped table-bordered table-hover custtable main-table">
				    	<thead>
							<tr>
								<?php $idx = 1 ?>
								<th class="fixed-side collumn-select" scope="col"> Select <input id="selectAll" class="dd" style="margin-bottom:0px " type="checkbox" value=""> </th>
								<!-- Mendapatkan judul setiap kolom pada tabel dari variabel heads -->
								@foreach ($headsMaster as $headMaster)
								<th class="fixed-side" scope="col"> {{ $headMaster }} 
									@if ($headMaster == 'Tanggal Lahir')
									<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
										<div class="filter panel panel-default collapse" id="dd{{$idx}}">
											<form>
												<label>Filter</label>
												<div class="panel panel-default filter-selection">
												@foreach($filter_birthdates as $filter_birthdate)
													<div class="checkbox">
														<label>
															<input type="checkbox" value=""> {{ $filter_birthdate }}
														</label>
													</div>
												@endforeach
												</div>
												<button class="btn btn-default btn-xs">Filter</button>
											</form>
										</div>
									@endif
								</th>
								<?php $idx = $idx + 1; ?>
								@endforeach

								<!-- Mendapatkan judul setiap kolom pada tabel dari variabel heads -->
								<?php $idx = 6; ?>
								@foreach ($heads as $head)
								<th style="white-space: nowrap; min-width: 180px"> <div style="display: inline-block;">{{$head}}</div>
								@if (isset($filterable[$head]))
								<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
									<div class="filter panel panel-default collapse" id="dd{{$idx}}">
										<form id="formCities" action="#" method="post">
											<label>Filter</label>
											<div class="panel panel-default filter-selection">
											@foreach ($filterable[$head] as $filter)
												<div class="checkbox">
													<label>												
														<input type="checkbox" value="">@foreach ($filter as $f)
														{{ $f }}
														@endforeach
													</label>
												</div>											
											@endforeach
											</div>
											<button class="btn btn-default btn-xs">Filter</button>
										</form>
									</div>							
								@endif
								</th>
								<?php $idx = $idx + 1; ?>
								@endforeach
							</tr>
						</thead>
						<tbody>
							<?php $idx = 0 ?>
							@foreach ($clients as $client)
								<tr>
									<td class="fixed-side collumn-select" style="text-align:center; padding-bottom: 0px">
										<input class="selectable" id="{{ $client->user_id }}" onchange="" type="checkbox" style="" name="assigned{{ $idx }}">
										<input type="hidden" name="id{{ $idx }}" value="">
									@foreach ($attsMaster as $attMaster)
										@if ($attMaster == 'name')
											<td class="fixed-side" style="white-space: nowrap;"> <a id="{{$attMaster}}_{{$client->user_id}}" target="_blank" href="{{route($route . '.detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;"> {{ $client->$attMaster }}</a></td>
										@else
											<td class="fixed-side" style="white-space: nowrap;"> {{ $client->$attMaster }} </td>
										@endif
									@endforeach
									@foreach ($atts as $att)
										<td style="max-width: 100px; white-space: nowrap;"> {{$client->$att}} </td>
									@endforeach
								</tr>
							<?php $idx = $idx + 1; ?>
							@endforeach
						</tbody>
						<input type="hidden" name="numusers" value="{{ $idx }}">
				</table>
				</div>
			</div>

			<!--
				<div class="col-xs-6" style="margin:0px;padding: 0px;">
				<table id="tablebase" class="table table-condensed table-striped table-bordered table-hover custtable">
					<thead>
						<tr>
							<?php $idx = 1 ?>
							<th> Select <input id="selectAll" class="dd" style="margin-bottom:0px " type="checkbox" value=""> </th>
							Mendapatkan judul setiap kolom pada tabel dari variabel heads 
							@foreach ($headsMaster as $headMaster)
							<th> {{ $headMaster }} 
								@if ($headMaster == 'Tanggal Lahir')
								<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
									<div class="filter panel panel-default collapse" id="dd{{$idx}}">
										<form>
											<label>Filter</label>
											<div class="panel panel-default filter-selection">
											@foreach($filter_birthdates as $filter_birthdate)
												<div class="checkbox">
													<label>
														<input type="checkbox" value=""> {{ $filter_birthdate }}
													</label>
												</div>
											@endforeach
											</div>
											<button class="btn btn-default btn-xs">Filter</button>
										</form>
									</div>
								@endif
							</th>
							<?php $idx = $idx + 1; ?>
							@endforeach
						</tr>
					</thead>
					<tbody>
						<?php $idx = 0 ?>
						@foreach ($clients as $client)
							<tr>
								<td style="text-align:center; padding-bottom: 0px">
									<input class="selectable" id="{{ $client->user_id }}" onchange="" type="checkbox" style="" name="assigned{{ $idx }}">
									<input type="hidden" name="id{{ $idx }}" value="">
								@foreach ($attsMaster as $attMaster)
									<td style="white-space: nowrap;"> {{ $client->$attMaster }}</td>
								@endforeach
							</tr>
						<?php $idx = $idx + 1; ?>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-xs-6" style="margin:0px;padding: 0px;overflow-x: scroll;">
				<table id="tablebase2" class="table table-condensed table-striped table-bordered table-hover custtable">

					<thead>
						<tr>
							Mendapatkan judul setiap kolom pada tabel dari variabel heads
							<?php $idx = 6; ?>
							@foreach ($heads as $head)
							<th style="white-space: nowrap; min-width: 180px"> <div style="display: inline-block;">{{$head}}</div>
							@if (isset($filterable[$head]))
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form id="formCities" action="#" method="post">
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filterable[$head] as $filter)
											<div class="checkbox">
												<label>												
													<input type="checkbox" value="">@foreach ($filter as $f)
													{{ $f }}
													@endforeach
												</label>
											</div>											
										@endforeach
										</div>
										<button class="btn btn-default btn-xs">Filter</button>
									</form>
								</div>							
							@endif
							</th>
							<?php $idx = $idx + 1; ?>
							@endforeach
						</tr>
					</thead>
					<tbody>
						<?php $idx = 0; ?>
						Menampilkan seluruh client untuk PC terkait, dari list pada variabel clients

						@foreach ($clients as $client)
						<tr>
							@foreach ($atts as $att)
							<td style="max-width: 100px; white-space: nowrap;"> <a id="{{$att}}_{{$client->user_id}}" target="_blank" href="{{route($route . '.detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;">{{$client->$att}} </a></td>
							@endforeach
						</tr>

						<?php $idx = $idx + 1; ?>

						@endforeach
					</tbody>
					<input type="hidden" name="numusers" value="{{ $idx }}">
				</table>
			</div>
		-->
		</div>
	</div>
</div>




</body>
</html>
<script type="text/javascript">
	$(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');  
	$( "#selectAll" ).change(function() {
		$(".selectable").prop( "checked", $( "#selectAll" ).is(":checked"));
	});
	$( ".clone #selectAll" ).change(function() {
		$(".selectable").prop( "checked", $( ".clone #selectAll" ).is(":checked"));
	});

	var arrFilter = [];
	var jsonFilter = [];
	$( ".filterCity" ).change(function() {
		arrFilter = [];
		$.each($(".filterCity:checked"), function(){            
                arrFilter.push($(this).val());
            });
		jsonFilter = JSON.parse(JSON.stringify(arrFilter));
		console.log(jsonFilter);
	});

	$("#add-bonus").click(function() {
		console.log("add bonus");
		var idSelector = function() { return this.id; };
		var checked = $(".selectable:checked").map(idSelector).get();
		var days = $("#bonus-days").val();
		console.log(checked);
		console.log(days);

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    // $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    var request = $.ajax({
        url: "/AClub/add-bonus",
        type: "post",
        data: {
					"_token": "{{ csrf_token() }}",
					"data": checked,
					"days": days
				}
    });

		// Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
				console.log(response);
				$.each(response, function(k, v) {
				    //display the key and value pair
				    var masa_tenggang_id = "#masa_tenggang_" + k;
						$(masa_tenggang_id).html(v);
						var bonus_id = "#bonus_" + k;
						var updated_bonus = parseInt($(bonus_id).html()) + parseInt(days);
						$(bonus_id).html(updated_bonus);
				});
    });
	})
</script>
