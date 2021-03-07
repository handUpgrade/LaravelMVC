@extends('layouts.profile')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    
    <hr />
    <!-- {{-- css 는 bootstrap 4.3.1 을 사용함. 9장에  
        php artisan ui:vue --auth, npm i , npm run dev 에 의해서. 라이브러리 설치가 되고, 
        public\css\app.css 가 만들어 짐.
        
        --}} -->
    {!! csrf_field() !!} {{-- @csrf   로 대체가능 (블레이드) --}}
    {{-- cross site request forge --}}
    {{-- route() : url 경로 , csrf_field(): csrf 대응하는 헬퍼함수 --}}
    <div class="form-group">
        <label for="">글 제목</label>
        <p class="form-control">{{$question->title}}</p>
    </div>
    <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
        <label for="title">작성자</label>
        <p type="text" name="title" id="title" value="" >
            {{$question->user->user_id}}
        </p>
    </div>
    <div class="form-group {{ $errors->has('content') ? 'has-error':'' }}" >
        <label for="content">내용</label>
        <pre name="content" id="content"  class="form-control" value="{{ old('content') }}" style="height:auto;">{{$question->content}}</pre>
    </div>
    
    <!-- 글을 쓴 사람  or 관리자일 경우. ( 로그인 안했을 경우 admin 오류 날 수 있으니  로그인 안되어있을 경우 admin 값을 0으로 해줌) -->
    @if(Auth::id() == $question->user_id or isset(auth()->user()->admin) ?  (auth()->user()->admin==1)?1:0  : 0 )
        <div class="buttonadjustment">
            <!-- 글을 쓴 사람일 경우 ( 수정, 삭제 가능) -->
            @if(Auth::id() == $question->user_id)
            <form action="{{route('questions.edit',[$question->id])}}" method="get" style="display: inline;">
                <div class="form-group" style="display: inline;">
                    <button type="submit" class="btn btn-primary">수정</button>
                </div>
            </form>
            <form action="{{route('questions.destroy',[$question->id])}}" method="post" style="display: inline;">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="form-group" style="display: inline;">
                    <button type="submit" class="btn btn-primary">삭제</button>
                </div>
            </form>
            <!-- 관리자일 경우 ( 삭제 가능) -->
            @else
            <form action="{{route('questions.destroy',[$question->id])}}" method="post" style="display: inline;">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="form-group" style="display: inline;">
                    <button type="submit" class="btn btn-primary">삭제</button>
                </div>
            </form>
            @endif
        </div>
    @else
        <br><br>
    @endif
    <div class="form-group">
        <label for="answer">댓글</label><br>
        @auth
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".answer-add-modal">댓글 달기</button>

        <div class="modal fade answer-add-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <form id="answerSubmit">
                    <textarea name="content" id="answer" rows="10" class="form-control" required></textarea>
                    <br>
                    <button class="btn btn-primary" id="answer" type="submit">댓글 작성하기</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
        </div>
        @endauth
    </div>
    <div id="answersList"></div>
</div>
@stop
@section('script')

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<!-- <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


