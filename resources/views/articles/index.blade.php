@extends('layouts.app')

@section('title', isset($category) ? $category->name : '首页')

@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-9 article-list">
            @if (isset($category))
                <div class="alert alert-info" role="alert">
                    {{ $category->name }} ：{{ $category->description }}
                </div>
            @endif

            <div class="panel panel-default">

                <div class="panel-heading">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="http://larabbs.test/topics?order=default">最后回复</a></li>
                        <li class=""><a href="http://larabbs.test/topics?order=recent">最新发布</a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    @include('articles._article_list')
                    {!! $articles->render() !!}

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 sidebar">
            @include('articles._sidebar')
        </div>
    </div>

@stop