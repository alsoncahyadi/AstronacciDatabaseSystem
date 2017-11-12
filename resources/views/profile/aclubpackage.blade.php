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
    
<!--    <script src="{{ URL::asset('js/loader.js') }}"></script>    -->

    <script src="{{ URL::asset('js/astronacci.js') }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body style="overflow-x:hidden;  background-image: url('{{ URL::asset('images/swirl_pattern1.png') }}') ;">
    <div id="wrapper" style="margin:15px">

    <div class="row">
        <div class="col-lg-12">
            <h1>{{$route}} Profile</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    </div>
    
    <div class="panel panel-default" style="margin:15px">
        <div class="panel-heading">
            <i class="fa fa-child fa-fw"></i> Basic Information 
            <button class="btn btn-default" id="hide" style="margin-left:30px"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
            <button class="btn btn-danger" id="show" style="margin-left:30px;display:none"><i class="fa fa-pencil-square-o"></i> Edit </a></button>
        </div>
        
        <div class="panel-body">
            <div id="bod1">
                <div class="form-group">
                    <!-- Menuliskan tiap Judul atribut (key) dan isinya (value) -->
                    
                        @foreach ($heads as $key => $value)
                            <div class="col-lg-2" style="height:30px">
                                <label>{{$key}}</label>
                            </div>
                            <div class="col-lg-10" style="height:30px">
                                : {{$client->$value}}<br>
                            </div>
                        @endforeach
                </div>

                <form action="{{route($route . '.deletetrans', ['id' => $client->transaction_id])}}" method="post">
                    <input type="hidden" name="_method" value="DELETE" >
                    <input type="submit" onclick="del()" value="Delete Transaction" >
                    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                </form>
                
            </div>

                <div id="bod2" style="display:none">
                    <form role="form" method="post" action="{{route($route . '.edittrans')}}">
                        <input name="user_id" type="hidden" value="{{$client->transaction_id}}">
                        <div class="form-group">
                            <!-- Menuliskan input untuk setiap judul (key) dan data saat ini (value) -->
                            
                            @foreach ($ins as $key => $value)
                                <div style="height:60px">
                                    <label>{{$key}}</label>
                                        <input class="form-control" value="{{$client->$value}}" name="{{strtolower(str_replace(' ', '_', $key))}}">
                                </div>
                            @endforeach
                            
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
                    </form>
                </div> 
            
        </div>

     </div>

    <br><br>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <h4>{{$error}}</h4>
        @endforeach
    @endif
    
</div>
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
        $("delete").click(function(){
            $("#delete").hide();
            $("#condel").show();
            
        });
    });
    function del(){
        if (confirm('Data will be lost permanently. Are you sure you want to delete this transaction?'))
            window.location.replace("{{route($route . '.deletetrans', ['id' => $client->transaction_id])}}");

    }
    </script>
</body>
</html>