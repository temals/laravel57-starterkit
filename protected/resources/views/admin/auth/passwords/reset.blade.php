@extends('admin.layout.auth')

@section('content')
<div class="auto-form-wrapper">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/reset') }}">
  {{ csrf_field() }}

  <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
      <label class="label">Email</label>
      <div class="input-group">
        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" autofocus>

        <div class="input-group-append">
          <span class="input-group-text">
            <i class="mdi mdi-check-circle-outline"></i>
          </span> 
        </div>
      </div>
      @if($errors->has('email'))
        <small class="text-danger">{{ $errors->first('email') }}</small>
      @endif
    </div>

    <div class="form-group">
      <label class="label">Password</label>
      <div class="input-group">
        <input id="password" type="password" class="form-control" name="password">

        <div class="input-group-append">
          <span class="input-group-text">
            <i class="mdi mdi-check-circle-outline"></i>
          </span> 
        </div>
      </div>
      @if($errors->has('password'))
        <small class="text-danger">{{ $errors->first('password') }}</small>
      @endif
    </div>

    <div class="form-group">
      <label class="label">Konfirmasi Password</label>
      <div class="input-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

        <div class="input-group-append">
          <span class="input-group-text">
            <i class="mdi mdi-check-circle-outline"></i>
          </span> 
        </div>
      </div>
      @if($errors->has('password_confirmation'))
        <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
      @endif
    </div>

    <div class="form-group">
      <button class="btn btn-primary submit-btn btn-block">Reset Password</button>
    </div>

  </form>
</div>
@endsection
