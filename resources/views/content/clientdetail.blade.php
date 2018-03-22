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
	
	<p id="iscat" style="display:none"><?php echo $iscat?></p>
	<p id="ismrg" style="display:none"><?php echo $ismrg?></p>
	<p id="isuob" style="display:none"><?php echo $isuob?></p>
	<p id="isacl" style="display:none"><?php echo $isacl?></p>

</div>