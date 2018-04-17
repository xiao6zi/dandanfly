@extends('layouts.app')
@section('title', $user->name . '的个人中心')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div align="center">
                        <img width="300px" height="300px" src="{{ $user->avatar }}" alt="" class="thumbnail img-responsive">
                        <a class="btn btn-primary btn-block" href="{{ route('users.edit', [$user->id]) }}" id="user-edit-button">
                            <i class="glyphicon glyphicon-edit"></i> 编辑个人资料
                        </a>
                    </div>
                    <div class="media-body">
                        <hr>
                        <h4><strong>个人简介</strong></h4>
                        <p>{{ $user->introduction }}</p>
                        <hr>
                        <h4><strong>注册于</strong></h4>
                        <p>{{ $user->created_at->diffForHumans() }}</p></div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <span>
                        <h1 class="panel-title" style="font-size: 30px;"> {{ $user->name }} <small>{{ $user->email }}</small></h1>
                    </span>
                </div>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#">Ta 的话题</a>
                        </li>
                        <li>
                            <a href="#">Ta 的回复</a>
                        </li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="http://larabbs.test/topics/101"> test </a>
                            <span class="meta pull-right">0 回复<span> ⋅ </span>1天前</span>
                        </li>
                    </ul>
                    <ul class="pagination">
                        <li class="disabled"><span>«</span></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#" rel="next">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop