@extends('layouts.app')
<script type="text/javascript">
    function showLoading(show) {
        // body...
        var dialog = document.getElementById("loading"); 
        if(show){
            dialog.style.display = "block"; 
        }else{
            dialog.style.display = "none"; 
        }
        return true;
    }
</script>
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
                <div class="panel-heading">Dashboard</div>
                <div class="links panel-body">
                    <div class="panel-body">
                        @switch ($report->report_type)
                            @case(1)
                                <form action="{{ url('/extractor') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="report_id" value="{{$report->report_id}}">
                                    <h3>Extract</h3>
                                    <div class="form-group">
                                        <label>{{$report->report_name}}</label>
                                        <label for="input_text" class="sr-only">input</label>
                                        <input id="input_text" type="text" class="form-control" name="input_text" placeholder="{{$report->report_name}}" required autofocus/>
                                    </div>
                                    <input name="submit_type" type="submit" class="btn btn-primary" value="search" 
                                        onclick="showLoading(true)"/>
                                    <input name="submit_type" type="submit" class="btn btn-primary" value="export" 
                                        onclick="showLoading(true)"/>
                                    <div id="loading" class="loading" style="display:none;">
                                        extracting now, please wait...
                                    </div>
                                </form>
                                @break
                            @case(2)
                                <form action="{{ url('/extractor') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="report_id" value="{{$report->report_id}}">
                                    <h3>Extract</h3>
                                    <div class="form-group">
                                        <label>sex is</label>
                                        <label for="sex" class="sr-only">sex</label>
                                        <select id="sex" type="select" class="form-control" name="sex" value="male" required autofocus>
                                            <option>male</option>
                                            <option>female</option>
                                        </select>
                                    </div>
                                    <input name="submit_type" type="submit" class="btn btn-primary" value="search" 
                                        onclick="showLoading(true)"/>
                                    <input name="submit_type" type="submit" class="btn btn-primary" value="export" 
                                        onclick="showLoading(true)"/>
                                    <div id="loading" class="loading" style="display:none;">
                                        extracting now, please wait...
                                    </div>
                                </form>
                                @break
                            @case(3)
                                <form action="{{ url('/extractor') }}" method="POST">
                                    {{ csrf_field() }}
                                    <h3>Extract</h3>
                                    <input type="hidden" name="report_id" value="{{$report->report_id}}">
                                    <label>start at</label><input name="start_date" type="date" value="2018-09-01"/>
                                    <label>end at</label><input name="end_date" type="date" value="2018-09-01"/>
                                    <input name="submit_type" type="submit" class="btn btn-primary" value="search" 
                                        onclick="showLoading(true)"/>
                                    <input name="submit_type" type="submit" class="btn btn-primary" value="export" 
                                        onclick="showLoading(true)"/>
                                    <div id="loading" class="loading" style="display:none;">
                                        extracting now, please wait...
                                    </div>
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
