@extends('layouts.master')

@section('content')
<div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          @foreach($tagrow as $tag)
            <h1 class="my-4">{{$tag->name}}</h1>
          @endforeach
          

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
              @endif
            </div>
          </div>
          </div>
          @endforeach
          </div>

          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            {{$posts->links()}}
          </ul>

        </div>

        @include('layouts.sidebar')

      </div>
      <!-- /.row -->
@endsection