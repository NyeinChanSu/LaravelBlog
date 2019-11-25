@extends('adminpanel.main')

@section('content')

<div class="row justify-content-center">

	<div class="col-md-8 my-4">

		<h1 class="my-4">Edit a comment</h1>
		<hr>
		@include('layouts.errors')
		<form method="post" action="/comupdate" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="hidden" name="comeditid" value="{{$comment->id}}">
		<div class="form-group">
			<lable for="exampleInputText">Author Name:</lable>
			<input class="form-control" type="text" name="authorname" value="@if($comment->user_id != 0){{$comment->user->name}}@endif @if($comment->member_id != 0){{$comment->member->name}}@endif" id="exampleInputText" disabled>
		</div>
		<div class="form-group">
			<lable for="exampleInputText">Author Email:</lable>
			<input class="form-control" type="text" name="authoremail" value="@if($comment->user_id != 0){{$comment->user->email}}@endif @if($comment->member_id != 0){{$comment->member->email}}@endif" id="exampleInputText" disabled>
		</div>
		<div class="form-group">
			<lable for="exampleBodyText">Comment:</lable>
			<textarea name="commentbody" class="form-control" id="body" rows="5">{!!$comment->body!!}</textarea>
		</div>
		<input class="btn btn-primary" type="submit" name="btnSave" value="Save">
	</form>
	</div>

</div>

@endsection