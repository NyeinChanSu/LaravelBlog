@extends('adminpanel.main')

@section('content')

<div class="row justify-content-center">
	
	<div class="col-md-8 my-5">

		@if(Session::has('tagCreateMsg'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
          {!! Session::get('tagCreateMsg') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      	@endif
		
		<div class="card">
		<div class="card-header"><h3>Create a New Tag</h3></div>

		<form method="post" action="/tagCreate">
		{{csrf_field()}}
		<div class="card-body">
			<div class="form-group">
				<label for="exampleTagName">Tag Name:</label>
				<input type="text" name="tagName" class="form-control" id="exampleTagName">
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary">
		</div>
		</form>
		</div>
	</div>
</div>

@endsection