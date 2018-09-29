@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                @if (@preg_match('/[^Guest_]*?[_]([0-9]?$)/', Auth::user()->name))
                    <div class="panel-heading">report list</div>
                    <div class="list-group">
                         @foreach ($reports as $report)
                                <a href="/selector/{{$report->report_id}}" class="list-group-item">{{$report->report_name}}</a>
                         @endforeach
                     </div>
                @elseif (Auth::user()->name == config('app.admin', 'admin'))
                    <div class="panel-heading">User records</div>
                    <div class="panel-body">
                        <form action="{{ url('/record') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="start_record" class="col-md-4 control-label">start at</label>

                                <div class="col-md-6">
                                    <input id="start_record" type="text" class="form-control" name="start_record" value="2018-08-01" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end_record" class="col-md-4 control-label">end at</label>

                                <div class="col-md-6">
                                    <input id="end_record" type="text" class="form-control" name="end_record" value="2018-09-01" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        extract
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
