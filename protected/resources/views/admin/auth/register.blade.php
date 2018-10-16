@extends('admin.layout.auth')

@section('content')
<div class="auto-form-wrapper">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/register') }}">
  
    {{ csrf_field() }}

    <div class="form-group">
      <label class="label">Email</label>
      <div class="input-group">
        <input id="email" type="email" required placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        <div class="input-group-append">
          <span class="input-group-text">
            <i class="mdi mdi-check-circle-outline"></i>
          </span>
        </div>
      </div>
      @if ($errors->has('email'))
          <small class="help-block text-danger">
              <strong>{{ $errors->first('email') }}</strong>
          </small>
      @endif
    </div>
    
    <div class="form-group">
      <label class="label">Password</label>
      <div class="input-group">
        <input id="password" type="password" required placeholder="Password" class="form-control" name="password" value="{{ old('password') }}">

        <div class="input-group-append">
          <span class="input-group-text">
            <i class="mdi mdi-check-circle-outline"></i>
          </span>
        </div>
      </div>
      @if ($errors->has('password'))
          <small class="help-block text-danger">
              <strong>{{ $errors->first('password') }}</strong>
          </small>
      @endif
    </div>

    <div class="form-group">
      <label class="label">Konfirmasi Password</label>
      <div class="input-group">
        <input id="password_confirmation" placeholder="Password confirmation" type="password_confirmation" class="form-control" required name="password_confirmation" value="{{ old('password_confirmation') }}">
        <div class="input-group-append">
          <span class="input-group-text">
            <i class="mdi mdi-check-circle-outline"></i>
          </span>
        </div>
      </div>
      @if ($errors->has('password_confirmation'))
          <small class="help-block text-danger">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
          </small>
      @endif
    </div>

    <div class="form-group d-flex justify-content-center">
      <div class="form-check form-check-flat mt-0">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" required> I agree to the terms
        </label>
      </div>
    </div>
    <div class="form-group">
      <button class="btn btn-primary submit-btn btn-block" type="submit">Register</button>
    </div>
    <div class="text-block text-center my-3">
      <span class="text-small font-weight-semibold">Already have and account ?</span>
      <a href="{{ url('/admin/login') }}" class="text-black text-small">Login</a>
    </div>
  </form>
</div>
@endsection
