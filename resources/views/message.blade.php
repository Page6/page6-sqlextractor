@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @switch ($type)
                @case ('success')
                    <div class="panel panel-success">
                        <div class="panel-heading">success</div>
                            <div class="panel-body">
                                {{ $message }}
                            </div>
                    </div>
                    @break
                @case ('warning')
                    <div class="panel panel-warning">
                        <div class="panel-heading">warning</div>
                            <div class="panel-body">
                                {{ $message }}
                            </div>
                    </div>
                    @break
                @case ('info')
                    <div class="panel panel-info">
                        <div class="panel-heading">tips</div>
                            <div class="panel-body">
                                {{ $message }}
                            </div>
                    </div>
                    @break
                @case ('danger')
                    <div class="panel panel-danger">
                        <div class="panel-heading">注意</div>
                            <div class="panel-body">
                                {{ $message }}
                            </div>
                    </div>
                    @break
                @default
            @endswitch
        </div>
    </div>
</div>
@endsection
