	<div>
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:red">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>	
	
	
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
								<label>{{$atr}}</label>
								<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
							</div>
						@endforeach
						<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
						<input type="submit" class="btn btn-default" value="Insert">
						<button type="reset" class="btn btn-default">Reset Form</button>
					</form>
				</div>
			</div>
		</div>
		@if(($route != 'product') and ($route != 'trans'))	
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
				<form action="" method="post"> 
                <!-- /.panel-heading -->
                <div class="panel-body">
					<div style="overflow-x:scroll">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
							<tr>
								<th> Select </th>
							@foreach ($heads as $head)
								<th> {{$head}} </th>
							@endforeach
								
							</tr>
                        </thead>
						<tbody>
						@foreach ($clients as $client)
							<tr class="gradeA">
								<td style="text-align:center;"><input id="" onchange="" type="checkbox" style=""></td>
							@foreach ($atts as $att)
                                @if ($route == 'green')
                                    <td> <a target="_blank" href="{{route($route . '.detail', ['id' => $client->green_id])}}">{{$client->$att}} </a></td>
                                @elseif ($route == 'RedClub')
                                    <td> <a target="_blank" href="{{route($route . '.detail', ['id' => $client->username])}}">{{$client->$att}} </a></td>
                                @elseif (($route != 'product') and ($route != 'trans'))
								    <td> <a target="_blank" href="{{route($route . '.detail', ['id' => $client->all_pc_id])}}">{{$client->$att}} </a></td>
								@else
									<td>{{$client->$att}}</td>
                                @endif
							@endforeach
							</tr>
						@endforeach
						</tbody>
					</table>
                    <!-- /.table-responsive -->
					</div>
					
					<div style="float:right">
						&nbsp &nbsp Prospect to:
						<select id="" onchange="" name="prospect">
							<option value="1">A-Club admin</option>
							<option value="2">MRG admin</option>
							<option value="3">CAT admin</option>
							<option value="4">UOB admin</option>
						</select>
						&nbsp &nbsp Assign to:
						<select id="" onchange="" name="assign">
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
						<button class="button turquoise" style="border: 0; margin:20px; margin-bottom:10px" type="submit" name="assbut"><span>✎</span>Save</button>
					</div>
				
                </div>
                <!-- /.panel-body -->
							
				</form>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
