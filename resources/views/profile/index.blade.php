@extends('layouts.profile')

@section('content')
<div class="container">
    <!-- <h3>회원 정보</h3> -->
    <div class="textinfo">
      <h3 style="margin-top:100px;">회원 정보</h3>
    </div>
    <div class='mid'>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">아이디</th>
                            <th scope="col">이름</th>
                            <th scope="col">이메일</th>
                            <th scope="col">전화번호</th>
                            <th scope="col">생일</th>
                            <th scope="col">가입일</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> {{-- $user_info : 로그인한 회원 정보 --}}
                            <td>{{$user_info->id }}</a></td>
                            <td>{{$user_info->user_id}}</td>
                            <td>{{$user_info->name}}</td>
                            <td>{{$user_info->email}}</td>
                            <td>{{$user_info->phone}}</td>
                            <td>{{$user_info->birth}}</td>
                            <td>{{$user_info->created_at}}</td>
                        </tr>
                    </tbody>
                </table>
    <button type='button' class='edit_info'> 내 정보 수정하기</button>
    <button type='button' class='edit_pwd'>비밀번호 변경하기</button>

    <br><br><br>
        <h3>작성한 글</h3>
        <table class="table table-hover">
            <thead>
                <th scope="col">No</th>
                <th scope="col">글 제목</th>
                <th scope="col">댓글 개수</th>
            </thead>
            <tbody>
                @forelse ( $user_questions as $question ) {{-- $user_questions : 회원이 작성한 게시글 없으면 글이 없습니다. 출력 --}}
                    <tr>
                        <td>{{$question->id}}</td>
                        <td><a href="/questions/{{$question->id}}">{{$question->title}}</a></td>
                        <td>{{$user_q_a_num[$question->id]}}</td>
                    </tr>
                    @empty
                    <p>글이 없습니다.</p>
                @endforelse
            </tbody>
        </table>
        @if($user_questions->count())
            <div class="text-center" style="display:flex; justify-content:center;">
            {{--css 가 bootstrap 에 설정되어 있고, 필요하면 가져다가 넣으면 됨.--}}
            {{--https://getbootstrap.com/docs/4.3/getting-y3R3started/introduction/--}}
            {{--public 의 app.js 를 사용하는 거임. --}}
                {!! $user_questions->render() !!}
                {{--XSS 방지 기능 무력화 , 보호기능 끄기: htmlspecialchars 이거 안하기==> render 로 테그를 만드는데 뭐 마음대로 바뀌니까.--}}
            </div>
        @endif
        @if($user_info->admin==1)
        <br><br><br>
            <h3>유저 관리</h3>
            <table class="table table-hover">
            <thead>
                <th scope="col">No</th>
                <th scope="col">유저 아이디</th>
                <th scope="col">유저 이름</th>
                <th scope="col">권한부여</th>
                <th scope="col">유저 삭제</th>
            </thead>
            <tbody class ="user_body">
                @forelse ( $users as $user )  {{-- $users : 모든 회원 정보(관리자일 경우만 존재) --}}
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->user_id}}</a></td>
                        <td>{{$user->name}}</a></td>
                        <td><button type='button' class="edit_human" onclick='permission({{$user->id}})'>{{$user->admin == 0?"유저":"관리자"}}</button></td>
                        <td><button type='button' class="edit_delete" onclick='delete_user({{$user->id}})'>삭제</button></td>
                    </tr>
                    @empty
                    <p>유저가 없습니다.</p>
                @endforelse
            </tbody>
        </table>

    @endif
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
    $('.edit_info').on('click', function(e){ //class가 edit_info인 오브젝트에 클릭 이벤트가 발생했을 때 (이벤트 캐쳐)
        console.log("정보 변경 가기");
        $('.user_questions').empty(); // 클레스가 user_questions인 div안의 요소 전부 제거
        $('.mid').load('/profile/{{$user_info->user_id}}/edit_info');   // load를 통해 -> web.php-> profileController@edit_info({{$user_info->user_id}}) 실행
    });                                                                 // $user_info->user_id == 로그인한 회원의 id
    $('.edit_pwd').on('click', function(e){ //class가 edit_info인 오브젝트에 클릭 이벤트가 발생했을 때 (이벤트 캐쳐)
        console.log("비밀번호 변경 가기")
        $('.mid').load('/profile/{{$user_info->user_id}}/edit_pwd');    // load를 통해 -> web.php-> profileController@edit_pwd({{$user_info->user_id}}) 실행
    });
    function draw_users(users){ // users(모든 회원 정보) ajax로 리턴한 데이터
        $('.user_body').empty();// 클래스가 user_body인 div 안의 요소 지움
        var body = "";          // 초기화
        users.map(user=>{       // map을 통해 users(모든 회원 정보(배열))의 요소 하나하나 마다 반복문 실행 user(배열의 value)
            if (user.admin == 0)// 회원이 admin이 0일 경우 변수 admin_s에 문자열 '유저'를 담아서 생성
                var admin_s = "유저";
            else                // 회원이 admin이 1일 경우 변수 admin_s에 문자열 '관리자'를 담아서 생성
                var admin_s = "관리자";
            body += "<tr>"+     // body 변수에 회원 id(고유번호), user_id(아이디) , name(이름)를 이용한 테이블 구문 생성
                "<td>"+user.id+"</td>"+
                "<td>"+user.user_id+"</td>"+
                "<td>"+user.name+"</td>"+
                "<td><button type='button' class='edit_human' onclick='permission("+user.id+")'>"+admin_s+"</button></td>"+ // 위에 생성된 admin_s를 이용해서 버튼생성 클릭 이벤트 발생시 permission(회원 고유번호) 함수 실생
                "<td><button type='button' class='edit_delete' onclick='delete_user("+user.id+")'>삭제</button></td>"+// 클릭 이벤트 발생시 delete_user(회원 고유번호) 함수 실생
                "<tr>"
        });
        $('.user_body').append(body);   // 클래스가 user_body인 div에 body 내용 추가
    }
    function permission(id){    // id = 회원 고유 번호
        $.ajax({
                headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')   // 토큰 생성
                },
                type: 'put',
                url: "/profile/"+id+"/admin",
                data:{
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log("통신 성공");
                    if(data.message)
                        alert(data.message);
                    else
                        draw_users(data);       //drau_users함수 실행(data = 모든 회원 정보(배열))
                },
                error: function(data) {
                    console.log("실패");
                }
            });
    }
    function delete_user(id){    // id = 회원 고유 번호
        $.ajax({
                headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                type: 'delete',
                url: "/profile/"+id,
                data:{
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log("통신 성공");
                    if(data.message)
                        alert(data.message);       //drau_users함수 실행(data = 모든 회원 정보(배열))
                    else
                        draw_users(data);
                },
                error: function(data) {
                    console.log("실패");
                }
            });
    }
</script>
@stop