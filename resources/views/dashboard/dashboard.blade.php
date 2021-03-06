@extends('layouts.logged')
@section('content')
<div>
    <div id="tab">
    </div> <br/>
    <div id="non-tab">
        <div class="panel panel-default">
            <div class="panel-heading">
                View Client
            </div>
            <div class="panel-body">
                <form>
                    <div class="form-group">
                        <label>Search</label>
                        <input id="input" class="form-control" type="text" autocomplete="off">
                        <ul class="list-group" style="position:absolute;">
                            <div id="dropdown"></div>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                New Member
            </div>
            <div class="panel-body">
                <a class="btn btn-primary" href="{{route('mockup')}}"> Add Membership </a>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                View Profit Center
            </div>
            <div class="panel-body">
                <a href="{{route('view')}}" class="btn btn-warning">MASTER</a>
                @if ((Auth::user()->hasAnyRole(['1'])) or (Auth::user()->hasAnyRole(['0'])))
                    <a href="{{route('AClub')}}" class="btn btn-primary">A-CLUB</a>
                @endif
                @if ((Auth::user()->hasAnyRole(['2'])) or (Auth::user()->hasAnyRole(['0'])))
                    <a href="{{route('MRG')}}" class="btn btn-primary">MRG</a>
                @endif
                @if ((Auth::user()->hasAnyRole(['3'])) or (Auth::user()->hasAnyRole(['0'])))
                    <a href="{{route('CAT')}}" class="btn btn-primary">CAT</a>
                @endif
                @if ((Auth::user()->hasAnyRole(['4'])) or (Auth::user()->hasAnyRole(['0'])))
                    <a href="{{route('UOB')}}" class="btn btn-primary">UOB</a>
                @endif
            </div>
        </div>
        <!-- <a id="importb" onclick="importex()" class="btn btn-primary">Import Excel File</a>
        <div id="import" style="display:none"> 
        <div class="panel panel-default" style="padding:15px">
            <div class="panel-body">
                <form method="post" action="{{route('master.import')}}" enctype="multipart/form-data">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
                    <input type="file" name="import_file" />
                    <br>
                    <button class="btn btn-primary">Import .xls File</button>
                </form>
            </div>
        </div> -->
    </div>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <h4>{{$error}}</h4>
        @endforeach
    @endif
</div>
        <script>
        $(document).ready(function() {
            $('#dataTables').DataTable({
                responsive: true
            });
        });
    </script>

<script type="text/javascript">
    var fullnames = [
        @foreach ($clients as $client)
            '{{$client->name}}', 
        @endforeach
    ]
    var emails = [
        @foreach ($clients as $client)
            '{{$client->email}}', 
        @endforeach
    ]
    var ids = [
        @foreach ($clients as $client)
            '{{$client->master_id}}', 
        @endforeach
    ]
    $('#input').on( 'input', function() {
        var inputString = $('#input').val();    
        var joinName = '';
        var listlen = 0;
        if (inputString != ""){
            var arrayLength = fullnames.length;
            for (var i = 0; i < arrayLength; i++) {
                if (inputString.toLowerCase() == fullnames[i].toLowerCase().substring(0,inputString.length) || inputString.toLowerCase() == emails[i].toLowerCase().substring(0,inputString.length)){
                    joinName += ' <a href="{{route("detail", ["id" => ""])}}/'+ ids[i] +' "><li class="list-group-item" style="cursor:pointer;">' 
                                + fullnames[i] + '<br><p style="font-style:italic; color:gray">'
                                + emails[i] + '</p></li></a>';
                    listlen++;
                }
                if (listlen > 5){
                    break;
                }
                console.log("tes");
            }
            console.log(joinName);
        }
        document.getElementById("dropdown").innerHTML = joinName;
    });
    
    $('body').click(function(evt){    
        if(evt.target.id == "input")
            return;
        document.getElementById("dropdown").innerHTML = "";
    });
</script>

@endsection
</html>