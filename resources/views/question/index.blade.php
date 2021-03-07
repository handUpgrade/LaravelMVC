@extends('layouts.profile')

@section('content')
<!-- <img src="{{ asset('pic/winter_14-wallpaper-1920x1080.jpg') }}" width=100% height="500px" alt="Responsive image"> -->
<img src="{{asset('images/qna.jpg')}}" class="img-fluid" alt="그림없음">
<div class="qnacontainer"style="display:flex; justify-content:center;">
<button class="btn btn-secondary" type="button" onclick="location.href='{{route('questions.create')}}'">작성하기</button>
</div>

<div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">글 제목</th>
                                <th scope="col">작성자</th>
                                <th scope="col">댓글 개수</th>
                            </tr>
                        </thead>
                    @forelse($questions as $question)
                        <tbody>
                            <tr onclick="">
                                <th scope="row">{{$question->id}}</th>
                                <td><a href="{{route('questions.show',[$question->id])}}">{{ $question->title }}</a></td>
                                <td>{{$question->user->name}}</td>
                                <td>{{$answers_num[$question->id]}}</td>
                                <!-- <td>{{$question->user->user_id}}</td> -->
                            </tr>
                        </tbody>
                    @empty
                        <p>글이 없습니다.</p>
                    @endforelse
                    </table>
    @if($questions->count())
        <div class="text-center" style="display:flex; justify-content:center;"> 
        {{--css 가 bootstrap 에 설정되어 있고, 필요하면 가져다가 넣으면 됨.--}}
        {{--https://getbootstrap.com/docs/4.3/getting-started/introduction/--}}
        {{--public 의 app.js 를 사용하는 거임. --}}
            {!! $questions->render() !!}
            {{--XSS 방지 기능 무력화 , 보호기능 끄기: htmlspecialchars 이거 안하기==> render 로 테그를 만드는데 뭐 마음대로 바뀌니까.--}}
        </div>
    @endif
</div>

@stop
