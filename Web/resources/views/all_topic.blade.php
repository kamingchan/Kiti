@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Topic</li>
                </ul>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Topic</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-dismissible alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Info!</h4>
                            <p>This page will only show 100 recent topics.</p></div>
                        <ul class="list-group">
                            @foreach( $topics as $topic)
                                <li class="list-group-item">
                                    <span class="badge">{{ $topic->created_at }}</span>{{ $topic->getContentWithBy() }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
