@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default col-md-6 col-md-offset-3">
                    {{ csrf_field() }}
                    <div class="panel-heading">用户登录</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('login') }}">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">邮箱:</label>
                                <input type="email" class="form-control" id="email" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">密码:</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary col-md-12">登录</button>
                                <a class="btn btn-link text-muted forget-password" href="{{ route('password.request') }}">
                                    忘记密码?
                                </a>
                            </div>
                            <div class="row">
                                {{--<div class="col-xs-6 col-sm-6 col-md-6">--}}
                                    {{--<a class="btn btn-link" href="{{ route('socials.authorizations.login', ['type' => 'github']) }}">--}}
                                        {{--<i class="iconfont icon-github"></i> 使用Github登录--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-6 col-sm-6 col-md-6">--}}
                                    {{--<a class="btn btn-link pull-right" href="{{ route('socials.authorizations.login', ['type' => 'wechat']) }}">--}}
                                        {{--<i class="iconfont icon-wechat"></i> 使用微信登录--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
