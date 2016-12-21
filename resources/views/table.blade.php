@foreach($posts as $post)
    <tr>
        <td><a href="{{route('CAT.detail', ['id' => $loop->index])}}"> {{ $post }} </a></td>
    </tr>
@endforeach
