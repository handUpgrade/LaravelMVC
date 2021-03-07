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
  <link href="startbootstrap-modern-business/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <!-- 큰 그림 이미지 -->
  <link href="startbootstrap-modern-business/css/modern-business.css" rel="stylesheet">
  <link href="startbootstrap-modern-business/css/load.scss" rel="stylesheet">
  <!-- 아이콘 이미지 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    @endauth
                      </div>
                    </div>

        </div>
  </nav>

  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
         <div class="carousel-item active" style="background-image: url('/images/main.jpg'); ">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h3>아름다운 우리나라</h3> -->
            <!-- <p>This is a description for the first slide.</p> -->
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('/images/main2.jpg'); ">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h3>REDTUBE</h3> -->
            <p>This is a description for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('/images/main3.jpg')">
          <div class="carousel-caption d-none d-md-block">
            <!-- <h3>탈주전문 6조</h3> -->
            <p>This is a description for the third slide.</p>
          </div>
        </div>
      </div>

      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>


    <!-- Portfolio Section -->
    <br>
    <!-- <h2>조원 소개</h2> -->
    <div class="row">
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="/introduce"><img class="card-img-top" src="/images/1.jpg" alt=""></a>
          <div class="middle">
            <a href="/introduce"><div class="middletext">조원소개</div></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-sm-2 portfolio-item">
        <div class="card h-100">
          <a href="/intros"><img class="card-img-top" src="/images/2.jpg" alt=""></a>
          <div class="middle">
            <a href="/intros"><div class="middletext">현지학기제</div></a>
          </div>

        </div>
      </div>
      <div class="col-lg-4 col-sm-3 portfolio-item">
        <div class="card h-100">
          <a href="/questions"><img class="card-img-top" src="/images/3.jpg" alt=""></a>
          <div class="middle">
            <a href="/questions"><div class="middletext">Q&A</div></a>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-3 col-sm-3 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="/images/4.jpg" alt=""></a> -->
          <!-- <div class="card-body">
            <h4 class="card-title">
              <a href="#">틀니 찾아 서은우</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
          </div> -->
        <!-- </div>
      </div> -->
     <!-- <div class="col-lg-2 col-sm-2 portfolio-item">
        <div class="card h-100">
          <a href="#">
          <img class="card-img-top" src="/images/5.jpg" alt=""> -->
          <!-- <img class="card-img-top" src="/images/4.jpg" alt=""> -->
          <!-- </a> -->

          <!-- <div class="card-body">
            <h4 class="card-title">
              <a href="#">킹갓민석</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
          </div> -->
        <!-- </div>
      </div> -->
      <!-- <div class="col-lg-2 col-sm-2 portfolio-item">
        <div class="card h-700">
          <a href="#"><img class="card-img-top " src="/images/6.jpg" alt=""></a> -->
          <!-- <div class="card-body">
            <h4 class="card-title">
              <a href="#">GS 계승 박형준</a>
            </h4>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque earum nostrum suscipit ducimus nihil provident, perferendis rem illo, voluptate atque, sit eius in voluptates, nemo repellat fugiat excepturi! Nemo, esse.</p>
          </div> -->
        <!-- </div> -->
      <!-- </div>
    </div> -->
    <!-- <div class="sombra_fija"><p>Sombra Fija</p></div> -->

    <!-- <div class="recogida_borde"><p>recogida borde</p></div> -->
    <!-- /.row -->

    <!-- Features Section -->
    <!-- <div class="row">
      <div class="col-lg-6">
        <h2>현지학기제</h2>
        <p>The Modern Business template by Start Bootstrap includes:</p>
        <ul>
          <li>
            <strong>Bootstrap v4</strong>
          </li>
          <li>jQuery</li>
          <li>Font Awesome</li>
          <li>Working contact form with validation</li>
          <li>Unstyled page elements for easy customization</li>
        </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
      </div>
      <div class="col-lg-6">
        <img class="img-fluid rounded" src="/images/example2.jpg" alt="">
      </div>
    </div> -->
    <!-- /.row -->

    <!-- <hr> -->

    <!-- Call to Action Section -->
    <!-- <div class="row mb-4">
      <div class="col-md-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum deleniti beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
      </div>
      <div class="col-md-4">
        <a class="btn btn-lg btn-secondary btn-block" href="#">젤 위로</a>
      </div>
    </div> -->

  </div>
  <!-- /.container -->

<!-- <hr> -->
</div>

    <!-- Footer -->
  <footer class="py-3 bg-darkblue">
    <div class="container">
      <p class="m-0 text-center text-white font-weight-bold">Copyright &copy; YORIYOI @ 2WDJ Final Test </p>
    </div>
    <!-- /.container -->
  </footer>
  <div class="loader"></div>
  <!-- Bootstrap core JavaScript -->
  <script src="startbootstrap-modern-business/vendor/jquery/jquery.min.js"></script>
  <script src="startbootstrap-modern-business/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>console.log(auth()->user())  </script>
</body>

</html>
