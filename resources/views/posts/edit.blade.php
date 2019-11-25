@extends('adminpanel.main')

@section('content')

<div class="row justify-content-center">

	<div class="col-md-8 my-4">

		@if(Session::has('postUpdMsg'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
          {!! Session::get('postUpdMsg') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      	@endif

		<h1 class="my-4">Edit a post</h1>
		<hr>
		@include('layouts.errors')
		<form method="post" action="/update" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="hidden" name="editid" value="{{$post->id}}">
		<div class="form-group">
			<lable for="exampleInputText">Title:</lable>
			<input class="form-control" type="text" name="title" value="{{$post->title}}" id="exampleInputText">
		</div>

		<div class="form-group">
			<label for="categoryText">Category:</label>
			<select name="type" class="form-control" id="categoryText">
				<option>Choose Category</option>
				@foreach($types as $type)
				<option value="{{$type->id}}" @if($type->id == $post->type_id){{'selected'}} @endif>{{$type->name}}</option>
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
			<lable for="exampleBodyText">Body:</lable>
			<textarea name="body" class="form-control post-body" id="body" rows="5">{!!$post->body!!}</textarea>
		</div>

		<div class="form-group">
			<label for="exampleImagePlace">Choose Image:</label>
			<input type="file" name="image" class="form-control" id="exampleImagePlace" onchange="readURL(this);" multiple>
			<img src="{{$post->image}}" id="blah" style="width:150px;height:100px;">
		</div>

		<input class="btn btn-primary" type="submit" name="btnSubmit" value="Submit">
	</form>
	</div>

</div>

@endsection

@section('script')

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(document).ready(function(){
      $('.js-example-basic-multiple').select2();
      $('.js-example-basic-multiple').select2().val({{json_encode($post->tags()->allRelatedIds()->toArray())}}).trigger('change');
    })
</script>

@endsection