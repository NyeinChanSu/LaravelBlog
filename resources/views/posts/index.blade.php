@extends('layouts.master')

@section('content')

          @if(Session::has('successmsg'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
              {!! Session::get('successmsg') !!}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

<div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <h1 class="my-4">Top News</h1>
          
          <div class="row">
          <!-- Blog Post --> 
          @foreach($topnews as $topnew)
          <div class="col-md-7">
          <div class="card mb-4">
            <a href="/posts/{{$topnew->id}}" class="post-img"><img class="card-img-top news-imgsize" src="{{$topnew->image}}" alt="Card image cap"></a>
            <div class="card-body">
              <h2 class="card-title"><a href="/posts/{{$topnew->id}}" class="post-title">{{$topnew->title}}</a></h2>
              <p class="card-text">{!! str_limit(strip_tags($topnew->body),100) !!}</p>
              <a href="/posts/{{$topnew->id}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on {{$topnew->created_at->toFormattedDateString()}} by
              <a href="/authors?user={{$topnew->user->id}}">{{ $topnew->user->name }}</a>
            </div>
          </div>
          </div>
         @endforeach

         @foreach($rtopnews as $rtopnew)
          <div class="col-md-5">
          <div class="card mb-4">
            <a href="/posts/{{$rtopnew->id}}" class="post-img"><img class="card-img-top news-imgsize" src="{{$rtopnew->image}}" alt="Card image cap"></a>
            <div class="card-body">
              <h2 class="card-title"><a href="/posts/{{$rtopnew->id}}" class="post-title">{{$rtopnew->title}}</a></h2>
            </div>
            <div class="card-footer text-muted">
              Posted on {{$rtopnew->created_at->toFormattedDateString()}} by
              <a href="/authors?user={{$rtopnew->user->id}}">{{ $rtopnew->user->name }}</a>
            </div>
          </div>
          </div>
          @endforeach
          </div>

          <h1 class="my-4">Trend News</h1>

          <!-- Blog Post -->
          <div class="row">
          @foreach($trendnews as $trendnew)
          
          <div class="col-md-6">
          <div class="card mb-4">
            <a href="/posts/{{$trendnew->id}}" class="post-img"><img class="card-img-top news-imgsize" src="{{$trendnew->image}}" alt="Card image cap"></a>
            <div class="card-body">
              <h2 class="card-title"><a href="/posts/{{$trendnew->id}}" class="post-title">{{$trendnew->title}}</a></h2>
              <p class="card-text">{!! str_limit(strip_tags($trendnew->body),100) !!}</p>
              <a href="/posts/{{$trendnew->id}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on {{$trendnew->created_at->toFormattedDateString()}} by
              <a href="/authors?user={{$trendnew->user->id}}">{{ $trendnew->user->name }}</a>
              @if(Auth::check() && Auth::user()->id ==$trendnew->user_id)
              <a href="/post/edit/{{$trendnew->id}}" class="td-none mx-1 text-warning">Edit</a>
              @endif
            </div>
          </div>
          </div>
          @endforeach
          </div>

          <h1 class="my-4">Popular News</h1>

          <!-- Blog Post -->
          <div class="row">
          @foreach($popnews as $popnew)
          
          <div class="col-md-6">
          <div class="card mb-4">
            <a href="/posts/{{$popnew->id}}" class="post-img"><img class="card-img-top news-imgsize" src="{{$popnew->image}}" alt="Card image cap"></a>
            <div class="card-body">
              <h2 class="card-title"><a href="/posts/{{$popnew->id}}" class="post-title">{{$popnew->title}}</a></h2>
              <p class="card-text">{!! str_limit(strip_tags($popnew->body),100) !!}</p>
              <a href="/posts/{{$popnew->id}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on {{$popnew->created_at->toFormattedDateString()}} by
              <a href="/authors?user={{$popnew->user->id}}">{{ $popnew->user->name }}</a>
              @if(Auth::check() && Auth::user()->id ==$popnew->user_id)
              <a href="/post/edit/{{$popnew->id}}" class="td-none mx-1 text-warning">Edit</a>
              @endif
            </div>
          </div>
          </div>
          @endforeach
          </div>

          <h1 class="my-4">Latest News</h1>
          
          <!-- Blog Post -->
          <div class="row">
          @foreach($posts as $post)
          
          <div class="col-md-6">
          <div class="card mb-4">
            <a href="/posts/{{$post->id}}" class="post-img"><img class="card-img-top news-imgsize" src="{{$post->image}}" alt="Card image cap"></a>
            <div class="card-body">
              <h2 class="card-title"><a href="/posts/{{$post->id}}" class="post-title">{{$post->title}}</a></h2>
              <p class="card-text">{!! str_limit(strip_tags($post->body),100) !!}</p>
              <a href="/posts/{{$post->id}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on {{$post->created_at->toFormattedDateString()}} by
              <a href="/authors?user={{$post->user->id}}">{{ $post->user->name }}</a>
              @if(Auth::check() && Auth::user()->id ==$post->user_id)
              <a href="/post/edit/{{$post->id}}" class="td-none mx-1 text-warning">Edit</a>
              <!-- <form method="post" action="{{ action('PostsController@destroy', $post->id) }}" style="display: inline-block;">
                {{csrf_field()}}
              <input type="submit" class="custom-link" value="Delete">
              </form> -->
              @endif
            </div>
          </div>
          </div>
          @endforeach
          </div>

        </div>

        @include('layouts.sidebar')

      </div>
      <!-- /.row -->
@endsection