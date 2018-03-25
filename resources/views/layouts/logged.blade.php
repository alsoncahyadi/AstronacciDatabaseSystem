<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Astronacci Database System</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('images/favicon.ico') }}" />

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ URL::asset('css/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ URL::asset('css/styling.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/select.dataTables.min.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ URL::asset('js/laravel.js') }}"></script>
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

    <script src="{{ URL::asset('js/astronacci.js') }}"></script>

    <!-- Icon Script -->
    <script src="{{ URL::asset('js/e365a82a3d.js') }}"></script>

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
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-image: url('{{ URL::asset('images/swirl_pattern1.png') }}') ;">
            <div class="navbar-header" style="height:95px;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route ('home')}}"><img src="{{ URL::asset('images/logo.png') }}"/></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw" style="color:black;"></i> <i class="fa fa-caret-down" style="color:black;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url('updatePassword')}}"><i class="fa fa-user fa-fw"></i> Change Password</a>
                        </li>
                        @if (Auth::user()->hasAnyRole(['0']))
                        <li>
                            <a href="{{ url('list') }}"><i class="fa fa-gear fa-fw"></i> User List</a>
                        </li>
                        @endif
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

            <div class="navbar-default sidebar" role="navigation" style="width:15%">                
                <div class="sidebar-nav navbar-collapse">					
                    <ul class="nav" id="side-menu"  style="background-color:#dd1111">
                      <ul class="nav">
                          <li>
                             <a href="dashboard" style="color:white;"><i class="fa fa-dashboard fa-fw"></i> Client Member <span class="fa arrow"></span></a>
                         </li>
                     </ul>
                     @if (Auth::user()->hasAShop(Auth::user()->username))
                     <li>
                        <a href="AShopDashboards" style="color:white;"><i class="fa fa-shopping-cart fa-fw"></i> A-SHOP<span class="fa arrow"></span></a>
                    </li>
                    @endif
                    @if (Auth::user()->hasAnyRole(['0']))
                    <li id="t3">
                        <a href="GreenDashboard" style="color:white;"><i class="fa fa-pencil-square-o fa-fw"></i> Green Prospect</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
    </nav>

    <div id="page-wrapper" style="padding-bottom:10px; margin-left:15%">
     <img src="{{ URL::asset('images/pojokatas.png') }}"style="position:absolute; top:95; right:0;"/>
     @yield('content')
 </div>
</div>

</body>
</html>