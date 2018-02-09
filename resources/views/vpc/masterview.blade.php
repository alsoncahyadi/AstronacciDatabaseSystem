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
					<i class="fa fa-spinner fa-spin spinner_load" style="font-size:24px; margin-top:4px; display: none;"></i>
				</div>
			</div>
		</div>

		<div class="panel-body">
			<div class="row" id="bod1">
				<div class="col-xs-6">
					<table id="tablebase" class="table table-condensed table-striped table-bordered table-hover">
						<thead>
							<th>ID</th>
							<th>Name</th>
							<th style="min-width: 100px">A-CLUB Stocks <button id="bt1" class="btn btn-default btn-xs dd" data-toggle="modal" data-target="#dd1"><i class="fa fa-caret-down"></i></button>
								<div id="dd1" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Filter</h4>
											</div>
											<div class="modal-body">
												<div class="checkbox">
												<input class="check-filter margincheck" data-type="stock" type="checkbox" value="TRUE">
												<label>
													Yes
												</label>
											</div>
											<div class="checkbox">
												<input class="check-filter margincheck" data-type="stock" type="checkbox" value="FALSE">
												<label>
													No
												</label>
											</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>

									</div>
								</div>
							</th>
							<th style="min-width: 100px">A-CLUB Futures<button id="bt2" class="btn btn-default btn-xs dd" data-toggle="modal" data-target="#dd2"><i class="fa fa-caret-down"></i></button>
								<div id="dd2" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Filter</h4>
											</div>
											<div class="modal-body">
												<div class="checkbox">
												<input class="check-filter margincheck" data-type="future" type="checkbox" value="TRUE">
												<label>
													Yes
												</label>
											</div>
											<div class="checkbox">
												<input class="check-filter margincheck" data-type="future" type="checkbox" value="FALSE">
												<label>
													No
												</label>
											</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>

									</div>
								</div>
							</th>
							<th style="min-width: 80px">CAT<button id="bt3" class="btn btn-default btn-xs dd" data-toggle="modal" data-target="#dd3"><i class="fa fa-caret-down"></i></button>
								<div id="dd3" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Filter</h4>
											</div>
											<div class="modal-body">
												<div class="checkbox">
												<input class="check-filter margincheck" data-type="cat" type="checkbox" value="TRUE">
												<label>
													Yes
												</label>
											</div>
											<div class="checkbox">
												<input class="check-filter margincheck" data-type="cat" type="checkbox" value="FALSE">
												<label>
													No
												</label>
											</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>

									</div>
								</div>
							</th>
							<th style="min-width: 80px">MRG<button id="bt4" class="btn btn-default btn-xs dd" data-toggle="modal" data-target="#dd4"><i class="fa fa-caret-down"></i></button>
								<div id="dd4" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Filter</h4>
											</div>
											<div class="modal-body">
												<div class="checkbox">
												<input class="check-filter margincheck" data-type="mrg" type="checkbox" value="TRUE">
												<label>
													Yes
												</label>
											</div>
											<div class="checkbox">
												<input class="check-filter margincheck" data-type="mrg" type="checkbox" value="FALSE">
												<label>
													No
												</label>
											</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>

									</div>
								</div>
							</th>
							<th style="min-width: 80px">UOB<button id="bt5" class="btn btn-default btn-xs dd" data-toggle="modal" data-target="#dd5"><i class="fa fa-caret-down"></i></button>
								<div id="dd5" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Filter</h4>
											</div>
											<div class="modal-body">
												<div class="checkbox">
												<input class="check-filter margincheck" data-type="uob" type="checkbox" value="TRUE">
												<label>
													Yes
												</label>
											</div>
											<div class="checkbox">
												<input class="check-filter margincheck" data-type="uob" type="checkbox" value="FALSE">
												<label>
													No
												</label>
											</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>

									</div>
								</div>
							</th>
						</thead>
						<tbody id="tbody">@include('vpc/mastertable')</tbody>
					</table>
				</div>
				<div id="pageController" style="margin-left: 2px; margin-top: 12px;">
				<div class="col-xs-6" style="margin-left: 200px">
					Page
					<input id="pagenum" type="number" name="pagenum" value="1" min="1" max="{{ (isset($count) ? $count : "" )}}">
					/<label id="page_count">{{ (isset($count) ? $count : "" )}}</label>
					<button id="page_number">Go</button>
				</div>
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
	var filters = {};
	$( ".filterCity" ).change(function() {
		arrFilter = [];
		$.each($(".filterCity:checked"), function(){            
                arrFilter.push($(this).val());
            });
		jsonFilter = JSON.parse(JSON.stringify(arrFilter));
		console.log(jsonFilter);
	});

	function sortAndFilter(page) {
		var sorts = {};

		var json_filters = JSON.stringify(filters);
		console.log(json_filters);

		$(".spinner_load").css('display', 'inline-block');
		// Request to API
	    var request = $.ajax({
	        url: "/master/filter",
	        type: "post",
	        data: {
						"_token": "{{ csrf_token() }}",
						"filters": json_filters,
						"page": page,
						"ajax": true
					}
	    });

		// Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
			// console.log(response);
			$("#tbody").html(response);
			$(".clone").remove();
			$(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');

			var count_page = $("#hidden_page_count").val();
			$("#page_count").html(count_page);
			$("#pagenum").attr({"max" : count_page});
	    	$(".spinner_load").css('display', 'none');
	    });

	}

	$("body").click(function(e) {
		var elem = e.target;
		console.log(elem.className);
		if (elem.className =='check-filter margincheck'){
			var filter_type = elem.getAttribute("data-type");
			var filter_value = elem.value;
			if (elem.checked) {
				// alert(filter_type + " " + filter_value);
				if (filters[filter_type]) {
					filters[filter_type].push(filter_value);
				} else {
					filters[filter_type] = [];
					filters[filter_type].push(filter_value);
				}
			} else {
				filters[filter_type].splice($.inArray(filter_value, filters[filter_type]),1);
				if (filters[filter_type].length == 0) {
					delete filters[filter_type];
				}
			}
			sortAndFilter(1);
			$("#pagenum").val("1");
		}
	});

	$("#page_number").click(function() {
		// var filter_type = $(".check-filter").attr("data-type");
		// var filter_value = $(".check-filter").val();
		// if ($(".check-filter").prop('checked')) {
		// 	// alert(filter_type + " " + filter_value);
		// 	if (filters[filter_type]) {
		// 		filters[filter_type].push(filter_value);
		// 	} else {
		// 		filters[filter_type] = [];
		// 		filters[filter_type].push(filter_value);
		// 	}
		// } else {
		// 	filters[filter_type].splice($.inArray(filter_value, filters[filter_type]),1);
		// 	if (filters[filter_type].length == 0) {
		// 		delete filters[filter_type];
		// 	}
		// }
		var page = $("#pagenum").val();		
		sortAndFilter(page);
	});

</script>
