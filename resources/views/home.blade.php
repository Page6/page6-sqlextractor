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
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                <div class="links panel-body">
                @if (@preg_match('/[^Guest_]*?[_]([0-9]?$)/', Auth::user()->name))
                    <table border=1>
                        <tr>
                            <td>报表号</td>
                            <td>报表内容</td>
                        </tr>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{$report->id}}</td>
                                <td><a href="">{{$report->comment}}</a></td>
                            </tr>
                        @endforeach
                    </table>
                @elseif (Auth::user()->name == config('app.admin', 'Admin'))
                <form action="{{ url('/record') }}" method="POST">
                    {{ csrf_field() }}
                    <h3>Record</h3>
                    <label>开始日期：</label><input name="start_record" type="date" value="2018-09-01"/>
                    <label>结束日期：</label><input name="end_record" type="date" value="2018-09-01"/>
                    <input type="submit" value="查询"/>
                    <!-- <a href="{{ url('/extractor') }}"><h1>Extractor</h1></a> -->
                    <!-- <a href="{{ url('/record') }}"><h1>Record</h1></a> -->
                    <!--<a href="https://github.com/laravel/laravel">GitHub</a>-->
                </form>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
