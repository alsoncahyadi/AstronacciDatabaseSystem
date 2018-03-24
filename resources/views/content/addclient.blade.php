@extends('layouts.logged')
@section('content')
<div>
	<div class="row">
		<br><br>
		<!-- /.col-lg-12 -->
	</div>
</div>

	<div class="panel panel-default" style="padding:15px 280px;" >

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		<form method="post" action="{{route('insert')}}">
			<div class="form-group" id="ads_nama">
				<label>Nama</label>
				<input id="input" class="form-control" type="text" autocomplete="off" name="nama">
				<ul class="list-group" style="position:absolute;">
				    <div id="dropdown"></div>
				</ul>
			</div>


			<div id="addcli" style="display: none">
				@foreach ($ins as $atr => $req)
				<?php
					$str_id = $atr;
					$str_id = str_replace(' ', '', $str_id);
				?>
				<div class="form-group" id="{{$str_id}}">				
					<label>{{$atr}} <?php if ($req) : ?> <span style="color:red; font-weight: bold"> * </span> <?php endif; ?></label>
					<?php if ($str_id == 'Gender') : ?>
							<select class="form-control" name="{{strtolower(str_replace(' ', '_', $atr))}}">
								<option>M</option>
								<option>F</option>
							</select>
					<?php elseif ($str_id == 'TanggalLahir') : ?>
							<input class="form-control no-spin" type="date" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					<?php elseif (($str_id == 'NoHP') || ($str_id == 'NoTelepon')) : ?>
							<input class="form-control no-spin" type="number" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					<?php elseif ($str_id == 'Provinsi') : ?>
							<select class="form-control" name="{{strtolower(str_replace(' ', '_', $atr))}}" id="prov" >

							</select>
					<?php elseif ($str_id == 'Kota') : ?>
							<select class="form-control" name="{{strtolower(str_replace(' ', '_', $atr))}}" id="kota">

							</select>
					<?php else : ?>
							<input class="form-control masterrequired" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}" 
								<?php if ($req) : ?> required <?php endif; ?>
								>
					<?php endif; ?>
				</div>
				@endforeach
			</div>

			<div id="tab">
			</div>
			<!-- PASTE CODE HERE -->

			<div id="next" style="display: none;">
				<br>
				<div class="form-group">
					<label>Profit Center</label>
					<select id="pc" class="form-control">
						<option>-</option>
						@if ((Auth::user()->hasAnyRole(['1'])) or (Auth::user()->hasAnyRole(['0'])))
							<option>A-CLUB</option>
						@endif
						@if ((Auth::user()->hasAnyRole(['2'])) or (Auth::user()->hasAnyRole(['0'])))
							<option>MRG</option>
						@endif
						@if ((Auth::user()->hasAnyRole(['4'])) or (Auth::user()->hasAnyRole(['0'])))
							<option>UOB</option>
						@endif
						@if ((Auth::user()->hasAnyRole(['3'])) or (Auth::user()->hasAnyRole(['0'])))					
							<option>CAT</option>
						@endif
					</select>
				</div>
				<br>
				<div class="form-group">
				<div id="aclub" style="display: none;">					
				@if ((Auth::user()->hasAnyRole(['1'])) or (Auth::user()->hasAnyRole(['0'])))
					@foreach ($aclub as $atr => $req)
					<div class="form-group">
						<label>{{$atr}} <?php if ($req) : ?> <span style="color:red; font-weight: bold"> * </span> <?php endif; ?></label>
						@if (($atr == "Keterangan") || ($atr == "Sumber Data") || ($atr == "User ID") || ($atr == "Sales"))
							<input class="form-control <?php if ($req) : ?> aclubrequired <?php endif; ?>" type="text" name="{{strtolower(str_replace(' ', '_', $atr)).'_aclub'}}">


						@elseif ($atr == "Group")
							<input type="hidden" name="{{strtolower(str_replace(' ', '_', $atr))}}" value="-">

						@elseif ($atr == "Kode")
							<select class="form-control" id="kode" name="{{strtolower(str_replace(' ', '_', $atr))}}">
								<option selected="selected">SS</option>
								<option>FS</option>
								<option>SG</option>
								<option>FG</option>
								<option>SP</option> 
								<option>FP</option>
								<option>RD</option>
							</select>
						@elseif ($atr == "Status")
							<select class="form-control" name="{{strtolower(str_replace(' ', '_', $atr)).'_aclub'}}">
								<option selected="selected">Baru</option>
								<option>Perpanjang</option>
								<option>Tidak Aktif</option>
							</select>
						@elseif ($atr == "Start Date")
							<input class="form-control no-spin" type="date" id="startdate" name="{{strtolower(str_replace(' ', '_', $atr))}}">
						@elseif ($atr == "Payment Date")
							<input class="form-control no-spin" type="date" id="startdate" name="{{strtolower(str_replace(' ', '_', $atr))}}">
						@elseif ($atr == "Expired Date")
							<input class="form-control no-spin" type="date" id="expireddate" name="{{strtolower(str_replace(' ', '_', $atr))}}" readonly>
						@elseif ($atr == "Masa Tenggang")
							<input class="form-control no-spin" type="date" id="masatenggang" name="{{strtolower(str_replace(' ', '_', $atr))}}">
						@elseif ($atr == "Yellow Zone")
							<input class="form-control no-spin" type="date" id="yellowzone" name="{{strtolower(str_replace(' ', '_', $atr))}}" readonly>
						@elseif ($atr == "Red Zone")
							<input class="form-control no-spin" type="date" id="redzone" name="{{strtolower(str_replace(' ', '_', $atr))}}" readonly>
						@else
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}" <?php if ($req) : ?> required <?php endif; ?>>
						@endif
					</div>
					@endforeach
				@endif
				</div>
				<script type="text/javascript">
					
				</script>
				<div id="mrg" style="display: none;">
				@if ((Auth::user()->hasAnyRole(['2'])) or (Auth::user()->hasAnyRole(['0'])))
					@foreach ($mrg as $atr => $req)
					<div class="form-group">
						<label>{{$atr}} <?php if ($req) : ?> <span style="color:red; font-weight: bold"> * </span> <?php endif; ?></label>
						@if (($atr == "Keterangan") || (($atr == "Status")) || ($atr == "Sumber Data") || ($atr == "User ID") || ($atr == "Sales"))
							<input class="form-control <?php if ($req) : ?> mrgrequired <?php endif; ?>" type="text" name="{{strtolower(str_replace(' ', '_', $atr)).'_mrg'}}" >

						@elseif ($atr == "Tanggal Join")
							<input class="form-control no-spin" type="date" id="startdate" name="{{strtolower(str_replace(' ', '_', $atr)).'_mrg'}}">
						@elseif ($atr == "Account Type")
							<select class="form-control" id="accounttype" name="{{strtolower(str_replace(' ', '_', $atr))}}">
								<option selected="selected">Recreation</option>
								<option>Basic</option>
								<option>Syariah</option>
								<option>Signature</option>
							</select>
						@else
							<input class="form-control <?php if ($req) : ?> mrgrequired <?php endif; ?>" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}" >
						@endif
					</div>
					@endforeach
				@endif
				</div>
				<div id="uob" style="display: none;">
				@if ((Auth::user()->hasAnyRole(['4'])) or (Auth::user()->hasAnyRole(['0'])))
					<input type="hidden" name="uob" value="1">
					@foreach ($uob as $atr => $req)
					<div class="form-group">				
						<label>{{$atr}} <?php if ($req) : ?> <span style="color:red; font-weight: bold"> * </span> <?php endif; ?></label>
						@if (($atr == "Keterangan") || (($atr == "Status")) || ($atr == "Sumber Data") || ($atr == "User ID") || ($atr == "Sales"))
							<input class="form-control <?php if ($req) : ?> uobrequired <?php endif; ?>" type="text" name="{{strtolower(str_replace(' ', '_', $atr)).'_uob'}}">
						@elseif ($atr == "Tanggal Join")
							<input class="form-control no-spin" type="date" id="startdate" name="{{strtolower(str_replace(' ', '_', $atr)).'_uob'}}">
						@elseif ($atr == "Expired KTP")
							<input class="form-control no-spin" type="date" id="expiredktp" name="{{strtolower(str_replace(' ', '_', $atr))}}">	
						@else
							<input class="form-control <?php if ($req) : ?> uobrequired <?php endif; ?>" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
						@endif
					</div>
					@endforeach
				@endif
				</div>
				<div id="cat" style="display: none;">
				@if ((Auth::user()->hasAnyRole(['3'])) or (Auth::user()->hasAnyRole(['0'])))
					<input type="hidden" name="cat" value="1">
					@foreach ($cat as $atr => $req)
					<div class="form-group">				
						<label>{{$atr}} <?php if ($req) : ?> <span style="color:red; font-weight: bold"> * </span> <?php endif; ?></label>
						@if (($atr == "Keterangan") || (($atr == "Status")) || ($atr == "Sumber Data") || ($atr == "User ID") || ($atr == "Sales") || ($atr == "Tanggal Join"))
							<input class="form-control <?php if ($req) : ?> catrequired <?php endif; ?>" type="text" name="{{strtolower(str_replace(' ', '_', $atr)).'_cat'}}">
						@elseif (($atr == "DP Date") || ($atr == "Opening Class"))
							<input class="form-control no-spin" type="date" id="dpdate" name="{{strtolower(str_replace(' ', '_', $atr))}}">	
						@else
							<input class="form-control <?php if ($req) : ?> catrequired <?php endif; ?>" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}" >
						@endif
					</div>
					@endforeach
				@endif
				</div>	
				<p id="hahaha" style="display: none; padding-bottom: 50px"></p>
				<br>
				<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
				<input type="hidden" id="flag" name="flag" value="" />
				<input type="hidden" id="master" name="master" value="" />
				<input type="hidden" id="master_id" name="master_id" value="" />
				<input type="submit" id="insert_button" class="btn btn-default" value="Insert">
				<span onclick="reset()"><button type="reset" class="btn btn-default">Reset Form</button></span>
				<a href="{{route('home')}}"><button type="button" class="btn btn-default">Back</button></a>
			</div>
		</form>
		
	</div>
