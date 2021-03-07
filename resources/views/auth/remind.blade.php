@include('flash::message')
@extends('auth.master')

@section('content')
  <form action="{{ route('remind.store') }}" method="POST" role="form" class="form__auth">
    {!! csrf_field() !!}

    <div class="page-header">
      <h4>
      비밀번호 변경
      </h4>
      <p class="text-muted">
      비밀번호를 변경하고자 하는 아이디 입력
      </p>
    </div>

    <div class="form-group">
      <input type="user_id" name="user_id" id="user_id" class="form-control" value="{{ old('user_id') }}" autofocus>
      {!! $errors->first('user_id', '<span class="form-error">:message</span>') !!}
    </div>

    <button class="btn btn-primary btn-lg btn-block" type="submit">
      확인하기  
    </button>
  </form>
@stop