<?php use App\MonthDropdownValidator; ?>
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
		.clone .collumn-select, .clone .birthday-column  {
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
		#copy_clipboard {
		  position: fixed;
		  bottom: 0;
		  right: 0;
		  pointer-events: none;
		  opacity: 0;
		  transform: scale(0);
		}
		th.fixed-side {
			background-color: #fff !important;
		}
		.popup{
			display:none;
			position:absolute;
			background:#f5f5f5;
			border-radius:6px;
			padding:6px;
		}
	</style>
</head>
<body style="overflow-x:hidden;  background-image: url('{{ URL::asset('images/swirl_pattern1.png') }}'); padding:15px;">
	<div id="wrapper" >

		<div class="row">
			<div class="col-lg-12">
				<h1>MRG Members</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
	</div>
<!-- MODAL TGL LAHIR -->
	<div id="tgllahir" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Filter</h4>
				</div>
				<div class="modal-body">
					@foreach($filter_birthdates as $filter_birthdate)
					<div class="checkbox">
						@foreach($filter_birthdate as $f)
						<label>
							<input type="checkbox" class="check-filter" data-type="birthdate" value="{{date('m', strtotime($f))}}"> {{ $f }}
						</label>
						@endforeach
					</div>
					@endforeach
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading vpchead">
			<div class="row">
                <div class="col-md-3 row">
                    <div class="col-md-4">
                        <a href="{{route('home')}}"><button type="button" class="btn btn-default">Back</button></a>&nbsp;
                        <i class="fa fa-spinner fa-spin spinner_load" style="font-size:24px; margin-top:4px;position:fixed;display:none"></i>
                    </div>
                    <div class="col-md-8">
                    </div>
                </div>
                <div class="col-md-9 row" style="float: right;">
                    <div class="col-md-1" style="white-space: nowrap; padding-left: 0px;">Sort by:</div>
                    <!--SORT PARAMS -->
                    <div class="col-md-2">
                        <select class="sort form-control no-spin" name="sort1">
                            <option value=""> <option>
                            @foreach ($sortables as $sortable => $value)
                                <option value="{{ $value }}">{{ $sortable }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="sort form-control no-spin" name="sort2">
                            <option value=""> <option>
                            @foreach ($sortables as $sortable => $value)
                                <option value="{{ $value }}">{{ $sortable }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="sort form-control no-spin" name="sort3">
                            <option value=""> <option>
                            @foreach ($sortables as $sortable => $value)
                                <option value="{{ $value }}">{{ $sortable }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1" style="white-space: nowrap; padding-left: 0px;">Order :</div>
					<div class="col-md-3">
						<form action="">
							<input class="check-sort" type="radio" name="asc-desc" id="asc-desc" value="asc"> asc (&#8593;) &nbsp;
							<input class="check-sort" type="radio" name="asc-desc" id="asc-desc" value="desc"> desc (&#8595;)
						</form>
					</div>
                    <div class="col-md-1" style="width:2%;">
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
								<!-- Mendapatkan judul setiap kolom pada tabel dari variabel heads -->
								@foreach ($headsMaster as $headMaster)
									@if ($headMaster == 'Tanggal Lahir')
									<th class="fixed-side birthday-column" scope="col" style="min-width: 130px;"> {{ $headMaster }} 
									<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="modal" href="#tgllahir"><i class="fa fa-caret-down"></i></button>
									@else
									<th class="fixed-side" scope="col"> {{ $headMaster }} 
									@endif
								</th>
								<?php $idx = $idx + 1; ?>
								@endforeach

								<!-- Mendapatkan judul setiap kolom pada tabel dari variabel heads -->
								<?php $idx = 6; ?>
								@foreach ($heads as $head => $value)
								<th style="white-space: nowrap; min-width: 180px"> <div style="display: inline-block;">{{$head}}</div>
								@if (isset($filterable[$head]))
								<button id="bt{{$idx}}" class="btn btn-default btn-xs dd" data-toggle="modal" data-target="#dd{{$idx}}"><i class="fa fa-caret-down"></i></button>

									<div id="dd{{$idx}}" class="modal fade" role="dialog">
									  <div class="modal-dialog">

									    <!-- Modal content-->
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal">&times;</button>
									        <h4 class="modal-title">Filter</h4>
									      </div>
									      <div class="modal-body">
									        @foreach ($filterable[$head] as $filter)
												<div class="checkbox">
													<label>
														@foreach ($filter as $f)						
														@if (!MonthDropdownValidator::is_month($f))
														<input {{$f}} class="check-filter" data-type="{{$value}}" type="checkbox" value="{{$f}}">
														{{ $f }}
														@else
														<input {{$f}} class="check-filter" data-type="{{$value}}" type="checkbox" value="{{date('m', strtotime($f))}}">
														{{ $f }}
														@endif
														@endforeach
													</label>
												</div>											
											@endforeach
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									      </div>
									    </div>

									  </div>
									</div>
								@endif
								</th>
								<?php $idx = $idx + 1; ?>
								@endforeach

							</tr>
						</thead>
						
						<tbody id="tbody">@include('vpc/mrgtable')</tbody>
						<input type="hidden" name="numusers" value="{{ $idx }}">
				</table>
				</div>
			</div>

			
		</div>
		<br>
        <div class="row">
            <div class="col-md-8">
                <div id="pageController" style="margin-left: 2px;">
                    Page
                    <input id="pagenum" type="number" name="pagenum" value="1" min="1" max="{{$count}}">
                    /<label id="page_count">{{$count}}</label>
                    <button id="page_number">Go</button>
                </div>
            </div>
            <div class="col-md-4">
                <button onclick="downloadFx()" class="btn btn-default" style="float:right"><i class="fa fa-download"></i> &nbsp Download </button>
                <button onclick="templateFx()" class="btn btn-default" style="float:right"><i class="fa fa-download"></i> &nbsp Template </button>
                <a class="btn btn-default" data-toggle="collapse" data-parent="#accordion" href="#collapse" style="float:right">Import Excel File</a>
				<br><br>
				<div id="collapse" class="panel-collapse collapse">
					<div class="well" style="float:right">
						<form method="post" action="{{route($route . '.import')}}" enctype="multipart/form-data">
							<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
							<input type="file" name="import_file" />
							<br>
							<button class="btn btn-primary">Import .xls File</button>
						</form>
					</div>
				</div>
            </div>
        </div>
        @if ($errors->any())
			<div class="alert alert-danger">
				<ul>
				    @foreach ($errors->all() as $error)
				        <li>{{ $error }}</li>
				    @endforeach
				</ul>
			</div>
		@endif
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

		$('.sort').each(function() {
			var sort_value = $(this).find(":selected").val();
			if (sort_value) {
				if (document.getElementById("asc-desc").checked) {
                    $('.check-sort:checked').each(function() {
                        var check_sort = $(this).val();
                        if (check_sort == 'asc') {
                            sorts[sort_value] = true;
                        } else {
                            sorts[sort_value] = false;
                        }
                    });
                } else {
                    sorts[sort_value] = false;
                }
			}
		});

		var json_sorts = JSON.stringify(sorts);
		console.log(json_sorts);
		$(".spinner_load").css('display', 'table');
		// Request to API
	    var request = $.ajax({
	        url: "/MRG/filter",
	        type: "post",
	        data: {
						"_token": "{{ csrf_token() }}",
						"filters": json_filters,
						"sorts": json_sorts,
						"page": page
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

		var var_page = document.getElementById("pagenum").value;

		// Request to API
	    var request = $.ajax({
	        url: "/MRG/filter",
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
			$("#tbody").html(response);
			$(".clone").remove();
			$(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');

			var count_page = $("#hidden_page_count").val();
			$("#page_count").html(count_page);
	    });
	}

	$("body").click(function(e) {
		var elem = e.target;
		if (elem.className =='check-filter'){
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

	$("#sort-button").click(function() {
		sortAndFilter(1);
		$("#pagenum").val("1");
	});

	$("#page_number").click(function() {
		gotoPage();
		console.log($("#pagenum").val());
		sortAndFilter($("#pagenum").val());
	});

	function copyFunction(x) {
		$('#copy_clipboard').remove();
		const txt = document.createElement('textarea');
		txt.id = 'copy_clipboard'
		document.body.appendChild(txt);
		txt.value = x.innerHTML; // chrome uses this
		txt.textContent = x.innerHTML; // FF uses this
		var sel = getSelection();
		var range = document.createRange();
		range.selectNode(txt);
		sel.removeAllRanges();
		sel.addRange(range);
		document.execCommand("Copy");
	    
        var html_popup = '<div class="popup">text copied</div>';
        $('.popup').remove();
        $('#wrapper').prepend(html_popup);
        $('.popup').css('top', '5vh');
        $('.popup').css('left', 'calc( 50% - 30px)');
        $('.popup').fadeIn();
        $('.popup').delay(500).fadeOut("slow");
	}

	function downloadFx() {
		window.location.href = "/export/mrg";
	}

	function templateFx() {
		window.location.href = "/template/mrg";
	}
</script>
