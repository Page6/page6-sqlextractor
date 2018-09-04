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
							<td>用户</td>
							<td>查询</td>
							<td>提取时间</td>
						</tr>
						@foreach ($records as $record)
						<tr>
							<td>{{ $record->id }}</td>
							<td>{{ $record->user }}</td>
							<td>{{ $record->sql }}</td>
							<td>{{ $record->extracted_at }}</td>
						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
