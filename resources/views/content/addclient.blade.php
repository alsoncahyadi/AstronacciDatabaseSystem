@extends('layouts.logged')
@section('content')
<div>
	<div class="row">
		<br><br>
		<!-- /.col-lg-12 -->
	</div>
</div>
	<div class="panel panel-default" style="padding:15px" >
		<form method="post" action="{{route('insert')}}">
			<div class="form-group">
				<label>Nama</label>
				<input id="input" class="form-control" type="text" autocomplete="off">
				<ul class="list-group" style="position:absolute;">
				    <div id="dropdown"></div>
				</ul>
			</div>
			<div id="addcli" style="display: none">
				@foreach ($ins as $atr)
				<div class="form-group">				
					<label>{{$atr}}</label>
					<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
				</div>
				@endforeach
			</div>

			<div id="addcli2" style="display: none">
				@foreach ($ins as $atr)
				<div class="form-group">
					<label>{{$atr}}</label>
					<p class="form-control-static">Example Data</p>
				</div>
				@endforeach
			</div>

			<div id="next" style="display: none;">
				<div class="form-group">
					<label>Profit Center</label>
					<select id="pc" class="form-control">
						<option>A-Club</option>
						<option>MRG</option>
						<option>UOB</option>
						<option>CAT</option>
					</select>
				</div>
				<div class="form-group">
				<div id="aclub">
					@foreach ($aclub as $atr)
					<div class="form-group">				
						<label>{{$atr}}</label>
						<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					</div>
					@endforeach
				</div>
				<div id="mrg" style="display: none;">
					@foreach ($mrg as $atr)
					<div class="form-group">				
						<label>{{$atr}}</label>
						<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					</div>
					@endforeach
				</div>
				<div id="uob" style="display: none;">
					<input type="hidden" name="uob" value="1">
					@foreach ($uob as $atr)
					<div class="form-group">				
						<label>{{$atr}}</label>
						<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					</div>
					@endforeach
				</div>
				<div id="cat" style="display: none;">
					<input type="hidden" name="cat" value="1">
					@foreach ($cat as $atr)
					<div class="form-group">				
						<label>{{$atr}}</label>
						<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					</div>
					@endforeach
				</div>
				<br>
				<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
				<input type="hidden" id="flag" name="flag" value="" />
				<input type="hidden" id="master" name="master" value="" />
				<input type="hidden" id="master_id" name="master_id" value="" />
				<input type="submit" class="btn btn-default" value="Insert">
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
				    joinName += ' <li class="list-group-item" onclick="exec(' + i + ')" style="cursor:pointer;">' 
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
	$( "#pc" ).change(function() {
		document.getElementById("aclub").style.display = "none";
		document.getElementById("mrg").style.display = "none";
		document.getElementById("uob").style.display = "none";
		document.getElementById("cat").style.display = "none";	
		if ($( "#pc option:checked" ).val() == "A-Club"){
			document.getElementById("aclub").style.display = "inline";
			document.getElementById("flag").value = 'aclub';
		} else if ($( "#pc option:checked" ).val() == "UOB"){
			document.getElementById("uob").style.display = "inline";
			document.getElementById("flag").value = 'uob';
		} else if ($( "#pc option:checked" ).val() == "MRG"){
			document.getElementById("mrg").style.display = "inline";
			document.getElementById("flag").value = 'mrg';
		} else if ($( "#pc option:checked" ).val() == "CAT"){
			document.getElementById("cat").style.display = "inline";
			document.getElementById("flag").value = 'cat';
		}
	});
	function exec(id) {
		document.getElementById("dropdown").innerHTML = "";
		if (id != -1){
			document.getElementById("addcli").style.display = "none";
			document.getElementById("addcli2").style.display = "inline";
			document.getElementById("input").value = fullnames[id];
			document.getElementById("master").value = '1';
			document.getElementById("master_id").value = ids[id];
		} else {
			document.getElementById("addcli2").style.display = "none";
			document.getElementById("addcli").style.display = "inline";
			document.getElementById("master").value = '0';
		}
		document.getElementById("next").style.display = "inline";
		window.scrollTo(0, 0);
	}
	function reset(){
		document.getElementById("next").style.display = "none";
		document.getElementById("addcli").style.display = "none";
		document.getElementById("addcli2").style.display = "none";
	}
</script>

@endsection