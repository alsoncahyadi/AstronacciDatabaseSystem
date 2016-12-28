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
							<div style="height:60px">
								<label>Nama</label><br>
								Michael Tjandra<br><br>
							</div>
							<div style="height:60px">
								<label>Gender</label><br>
								Ayam<br>
							</div>
						</div>
					</div>
					<div id="bod2" style="display:none">
						<form role="form">
							<div class="form-group">
								<div style="height:60px">
									<label>Nama</label>
									<input class="form-control">
								</div>
								<div style="height:60px">
									<label>Gender</label>
									<input class="form-control">
								</div>
							</div>
							<button type="submit" class="btn btn-default">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
						</form>
					</div> 
				</div>
            </div>

            <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-money fa-fw"></i> Transactions
                    </div>
                    <div class="panel-body">
                        Ini isinya TABEL
                    </div>
                    <!-- /.panel-body -->
                </div>
            

	<br><br>
	
@endsection
</html>
