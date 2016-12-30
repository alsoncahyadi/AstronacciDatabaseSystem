@extends('layouts.logged')
@section('content')
    <div>
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:red">Profile</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
            <!-- /.row -->
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-child fa-fw"></i> Basic Information 
					<button class="btn btn-default" id="hide" style="margin-left:30px"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
					<button class="btn btn-danger" id="show" style="margin-left:30px;display:none"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
                </div>
				
                <div class="panel-body" >
					<div id="bod1">
						<div class="form-group">
                            @foreach ($heads as $key => $value)
                                <div style="height:60px">
                                    <label>{{$key}}</label><br>
                                    {{$client->$value}}<br><br>
                                </div>
                            @endforeach
                            @if(($route == "CAT") || ($route == "AClub"))
                                <hr>
                                <H3>REGISTRASI</H3><br>
                                @foreach ($insreg as $keyreg => $value)
                                    <div style="height:60px">
                                        <label>{{$keyreg}}</label><br>
                                        {{$clientreg->$value}}<br><br>
                                    </div>
                                @endforeach
                            @endif
						</div>
					</div>
					<div id="bod2" style="display:none">
						<form role="form" method="post" action="{{route($route . '.edit')}}">
							<div class="form-group">
								
                                @foreach ($ins as $key => $value)
                                    <div style="height:60px">
                                        <label>{{$key}}</label>
                                        <input class="form-control" value="{{$client->$value}}" name="{{$value}}">
                                    </div>
                                @endforeach
							</div>
							<button type="submit" class="btn btn-default">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                            @if ($route != "green")
                                <input type="hidden" name="all_pc_id" value="{{$client->all_pc_id}}">
                            @endif
						</form>
					</div> 
				</div>
            </div>

            <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-money fa-fw"></i> Transactions
                    </div>
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="trans">
                        <thead>
							<tr>
							
								<th> head </th>
								<th> head2</th>
								<th> head3</th>
							
								
							</tr>
                        </thead>
						<tbody>
						
							<tr class="gradeA">
							
                                
                                    <td> tes </td>
                                    <td> tes2 </td>
                                    <td> tes3 </td>
                                
							
							</tr>
						
						</tbody>
					</table>
                    </div>
                    <!-- /.panel-body -->
                </div>
            

	<br><br>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <h4>{{$error}}</h4>
        @endforeach
    @endif
	
@endsection
</html>
