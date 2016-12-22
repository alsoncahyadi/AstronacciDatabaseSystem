<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Astronacci Database System</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ URL::asset('css/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/select.dataTables.min.css') }}" rel="stylesheet">
	    <!-- Scripts -->
	<!-- jQuery -->

    <script src="{{ URL::asset('js/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('js/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ URL::asset('js/metisMenu/metisMenu.min.js') }}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{ URL::asset('js/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::asset('js/morrisjs/morris.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ URL::asset('js/sb-admin-2.js') }}"></script>
	<script src="{{ URL::asset('js/datatables/js/jquery.dataTables.min.js') }}"></script>
	
<!--	<script src="{{ URL::asset('js/loader.js') }}"></script>	-->
	
	<script>
    function load($type, $pc) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tab").innerHTML = this.responseText;
        }
    };
    $str = "{{route('AClub')}}";
    if ($type == "table"){
		if ($pc == "CAT") {
			$str = "{{route('CAT')}}";
		} else if ($pc == "MRG") {
			$str = "{{route('MRG')}}";
		} else if ($pc == "UOB") {
			$str = "{{route('UOB')}}";
		}
	} else
	if ($type == "form"){
		if ($pc == "CAT") {
			$str = "{{route('CAT.add')}}";
		} else if ($pc == "MRG") {
			$str = "{{route('MRG.add')}}";
		} else if ($pc == "UOB") {
			$str = "{{route('UOB.add')}}";
		}
	}
    xmlhttp.open("GET", $str, true);
    xmlhttp.send();

}    
    </script>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-image: url('{{ URL::asset('img/swirl_pattern1.png') }}') ;">
            <div class="navbar-header" style="height:95px;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src="{{ URL::asset('img/logo.png') }}"/></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw" style="color:black;"></i> <i class="fa fa-caret-down" style="color:black;" ></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-calendar-o fa-fw"></i> Budi's Birthday
                                    <span class="pull-right text-muted small"> Today</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>                        
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New client assigned
                                    <span class="pull-right text-muted small"> Today</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New client assigned
                                    <span class="pull-right text-muted small"> Yesterday</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw" style="color:black;"></i> <i class="fa fa-caret-down" style="color:black;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i> Logout</a>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu"  style="background-color:#dd1111;">
                        <li id="t2">
                            
                        </li>                        
                        <li id="t1">
                            <a href="index.html" style="color:white;"><i class="fa fa-dashboard fa-fw"></i> Dashboard<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a onclick="load('form', 'AClub')" href="#" style="color:white;">Admin A-Club</a>
                                </li>
                                <li>
                                    <a onclick="load('form', 'MRG')" href="#" style="color:white;">Admin MRG</a>
                                </li>
                                <li>
                                    <a onclick="load('table', 'UOB'); " href="#" style="color:white;">Admin UOB</a>
                                </li>
                                <li>
                                    <a onclick="load('form', 'CAT')" href="#" style="color:white;">Admin CAT</a>
                                </li>
                                <li>
                                    <a href="#" style="color:white;">Sales</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li id="t2">
                            <a href="{{ url('dashboard2') }}" style="color:white;"><i class="fa fa-bar-chart-o fa-fw"></i> A-Shop</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
        </nav>
		
		<div id="page-wrapper">
			<br>
			@yield('content')
		</div>
    </div>

</body>
</html>