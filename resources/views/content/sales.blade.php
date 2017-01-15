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
								<th> Name </th>
								<th> Email </th>
								<th> Phone </th>
								<th> Assigned By </th>
								<th> Status </th>
							</tr>
                        </thead>
						<tbody>
							<tr class="gradeA">
								<td>a</td>
								<td>b</td>
								<td>c</td>
								<td>d</td>
								<td>e</td>
								<td>f</td>
							</tr>
						</tbody>
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
