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
                <div class="links panel-body">
                    <div class="panel-body">
                        @switch ($report->id)
                            @case(1)
                            @case(2)
                                <form action="{{ url('/extractor') }}" method="POST">
                                    {{ csrf_field() }}
                                    <h3>Extract</h3>
                                    <label>开始日期：</label><input name="start_extract" type="date" value="2018-09-01"/>
                                    <label>结束日期：</label><input name="end_extract" type="date" value="2018-09-01"/>
                                    <input name="submit_type" type="submit" value="查询"/>
                                    <input name="submit_type" type="submit" value="导出"/>
                                    <!-- <a href="{{ url('/extractor') }}"><h1>Extractor</h1></a> -->
                                    <!-- <a href="{{ url('/record') }}"><h1>Record</h1></a> -->
                                    <!--<a href="https://github.com/laravel/laravel">GitHub</a>-->
                                </form>
                                @break
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
