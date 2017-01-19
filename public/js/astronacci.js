 function load($pc) {
    //Javascript untuk ajax request
    //Ajax digunakan untuk mengambil tabel/konten untk page tertentu
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //Konten yang diperoleh dari ajax dimasukkan ke dalam div tab
            document.getElementById("tab").innerHTML = this.responseText;
            $('#dataTables').DataTable({
                responsive: true
            });
        }
    };
    xmlhttp.open("GET", $pc, true);
    xmlhttp.send();
};
function salesinput($id, $type){
	document.getElementById("inputid").value = $id;
	document.getElementById("inputtype").value = $type;
	
	document.getElementById("repformid").action = 'report/' + $type;
	
	document.getElementById("panel2").style.display = 'block';
	document.getElementById("panel1").style.display = 'none';
	
}