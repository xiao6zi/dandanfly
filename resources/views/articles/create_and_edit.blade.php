@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h2 class="text-center">
                        <i class="glyphicon glyphicon-edit"></i>
                        @if ($article->id)
                            编辑话题
                            @else
                            新建话题
                            @endif
                    </h2>

                    <hr>

                    @if ($article->id)
                        <form action="{{ route('articles.update', $article->id) }}" method="POST" accept-charset="UTF-8">
                            <input type="hidden" name="_method" value="PUT">
                    @else
                        <form action="{{ route('articles.store') }}" method="POST" accept-charset="UTF-8">
                    @endif

                        @include('common.error')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input class="form-control" type="text" name="title" value="{{ old('title', $article->title ) }}" placeholder="请填写标题" required/>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="category_id" required>
                                <option value="" hidden disabled {{ $article->id ? '' : 'selected' }}>请选择分类</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea name="body_original" class="form-control" id="editor" rows="15" placeholder="请使用 Markdown 格式书写 ;-)，代码片段黏贴时请注意使用高亮语法。" >{{ old('body', trim($article->body_original) ) }}</textarea>
                        </div>

                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simplemde.min.css') }}">
@stop

@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/simplemde.min.js') }}"></script>

    <script>
        $(document).ready(function(){
          var simplemde = new SimpleMDE({ element: $("#editor")[0] });
			simplemde.codemirror.on('drop', function (editor, e) {
				if (!e.dataTransfer && e.dataTransfer.files) {
					alert('浏览器不支持此操作');
					return;
				}
				var dataList = e.dataTransfer.files;
				// 处理图片批量上传
				batchUpload(dataList, editor);
			});

			simplemde.codemirror.on('paste', function (editor, e) {
				if (!e.clipboardData && e.clipboardData.files) {
					alert('浏览器不支持此操作');
					return;
				}
				var dataList = e.clipboardData.items;
				batchUpload(dataList, editor);
			});

			// 处理图片批量上传
			function batchUpload(dataList) {
				for (let i = 0; i < dataList.length; i++) {
					if (dataList[i].type.indexOf('image') === -1) {
						continue;
					}
					let formData = new FormData();
					formData.append('image', dataList[i]);
					fileUpload(formData);
				}
			}

			// ajax上传图片
			function fileUpload(formData) {
				simplemde.value(simplemde.value() + "\n 图片上传中。。。");
				formData.append('_token', '{{ csrf_token() }}');
				$.ajax({
					url: 'upload',
					type: 'POST',
					cache: false,
					data: formData,
					dataType: 'json',
					timeout: 5000,
					processData: false,
					contentType: false,
					xhrFields: {
						withCredentials: true
					},
					success: function (data) {
						// 将返回的图片url追加到编辑器内
						simplemde.value(simplemde.value() .substring(0, simplemde.value() .lastIndexOf("\n")));
						simplemde.value(simplemde.value() + "\n ![file](" + data.url + ") \n");
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						simplemde.value(simplemde.value() .substring(0, simplemde.value() .lastIndexOf("\n")));
						simplemde.value(simplemde.value() + "\n 上传图片出错了!");
						alert("上传图片出错了");
					}
				});
			}
        });
    </script>

@stop