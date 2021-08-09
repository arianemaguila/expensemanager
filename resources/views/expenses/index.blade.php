@extends('layouts.main')

@section('content')
<script type="text/javascript">  
    $(function () {
    $('.datetimepicker').datetimepicker();
});   
</script> 
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Expenses</h1>
		<div class="pull-right">
			<span>User Management > Expenses</span>
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
		<table class='table table-bordered table-condensed table-striped table-hover'>
		  <tr>
			<th>Expense Category</th>
			<th>Amount</th>
			<th>Entry Date</th>
			<th>Created At</th>
			<th>Action</th>
		  </tr>
		  <body>
			@foreach($expenses as $expense)
			  <tr>
				<td>{{ $expense->expense_category->name }}</td>
				<td>{{ $expense->amount }}</td>
				<td>{{ $expense->entry_date }}</td>
				<td>{{ $expense->created_at }}</td>
				<td align="center">
					<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#editExpenseModal{{$expense->id}}">{{ __('Edit') }}</a>
				</td>
				@include('expenses.modal.edit')
			  </tr>
			@endforeach
		  </body>
		</table>
	</div>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"></h1>
		<div class="pull-right">	
			<a class="btn btn-success text-light" data-toggle="modal" id="mediumButton" data-target="#mediumModal"> Add Expense
			</a>
		</div>
	</div>
</div>

    <!-- medium modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">Add Expense
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<form action="{{ route('expenses.store') }}" method="POST">
				@csrf
                <div class="modal-body" id="mediumBody">
                    <div>
						<div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Expense Category') }}</label>
                            <div class="col-md-6">
                                <select name="expense_category_id" class="form-control" >
								  <option value="" selected>Select Expense Category</option>
								  @foreach ($expensecategories as $expensecategory)
								  <option value="{{ $expensecategory->id }}">{{ $expensecategory->name }}</option>
								  @endforeach
								</select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" />
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Entry Date') }}</label>
                            <div class="col-md-6">
                                <div class="form-group input-group date">
									<input id="entry_date" type="date" class="form-control" name="entry_date">
								</div>
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
