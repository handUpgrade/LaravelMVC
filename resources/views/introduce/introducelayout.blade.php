<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>3조 프로젝트</title>

  <!-- Bootstrap core CSS -->
  <!-- 큰 그림 밑에 애들 -->
  <!-- <link href="startbootstrap-modern-business/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="{{asset('startbootstrap-modern-business/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <!-- 아이콘 이미지 -->
  <link rel="stylesheet" href="{{asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}">
  <script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.1.1.min.js')}}"></script>
  <script src="{{asset('https://code.jquery.com/ui/1.12.1/jquery-ui.js')}}"></script>
  <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> -->
  <style>
  /* 폼 태크 */
  .form-group{
    font-weight:bold;
  }
  /* 오류메시지 */
    .print-error-msg{
        border:1px solid #F2F2F2;
        background-color:#FFE4E1;
        border-radius:5px;
        color:#8A0808;
    }
    .print-error-msg li{
        padding-top: 10px;
    }
/* 사용자인증 */
    .authenticate{
        background-color: #CEECF5;
        border-radius:5px;
        padding-left: 10px;
    }
    .authenticate h3{
        padding-top: 10px;
        FONT-SIZE: 22px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        COLOR: #2E86B9;
        PADDING-BOTTOM: 5px;
        font-weight:bold;
        /* FONT-SIZE: 22px; COLOR: #eeeeee; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 10px; BORDER-LEFT: #00b5ff 8px solid; PADDING-RIGHT: 10px; BACKGROUND-COLOR: #282828; border-radius:3px; padding-left: 0px; */
    }
    .authenticate p{
        margin: 0px;
    }
    .authenticate input{
        margin-bottom: 10px;
    }
/* 생성하기 */
    .create p{
        margin: 0px;
        margin-top: 10px;
    }
/* 수정하기 */
    .edit p{
        margin: 0px;
        margin-top: 10px;
    }
/* 사진 크기 */
    .img_wrap img{
        width: 300px;
        max-width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;

    }
    .img_wrap p{
        margin-top : 10px;
    }
    /* 기존 사진 */
    .save_img{
        text-align:center;
        border:1px solid #F2F2F2;
        border-radius:5px;
    }
    .save_img img{
        display: inline-block;
    }
    /* 미리보기 사진 */
    .change_img{
        text-align:center;
        border:1px solid #F2F2F2;
        border-radius:5px;
        font-weight:normal;
        font-size:10px;
    }
    .change_img img{
        display: inline-block;
    }


/* 나경이누나가 한거 주로 hover effect */
    .main{
        display:flex;
        justify-content:center;
        flex-direction: column;
        align-content: center;
        flex-wrap:wrap;
    }
    .hovereffect {
        width: 100%;
        height: 100%;
        float: left;
        overflow: hidden;
        position: relative;
        text-align: center;
        cursor: default;
        background: #4244b0;
      }
      .hovereffect .overlay {
        width: 100%;
        height: 100%;
        position: absolute;
        overflow: hidden;
        top: 0;
        left: 0;
        padding: 50px 20px;
      }
      .hovereffect img {
        display: block;
        position: relative;
        max-width: none;
        width: calc(100% + 20px);
        -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
        transition: opacity 0.35s, transform 0.35s;
        -webkit-transform: translate3d(-10px,0,0);
        transform: translate3d(-10px,0,0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
      }
      .hovereffect:hover img {
        opacity: 0.4;
        filter: alpha(opacity=40);
        -webkit-transform: translate3d(0,0,0);
        transform: translate3d(0,0,0);
      }
      .hovereffect h2 {
        text-transform: uppercase;
        color: #fff;
        text-align: center;
        position: relative;
        font-size: 17px;
        overflow: hidden;
        padding: 0.5em 0;
        background-color: transparent;
      }
      .hovereffect h2:after {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: #fff;
        content: '';
        -webkit-transition: -webkit-transform 0.35s;
        transition: transform 0.35s;
        -webkit-transform: translate3d(-100%,0,0);
        transform: translate3d(-100%,0,0);
      }
      .hovereffect:hover h2:after {
        -webkit-transform: translate3d(0,0,0);
        transform: translate3d(0,0,0);
      }
      .hovereffect a, .hovereffect p {
        color: #FFF;
        opacity: 0;
        filter: alpha(opacity=0);
        -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
        transition: opacity 0.35s, transform 0.35s;
        -webkit-transform: translate3d(100%,0,0);
        transform: translate3d(100%,0,0);
      }
      .hovereffect:hover a, .hovereffect:hover p {
        opacity: 1;
        filter: alpha(opacity=100);
        -webkit-transform: translate3d(0,0,0);
        transform: translate3d(0,0,0);
      }
       /** body & html */
       * {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        }
      html, body{
        height: 100%;
      }
      body{
        margin-top: 70px;
      }
      .main-content{
        min-height: 100%;
        margin-top: 70px;
        position: relative;
        padding-bottom: 56px;
      }
      .usershokai{
        text-align:center;
        color:black;
        margin-bottom: 30px;
      }
      footer{
        position: relative;
        bottom: 0;
        left: 0;
        right: 0;
      }
  </style>
</head>

<body>

  <!-- Navigation -->

  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-darkblue fixed-top">
  <a class="navbar-brand" href="{{url('/')}}">YORIYOI</a>
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- <div class="collapse navbar-collapse" id="navbarResponsive"> -->
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/introduce">조원 소개</a>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="/intros">현지 학기제</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/questions">Q & A</a>
          </li>
          <li class="nav-item dropdown">
          @auth
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              내 상태
            </a>
            <div class="dropdown-menu dropdown-menu-right login-drop" aria-labelledby="navbarDropdownBlog">
              <i class="fa fa-user" aria-hidden="true" ></i>
              <a class="login-drop">:  {{auth()->user()->user_id}}</a>
              <br>
              <hr>
              <a class="dropdown-item" href="/profile"> 프로필 설정</a>
              <!-- <i class="fa fa-comment" aria-hidden="true" href="http://yjp.ac.kr" >프로필 설정</i> -->
              <!-- <a class="dropdown-item" href="http://yjp.ac.kr">영진</a> -->
            </div>
            @endauth
          </li>
        </ul>
      </div>
    </div>

                    @auth
                      <!-- 드롭다운으로 할것-->
                      <!-- <div class="namep">
                        <a>{{auth()->user()->user_id}}</a><span> 님 환영합니다</span>
                      </div>   -->
                        <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        @method('delete')
                          <div class="form-group1">
                            <!-- <button type="submit" class="btn btn-primary1">삭제</button> -->
                            <button type="submit" class="btn btn-primary1">logout</button>

                          </div>
                        </form>
                    @else
                    <!-- <div class="Login"> -->
                    <div class="form-group1">
                      <div class="btn btn-primary1">

                        <a href="{{ route('login.index') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register.index') }}">Register</a>
                        @endif
                    @endauth
                      </div>
                    </div>

        </div>
  </nav>
<body>
  <div class="main-content">
    @yield('content')
    @yield('script')
  </div>
    <footer class="py-3 bg-darkblue">
      <div class="container">
        <p class="m-0 text-center text-white font-weight-bold">Copyright &copy; YORIYOI @ 2WDJ Final Test </p>
      </div>
      <!-- /.container -->
    </footer>
     <!-- Bootstrap core JavaScript -->
     <script src="{{asset('startbootstrap-modern-business/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('startbootstrap-modern-business/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
