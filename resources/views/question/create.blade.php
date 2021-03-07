@extends('layouts.profile')

@section('content')
    <div class="container">
        <br><br>
        <h2>새로운 질문 작성</h2>
        <hr/>
        <!-- {{-- css 는 bootstrap 4.3.1 을 사용함. 9장에  
        php artisan ui:vue --auth, npm i , npm run dev 에 의해서. 라이브러리 설치가 되고, 
        public\css\app.css 가 만들어 짐.
        
        --}} -->
        <form action="{{ route('questions.store') }}" method="post">
            {!! csrf_field() !!}  {{-- @csrf   로 대체가능 (블레이드) --}}
            {{-- cross site request forge --}}
            {{-- route() : url 경로 , csrf_field(): csrf 대응하는 헬퍼함수 --}}

            <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
                <label for="title">제목</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" />
                {!! $errors->first('title', '<span class="form-error">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('content') ? 'has-error':'' }}">
                <label for="content">내용</label>
                <textarea name="content" id="content" rows="10" class="form-control">{{ old('content') }}</textarea>
                {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                저장하기
                </button>
            </div>
        </form>
    </div>
@endsection