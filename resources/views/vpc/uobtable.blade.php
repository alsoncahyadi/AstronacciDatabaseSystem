
                            <?php $idx = 0 ?>
                            <input id="hidden_page_count" type="hidden" value="{{$count}}">
                            @foreach ($clients as $client)
                                <tr>
                                    <td class="fixed-side collumn-select" style="text-align:center; padding-bottom: 0px">
                                        <input class="selectable" id="{{ $client->client_id }}" onchange="" type="checkbox" style="" name="assigned{{ $idx }}">
                                        <input type="hidden" name="id{{ $idx }}" value="">
                                    @foreach ($attsMaster as $attMaster)
{{--                                        @if ($attMaster == 'name')
                                        <td class="fixed-side" style="white-space: nowrap; pointer-events: auto !important;"> <a id="{{$attMaster}}_{{$client->user_id}}" target="_blank" href="{{route($route . '.detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;"> {{ $client->$attMaster }}</a></td>
                                        @else --}}
                                        <td class="fixed-side" onclick="copyFunction(this)" style="white-space: nowrap; cursor:context-menu;"> {{ $client->$attMaster }} </td>
                                        {{--@endif--}}
                                        
                                    @endforeach
                                    @foreach ($atts as $att)
<!-- <<<<<<< HEAD
                                        <td onclick="copyFunction(this)" style="max-width: 100px; white-space: nowrap; cursor:context-menu;"> {{$client->$att}} </td>
======= -->
                                        <td style="max-width: 100px; white-space: nowrap;"> <a id="{{$att}}_{{$client->client_id}}" target="_blank" href="{{route($route . '.detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;">{{$client->$att}} </a></td>
<!-- >>>>>>> 131fac5ac3ac9e7c7e6f9bfa7a2b73f8dc713c59 -->
                                    @endforeach
                                </tr>
                            <?php $idx = $idx + 1; ?>
                            @endforeach
                        