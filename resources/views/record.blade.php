@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <table border=1>
						@foreach ($records as $raw => $line)
							@if ($raw == 0)
								<tr>
								@foreach ($line as $key => $value)
								<td>{{ $key }}</td>
								@endforeach
								</tr>
							@endif
							<tr>
							@foreach ($line as $key => $value)
							<td>{{ $value }}</td>
							@endforeach
							</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
