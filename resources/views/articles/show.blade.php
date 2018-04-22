@extends('layouts.app')

@section('title', $article->title)

@section('content')

<div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    作者：{{ $article->user->name }}
                </div>
                <hr>
                <div class="media">
                    <div align="center">
                        <a href="http://larabbs.test/users/5">
                            <img class="thumbnail img-responsive" src="{{ $article->user->avatar }}" width="300px" height="300px">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-center">{{ $article->title }}</h1>

                <div class="article-meta text-center">
                    {{ $article->created_at->diffForHumans() }} ⋅
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> {{ $article->reply_count }}
                </div>

                <div class="topic-body">
                    {{ $article->body }}
                </div>


            </div>
        </div>

        <div class="panel panel-default topic-reply">
            <div class="panel-body">
                <div class="reply-list">
                    <div class=" media" name="reply37" id="reply37">
                        <div class="avatar pull-left">
                            <a href="http://larabbs.test/users/2"> <img class="media-object img-thumbnail"
                                                                        alt="Carmel Hilll"
                                                                        src="https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200"
                                                                        style="width:48px;height:48px;"/> </a>
                        </div>

                        <div class="infos">
                            <div class="media-heading">
                                <a href="http://larabbs.test/users/2" title="Carmel Hilll"> Carmel Hilll </a>
                                <span> •  </span> <span class="meta" title="2018-03-29 09:43:44">3周前</span>


                            </div>
                            <div class="reply-content">
                                Molestiae ratione soluta ea et ex maiores veritatis expedita.
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>

@stop