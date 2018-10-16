@extends('admin.layout.app')

@section('content')
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
	  <div class="card">
	    <div class="card-body">
	      <h4 class="card-title">Master User</h4>

	      <div class="float-right">
	      	<a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fa fa-add"></i> Tambah User</a>
	      </div>
	      <p class="card-description">
	        Data user
	      </p>
	      <div class="table-responsive">
	      	@if(!empty($data) && !$data->isEmpty())
		        <table class="table">
		          <thead>
		            <tr>
		              <th>Name</th>
		              <th>Email</th>
		              <th>Created</th>
		              <th>Status</th>
		            </tr>
		          </thead>
		          <tbody>
		          	@foreach($data as $user)
		            <tr>
		              <td>{{ $user->name ?? '' }}</td>
		              <td>{{ $user->email ?? '' }}</td>
		              <td>{{ $user->created_at ?? '' }}</td>
		              <td>
		                <div class="dropdown">
		                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                    Action
		                  </button>
		                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		                    <a class="dropdown-item" href="{{ route('admin.user.edit',$user->slug) }}">Edit</a>
		                    <a class="dropdown-item actionDelete" href="{{ route('admin.user.destroy',$user->slug) }}">Delete</a>
		                  </div>
		                </div>
		              </td>
		            </tr>
		            @endforeach
		          </tbody>
		        </table>

		        <form action='#' method="post" id="formDelete">
		        	@csrf 
		        	@method("DELETE")
		        </form>
	        @else
	        	<p class="text-center">Tidak terdapat data user</p>
	        @endif
	      </div>
	    </div>
	  </div>
	</div>
</div>
@endsection