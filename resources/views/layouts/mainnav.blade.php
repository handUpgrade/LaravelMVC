<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>3조 프로젝트</title>

  <!-- Bootstrap core CSS -->
  <!-- 큰 그림 밑에 애들 -->
  <!-- <link href="startbootstrap-modern-business/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="{{asset('startbootstrap-modern-business/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <!-- 큰 그림 이미지 -->
  <link href="{{asset('startbootstrap-modern-business/css/modern-business.css')}}" rel="stylesheet">
  <link href="{{asset('startbootstrap-modern-business/css/load.scss')}}" rel="stylesheet">
  <!-- 아이콘 이미지 -->
  <link rel="stylesheet" href="{{asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}">
  <style>
    .main-content{
      margin-top: 5%;
    }
    h3{
      color:black;
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
  @yield('content')
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('startbootstrap-modern-business/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('startbootstrap-modern-business/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <link href="{{ asset('startbootstrap-modern-business/css/edit.css') }}" rel="stylesheet">
</body>

</html>