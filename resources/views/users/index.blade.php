@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Users</h1>
		<div class="pull-right">
			<span>User Management > Users</span>
		</div>
	</div>
	<div class="row">
		@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		@endif
	
		@if(\Session::has('success'))
			<div class="alert alert-success">
				<p>{{ \Session::get('success')}}</p>
			</div>
		@endif
		
		@if(\Session::has('errorMsg'))
			<div class="alert alert-danger">
				<p>{{ \Session::get('errorMsg')}}</p>
			</div>
		@endif
	</div>
	<div class="row">
		<table class='table table-bordered table-condensed table-striped table-hover'>
		  <tr>
			<th>Name</th>
			<th>Email Address</th>
			<th>Role</th>
			<th>Created At</th>
			<th>Action</th>
		  </tr>
		  <body>
			@foreach($users as $user)
			  <tr>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->role->name }}</td>
				<td>{{ $user->created_at }}</td>
				@if($user->role_id!=1) 
					<td align="center">
						<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#editUserModal{{$user->id}}">{{ __('Edit') }}</a>
					</td>
					@include('users.modal.edit')
				@endif
			  </tr>
			@endforeach
		  </body>
		</table>
	</div>
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"></h1>
		<div class="pull-right">
			<a class="btn btn-success text-light" data-toggle="modal" id="mediumButton" data-target="#addUserModal"
				data-attr="{{ route('users.create') }}" title="Create a project"> Add User
			</a>
		</div>
	</div>
</div>
<!-- add modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">Add User
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('users.store') }}" method="POST">
			@csrf
			<div class="modal-body" id="mediumBody">
				<div>
					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

						<div class="col-md-6">
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="form-group row">
						<label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
						<div class="col-md-6">
							<select id="role_id" name="role_id" class="form-control @error('role') is-invalid @enderror" required>
							  <option value="" selected>Select Role</option>
							  @foreach ($roles as $role)
							  <option value="{{ $role->id }}">{{ $role->name }}</option>
							  @endforeach
							</select>
							
							@error('role_id')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-4">
							<button type="submit" class="btn btn-primary">
								{{ __('Save') }}
							</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								{{ __('Cancel') }}
							</button>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
@endsection
