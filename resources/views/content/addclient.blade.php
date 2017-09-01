@extends('layouts.logged')
@section('content')
<div>
	<div class="row">
		<br><br>
		<!-- /.col-lg-12 -->
	</div>
</div>
<div class="panel panel-default" style="padding:15px" >
	<div class="form-group">
		<label>Name</label>
		<input id="input" class="form-control" type="text">
		<ul class="list-group" style="position:absolute;">
		    <div id="dropdown"></div>
		</ul>
	</div>
</div>	
<div id="addcli" style="display: none">
	<div class="panel panel-default" style="padding:15px" >
		<form method="post">
			@foreach ($ins as $atr)
			<div class="form-group">
				@if ($atr == 'Product ID')
				<label>{{$atr}}</label><br>
				<select id = "myList" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					@foreach($prods as $prod)
					<option value = {{$prod->product_id}}>{{$prod->product_id}}</option>
					@endforeach
				</select>
				@elseif ($atr == 'PC ID')
				<label>{{$atr}}</label><br>
				<select id = "myList" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					@foreach($foreigns as $foreign)
					<option value = {{$foreign->all_pc_id}}>{{$foreign->all_pc_id}}->{{$foreign->fullname}}</option>
					@endforeach
				</select>
				@elseif ($atr == 'Sales')
				<label>{{$atr}}</label><br>
				<select id = "myList" name="{{strtolower(str_replace(' ', '_', $atr))}}">
					@foreach($sales as $sale)
					<option value = {{$sale->sales_username}}>{{$sale->sales_username}}</option>
					@endforeach
				</select>
				@else
				<label>{{$atr}}</label>
				<input class="form-control" type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}">
				@endif
			</div>
			@endforeach
			<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
			<input type="submit" class="btn btn-default" value="Insert">
			<button type="reset" class="btn btn-default">Reset Form</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	var fullnames = [
		@foreach ($clients as $client)
			'{{$client->fullname}}', 
		@endforeach
	]
	var emails = [
		@foreach ($clients as $client)
			'{{$client->email}}', 
		@endforeach
	]

	$('#input').on( 'input', function() {
		var inputString = $('#input').val(); 	
		var joinName = '<li class="list-group-item" onclick="exec(-1)">Tambahkan Client Baru + </li>';
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

	function exec(id) {
		document.getElementById("dropdown").innerHTML = "";
		document.getElementById("addcli").style.display = "inline";
		document.getElementById("input").value = fullnames[id];
	}

</script>

@endsection
