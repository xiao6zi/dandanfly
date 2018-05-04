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
                            <textarea name="body_original" class="form-control" id="editor" rows="15" placeholder="请使用 Markdown 格式书写 ;-)，代码片段黏贴时请注意使用高亮语法。" required>{{ old('body', trim($article->body_original) ) }}</textarea>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('scripts')
    <script type="text/javascript"  src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor.js') }}"></script>

    {{--<script>--}}
        {{--$(document).ready(function(){--}}
            {{--var editor = new Simditor({--}}
                {{--textarea: $('#editor'),--}}
                {{--upload: {--}}
                    {{--url: '{{ route('topics.upload_image') }}',--}}
                    {{--params: { _token: '{{ csrf_token() }}' },--}}
                    {{--fileKey: 'upload_file',--}}
                    {{--connectionCount: 3,--}}
                    {{--leaveConfirm: '文件上传中，关闭此页面将取消上传。'--}}
                {{--},--}}
{{--//                pasteImage: true,--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}

@stop