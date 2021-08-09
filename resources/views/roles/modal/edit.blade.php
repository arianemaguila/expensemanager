<div class="modal fade" id="editRoleModal{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">Edit Role
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
			{{ method_field('patch') }}
			{{ csrf_field() }}
			<div class="modal-body" id="mediumBody">
				<div>
					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
						<div class="col-md-6">
							{!! Form::text('name', $role->name, array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
						<div class="col-md-6">
							{!! Form::text('description', $role->description, array('class' => 'form-control')) !!}
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
			<form action="{{ route('roles.destroy', $role->id) }}" method="post" enctype="multipart/form-data">
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