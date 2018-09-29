@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Records</div>

                <div class="panel-body">
                    <table class="table table-bordered">
						@foreach ($records as $raw => $line)
							@if ($raw == 0)
								<thead>
									<tr>
									@foreach ($line as $key => $value)
									<td>{{ $key }}</td>
									@endforeach
									</tr>
								</thead>
							@endif
							<tbody>
								<tr>
								@foreach ($line as $key => $value)
								<td>{{ $value }}</td>
								@endforeach
								</tr>
							</tbody>
						@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
