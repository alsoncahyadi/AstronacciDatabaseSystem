 function load($pc) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tab").innerHTML = this.responseText;
                $('#dataTables').DataTable({
                    responsive: true
                });
            }
        };
        xmlhttp.open("GET", $pc, true);
        xmlhttp.send();
    };