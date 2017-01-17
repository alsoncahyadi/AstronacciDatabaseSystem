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
            <div class="panel panel-default">
                <div class="panel-heading">
				List of Sales Prospect
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" onload="alert('Test');">
				<h1>Clients</h1>
				<form>
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<?php $idx = 0; ?>
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
							<tr class="gradeA">
								<td><a target="_blank" href="{{route('report.detail', ['type'=> $client->type, 'id' => $client->assign_id])}}">Report</a></td>
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
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
