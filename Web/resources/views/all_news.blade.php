@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">BigNews</li>
                </ul>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">BigNews</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-dismissible alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Info!</h4>
                            <p>This page will only show 100 recent news.</p></div>
                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Time</th>
                                <th>URL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $big_news as $news)
                                <tr>
                                    <td>{{ $news->id }}</td>
                                    <td>{{ $news->name }}</td>
                                    <td>{{ $news->created_at }}</td>
                                    <td><a href="{{ $news->url }}">{{ $news->url }}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
