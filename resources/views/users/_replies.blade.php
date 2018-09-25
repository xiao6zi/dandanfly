@if (count($replies))
    <ul class="list-group">
        @foreach ($replies as $reply)
            <li class="list-group-item">
                <a href="{{ $reply->article->link(['#reply' . $reply->id]) }}">
                    {{ $reply->article->title }}
                </a>

                <div class="reply-content">
                    {!! $reply->body !!}
                </div>

                <div class="meta">
                    <span class="glyphicon glyphicon-time" aria-hidden="true">回复于 {{ $reply->created_at->diffForHumans() }}</span>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}

{!! $replies->appends(Request::except('page'))->render() !!}

