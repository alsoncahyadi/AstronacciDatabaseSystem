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
					<a href="www.google.com" style="padding-left:50px"><i class="fa fa-pencil-square-o"></i> Edit </a>
                </div>
                <div class="panel-body">
					
					<div>
						<div class="col-lg-1">
							Name
						</div>
						<div class="col-lg-11">
							: Something
						</div>
					</div>
					<div>
						<div class="col-lg-1">
							Gender
						</div>
						<div class="col-lg-11">
							: sex
						</div>
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
