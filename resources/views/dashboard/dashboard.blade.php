<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
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
                }
                xmlhttp.open("GET", $str, true);
                xmlhttp.send();
            }
        </script>
        
    </head>
    <body onload="loadtable('AClub')">
        <h1>Dashboard</h1>
        <input type="button" onclick="loadtable('CAT')" value="CAT">
        <input type="button" onclick="loadtable('AClub')" value="AClub">
        <input type="button" onclick="loadtable('MRG')" value="MRG">
        <table id="tab">
        </table> <br/>

        <form method="post" action="{{route('MRG.insert')}}">
            Account <input type="text" name="account"> <br/>
            Nama <input type="text" name="nama"> <br/>
            Tanggal Join <input type="text" name="tgljoin"> <br/>
            Alamat <input type="text" name="alamat"> <br/>
            Kota <input type="text" name="kota"> <br/>
            Telepon <input type="text" name="telepon"> <br/>
            Email <input type="text" name="email"> <br/>
            Type <input type="text" name="type"> <br/>
            Sales <input type="text" name="sales"> <br/>
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
            <input type="submit" value="insert">
        </form>

        <form method="post" action="{{route('MRG.import')}}" enctype="multipart/form-data">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
            <input type="file" name="import_file" />
            <button class="btn btn-primary">Import File</button>
        </form>

        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <h4>{{$error}}</h4>
            @endforeach
        @endif
    </body>
</html>
