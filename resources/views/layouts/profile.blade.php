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
  <link href="{{asset('startbootstrap-modern-business/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> -->

  <!-- Custom styles for this template -->
  <link href="{{ asset('startbootstrap-modern-business/css/modern-business.css') }}" rel="stylesheet">
  <link href="{{ asset('startbootstrap-modern-business/css/edit.css') }}" rel="stylesheet">

  <!-- intros jquery -->
  <script src="{{asset('https://code.jquery.com/jquery-1.12.4.js')}}"></script>
  <script src="{{asset('https://code.jquery.com/ui/1.12.1/jquery-ui.js')}}"></script>

  <style>
    .buttonadjustment{
      display:flex;
      flex-direction: row;
    }
    h1, h3{
      color: black;
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
        padding-top: 0px;
        margin-top: 70px;
        
      }
      .main-content{
        min-height: 100%;
        position: relative;
        padding-bottom: 56px;
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
    </div>
    @yield('script')
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