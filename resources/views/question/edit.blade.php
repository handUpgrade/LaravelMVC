@extends('layouts.profile')

@section('content')
    <div class="container">
        <h1 style="margin-top:100px;">질문 수정</h1>
        <hr/>

    <form action="/questions/{{$question->id}}" method="post">
        {{ method_field('PATCH') }}
        
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
            <label for="title">제목</label>
            <input type="text" name="title" id="title" value="{{$question->title}}" class="form-control"/>
            {!! $errors->first('title','<span class="form-error">:message</span>') !!}
        </div>
        <div class="form-group {{ $errors->has('content') ? 'has-error':'' }}">
            <label for="content">내용</label>
            <textarea name="content" id="content" rows="10" class="form-control">{{$question->content}}</textarea>
            {!! $errors->first('content','<span class="form-error">:message</span>') !!}
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
            수정 완료
            </button>
        </div>
    </form>
</div>
        
        
@stop