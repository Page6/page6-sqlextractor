@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <table border=1>
						<tr>
							<td>ID号</td>
							<td>姓名</td>
							<td>年龄</td>
							<td>职位</td>
						</tr>
						@foreach ($employees as $employee)
						<tr>
							<td>{{ $employee->id }}</td>
							<td>{{ $employee->name }}</td>
							<td>{{ $employee->age }}</td>
							<td>{{ $employee->position }}</td>
						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
