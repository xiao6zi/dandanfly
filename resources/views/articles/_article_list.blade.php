@if (count($articles))
    <ul class="media-list">
        @foreach ($articles as $article)
            <li class="media">
                <div class="media-left">
                    <a href="{{ route('users.show', $article->user_id) }}">
                        <img class="media-object img-thumbnail" style="width: 52px; height: 52px;" src="{{ $article->user->avatar  }}" title="{{ $article->user->name }}">
                    </a>
                </div>

                <div class="media-body">

                    <div class="media-heading">
                        <a href="{{ route('articles.show', $article->id) }}" title="{{ $article->title }}">
                            {{ $article->title }}
                        </a>
                        <a class="pull-right" href="{{ route('articles.show', $article->id) }}" >
                            <span class="badge"> {{ $article->reply_count }} </span>
                        </a>
                    </div>

                    <div class="media-body meta">

                        <a href="{{ route('categories.show', $article->categry_id) }}" title="{{ $article->category->name }}">
                            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                            {{ $article->category->name }}
                        </a>

                        <span> • </span>
                        <a href="{{ route('users.show', $article->user_id) }}" title="{{ $article->user->name }}">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            {{ $article->user->name }}
                        </a>
                        <span> • </span>
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        <span class="timeago" title="最后活跃于">{{ $article->user->updated_at->diffForHumans() }}</span>
                    </div>

                </div>
            </li>

            @if ( ! $loop->last)
                <hr>
            @endif

        @endforeach

    </ul>
@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif