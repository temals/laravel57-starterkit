@extends('admin.layout.auth')

@section('content')
<div class="auto-form-wrapper">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
  {{ csrf_field() }}

    <div class="form-group">
      <label class="label">Username</label>
      <div class="input-group">
        <input id="email" type="email" required class="form-control" name="email" value="{{ old('email') }}" autofocus>

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
        
        <input id="password" type="password" required class="form-control" name="password" value="{{ old('password') }}" autofocus>

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
      <button class="btn btn-primary submit-btn btn-block">Login</button>
    </div>
    <div class="form-group d-flex justify-content-between">
      <div class="form-check form-check-flat mt-0">
        <label class="form-check-label">
            <input type="checkbox" name="remember" class="form-check-input"> Remember  Me        
        </label>
      </div>
      <a href="{{ url('/admin/password/reset') }}" class="text-small forgot-password text-black">Forgot Password</a>
    </div>
    <div class="form-group">
      <button class="btn btn-block g-login" type="submit">
        <img class="mr-3" src="{{ url('/assets/startadmin')}}/images/file-icons/icon-google.svg" alt="">Log in with Google</button>
    </div>
    <div class="text-block text-center my-3">
      <span class="text-small font-weight-semibold">Not a member ?</span>
      <a href="{{ url('/admin/register') }}" class="text-black text-small">Create new account</a>
    </div>
  </form>
</div>
@endsection
