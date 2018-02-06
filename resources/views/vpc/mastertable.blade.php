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
			height: 150px;
			width: 150px;
			padding: 5px;
			overflow-x: hidden;
			overflow-y: hidden;
			position: fixed;
			z-index: 1;
		} .checkbox {
			margin-top: 3px;
			margin-bottom: 3px;
		}
		.filter-selection{
			height: 100px;
			padding: 5px;
			margin-bottom: 5px;
		}
		.dd{
			float: right;
		}
		.checkbox {
			margin-top: 3px;
			margin-bottom: 3px;
		}
		.margincheck{
			margin-left: 5px !important;
		}
	</style>
</head>
<body style="overflow-x:hidden;  background-image: url('{{ URL::asset('images/swirl_pattern1.png') }}'); padding:15px;">
	<div id="wrapper" >

		<div class="row">
			<div class="col-lg-12">
				<h1>Master Table</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading vpchead">
			<div class="row">
				<div class="col-md-4">
					<i class="fa fa-child fa-fw"></i> Members &nbsp;
					<a href="{{route('home')}}"><button type="button" class="btn btn-default">Back</button></a>
				</div>
			</div>
		</div>

		<div class="panel-body">
			<div id="bod1">
				<div class="col-xs-6" style="margin:0px;padding: 0px;">
				<table id="tablebase" class="table table-condensed table-striped table-bordered table-hover">
					<thead>
						<th>ID</th>
						<th>Name</th>
						<th>A-CLUB Stocks <button id="bt1" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd1"><i class="fa fa-caret-down"></i></button>
							<div class="filter panel panel-default collapse" id="dd1">
								<form id="form1" action="#" method="post">
									<label>Filter</label>
									<div class="panel panel-default filter-selection">
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												Yes
											</label>
										</div>
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												No
											</label>
										</div>
									</div>
								</form>
							</div>
						</th>
						<th>A-CLUB Futures<button id="bt2" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd2"><i class="fa fa-caret-down"></i></button>
							<div class="filter panel panel-default collapse" id="dd2">
								<form id="form1" action="#" method="post">
									<label>Filter</label>
									<div class="panel panel-default filter-selection">
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												Yes
											</label>
										</div>
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												No
											</label>
										</div>
									</div>
								</form>
							</div>
						</th>
						<th>CAT<button id="bt3" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd3"><i class="fa fa-caret-down"></i></button>
							<div class="filter panel panel-default collapse" id="dd3">
								<form id="form1" action="#" method="post">
									<label>Filter</label>
									<div class="panel panel-default filter-selection">
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												Yes
											</label>
										</div>
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												No
											</label>
										</div>
									</div>
								</form>
							</div>
						</th>
						<th>MRG<button id="bt4" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd4"><i class="fa fa-caret-down"></i></button>
							<div class="filter panel panel-default collapse" id="dd4">
								<form id="form1" action="#" method="post">
									<label>Filter</label>
									<div class="panel panel-default filter-selection">
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												Yes
											</label>
										</div>
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												No
											</label>
										</div>
									</div>
								</form>
							</div>
						</th>
						<th>UOB<button id="bt5" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd5"><i class="fa fa-caret-down"></i></button>
							<div class="filter panel panel-default collapse" id="dd5">
								<form id="form1" action="#" method="post">
									<label>Filter</label>
									<div class="panel panel-default filter-selection">
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												Yes
											</label>
										</div>
										<div class="checkbox">
											<input class="check-filter margincheck" data-type="0" type="checkbox" value="0">
											<label>
												No
											</label>
										</div>
									</div>
								</form>
							</div>
						</th>
					</thead>
					<tbody>
					@foreach ($clients as $client)	
						<tr>
							<td> {{$client->master_id}} </td>
							<td> {{$client->name}} </td>
							@if ($client->stock)
								<td> v </td>
							@else
								<td> </td>
							@endif
							@if ($client->future)
								<td> v </td>
							@else
								<td> </td>
							@endif
							@if ($client->cat)
								<td> v </td>
							@else
								<td> </td>
							@endif
							@if ($client->mrg)
								<td> v </td>
							@else
								<td> </td>
							@endif
							@if ($client->uob)
								<td> v </td>
							@else
								<td> </td>
							@endif
						</tr>
					@endforeach
					</tbody>
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
</script>
