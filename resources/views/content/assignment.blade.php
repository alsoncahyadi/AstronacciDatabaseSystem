@extends('layouts.logged')
@section('content')
            
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
	});
	</script>
	<script>
		function checkChange(idx) {
			var ashopcb = document.getElementById("ashop"+idx);
			var rolesel = document.getElementById("roles"+idx);
			if ((ashopcb.checked != ashopcb.defaultChecked)||(!rolesel.options[rolesel.selectedIndex].defaultSelected)) {
				document.getElementById("ischanged"+idx).checked = true;
				if (!document.getElementById("isdel"+idx).checked) {
					document.getElementById(idx).style.backgroundColor = "yellow";
				}
			}
			else {
				document.getElementById("ischanged"+idx).checked = false;
				if (!document.getElementById("isdel"+idx).checked) {
					if (idx % 2 == 0){
						document.getElementById(idx).style.backgroundColor = "white";
					} else {
						document.getElementById(idx).style.backgroundColor = "#e7e7e7";
					}
				}
			}
		}
		function checkDel(idx) {
			var seldel = document.getElementById("isdel"+idx);
			var delbut = document.getElementById("delbut"+idx);
			if (seldel.checked) {				
				seldel.checked = false;
				delbut.innerHTML = "X";
				if (document.getElementById("ischanged"+idx).checked == true){
					document.getElementById(idx).style.backgroundColor = "yellow";
				} else
				if (idx % 2 == 0){
					document.getElementById(idx).style.backgroundColor = "white";
				} else {
					document.getElementById(idx).style.backgroundColor = "#e7e7e7";
				}
				
			}
			else {
				seldel.checked = true;
				delbut.innerHTML = "Undo";
				document.getElementById(idx).style.backgroundColor = "red";
			}
		}
	</script>

	<div>
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:red">List of Assignment</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>	
	
	@if ($route != 'assign')
		<div class="panel-group" id="accordion1">
			<div class="panel">
				@if($route == 'product')
					<a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#addcli">Add New Product</a>
				@elseif ($route == 'trans')
					<a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#addcli">Add New Transaction</a>
				@else
					<a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#addcli">Add New Client</a>
				@endif
				<div id="addcli" class="panel-collapse collapse">
					<div class="panel-body">
						<form method="post" action="{{route($route . '.insert')}}">
							@foreach ($ins as $atr)
								<div class="form-group">
									@if ($atr == 'Product ID')
										<label>{{$atr}}</label><br>
										<select id = "myList" name="{{strtolower(str_replace(' ', '_', $atr))}}">
										@foreach($prods as $prod)
										<option value = {{$prod->product_id}}>{{$prod->product_id}}</option>
						               @endforeach
										</select>
									@elseif ($atr == 'PC ID')
										<label>{{$atr}}</label><br>
										<select id = "myList" name="{{strtolower(str_replace(' ', '_', $atr))}}">
										@foreach($foreigns as $foreign)
										<option value = {{$foreign->all_pc_id}}>{{$foreign->all_pc_id}}->{{$foreign->fullname}}</option>
						               @endforeach
										</select>
									@elseif ($atr == 'Sales')
										<label>{{$atr}}</label><br>
										<select id = "myList" name="{{strtolower(str_replace(' ', '_', $atr))}}">
										@foreach($sales as $sales)
										<option value = {{$sales->sales_username}}>{{$sales->sales_username}}</option>
						               @endforeach
										</select>
									@else
										<label>{{$atr}}</label>
										<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
									@endif
								</div>
							@endforeach
							<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
							<input type="submit" class="btn btn-default" value="Insert">
							<button type="reset" class="btn btn-default">Reset Form</button>
						</form>
					</div>
				</div>
			</div>
		@endif
		@if(($route != 'product') and ($route != 'trans') and ($route != 'assign'))	
		<div class="panel">
			<a class="btn btn-primary" data-toggle="collapse" data-parent="#accordion1" href="#impo">Import Excel File</a>       
			<div id="impo" class="panel-collapse collapse">
				<div class="panel-body">
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
	@endif
	
	
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
				List of {{ $route }} client
                </div>
				<!-- TODO FORM -->
				@if($route == 'green')
					<form action="{{ route('green.assign') }}" method="post">
				@elseif($route == 'RedClub')
					<form action="{{ route('RedClub.assign') }}" method="post">
				@else
					<form action="{{ route('grow.assign') }}" method="post">
				@endif
				
                <!-- /.panel-heading -->
                <div class="panel-body">
					<div style="overflow-x:scroll">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
							<tr>
							@if(($route == 'green')||($route == 'RedClub')||($route == 'grow'))
								<th> Select </th>
							@endif
							@foreach ($heads as $head)
								<th> {{$head}} </th>
							@endforeach
								
							</tr>
                        </thead>
						<tbody>
						<?php $idx = 0; ?>
						@foreach ($clients as $client)																				
							<tr class="gradeA">
								@if(($route == 'green')||($route == 'RedClub')||($route == 'grow'))
								<td style="text-align:center;">
									<input id="" onchange="" type="checkbox" style="" name="assigned{{ $idx }}">
									@if($route == 'green')
									<input type="hidden" name="id{{ $idx }}" value={{ $client->green_id }}>
									@elseif($route == 'RedClub')
									<input type="hidden" name="id{{ $idx }}" value={{ $client->username }}>
									@elseif($route == 'grow')
									<input type="hidden" name="id{{ $idx }}" value={{ $client->grow_id }}>
									@endif
								</td>
								@endif
							@foreach ($atts as $att)
                                @if ($route == 'green')
                                    <td> <a target="_blank" href="{{route($route . '.detail', ['id' => $client->green_id])}}">{{$client->$att}} </a></td>
                                @elseif ($route == 'RedClub')
                                    <td> <a target="_blank" href="{{route($route . '.detail', ['id' => $client->username])}}">{{$client->$att}} </a></td>
                                @elseif ($route == 'assign')
                                		@if ($client->type == 'green')
								    		<td> <a target="_blank" href="{{route($route . '.greendetail', ['id' => $client->assign_id])}}">{{$client->$att}} </a></td>
								    	@elseif ($client->type == 'grow')
								    		<td> <a target="_blank" href="{{route($route . '.growdetail', ['id' => $client->assign_id])}}">{{$client->$att}} </a></td>
								    	@else ($client->type == 'redclub')
								    		<td> <a target="_blank" href="{{route($route . '.redclubdetail', ['id' => $client->assign_id])}}">{{$client->$att}} </a></td>
								    	@endif
                                @elseif (($route != 'product') and ($route != 'trans'))
								    <td> <a target="_blank" href="{{route($route . '.detail', ['id' => $client->all_pc_id])}}">{{$client->$att}} </a></td>
								
								@else

									<td>{{$client->$att}}</td>
                                @endif
							@endforeach
							</tr>
							
							<?php $idx = $idx + 1; ?>
							
						@endforeach
						</tbody>
						<input type="hidden" name="numusers" value="{{ $idx }}">
					</table>
                    <!-- /.table-responsive -->
					</div>
					{{ csrf_field() }}
					
					@if(($route == 'green')||($route == 'RedClub')||($route == 'grow'))
					<input type="hidden" name="username" value={{ Auth::user()->username }}>
					<div style="float:right">
						&nbsp &nbsp Prospect to:
						<select id="" onchange="" name="prospect">
							<option {{ Auth::user()->hasRole(Auth::user()->username, '1') ? 'selected' : ''}}>A-CLUB</option>
							<option {{ Auth::user()->hasRole(Auth::user()->username, '2') ? 'selected' : ''}}>MRG</option>
							<option {{ Auth::user()->hasRole(Auth::user()->username, '3') ? 'selected' : ''}}>CAT</option>
							<option {{ Auth::user()->hasRole(Auth::user()->username, '4') ? 'selected' : ''}}>UOB</option>
						</select>
						&nbsp &nbsp Assign to:
						<select name="assign">
						@foreach($sales as $sale)
							<option>{{$sale->sales_username}}</option>
						@endforeach
						</select>
						<button class="button turquoise" style="border: 0; margin:20px; margin-bottom:10px" type="submit" name="assbut"><span>✎</span>Save</button>
					</div>
					@endif
				
                </div>
                <!-- /.panel-body -->
							
				</form>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
 @endsection
