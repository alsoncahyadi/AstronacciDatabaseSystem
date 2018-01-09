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
		} th { 
			max-height: 40px;
		} td {
			overflow: hidden;
			max-width: 150px;
		}
		.filter {
			height: 210px;
			width: 150px;
			padding: 5px;
			overflow-x: hidden;
			overflow-y: hidden;
			position: absolute;
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
						<input type="number" class="form-control" placeholder="Add Bonus Days">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"> <i class="fa fa-plus"></i>
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
				<div class="col-xs-6" style="margin:0px;padding: 0px;">
				<table id="tablebase" class="table table-condensed table-striped table-bordered table-hover custtable">
					<thead>
						<tr>
							<?php $idx = 1 ?>
							<th> Select <input id="selectAll" class="dd" style="margin-bottom:0px " type="checkbox" value=""> </th>
							<!-- Mendapatkan judul setiap kolom pada tabel dari variabel heads -->
							@foreach ($headsMaster as $headMaster)
							<th> {{ $headMaster }} <button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								@if ($headMaster == 'Tanggal Lahir')
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
									<input class="selectable" id="" onchange="" type="checkbox" style="" name="assigned{{ $idx }}">
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
							<!-- Mendapatkan judul setiap kolom pada tabel dari variabel heads -->
							<?php $idx = 6; ?>
							@foreach ($heads as $head)
							<th style="white-space: nowrap; min-width: 180px"> <div style="display: inline-block;">{{$head}}</div>
							@if ($head == 'Kota')
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form>
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filter_cities as $filter_city)
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">{{ $filter_city->city }}
												</label>
											</div>											
										@endforeach
										</div>
										<button class="btn btn-default btn-xs">Filter</button>
									</form>
								</div>							
							@elseif ($head == 'Gender')
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form>
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filter_gender as $filter_gend)
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">{{ $filter_gend->gender }}
												</label>
											</div>											
										@endforeach
										</div>
										<button class="btn btn-default btn-xs">Filter</button>
									</form>
								</div>
							@elseif ($head == 'Sumber')
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form>
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filter_sumber as $filter_sumb)
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">{{ $filter_sumb->sumber_data }}
												</label>
											</div>											
										@endforeach
										</div>
										<button class="btn btn-default btn-xs">Filter</button>
									</form>
								</div>
							@elseif ($head == 'Sales')
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form>
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filter_sales as $filter_sale)
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">{{ $filter_sale->sales_name }}
												</label>
											</div>											
										@endforeach
										</div>
										<button class="btn btn-default btn-xs">Filter</button>
									</form>
								</div>
							@elseif ($head == 'Kode')
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form>
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filter_kode as $filter_kod)
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">{{ $filter_kod->kode }}
												</label>
											</div>											
										@endforeach
										</div>
										<button class="btn btn-default btn-xs">Filter</button>
									</form>
								</div>
							@elseif ($head == 'Status')
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form>
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filter_status as $filter_stat)
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">{{ $filter_stat->status }}
												</label>
											</div>											
										@endforeach
										</div>
										<button class="btn btn-default btn-xs">Filter</button>
									</form>
								</div>
							@elseif ($head == 'Payment Date')
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form>
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filter_date as $filter_dat)
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">{{ $filter_dat }}
												</label>
											</div>											
										@endforeach
										</div>
										<button class="btn btn-default btn-xs">Filter</button>
									</form>
								</div>
							@elseif ($head == 'Start Date')
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form>
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filter_date as $filter_dat)
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">{{ $filter_dat }}
												</label>
											</div>
										@endforeach
										</div>
										<button class="btn btn-default btn-xs">Filter</button>
									</form>
								</div>
							@elseif ($head == 'Masa Tenggang')
							<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>
								<div class="filter panel panel-default collapse" id="dd{{$idx}}">
									<form>
										<label>Filter</label>
										<div class="panel panel-default filter-selection">
										@foreach ($filter_date as $filter_dat)
											<div class="checkbox">
												<label>
													<input type="checkbox" value="">{{ $filter_dat }}
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
						<!-- Menampilkan seluruh client untuk PC terkait, dari list pada variabel clients -->
						
						@foreach ($clients as $client)																				
						<tr>
							@foreach ($atts as $att)
							<td style="max-width: 100px; white-space: nowrap;"> <a target="_blank" href="{{route($route . '.detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;">{{$client->$att}} </a></td>
							@endforeach
						</tr>

						<?php $idx = $idx + 1; ?>

						@endforeach
					</tbody>
					<input type="hidden" name="numusers" value="{{ $idx }}">
				</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	$( "#selectAll" ).change(function() {
		console.log("fuc");
		$(".selectable").prop( "checked", $( "#selectAll" ).is(":checked"));
	});
</script>