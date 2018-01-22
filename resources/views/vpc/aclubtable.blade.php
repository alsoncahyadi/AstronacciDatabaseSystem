
							<?php $idx = 0 ?>
							@foreach ($clients as $client)
								<tr>
									<td class="fixed-side collumn-select" style="text-align:center; padding-bottom: 0px">
										<input class="selectable" id="{{ $client->user_id }}" onchange="" type="checkbox" style="" name="assigned{{ $idx }}">
										<input type="hidden" name="id{{ $idx }}" value="">
									@foreach ($attsMaster as $attMaster)
										<td class="fixed-side" style="white-space: nowrap;"> {{ $client->$attMaster }}</td>
									@endforeach
									@foreach ($atts as $att)
										<td style="max-width: 100px; white-space: nowrap;"> <a id="{{$att}}_{{$client->user_id}}" target="_blank" href="{{route($route . '.detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;">{{$client->$att}} </a></td>
									@endforeach
								</tr>
							<?php $idx = $idx + 1; ?>
							@endforeach
						