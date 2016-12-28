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

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-child fa-fw"></i> Basic Information
                </div>
                <div class="panel-body">
					<div class="col-lg-1">
						Name <br>
						Address <br>
						Email <br>
						Phone <br>
						Status <br>
						Date Join <br>
						PC <br>
						Other info <br>
					</div>
					<div class="col-lg-10">
					: <br>
					: <br>
					: <br>
					: <br>
					: <br>
					: <br>
					: <br>
					: <br>
					</div>
				</div>
                <!-- /.panel-body -->
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
