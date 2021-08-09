<div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">Edit User
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
			{{ method_field('patch') }}
			{{ csrf_field() }}
			<div class="modal-body" id="mediumBody">
				<div>
					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
						<div class="col-md-6">
							{!! Form::text('name', $user->name, array('class' => 'form-control')) !!}
						</div>
					</div>


					<div class="form-group row">
						<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
						<div class="col-md-6">
							{!! Form::text('email', $user->email, array('class' => 'form-control')) !!}
						</div>
					</div>
					
					<div class="form-group row">
						<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
						<div class="col-md-6">
							<select id="role_id" name="role_id" class="form-control @error('role') is-invalid @enderror" required>
							  <option value="">Select Role</option>
							  @foreach ($roles as $role)
							  <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
							  @endforeach
							</select>
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-6 offset-md-6">
							<button type="submit" class="btn btn-primary">
								{{ __('Update') }}
							</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								{{ __('Cancel') }}
							</button>
						</div>
					</div>
				</div>
			</div>
			</form>
			<form action="{{ route('users.destroy', $user->id) }}" method="post" enctype="multipart/form-data">
				{{ method_field('delete') }}
				{{ csrf_field() }}
				<div class="form-group row">
					<div class="form-group row mb-2">
					<div class="col-md-6 offset-md-6">
						<button type="submit" class="btn btn-danger ">{{ __('Delete') }}</button> 
					</div>
				</div>
				</div>
			</form>
		</div>
	</div>
</div>