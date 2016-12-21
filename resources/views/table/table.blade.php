@foreach($posts as $post)
    <tr>
        <td><a href="{{route($route, ['id' => $loop->index])}}"> {{ $post }} </a></td>
    </tr>
@endforeach

@foreach ($mrgs as $mrg)
	<li> all_pc_id -> {{$mrg->all_pc_id}} </li>
	<li> account -> {{$mrg->account}} </li>
	<li> join_date -> {{$mrg->join_date}} </li>
	<li> type -> {{$mrg->type}} </li>
	<li> sales_username -> {{$mrg->sales_username}} </li>
	<hr>
@endforeach
