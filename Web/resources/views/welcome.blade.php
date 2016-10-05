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
                            <p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra
                                augue.
                                Praesent commodo cursus magna,
                                <a href="#" class="alert-link">vel scelerisque nisl consectetur et</a>.</p></div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">14</span>Cras justo odio<br>Dapibus ac facilisis in
                            </li>
                            <li class="list-group-item">
                                <span class="badge">2</span>Dapibus ac facilisis in
                            </li>
                            <li class="list-group-item">
                                <span class="badge">1</span>Morbi leo risus
                            </li>
                        </ul>
                        <div class="btn-group">
                            <a class="btn btn-primary btn-large" href="#">New Post</a>
                            <a class="btn btn-default btn-large" href="#">Show All</a>
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
                            <p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue.
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
