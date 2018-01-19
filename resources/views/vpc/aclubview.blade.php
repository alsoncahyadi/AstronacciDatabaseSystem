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
			position: relative;
		} th { 
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
				<div class="col-md-4 row">
					<div class="col-md-3">
						<i class="fa fa-child fa-fw"></i> Members
					</div>
					<div class="col-md-4">
						<button class="btn btn-default" style="margin-left:30px"><i class="fa fa-download"></i> &nbsp Download </a></button>
					</div>
					<div class="col-md-3">
						<a href="{{route('home')}}"><button type="button" class="btn btn-default">Back</button></a>
					</div>
					<div class="col-md-2">
						<i class="fa fa-spinner fa-spin" style="font-size:24px; margin-top:4px; margin-left: -50px"></i>
					</div>
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
						<select class="sort form-control no-spin" name="sort1">
							<option value=""> <option>
							@foreach ($sortables as $sortable => $value)
								<option value="{{ $value }}">{{ $sortable }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<select class="sort form-control no-spin" name="sort2">
							<option value=""> <option>
							@foreach ($sortables as $sortable => $value)
								<option value="{{ $value }}">{{ $sortable }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<select class="sort form-control no-spin" name="sort3">
							<option value=""> <option>
							@foreach ($sortables as $sortable => $value)
								<option value="{{ $value }}">{{ $sortable }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-1">
						<button id="sort-button" class="btn btn-default">Sort</button>
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
						<!-- <tbody>
							<?php $idx = 0 ?>
							@foreach ($clients as $client)
								<tr>
									<td class="fixed-side collumn-select" style="text-align:center; padding-bottom: 0px">
										<input class="selectable" id="{{ $client->user_id }}" onchange="" type="checkbox" style="" name="assigned{{ $idx }}">
										<input type="hidden" name="id{{ $idx }}" value="">
									@foreach ($attsMaster as $attMaster)
										<td class="fixed-side" style="white-space: nowrap;"> {{ $client->$attMaster }}</td>
									@endforeach
									@foreach ($atts as $att)
										<td style="max-width: 100px; white-space: nowrap;"> <a id="{{$att}}_{{$client->user_id}}" target="_blank" href="{{route($route . '.detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;">{{$client->$att}} </a></td>
									@endforeach
								</tr>
							<?php $idx = $idx + 1; ?>
							@endforeach
						</tbody> -->
						@yield('content')
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
														<input type="checkbox" class="check-filter" data-type="birthdate" value="{{date('m', strtotime($filter_birthdate))}}"> {{ $filter_birthdate }}
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
							@foreach ($heads as $head => $value)
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
													@foreach ($filter as $f)						
													<?php $m = date('m', strtotime($f))?>
													@if (($m == 01)&&($f != 'January'))
													<input input class="check-filter" data-type="{{$value}}" type="checkbox" value="{{$f}}">
													{{ $f }}
													@else
													<input class="check-filter" data-type="{{$value}}" type="checkbox" value="{{date('m', strtotime($f))}}">
													{{ $f }}
													@endif
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
		<div id="pageController" style="margin-left: 15px">
			Page
			<input id="pagenum" type="text" name="pagenum" value="1">
			<button id="page_number">Go</button>
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

	    // Request to API
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
	});

	function sortAndFilter() {
		var filters = {};
		var sorts = {};
		$('.check-filter:checked').each(function () {
			var filter_type = $(this).attr("data-type");
			var filter_value = $(this).val();
			// alert(filter_type + " " + filter_value);
			if (filters[filter_type]) {
				filters[filter_type].push(filter_value);
			} else {
				filters[filter_type] = [];
				filters[filter_type].push(filter_value);
			}
		});

		var json_filters = JSON.stringify(filters);
		console.log(json_filters);

		$('.sort').each(function() {
			var sort_value = $(this).find(":selected").val();
			if (sort_value) {
				sorts[sort_value] = true;
			}
		});

		var json_sorts = JSON.stringify(sorts);
		console.log(json_sorts);

		document.getElementById("pagenum").value = "1";
		// Request to API
	    var request = $.ajax({
	        url: "/AClub/filter",
	        type: "post",
	        data: {
						"_token": "{{ csrf_token() }}",
						"filters": json_filters,
						"sorts": json_sorts,
						"page": 1
					}
	    });

		// Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
			// console.log(response);
			
	    });
	}

	function gotoPage() {
		var filters = {};
		var sorts = {};
		$('.check-filter:checked').each(function () {
			var filter_type = $(this).attr("data-type");
			var filter_value = $(this).val();
			// alert(filter_type + " " + filter_value);
			if (filters[filter_type]) {
				filters[filter_type].push(filter_value);
			} else {
				filters[filter_type] = [];
				filters[filter_type].push(filter_value);
			}
		});

		var json_filters = JSON.stringify(filters);
		console.log(json_filters);

		$('.sort').each(function() {
			var sort_value = $(this).find(":selected").val();
			if (sort_value) {
				sorts[sort_value] = true;
			}
		});

		var json_sorts = JSON.stringify(sorts);
		console.log(json_sorts);

		var_page = document.getElementById("pagenum").value;

		// Request to API
	    var request = $.ajax({
	        url: "/AClub/filter",
	        type: "post",
	        data: {
						"_token": "{{ csrf_token() }}",
						"filters": json_filters,
						"sorts": json_sorts,
						"page": var_page
					}
		});

		// Callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
			// console.log(response);
			
	    });
	}

	$(".check-filter").click(function() {
		sortAndFilter();
	});

	$("#sort-button").click(function() {
		sortAndFilter();
	});
/*	var mtable = [
		@foreach ($clients as $client) [
			@foreach ($attsMaster as $attMaster)
				"{{ $client->$attMaster }}",
			@endforeach ],
		@endforeach
	];
	var table =[
	@foreach ($clients as $client)[
		@foreach ($atts as $att)
			`{{$client->$att}}` ,
		@endforeach ],
	@endforeach
	];
	var idx = 0;
	
	console.log(mtable);
	console.log(table);
*/
	$("#page_number").click(function() {
		gotoPage();
	});
</script>
