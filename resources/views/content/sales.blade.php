	<div>
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:red">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>	
	
	<script>
	function hidePopup() {
		alert("hey");
		var popup = document.getElementById("popup");
		popup.style.visibility = "hidden";
	}
	
	function showPopup(id) {
		alert("woy");
		var popup = document.getElementById("popup");
		popup.style.visibility = "visible";		
	}
	</script>
	
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" id="panel1">
                <div class="panel-heading">
				List of Sales Prospect
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
				<h1>Clients</h1>
				<form>
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">						
                        <thead>							
							<tr>
							<th>Report</th>
							@foreach ($heads as $head)
								<th> {{$head}} </th>
							@endforeach
							</tr>
                        </thead>
						<tbody>
							@foreach ($clients as $client)
								@if (($client->report_time) <= 0)
								<tr class="gradeA">
									<td><a target="_blank" onclick="salesinput('{{$client->assign_id}}','{{$client->type}}')">Report</a></td>
									@foreach ($atts as $att)
										<td>{{$client->$att}}</td>
									@endforeach
								</tr>
								@endif
							@endforeach
						</tbody>
						
					</table>
                    <!-- /.table-responsive -->
                </form>
                </div>
                <!-- /.panel-body -->			
            </div>
            <!-- /.panel -->
			
			
			<div id="panel2" class="panel panel-default" style="display:none">
				<div class="panel-heading">
					Add Report
                </div>
				<div class="panel-body">
					<form id="repformid" method="post">
						<textarea name="report"></textarea>
						<br />
						<input name="issuccess" type="checkbox">		
						<input id="inputid" name="id" type="hidden" value=""> 
						<input id="inputtype" name="idtype" type="hidden" value=""> 
						<br />
						<button name="assbut" type="submit">Report</button>
						{{ csrf_field() }}
					</form>
				</div>
			</div>
			
        </div>
        <!-- /.col-lg-12 -->
    </div>
