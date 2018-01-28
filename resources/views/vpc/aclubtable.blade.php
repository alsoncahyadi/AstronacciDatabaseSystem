	
							<?php $idx = 0 ?>
							<input id="hidden_page_count" type="hidden" value="{{$count}}">
							
							@foreach ($clients as $client)
								<tr>
									<td class="fixed-side collumn-select" style="text-align:center; padding-bottom: 0px">
										<input class="selectable" id="{{ $client->transaction_id }}" onchange="" type="checkbox" style="" name="assigned{{ $idx }}">
										<input type="hidden" name="id{{ $idx }}" value="">
									@foreach ($attsMaster as $attMaster)
										@if ($attMaster == 'name')
 										<td class="fixed-side" style="white-space: nowrap; pointer-events: auto !important;"> <a id="{{$attMaster}}_{{$client->transaction_id}}" target="_blank" href="{{route($route . '.detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;"> {{ $client->$attMaster }}</a></td>
 										@else
 										<td class="fixed-side" onclick="copyFunction(this)" style="white-space: nowrap; cursor:context-menu;"> {{ $client->$attMaster }} </td>
 										@endif
									@endforeach
									@foreach ($atts as $att)
										<td onclick="copyFunction(this)" style="max-width: 100px; white-space: nowrap; cursor:context-menu;" id="{{$att}}_{{$client->transaction_id}}"> {{$client->$att}} </td>

									@endforeach
								</tr>
							<?php $idx = $idx + 1; ?>
							@endforeach						
