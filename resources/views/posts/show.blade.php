@extends('layouts.master')

@section('content')
<div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
          <h1 class="mt-4">{{$post->title}}</h1>

          <!-- Author -->
          <p class="lead">
            by
            <a href="/authors?user={{$post->user->id}}">{{$post->user->name}}</a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on {{$post->created_at->toFormattedDateString()}}</p>

          <hr>

          <!-- Preview Image -->
          <img class="img-fluid rounded" src="{{$post->image}}" alt="Get Rich">

          <hr>

          @if(Auth::check() && Auth::user()->id ==$post->user_id)
            <a href="/post/edit/{{$post->id}}" class="text-success">Edit</a>
          @endif

          <!-- Post Content -->
          <p class="lead">{!! $post->body !!}</p>

          <blockquote class="blockquote">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">Someone famous in
              <cite title="Source Title">Source Title</cite>
            </footer>
          </blockquote>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>

          <hr>

          
          @foreach($post->tags as $tag)
            <a href="/tags?tag={{$tag->id}}" class="badge badge-primary">{{$tag->name}}</a>
          @endforeach
        

          <!-- Comments Form -->
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form method="post" action="/posts/{{$post->id}}/comments">
                {{csrf_field()}}
                <div class="form-group">
                  <textarea class="form-control" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-4">Submit</button>
              </form>
              @include('layouts.errors')
            </div>
          </div>

          <!-- Single Comment -->
          @foreach($post->comments as $comment)
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">
               @if($comment->user_id != 0)
                {{$comment->user->name}}
               @endif

               @if($comment->member_id != 0)
                {{$comment->member->name}}
               @endif
                
              </h5>
              <p>{!!$comment->body!!}</p>
            </div>
            <div class="media-footer">
              <small>{{$comment->created_at->diffForHumans()}}</small>
            </div>
          </div>
          @endforeach

          <!-- Comment with nested comments -->

        </div>

        @include('layouts.sidebar')

      </div>
      <!-- /.row -->
@endsection