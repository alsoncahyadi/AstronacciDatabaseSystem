
							<?php $idx = 0 ?>
							<input id="hidden_page_count" type="hidden" value="{{$count}}">
							@foreach ($clients as $client)
								<tr>
									@foreach ($attsMaster as $attMaster)
										@if ($attMaster == 'name')
 										<td class="fixed-side" style="white-space: nowrap; pointer-events: auto !important;"> <a id="{{$attMaster}}_{{$client->user_id}}" target="_blank" href="{{route('detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;"> {{ $client->$attMaster }}</a></td>
 										@else
 										<td class="fixed-side" onclick="copyFunction(this)" style="white-space: nowrap; cursor:context-menu;"> {{ $client->$attMaster }} </td>
 										@endif
									@endforeach
									@foreach ($atts as $att)
										<td onclick="copyFunction(this)" style="max-width: 100px; white-space: nowrap; cursor:context-menu;"> {{$client->$att}} </td>
									@endforeach
								</tr>
							<?php $idx = $idx + 1; ?>
							@endforeach
						