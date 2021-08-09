@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Expense Categories</h1>
		<div class="pull-right">
			<span>Expense Management > Expense Categories</span>
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
		<table class='table table-bordered table-condensed table-striped table-hover'>
		  <tr>
			<th>Display Name</th>
			<th>Description</th>
			<th>Created At</th>
			<th>Action</th>
		  </tr>
		  <body>
			@foreach($expensecategories as $expensecategory)
			  <tr>
				<td>{{ $expensecategory->name }}</td>
				<td>{{ $expensecategory->description }}</td>
				<td>{{ $expensecategory->created_at }}</td>
				<td align="center">
					<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#editExpenseCategoryModal{{$expensecategory->id}}">{{ __('Edit') }}</a>
				</td>
				@include('expensecategories.modal.edit')
			  </tr>
			@endforeach
		  </body>
		</table>
	</div>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"></h1>
		<div class="pull-right">
			<a class="btn btn-success text-light" data-toggle="modal" id="addButton" data-target="#addModal"> Add Expense Category</a>
		</div>
	</div>
</div>

	<!-- edit modal -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">Edit Expense Category
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<form action="{{ route('expensecategories.store') }}" method="POST">
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

    <!-- add modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">Add Expense Category
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<form action="{{ route('expensecategories.store') }}" method="POST">
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
<script>
        // display a modal (small modal)
        $(document).on('click', '#editButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        // display a modal (medium modal)
        $(document).on('click', '#addButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

    </script>
@endsection
