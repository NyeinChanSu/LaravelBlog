@extends('adminpanel.main')

@section('content')
<div class="row justify-content-center">
	
	<div class="col-md-8">

		@if(Session::has('postCreateMsg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {!! Session::get('postCreateMsg') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      	@endif
		
		<h1 class="my-4">Create a New Post</h1>
		<hr>
		@include('layouts.errors')
		<form method="post" action="/create" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group">
				<label for="titleText">Title:</label>
				<input type="text" name="title" class="form-control" id="titleText">
			</div>
			<div class="form-group">
				<label for="categoryText">Category:</label>
				<select name="type" class="form-control" id="categoryText">
					<option>Choose Category</option>
					@foreach($types as $type)
					<option value="{{$type->id}}">{{$type->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="tagText">Tags:</label>
				<select name="tags[]" class="form-control js-example-basic-multiple" id="tagText" multiple>
					<option>Choose Tags</option>
					@foreach($tags as $tag)
					<option value="{{$tag->id}}">{{$tag->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="bodyText">Body:</label>
				<textarea name="body" class="form-control" id="bodyText body" rows="5"></textarea>
			</div>
			<div class="form-group">
				<label for="imagePlace">Upload Image:</label>
				<input type="file" name="image" class="form-control" id="imagePlace" multiple>
			</div>
			<input type="submit" name="btnSubmit" class="btn btn-primary mb-4" value="Submit">

		</form>

	</div>

</div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $('.js-example-basic-multiple').select2();
    })
  </script>
@endsection