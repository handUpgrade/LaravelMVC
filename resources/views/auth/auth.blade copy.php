@include('flash::message')
@extends('auth.master')

@section('content')

<!-- <h2>로그인 회원가입</h2> -->
<div class="container" id="container">
   <div class="form-container sign-in-container">
        <form action="{{ route('register.store') }}" method="POST">
            {!! csrf_field() !!} 
            <div class="form-group">
                    <h2>회원가입</h2>
                    <label for="id"> {{ __('ID') }} </label>
                    <div class="register-id">
                        <input id="user_id" type="text" name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" autofocus>
                        @error('user_id')
                            <span class="inavlid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="email"> {{ __('E-MAIL')}} </label>
                    <div class="register-email">
                        <input id="email" type="email" name="email" required  value="{{ old('email') }}" autocomplete="email">
                        @error('email')
                            <span class="inavlid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="name"> {{ __('name')}} </label>
                    <div class="register-name">
                        <input id="name" type="name" name="name" required  value="{{ old('name') }}" autocomplete="name">
                        @error('name')
                            <span class="inavlid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone"> {{ __('Phone')}} </label>
                    <div class="register-phone">
                        <input id="phone" type="tel" name="phone" required  value="{{ old('phone') }}" autocomplete="phone" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" placeholder="ex)010-1234-5678">
                        @error('phone')
                            <span class="inavlid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="birth"> {{ __('birth')}} </label>
                    <div class="register-birth">
                        <input id="birth" type="date" name="birth" required  value="{{ old('birth') }}" autocomplete="birth" min="1940-01-01">
                        @error('birth')
                            <span class="inavlid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password"> {{ __('PASSWORD') }} </label>
                    <div class="register-password">
                        <input id="password" type="password" name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm"> {{ __('CONFIRM PASSWORD')}} </label>
                    <div class="register-password">
                        <input id="password-confirm" type="password" name="password_confirmation" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="submit"></label>
                    <div class="register-submit">
                        <input id="register" type="submit" name="submit" value="submit">
                    </div>
                </div>
        </form>     
    </div>
<div class="container" id="container">
   <div class="form-container sign-up-container">
        <form action="{{ route('login.store') }}" method="POST">
              {!! csrf_field() !!}
              <h2>로그인</h2>
              <div>
                  <label for="id">{{ __('ID') }} </label>
                  <div>
                      <input id="user_id" type="text" name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" autofocus>
                      @error('user_id')
                          <span class="inavlid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div>
                  <label>
                      PASSWORD
                  </label>
                  <div>
                      <input id="password" type="password" name="password" required>
                      @error('password')
                          <span class="inavlid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div>
                  <div>
                      <input id="login" type="submit" name="submit">
                      <a href ="{{route('remind.create')}}">비밀번호 찾기</a>
                  </div>
              </div>
        </form>
   </div>
   <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>어서와라</h1>
                <p>로그인 해서 연결해라</p>
                <button class="ghost" id="signIn">등록</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello</h1>
                <p>마 니 이길수 있나</p>
                    <button class="ghost" id="signUp">로그인</button>
            </div>
      </div>
   </div>
</div>
<script>       
</script>
</body>
</html>
@stop