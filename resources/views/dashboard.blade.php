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
        </table>
    </body>
</html>
