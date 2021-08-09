@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Roles</h1>
		<div class="pull-right">
			<span>User Management > Roles</span>
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
	
		@if(\Session::has('errorMsg'))
			<div class="alert alert-danger">
				<p>{{ \Session::get('errorMsg')}}</p>
			</div>
		@endif
		
		@if(\Session::has('success'))
			<div class="alert alert-success">
				<p>{{ \Session::get('success')}}</p>
			</div>
		@endif
	</div>
	<div class="row">
		<table id="datatable" class='table table-bordered table-condensed table-striped table-hover'>
		  <tr>
			<th>Display Name</th>
			<th>Description</th>
			<th>Created At</th>
			<th>Action</th>
		  </tr>
		  <body>
			@foreach($roles as $role)
			  <tr>
				<td>{{ $role->name }}</td>
				<td>{{ $role->description }}</td>
				<td>{{ $role->created_at }}</td>
				@if($role->id!=1)
					<td align="center">
						<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#editRoleModal{{$role->id}}">{{ __('Edit') }}</a>
					</td>
					@include('roles.modal.edit')
				@endif
			  </tr>
			@endforeach
		  </body>
		</table>
	</div>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"></h1>
		<div class="pull-right">
			<a class="btn btn-success text-light" data-toggle="modal" id="addButton" data-target="#addModal"
				data-attr="{{ route('roles.create') }}" > Add Role
			</a>
		</div>
	</div>
</div>

<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">Add Role
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('roles.store') }}" method="POST">
			@csrf
			<div class="modal-body" id="mediumBody">
				<div>
					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Display Name') }}</label>
						<div class="col-md-6">
							<input id="name" type="text" class="form-control" name="name" />
						</div>
					</div>


					<div class="form-group row">
						<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

						<div class="col-md-6">
							<input id="description" type="text" class="form-control" name="description" />
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
