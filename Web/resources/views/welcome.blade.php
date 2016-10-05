@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <div class="jumbotron">
                    <h1>{{ config('app.name', 'Laravel') }}</h1>
                    <p>Miao, Moe, for SMIE.</p>
                    <p>
                        <a class="btn btn-primary btn-large" href="https://github.com/bazingaterry/OhMyCat">Star
                            project</a></p>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 column">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Topic</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-dismissible alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Warning!</h4>
                            <p>Spam will be deleted without warning and spammer's IP will be blocked by Cat!</p></div>
                        <ul class="list-group">
                            @foreach( $topics as $topic)
                                <li class="list-group-item">
                                    <span class="badge">{{ $topic->created_at }}</span>{{ $topic->getContentWithBy() }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="btn-group">
                            <a class="btn btn-primary btn-large" data-toggle="modal" data-target="#post_topic">New
                                Post</a>
                            <a class="btn btn-default btn-large" href="topic">Show All</a>
                        </div>
                        <div id="post_topic" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Say something...</h4>
                                    </div>
                                    <form class="form-horizontal" action="topic" method="post">
                                        <fieldset>
                                            {!! csrf_field() !!}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="author" class="col-lg-2 control-label">Name</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control" name="author"
                                                               placeholder="Your name (optional)">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="text"
                                                           class="col-lg-2 control-label">Text</label>
                                                    <div class="col-lg-9">
                                                        <textarea class="form-control" rows="5"
                                                                  name="text"></textarea>
                                                        <span class="help-block">World is powered by solitude.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <button type="submit" class="btn btn-primary">Post Now!</button>
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12 column">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Big News</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-dismissible alert-warning">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Warning!</h4>
                            <p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra
                                augue.
                                Praesent commodo cursus magna,
                                <a href="#" class="alert-link">vel scelerisque nisl consectetur et</a>.</p></div>
                        <table class="table table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Column heading</th>
                                <th>Column heading</th>
                                <th>Column heading</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                            </tr>
                            <tr class="info">
                                <td>3</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                            </tr>
                            <tr class="success">
                                <td>4</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                            </tr>
                            <tr class="danger">
                                <td>5</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                            </tr>
                            <tr class="warning">
                                <td>6</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                            </tr>
                            <tr class="active">
                                <td>7</td>
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
