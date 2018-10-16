@extends('admin.layout.auth')

<!-- Main Content -->
@section('content')
<div class="auto-form-wrapper">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/email') }}">
  {{ csrf_field() }}

    <div class="form-group">
      <label class="label">Email</label>
      <div class="input-group">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

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
      <button class="btn btn-primary submit-btn btn-block">Send Password Reset Link</button>
    </div>

  </form>
</div>
@endsection
