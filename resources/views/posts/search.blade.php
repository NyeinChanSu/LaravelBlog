@extends('layouts.master')

@section('content')

<div class="row">

<div class="col-md-9">
	@if(count($articles) >= 1)
    @foreach($articles as $article)
      <div class="card my-5">
      	<div class="card-body">
          <div class="row">
          <div class="col-md-5">
      		  <a href="/posts/{{$article->id}}" class="post-img"><img src="{{$article->image}}" class="card-img-top mb-3" alt="Post Image"></a>
          </div>
          <div class="col-md-7">
      		  <h2 class="card-title"><a href="/posts/{{$article->id}}" class="post-title">{{$article->title}}</a></h2>
      		  <p class="card-text">{!!str_limit(strip_tags($article->body),200)!!}</p>
          </div>
        </div>
      	</div> 
      	<div class="card-footer text-muted text">
      		Posted on {{$article->created_at->toFormattedDateString()}} by
      		<a href="/authors?user={{$article->user->id}}">{{$article->user->name}}</a>
      	</div>
      </div>
    @endforeach
    @else
    <p class="my-5"><h4>No results found...</h4></p>
    @endif
    <!-- Pagination -->
  <ul class="pagination justify-content-center mb-4">
    {{$articles->links()}}
  </ul>

</div>


</div>

@endsection