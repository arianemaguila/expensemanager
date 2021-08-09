@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"></h1>
		<div class="pull-right">
			<span>Update Password</span>
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
	</div>
	<div class="row">
		<form action="{{ route('users.updatepassword') }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="modal-body" id="mediumBody">
			<div>
				<div class="form-group row">
					<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

					<div class="col-md-8">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

					<div class="col-md-8">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					</div>
				</div>

				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-6">
						<button type="submit" class="btn btn-primary">
							{{ __('Update Password') }}
						</button>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
@endsection