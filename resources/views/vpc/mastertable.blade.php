
		<input id="hidden_page_count" type="hidden" value="{{$count}}">
		@foreach ($clients as $client)	
			<tr>
				<td> {{$client->master_id}} </td>
				<td> {{$client->name}} </td>
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
