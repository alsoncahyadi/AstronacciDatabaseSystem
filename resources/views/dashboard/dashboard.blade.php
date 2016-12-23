@extends('layouts.logged')
@section('content')
<div onload="loadtable('AClub')">

    <div id="tab">
    </div> <br/>

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <h4>{{$error}}</h4>
        @endforeach
    @endif
</div>
		<script>
		$(document).ready(function() {
			$('#dataTables').DataTable({
				responsive: true
			});
		});
    </script>
@endsection
</html>
