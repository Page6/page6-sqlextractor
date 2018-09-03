@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
                    <a href="{{ url('/extractor') }}"><h1>Extractor</h1></a>
                    <a href="https://laravel-news.com"><h1>Record</h1></a>
                    <!--<a href="https://github.com/laravel/laravel">GitHub</a>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
