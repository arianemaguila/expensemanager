<div class="modal fade" id="editExpenseModal{{$expense->id}}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">Edit Expense
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('expenses.update', $expense->id) }}" method="post" enctype="multipart/form-data">
			{{ method_field('patch') }}
			{{ csrf_field() }}
			<div class="modal-body" id="mediumBody">
				<div>
					<div class="form-group row">
						<label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Expense Category') }}</label>
						<div class="col-md-6">
							<select id="expense_category_id" name="expense_category_id" class="form-control @error('expense_category_id') is-invalid @enderror" required>
							  <option value="">Select Expense Category</option>
							  @foreach ($expensecategories as $expensecategory)
							  <option value="{{ $expensecategory->id }}" {{ $expense->expense_category_id == $expensecategory->id ? 'selected="selected"' : '' }}>{{ $expensecategory->name }}</option>
							  @endforeach
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
						<div class="col-md-6">
							{!! Form::text('amount', $expense->amount, array('class' => 'form-control')) !!}
						</div>
					</div>
					
					<div class="form-group row">
						<label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Entry Date') }}</label>
						<div class="col-md-6">
							{!! Form::date('entry_date', $expense->entry_date, array('class' => 'form-control')) !!}
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
			<form action="{{ route('expenses.destroy', $expense->id) }}" method="post" enctype="multipart/form-data">
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