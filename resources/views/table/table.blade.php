<table>
<tr>
@foreach ($heads as $head)
    <td> {{$head}} </td>
@endforeach
</tr>


@foreach ($clients as $client)
    <tr>
    @foreach ($atts as $att)
        <td> <a href="{{route($route . '.detail', ['id' => $client->all_pc_id])}}">{{$client->$att}} </a></td>
    @endforeach
    </tr>
@endforeach
</table>

<form method="post" action="{{route($route . '.insert')}}">
    @foreach ($ins as $atr)
        {{$atr}} <input type="text" name="{{strtolower(str_replace(' ', '_', $atr))}}"> <br/>
    @endforeach
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
    <input type="submit" value="insert">
</form>

<form method="post" action="{{route($route . '.import')}}" enctype="multipart/form-data">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>">
    <input type="file" name="import_file" />
    <button class="btn btn-primary">Import File</button>
</form>