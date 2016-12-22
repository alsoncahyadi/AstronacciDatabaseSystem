<tr>
@foreach ($heads as $head)
    <td> {{$head}} </td>
@endforeach
</tr>


@foreach ($clients as $client)
    <tr>
    @foreach ($atts as $att)
        <td> <a href="{{route($route . '.detail', ['id' => $client->all_pc_id])}}">{{$client[$att]}} </a></td>
    @endforeach
    </tr>
@endforeach