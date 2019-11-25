@extends('adminpanel.main')

@section('content')

<div class="row justify-content-center">

	<div class="col-md-8 my-4">

		@if(Session::has('userUpdMsg'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
          {!! Session::get('userUpdMsg') !!}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      	@endif
		
		<h1 class="my-4">Edit a profile</h1>
		<hr>
		@include('layouts.errors')
		<form method="post" action="/userUpdate" enctype="multipart/form-data">
		{{csrf_field()}}
		<input type="hidden" name="userid" value="{{$user->id}}">
		<div class="form-group">
			<lable for="name">Name:</lable>
			<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>
			
			@if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
		</div>
		<div class="form-group">
			<lable for="email">Email:</lable>
			<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

			@if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
		</div>
		<div class="form-group">
			<lable for="password">New Password:</lable>
			<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
			
			@if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
		</div>
		<div class="form-group">
			<lable for="password-confirm">Confirm Password:</lable>
			<input id="password-confirm" type="password" class="form-control" name="password_confirmation">
		</div>
		<input class="btn btn-primary" type="submit" name="btnSave" value="Save">
	</form>
	</div>

</div>

@endsection