<script>
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
	// ==================================
	// RUMUS 
	// ==================================
		
	$('#input').on( 'input', function() {
		var inputString = $('#input').val(); 	
		var joinName = '<li class="list-group-item" style="cursor:pointer;" onclick="exec(-1)">Tambahkan Client Baru + </li>';
		var listlen = 0;
		if (inputString != ""){

			var arrayLength = fullnames.length;
			for (var i = 0; i < arrayLength; i++) {
				if (inputString.toLowerCase() == fullnames[i].toLowerCase().substring(0,inputString.length) ||
				inputString.toLowerCase() == emails[i].toLowerCase().substring(0,inputString.length) ){
					joinName += ' <li class="list-group-item" onclick="exec(' + ids[i] + ', \'' + fullnames[i] + '\')" style="cursor:pointer;">' 
					+ fullnames[i] + '<br><p style="font-style:italic; color:gray">'
					+ emails[i] + '</p></li>';
					listlen++;
				}
				if (listlen > 5){
					break;
				}
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
 
	function exec(id, name) {
		var x = document.querySelectorAll('.masterrequired');
		document.getElementById("dropdown").innerHTML = "";
		if (id != -1){  //auto fill
			console.log("falsify");
			var i;
			for (i = 0; i < x.length; i++) {
			    x[i].required = false;
			}
			load('{{route('getClient')}}?id=' + id);
			document.getElementById("addcli").style.display = "none";
			document.getElementById("input").value = name;
			document.getElementById("master").value = '1';
			document.getElementById("master_id").value = id;	
		} else { //add new client			
			console.log("truefy");
			document.getElementById("tab").innerHTML = "";
			document.getElementById("addcli").style.display = "inline";
			document.getElementById("master").value = '0';
			document.getElementById("master_id").value = id;
			var i;
			for (i = 0; i < x.length; i++) {
			    x[i].required = true;
			}
		}
		document.getElementById("next").style.display = "inline";
		window.scrollTo(0, 0);

		$( "#pc" ).val('-');
		document.getElementById("aclub").style.display = "none";
		document.getElementById("mrg").style.display = "none";
		document.getElementById("uob").style.display = "none";
		document.getElementById("cat").style.display = "none";
		document.getElementById("hahaha").style.display = "none";
		document.getElementById("flag").value = '-';
		document.getElementById("insert_button").disabled = true;

		if (id == -1) {
			document.getElementById("insert_button").disabled = false;
		}

	}

		$( "#pc" ).change(function() {
			document.getElementById("aclub").style.display = "none";
			document.getElementById("mrg").style.display = "none";
			document.getElementById("uob").style.display = "none";
			document.getElementById("cat").style.display = "none";
			document.getElementById("hahaha").style.display = "none";
			document.getElementById("flag").value = '-';
			document.getElementById("insert_button").disabled = true;
			console.log("change");
			//document.getElementById("hahaha").innerHTML = document.getElementById("ismrg").innerHTML;
			if ($( "#pc option:checked" ).val() == "A-CLUB"){
				if (document.getElementById('isacl') !== null){
					if (document.getElementById("isacl").innerHTML == 1) {
						document.getElementById("hahaha").style.display = "inline";
						document.getElementById("hahaha").innerHTML = "This user has been registered to A-CLUB profit center.";
					} else {		
						document.getElementById("insert_button").disabled = false;
						document.getElementById("aclub").style.display = "inline";
						document.getElementById("flag").value = 'aclub';
						document.querySelector('.aclubrequired').required = true;
						document.querySelector('.uobrequired').required = false;
						document.querySelector('.mrgrequired').required = false;
						document.querySelector('.catrequired').required = false;

					}
				} else {		
					document.getElementById("insert_button").disabled = false;
					document.getElementById("aclub").style.display = "inline";
					document.getElementById("flag").value = 'aclub';
					document.querySelector('.aclubrequired').required = true;
					document.querySelector('.uobrequired').required = false;
					document.querySelector('.mrgrequired').required = false;
					document.querySelector('.catrequired').required = false;
				}
			} else if ($( "#pc option:checked" ).val() == "UOB"){
				if (document.getElementById('isuob') !== null){
					if (document.getElementById("isuob").innerHTML == 1) {
						document.getElementById("hahaha").style.display = "inline";
						document.getElementById("hahaha").innerHTML = "This user has been registered to UOB profit center.";
					} else {
						document.getElementById("insert_button").disabled = false;
						document.getElementById("uob").style.display = "inline";
						document.getElementById("flag").value = 'uob';
						document.querySelector('.aclubrequired').required = false;
						document.querySelector('.uobrequired').required = true;
						document.querySelector('.mrgrequired').required = false;
						document.querySelector('.catrequired').required = false;
					}
				} else {
					document.getElementById("insert_button").disabled = false;
					document.getElementById("uob").style.display = "inline";
					document.getElementById("flag").value = 'uob';
					document.querySelector('.aclubrequired').required = false;
					document.querySelector('.uobrequired').required = true;
					document.querySelector('.mrgrequired').required = false;
					document.querySelector('.catrequired').required = false;
				}
			} else if ($( "#pc option:checked" ).val() == "MRG"){
				if (document.getElementById('ismrg') !== null){
					if (document.getElementById("ismrg").innerHTML == 1) {
						document.getElementById("hahaha").style.display = "inline";
						document.getElementById("hahaha").innerHTML = "This user has been registered to MRG profit center.";
					} else {
						document.getElementById("insert_button").disabled = false;
						document.getElementById("mrg").style.display = "inline";
						document.getElementById("flag").value = 'mrg';
						document.querySelector('.aclubrequired').required = false;
						document.querySelector('.uobrequired').required = false;
						document.querySelector('.mrgrequired').required = true;
						document.querySelector('.catrequired').required = false;
					}
				} else {
					document.getElementById("insert_button").disabled = false;
					document.getElementById("mrg").style.display = "inline";
					document.getElementById("flag").value = 'mrg';
					document.querySelector('.aclubrequired').required = false;
					document.querySelector('.uobrequired').required = false;
					document.querySelector('.mrgrequired').required = true;
					document.querySelector('.catrequired').required = false;
				}
			} else if ($( "#pc option:checked" ).val() == "CAT"){
				if (document.getElementById('iscat') !== null){
					if (document.getElementById("iscat").innerHTML == 1) {
						document.getElementById("hahaha").style.display = "inline";
						document.getElementById("hahaha").innerHTML = "This user has been registered to CAT profit center.";
					} else {
						document.getElementById("insert_button").disabled = false;
						document.getElementById("cat").style.display = "inline";
						document.getElementById("flag").value = 'cat';
						document.querySelector('.aclubrequired').required = false;
						document.querySelector('.uobrequired').required = false;
						document.querySelector('.mrgrequired').required = false;
						document.querySelector('.catrequired').required = true;
					}
				} else {
					document.getElementById("insert_button").disabled = false;
					document.getElementById("cat").style.display = "inline";
					document.getElementById("flag").value = 'cat';
					document.querySelector('.aclubrequired').required = false;
					document.querySelector('.uobrequired').required = false;
					document.querySelector('.mrgrequired').required = false;
					document.querySelector('.catrequired').required = true;
				}
			}
			
		});


	function reset(){
		document.getElementById("next").style.display = "none";
		document.getElementById("addcli").style.display = "none";
		document.getElementById("addcli2").style.display = "none";
	}
		
    // ======================================================================================================
    // RUMUS ACLUB
	$( "#startdate" ).change(function() {
		document.getElementById("expireddate").value = document.getElementById("startdate").value;
		if (document.getElementById("kode").value == "SS" || document.getElementById("kode").value == "FS") {
			document.getElementById("expireddate").stepUp(30);
		} else if (document.getElementById("kode").value == "SG" || document.getElementById("kode").value == "FG"){
			document.getElementById("expireddate").stepUp(180);
		} else if (document.getElementById("kode").value == "SP" || document.getElementById("kode").value == "FP" || document.getElementById("kode").value == "RD"){
			document.getElementById("expireddate").stepUp(365);
		} 
		document.getElementById("masatenggang").value = document.getElementById("expireddate").value;
		document.getElementById("yellowzone").value = document.getElementById("masatenggang").value;
		document.getElementById("redzone").value = document.getElementById("masatenggang").value;
		document.getElementById("yellowzone").stepDown(3);
		document.getElementById("redzone").stepUp(3);
	});

	$( "#startdate" ).change(function() {
		document.getElementById("expireddate").value = document.getElementById("startdate").value;
		if (document.getElementById("kode").value == "SS" || document.getElementById("kode").value == "FS") {
			document.getElementById("expireddate").stepUp(30);
		} else if (document.getElementById("kode").value == "SG" || document.getElementById("kode").value == "FG"){
			document.getElementById("expireddate").stepUp(180);
		} else if (document.getElementById("kode").value == "SP" || document.getElementById("kode").value == "FP" || document.getElementById("kode").value == "RD"){
			document.getElementById("expireddate").stepUp(365);
		} 
		document.getElementById("masatenggang").value = document.getElementById("expireddate").value;
		document.getElementById("yellowzone").value = document.getElementById("masatenggang").value;
		document.getElementById("redzone").value = document.getElementById("masatenggang").value;
		document.getElementById("yellowzone").stepDown(3);
		document.getElementById("redzone").stepUp(3);
	});

	$( "#kode" ).change(function() {
		document.getElementById("expireddate").value = document.getElementById("startdate").value;
		if (document.getElementById("kode").value == "SS" || document.getElementById("kode").value == "FS") {
			document.getElementById("expireddate").stepUp(30);
		} else if (document.getElementById("kode").value == "SG" || document.getElementById("kode").value == "FG"){
			document.getElementById("expireddate").stepUp(180);
		} else if (document.getElementById("kode").value == "SP" || document.getElementById("kode").value == "FP" || document.getElementById("kode").value == "RD"){
			document.getElementById("expireddate").stepUp(365);
		} 
		document.getElementById("masatenggang").value = document.getElementById("expireddate").value;
		document.getElementById("yellowzone").value = document.getElementById("masatenggang").value;
		document.getElementById("redzone").value = document.getElementById("masatenggang").value;
		document.getElementById("yellowzone").stepDown(3);
		document.getElementById("redzone").stepUp(3);
	});

	$( "#masatenggang" ).change(function() {
		document.getElementById("yellowzone").value = document.getElementById("masatenggang").value;
		document.getElementById("redzone").value = document.getElementById("masatenggang").value;
		document.getElementById("yellowzone").stepDown(3);
		document.getElementById("redzone").stepUp(3);
	});
    // ======================================================================================================
    
    var prov = {
    	"Aceh" : ["Banda Aceh", "Langsa", "Lhokseumawe", "Meulaboh", "Sabang", "Subulussalam"],
    	"Bali" : ["Denpasar"],
        "Bangka Belitung" : ["Pangkalpinang"],
        "Banten" : ["Cilegon", "Serang", "Tangerang Selatan", "Tangerang"],
        "Bengkulu" : ["Bengkulu"],
        "Gorontalo" : ["Gorontalo"],
        "Jakarta" : ["Jakarta Barat", "Jakarta Pusat", "Jakarta Selatan", "Jakarta Timur", "Jakarta Utara"],
        "Jambi" : ["Sungai Penuh", "Jambi"],
        "Jawa Barat" : ["Bandung", "Bekasi", "Bogor", "Cimahi", "Cirebon", "Depok", "Sukabumi", "Tasikmalaya", "Banjar"],
        "Jawa Tengah" : ["Magelang", "Pekalongan", "Purwokerto", "Salatiga", "Semarang", "Surakarta", "Tegal"],
        "Jawa Timur" : ["Batu", "Blitar", "Kediri", "Madiun", "Malang", "Mojokerto", "Pasuruan", "Probolinggo", "Surabaya"],
        "Kalimantan Barat" : ["Pontianak", "Singkawang"],
        "Kalimantan Selatan" : ["Banjarbaru", "Banjarmasin"],
        "Kalimantan Tengah" : ["Palangkaraya"],
        "Kalimatan Timur" : ["Balikpapan", "Bontang", "Samarinda"],
        "Kalimantan Utara" : ["Tarakan"],
        "Kepulauan Riau" : ["Batam", "Tanjungpinang"],
        "Lampung" : ["Bandar Lampung", "Metro"],
        "Maluku Utara" : ["Ternate", "Kepulauan Tidore"],
        "Maluku" : ["Ambon", "Tual"],
        "Nusa Tenggara Barat" : ["Bima", "Mataram"],
        "Nusa Tenggara Timur" : ["Kupang"],
        "Papua Barat" : ["Sorong"],
        "Papua" : ["Jayapura"],
        "Riau" : ["Dumai", "Pekanbaru"],
        "Sulawesi Selatan" : ["Makassar", "Palopo", "Parepare"],
        "Sulawesi Tengah" : ["Palu"],
        "Sulawesi Tenggara" : ["Bau-Bau", "Kendari"],
        "Sulawesi Utara" : ["Bitung", "Kotamobagu", "Manado", "Tomohon"],
        "Sumatera Barat" : ["Bukittinggi", "Padang", "Padangpanjang", "Pariaman", "Payakumbuh", "Sawahlunto", "Solok"],
        "Sumatera Selatan" : ["Lubuklinggau", "Pagaralam", "Palembang", "Prabumulih"],
        "Sumatera Utara" : ["Binjai", "Medan", "Padang Sidempuan", "Pematangsiantar", "Sibolga", "Tanjungbalai", "Tebingtinggi"],
        "Yogyakarta" : ["Yogyakarta"],
    };
    var provKeys = Object.keys(prov);
	var select = document.getElementById('prov');
	var selectKota = document.getElementById('kota');
	for(var i=0; i< provKeys.length; i++)
	{
	  select.options[i] = new Option(provKeys[i], provKeys[i]);  //new Option("Text", "Value")
	}
	for(var i=0; i< prov["Aceh"].length; i++)
	{
	  selectKota.options[i] = new Option(prov["Aceh"][i], prov["Aceh"][i]);  //new Option("Text", "Value")
	}
	$('#prov').on('change', function() {
	  $("#kota").empty();
	  var temp = this.value;
	  for(var i=0; i< prov[temp].length; i++)
		{
		  selectKota.options[i] = new Option(prov[temp][i], prov[temp][i]);  //new Option("Text", "Value")
		}
	})
</script>

@endsection