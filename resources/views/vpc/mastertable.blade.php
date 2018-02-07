
		<input id="hidden_page_count" type="hidden" value="{{$count}}">
		@foreach ($clients as $client)	
			<tr>
				<td> {{$client->master_id}} </td>
				<td class="fixed-side" style="white-space: nowrap; pointer-events: auto !important;"> <a target="_blank" href="{{route('detail', ['id' => $client->master_id])}}" style="text-decoration:none; color:black;"> {{ $client->name }}</a></td>
				@if ($client->stock)
					<td> v </td>
				@else
					<td> </td>
				@endif
				@if ($client->future)
					<td> v </td>
				@else
					<td> </td>
				@endif
				@if ($client->cat)
					<td> v </td>
				@else
					<td> </td>
				@endif
				@if ($client->mrg)
					<td> v </td>
				@else
					<td> </td>
				@endif
				@if ($client->uob)
					<td> v </td>
				@else
					<td> </td>
				@endif
			</tr>
		@endforeach
