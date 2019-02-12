@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default col-md-6 col-md-offset-3">
                    <div class="panel-heading">用户登录</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <a class="btn btn-primary col-md-12" href="{{ route('login.github') }}">
                                <i class="iconfont icon-github"></i> 使用Github登录
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
