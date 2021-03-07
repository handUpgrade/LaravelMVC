<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('css/app.css')}}"></script>
     <script src="{{asset('css/new.css')}}"></script>
    <link href="{{asset('css/new.css')}}" rel="stylesheet">
</head>
<body>
<!-- <h2> 회원소개</h2>   -->
<!-- <div class="container" id="container"> -->
    @include('flash::message')
    <!-- <div class="container" id="container"> -->
             @yield('content')
<!-- <div class="container" id="container"> -->

    <script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
</body>
</html>
