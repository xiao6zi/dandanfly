<div class="panel panel-default">
    <div class="panel-body">
        <div class="text-center">今日诗词</div>
        <hr>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">
                    <a data-toggle="collapse" id="jinrishici" data-parent="#accordion" href="#collapseOne">
                        正在加载今日诗词....
                    </a>
                </span>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel panel-default" style="margin-bottom: 0;">
                    <div class="panel-heading">
                        <h4 id="jinrishici-title">题目</h4>
                        <span id="jinrishici-author" style="color:#636b6f;margin-left:5px;">作者：未知</span>
                    </div>
                    <div class="panel-body" id="jinrishici-body" style="font-size: 12px;"></div>
                    <div class="panel-footer" id="jinrishici-footer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (count($active_users))
    <div class="panel panel-default">
        <div class="panel-body active-users">

            <div class="text-center">活跃用户</div>
            <hr>
            @foreach ($active_users as $active_user)
                <a class="media" href="{{ route('users.show', $active_user->id) }}">
                    <div class="media-left media-middle">
                        <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="img-circle media-object">
                    </div>

                    <div class="media-body">
                        <span class="media-heading">{{ $active_user->name }}</span>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
@endif

@if (count($links))
    <div class="panel panel-default">
        <div class="panel-body active-users">

            <div class="text-center">资源推荐</div>
            <hr>
            @foreach ($links as $link)
                <a class="media" href="{{ $link->link }}">
                    <div class="media-body">
                        <span class="media-heading">{{ $link->title }}</span>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
@endif

@section('scripts')
    <script>
		$.ajax({
			url: 'https://v2.jinrishici.com/one.json',
			xhrFields: {
				withCredentials: true
			},
			success: function (result, status) {
				console.log(result);
				if (result.status === 'success') {
					$('#jinrishici').html(result.data.content);
					let contentHtml = '';
					let footerHtml = '关键词：';
					result.data.origin.content.forEach(function (val) {
						contentHtml += '<p>' + val + '</p>';
					})
					footerHtml += result.data.matchTags.join(',');
                    $('#jinrishici-author').html('作者：' + result.data.origin.author + '(' + result.data.origin.dynasty + ')')
                    $('#jinrishici-title').html(result.data.origin.title);
                    $('#jinrishici-body').html(contentHtml);
                    $('#jinrishici-footer').html(footerHtml);
                }
			},
            error: function () {
                $('#jinrishici').html('今日诗词加载失败')
			}
		});
    </script>
@stop