@include('flash::message')
@extends('auth.master')

@section('content')
  <form action="{{ route('reset.store') }}" method="POST" role="form" class="form__auth">
    {!! csrf_field() !!}

    <input type="hidden" id="token" name="token" value="{{ $token }}">

    <div class="page-header">
      <h4>비밀번호 변경</h4>
      <p class="text-muted">
        비밀번호 변경
      </p>
    </div>

    <div class="form-group">
      <input type="user_id" name="user_id" class="form-control" placeholder="아이디" value="{{ old('user_id') }}" autofocus>
      {!! $errors->first('user_id', '<span class="form-error">:message</span>') !!}
    </div>  

    <div class="form-group">
      <input type="password" name="password" class="form-control" placeholder="비밀번호 입력">
      {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
    </div>

    <div class="form-group">
      <input type="password" name="password_confirmation" class="form-control" placeholder="비밀번호 확인">
      {!! $errors->first('password_confirmation', '<span class="form-error">:message</span>') !!}
    </div>

    <button class="btn btn-primary btn-lg btn-block" type="submit">
      비밀번호 변경하기
    </button>
  </form>
@stop