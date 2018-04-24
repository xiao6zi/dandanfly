@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h2 class="text-center">
                        <i class="glyphicon glyphicon-edit"></i>
                        新建话题
                    </h2>

                    <hr>


                    <form action="{{ route('articles.store') }}" method="POST" accept-charset="UTF-8">

                        @include('common.error')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input class="form-control" type="text" name="title" value="" placeholder="请填写标题" required/>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="category_id" required>
                                <option value="" hidden disabled selected>请选择分类</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea name="body" class="form-control" id="editor" rows="3" placeholder="请填入至少三个字符的内容。" required></textarea>
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

    <script>
        $(document).ready(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                {{--upload: {--}}
                    {{--url: '{{ route('topics.upload_image') }}',--}}
                    {{--params: { _token: '{{ csrf_token() }}' },--}}
                    {{--fileKey: 'upload_file',--}}
                    {{--connectionCount: 3,--}}
                    {{--leaveConfirm: '文件上传中，关闭此页面将取消上传。'--}}
                {{--},--}}
//                pasteImage: true,
            });
        });
    </script>

@stop