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
						<th>A-CLUB Stocks<button id="bt1" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd1"><i class="fa fa-caret-down"></i></button></th>
						<th>A-CLUB Futures<button id="bt2" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd2"><i class="fa fa-caret-down"></i></button></th>
						<th>CAT<button id="bt3" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd3"><i class="fa fa-caret-down"></i></button></th>
						<th>MRG<button id="bt4" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd4"><i class="fa fa-caret-down"></i></button></th>
						<th>UOB<button id="bt5" class="btn btn-default btn-xs dd" data-toggle="collapse" href="#dd5"><i class="fa fa-caret-down"></i></button></th>
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
