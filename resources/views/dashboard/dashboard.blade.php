@extends('layouts.logged')
@section('content')
    <div onload="loadtable('AClub')">
	<script>
            function loadtable($pc) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("tab").innerHTML = this.responseText;
                    }
                };
                $str = "{{route('AClub')}}";
                if ($pc == "CAT") {
                    $str = "{{route('CAT')}}";
                } else if ($pc == "MRG") {
                    $str = "{{route('MRG')}}";
                } else if ($pc == "UOB") {
                    $str = "{{route('UOB')}}";
                }
                xmlhttp.open("GET", $str, true);
                xmlhttp.send();
            }
        </script>
        <h1>Dashboard</h1>
        <input type="button" onclick="loadtable('CAT')" value="CAT">
        <input type="button" onclick="loadtable('AClub')" value="AClub">
        <input type="button" onclick="loadtable('MRG')" value="MRG">
        <input type="button" onclick="loadtable('UOB')" value="UOB">
        <div id="tab">
        </div> <br/>

        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <h4>{{$error}}</h4>
            @endforeach
        @endif
    </div>
	
@endsection
</html>
