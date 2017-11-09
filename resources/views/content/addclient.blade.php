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
				@foreach ($ins as $atr)
				<?php
					$str_id = $atr;
					$str_id = str_replace(' ', '', $str_id);
				?>
				<div class="form-group" id="{{$str_id}}">				
					<label>{{$atr}}</label>
					<?php if ($str_id == 'JenisKelamin') : ?>
							<select class="form-control" name="{{strtolower(str_replace(' ', '_', $atr))}}">
								<option>Pria</option>
								<option>Wanita</option>
								<option>Hermaphrodite</option>
								<option>Null</option>
							</select>
					<?php elseif ($str_id == 'TanggalLahir') : ?>
							<input class="form-control no-spin" type="date" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					<?php elseif (($str_id == 'NoHP') || ($str_id == 'NoTelepon')) : ?>
							<input class="form-control no-spin" type="number" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					<?php else : ?>
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
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
						<option>A-Club</option>
						<option>MRG</option>
						<option>UOB</option>
						<option>CAT</option>
					</select>
				</div>
				<br>
				<div class="form-group">
				<div id="aclub" style="display: none;">					
					@foreach ($aclub as $atr)
					<div class="form-group">				
						<label>{{$atr}}</label>
						@if (($atr == "Keterangan") || (($atr == "Status")) || ($atr == "Sumber Data") || ($atr == "User ID") || ($atr == "Sales") || ($atr == "Tanggal Join"))
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr)).'_aclub'}}">
						@else
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
						@endif
					</div>
					@endforeach
				</div>
				<div id="mrg" style="display: none;">
					@foreach ($mrg as $atr)
					<div class="form-group">
						<label>{{$atr}}</label>
						@if (($atr == "Keterangan") || (($atr == "Status")) || ($atr == "Sumber Data") || ($atr == "User ID") || ($atr == "Sales") || ($atr == "Tanggal Join"))
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr)).'_mrg'}}">
						@else
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
						@endif
					</div>
					@endforeach
				</div>
				<div id="uob" style="display: none;">
					<input type="hidden" name="uob" value="1">
					@foreach ($uob as $atr)
					<div class="form-group">				
						<label>{{$atr}}</label>
						@if (($atr == "Keterangan") || (($atr == "Status")) || ($atr == "Sumber Data") || ($atr == "User ID") || ($atr == "Sales") || ($atr == "Tanggal Join"))
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr)).'_uob'}}">
						@else
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
						@endif
					</div>
					@endforeach
				</div>
				<div id="cat" style="display: none;">
					<input type="hidden" name="cat" value="1">
					@foreach ($cat as $atr)
					<div class="form-group">				
						<label>{{$atr}}</label>
						@if (($atr == "Keterangan") || (($atr == "Status")) || ($atr == "Sumber Data") || ($atr == "User ID") || ($atr == "Sales") || ($atr == "Tanggal Join"))
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr)).'_cat'}}">
						@else
							<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
						@endif
					</div>
					@endforeach
				</div>	
				<p id="hahaha" style="display: none; padding-bottom: 50px"></p>
				<br>
				<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
				<input type="hidden" id="flag" name="flag" value="" />
				<input type="hidden" id="master" name="master" value="" />
				<input type="hidden" id="master_id" name="master_id" value="" />
				<input type="submit" id="insert_button" class="btn btn-default" value="Insert">
				<span onclick="reset()"><button type="reset" class="btn btn-default">Reset Form</button></span>
			</div>
		</form>
		
	</div>

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
		var joinName = '<li class="list-group-item" style="cursor:pointer;" onclick="exec(-1)">Tambahkan Client Baru + </li>';
		var listlen = 0;
		if (inputString != ""){

			var arrayLength = fullnames.length;
			for (var i = 0; i < arrayLength; i++) {
				if (inputString.toLowerCase() == fullnames[i].toLowerCase().substring(0,inputString.length)){
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
		document.getElementById("dropdown").innerHTML = "";
		if (id != -1){  //auto fill
			load('{{route('getClient')}}?id=' + id);
			document.getElementById("addcli").style.display = "none";
			document.getElementById("input").value = name;
			document.getElementById("master").value = '1';
			document.getElementById("master_id").value = id;
		} else { //add new client			
			document.getElementById("tab").innerHTML = "";
			document.getElementById("addcli").style.display = "inline";
			document.getElementById("master").value = '0';
			document.getElementById("master_id").value = id;
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
			if ($( "#pc option:checked" ).val() == "A-Club"){
				if (document.getElementById('isacl') !== null){
					if (document.getElementById("isacl").innerHTML == 1) {
						document.getElementById("hahaha").style.display = "inline";
						document.getElementById("hahaha").innerHTML = "This user has been registered to A-Club profit center.";
					} else {		
						document.getElementById("insert_button").disabled = false;
						document.getElementById("aclub").style.display = "inline";
						document.getElementById("flag").value = 'aclub';
					}
				} else {		
					document.getElementById("insert_button").disabled = false;
					document.getElementById("aclub").style.display = "inline";
					document.getElementById("flag").value = 'aclub';
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
					}
				} else {
					document.getElementById("insert_button").disabled = false;
					document.getElementById("uob").style.display = "inline";
					document.getElementById("flag").value = 'uob';
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
					}
				} else {
					document.getElementById("insert_button").disabled = false;
					document.getElementById("mrg").style.display = "inline";
					document.getElementById("flag").value = 'mrg';
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
					}
				} else {
					document.getElementById("insert_button").disabled = false;
					document.getElementById("cat").style.display = "inline";
					document.getElementById("flag").value = 'cat';
				}
			} else if ($( "#pc option:checked" ).val() == "A-Shop"){
				document.getElementById("insert_button").disabled = false;
				document.getElementById("ashop").style.display = "inline";
				document.getElementById("flag").value = 'ashop';
			}
			
		});

	function reset(){
		document.getElementById("next").style.display = "none";
		document.getElementById("addcli").style.display = "none";
		document.getElementById("addcli2").style.display = "none";
	}
</script>

@endsection