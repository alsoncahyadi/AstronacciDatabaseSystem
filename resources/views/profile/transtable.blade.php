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

    <script src="{{ URL::asset('js/astronacci.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body style="overflow-x:hidden;  background-image: url('{{ URL::asset('images/swirl_pattern1.png') }}') ;">	   

    @if(($route == "CAT") || ($route == "MRG") || ($route == "UOB") || ($route == "green") || ($route == "AShop"))
    <div class="panel panel-default" style="margin:15px">        
            @if (($route == "CAT") || ($route == "UOB"))
                <?php $had_trans = false; ?>
                @foreach ($insreg as $atr)
                    <?php $atr2 = strtolower(str_replace(' ', '_',$atr)); ?>
                    @if ($client->$atr2 != NULL)
                        <?php $had_trans = true; ?>
                    @endif
                @endforeach
            @else
            <table width="100%" class="table table-striped table-bordered table-hover" id="trans">
                <thead>
                    <tr>
                        @foreach ($headsreg as $headreg)
                        <th> {{$headreg}} </th>
                        @endforeach
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientsreg as $clientreg)
                    
                    <tr class="gradeA">
                        <?php $count_temp = 1 ; ?>
                        @foreach ($attsreg as $attreg)
                       @if ($route == 'AClub')
                            <td> <a target="_blank" href="{{route('AClub.member',['id' => $client->master_id, 'package' => $clientreg->user_id])}}">{{$clientreg->$attreg}} </a>
                                @if ($count_temp == 1)
                                    <div class="btn-hvr-container"><button class="btn btn-primary hvr-btn">edit</button><button class="btn btn-primary hvr-btn">delete</button></div></td>
                                    <?php $count_temp++ ; ?>
                                @else
                                    </td>
                                @endif
                        @elseif ($route == 'green') 
                            <td> <a target="_blank" href="{{route('green.trans',['id' => $client->green_id, 'progress' => $clientreg->progress_id])}}">{{$clientreg->$attreg}} </a>
                                @if ($count_temp == 1)
                                    <div class="btn-hvr-container"><button class="btn btn-primary hvr-btn">edit</button><button class="btn btn-primary hvr-btn">delete</button></div></td>
                                    <?php $count_temp++ ; ?>
                                @else
                                    </td>
                                @endif
                        @elseif ($route == 'MRG')
                            <td> <a target="_blank" href="{{route('MRG.account',['id' => $client->master_id, 'account' => $clientreg->accounts_number])}}">{{$clientreg->$attreg}} </a>
                                @if ($count_temp == 1)
                                    <div class="btn-hvr-container"><button class="btn btn-primary hvr-btn">edit</button><button class="btn btn-primary hvr-btn">delete</button></div></td>
                                    <?php $count_temp++ ; ?>
                                @else
                                    </td>
                                @endif
                        @else
                            <td> <a target="_blank" href="{{route('AShop.trans',['id' => $client->master_id, 'transaction' => $clientreg->transaction_id])}}">{{$clientreg->$attreg}} </a>
                                @if ($count_temp == 1)
                                    <div class="btn-hvr-container"><button class="btn btn-primary hvr-btn">edit</button><button class="btn btn-primary hvr-btn">delete</button></div></td>
                                    <?php $count_temp++ ; ?>
                                @else
                                    </td>
                                @endif
                        @endif

                        @endforeach
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
    @elseif ($route == 'AClub')
    <div class="panel panel-default" style="margin:15px">                
            <table width="100%" class="table table-striped table-bordered table-hover" id="trans">
                <thead>
                    <tr>
                        @foreach ($headsreg as $headreg)
                        <th> {{$headreg}} </th>
                        @endforeach
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientsreg as $clientreg)
                    
                    <tr class="gradeA">
                        
                        <?php $count_temp = 1 ; ?>
                        @foreach ($attsreg as $attreg)  
                            @if ($route != 'AShop')
                                <td> <a target="_blank" href="{{route('AClub.member',['id' => $client->master_id, 'package' => $clientreg->user_id])}}">{{$clientreg->$attreg}} </a>
                                @if ($count_temp == 1)
                                    <div class="btn-hvr-container"><button class="btn btn-primary hvr-btn">edit</button><button class="btn btn-primary hvr-btn">delete</button></div></td>
                                    <?php $count_temp++ ; ?>
                                @else
                                    </td>
                                @endif
                            @else
                                <td> <a target="_blank" href="{{route('AShop.trans',['id' => $client->master_id, 'transaction' => $clientreg->transaction_id])}}">{{$clientreg->$attreg}} </a>
                                @if ($count_temp == 1)
                                    <div class="btn-hvr-container"><button class="btn btn-primary hvr-btn">edit</button><button class="btn btn-primary hvr-btn">delete</button></div></td>
                                    <?php $count_temp++ ; ?>
                                @else
                                    </td>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>    
    @endif

	<br><br>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <h4>{{$error}}</h4>
        @endforeach
    @endif
	
</div>
</body>
</html>