<script type="text/javascript">
    function modefiClick(id, content){ // 수정 클릭
        
        $('#userAnswer'+id).empty();
        $('#userAnswer'+id).append("<textarea id='newContent'>"+content+"</textarea>");

        $("#modefiAnswer"+id).empty();
        $("#modefiAnswer"+id).append("<div class='form-group'>" +
            "<button type='button' class='btn btn-primary' onclick='modefiSubmit("+id+")'>수정 완료</button>" +
            "</div>");
    }
    function modefiSubmit(id){  // 수정 사항 저장 
        var content = $('#newContent').val();
        var question_id = {{$question -> id}};
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                asnc: true,
                type: 'PUT',
                url: "/answers/"+id,
                data: {content:content,question_id:question_id},
                dataType: 'json',
                success: function(data) {
                    drawAnswer(data);
                },
                error: function(data) { 
                    // flash 메시지를 사용하고 싶어도, controller 에서 제약에 걸리면 오류로 반환하기 때문에 비동기적으로 해야만 함. 
                    // 따라서 ajax 에서는 사실상 사용 하기 어려움
                    var errors = data.responseJSON;
                    if(errors){ // 글자수, required  만족 못했을 경우.
                        alert(errors.errors.content[0]);
                    }else{ // 로그인 안한 경우
                        alert("답변 수정 실패");
                    }
                }
            });
    }
    function drawAnswer(datas) { // 데이터로 화면에 나타냄.
            $("#answersList").empty();
            datas.map((data) => {  // {id: , user_id: , content: , created_at: , .. }
                var id = <?php if (Auth::check()){
                print(Auth::user()->id);
                print(';');
            }else{print("'not login';");}
                ?>
                var addButton = '';
                if ( id == data.user_id || <?php if( isset(auth()->user()->admin) ){print(auth()->user()->admin?1:0);}else{print("false");} ?>){
                    if( id == data.user_id) {
                    addButton = 
                    "<form id='modefiAnswer" + data.id +"'style='display: inline;'>" +
                    "<div class='form-group' style='display: inline;'>" +
                    "<button type='button' class='btn btn-primary' onclick='modefiClick("+data.id+",\""+data.content+"\")'>수정</button>" +
                    "</div>" +
                    "</form>" +'  ';
                    }

                    addButton += 
                    "<form id='deleteAnswer" + data.id + "'style='display: inline;'>" +
                    "<div class='form-group'style='display: inline;'>" +
                    "<button type='submit' class='btn btn-primary'>삭제</button>" +
                    "</div>" +
                    "</form>" ;
                }
                var admin_s = "";
                if (data.u_admin){
                    admin_s = "(관리자)";
                    console.log("관리자 로딩 ");
                }
                console.log("관리자 들어가나?");
                $("#answersList").append("<div id='answer'" + data.id + "><h5>" + data.u_name + admin_s+
                    "</h5><pre id='userAnswer"+data.id+"' style='height:auto;font-size:20px;'>" 
                    + data.content +"</pre>"+
                    addButton+
                    "</div>");
                $("#deleteAnswer" + data.id).submit(function(e) {
                    var question_id = {{$question -> id}}      
                    e.preventDefault();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        url: "/answers/"+data.id,
                        data: {question_id:question_id},
                        dataType: 'json',
                        success: function(data) {
                            alert("답변 삭제 성공했습니다 !!");
                            drawAnswer(data)
                        },
                        error: function(data) {
                            alert("답변 삭제 오류 발생" + data);
                        }
                    });
                });
            });
        };
    $(document).ready(function() { // 페이지 로딩 된 후 이벤트 등록, 답변 받아오기 (ajax)
        ajaxShow();
        
        $("#answerSubmit").submit(function(e) {  // and delete ajax  # 답변 등록
            e.preventDefault();
            var content = $("textarea[name=content]").val();
            var user_id = <?php if (Auth::check()){
                print(Auth::user()->id);
            }else{print("'not login';");}
                ?>

            var question_id = {{$question -> id}};
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
                type: 'POST',
                url: "{{ route('answers.store') }}",
                data: {
                    question_id: question_id,
                    user_id: user_id,
                    content: content
                },
                dataType: 'json',
                success: function(data) {
                    alert("답변 등록에 성공했습니다 !!");
                    $("textarea[name=content]").val('');
                    drawAnswer(data)
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    if(errors){ // 글자수, required  만족 못했을 경우.
                        alert(errors.errors.content[0]);
                    }else{ // 로그인 안한 경우
                        alert("답변 등록 실패");
                    }
                    
                }
            });
        });

        function ajaxShow() { // 처음에 답변 로딩
            var question_id = {{$question -> id}}                    

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                asnc: true,
                type: 'GET',
                url: "{{ route('answers.index') }}",
                data: {question_id:question_id},
                dataType: 'json',
                success: function(data) {
                    drawAnswer(data);
                },
                error: function(data) {
                    alert("답변 로딩 오류 발생" + data);

                }
            });

        }
    });

</script>
@stop