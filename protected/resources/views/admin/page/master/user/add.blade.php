@extends('admin.layout.app')

@section('content')
<div class="col-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Add / Edit User</h4>
      <form class="form-sample" method="post" action="{{ $action }}">
        @csrf 

        @if(!empty($row->id))
          @method('PUT')
        @endif

        <p class="card-description">
          Data User
        </p>
        <div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" value="{{ $row->name ?? '' }}">
              @if(!empty($errors->has('name')))
                <small class="help-block text-danger">{{ $errors->first('name') }}</small>
              @endif
            </div>
          </div>
        
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" name="email" required value="{{ $row->email ?? '' }}">
              @if(!empty($errors->has('email')))
                <small class="help-block text-danger">{{ $errors->first('email') }}</small>
              @endif
            </div>
          </div>
        
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" name="password" value="">
              @if(!empty($errors->has('password')))
                <small class="help-block text-danger">{{ $errors->first('password') }}</small>
              @endif
            </div>
          </div>
        
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password Konfirmasi</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" name="password_confirmation" value="{{ $row->password_confirmation ?? '' }}">
              @if(!empty($errors->has('password_confirmation')))
                <small class="help-block text-danger">{{ $errors->first('password_confirmation') }}</small>
              @endif
            </div>
          </div>

          <div class="row">
            <label class="col-sm-3 col-form-label">&nbsp;</label>
            <div class="col-sm-9">
              <input type="submit" value="Simpan" class="btn btn-primary" />
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
@endsection