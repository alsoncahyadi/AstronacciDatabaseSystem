	<div>
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:red">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>	
		
	
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
				List of Sales Prospect
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
				<h1>{{ $user }}</h1>
				<form>
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
						<?php $idx = 0; ?>
							@foreach ($clients as $client)																				
							<tr class="gradeA">
								@foreach ($atts as $att)
									<td>{{$client->$att}}</td>
								@endforeach
							</tr>
							<?php $idx = $idx + 1; ?>	
						@endforeach
						</tbody>
						<input type="hidden" name="numusers" value="{{ $idx }}">
					</table>
                    <!-- /.table-responsive -->
                </form>    
                </div>
                <!-- /.panel-body -->
				<form>
					<input type="text">
					<button type="submit">Report</button>
				</form>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
