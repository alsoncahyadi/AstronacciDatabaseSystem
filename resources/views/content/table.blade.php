	<div>
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:red">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
	<br>
	
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
				List of {{ $route }} client
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
							<tr>
							@foreach ($heads as $head)
								<th> {{$head}} </th>
							@endforeach
							</tr>
                        </thead>
						<tbody>
						@foreach ($clients as $client)
							<tr class="gradeA">
							@foreach ($atts as $att)
								<td> <a href="{{route($route . '.detail', ['id' => $client->all_pc_id])}}">{{$client->$att}} </a></td>
							@endforeach
							</tr>
						@endforeach
						</tbody>
					</table>
                    <!-- /.table-responsive -->
                    
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

	
	
	<form method="post" action="{{route($route . '.insert')}}">
		@foreach ($ins as $atr)
			{{$atr}} <input type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}"> <br/>
		@endforeach
		<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
		<input type="submit" value="insert">
	</form>

	<form method="post" action="{{route($route . '.import')}}" enctype="multipart/form-data">
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
		<input type="file" name="import_file" />
		<button class="btn btn-primary">Import File</button>
	</form>