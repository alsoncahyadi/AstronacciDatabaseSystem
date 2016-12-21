@foreach($posts as $post)
    <tr>
        <td><a href="{{route($route, ['id' => $loop->index])}}"> {{ $post }} </a></td>
    </tr>
@endforeach
