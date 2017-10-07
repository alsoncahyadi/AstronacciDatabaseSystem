
<?php $i = 0; ?>
<div id="addcli2">
	@foreach ($colname as $atr)
	<div class="form-group">
		<label>{{$ins[$i]}}</label>
		@foreach ($dummy as $client)
		<p class="form-control-static">{{$client->$atr}}</p>		
		@endforeach
		<?php $i++; ?>
	</div>
	@endforeach
</div>