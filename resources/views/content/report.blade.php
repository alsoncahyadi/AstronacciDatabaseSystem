@extends('layouts.logged')
@section('content')
    <div>
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:red">Report</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
            <!-- /.row -->

            
		<form method="post" action="{{route('report.green')}}">
			<textarea name="report"></textarea>
			<br />
			<input name="issuccess" type="checkbox">
			<input type="text" value={{$type}}>
			<input name="id" type="text" value={{$id}}>
			<br />
			<button name="assbut" type="submit">Report</button>
			{{ csrf_field() }}
		</form>

	<br><br>
	
@endsection
</html>
