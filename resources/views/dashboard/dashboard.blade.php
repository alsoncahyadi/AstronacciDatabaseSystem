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
                Waiting
                <!--BOTTLENECK-->
            </div>
        </div>
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
                if (inputString.toLowerCase() == fullnames[i].toLowerCase().substring(0,inputString.length)){
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