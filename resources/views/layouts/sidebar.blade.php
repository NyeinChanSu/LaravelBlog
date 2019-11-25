<!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <form method="get" action="/search" role="search">
              <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <input type="submit" class="btn btn-secondary" value="Go!">
                </span>
              </div>
            </form>
            </div>
          </div>

          <!-- Tags Widget -->
          <div class="card my-4">
            <h5 class="card-header">Tags</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  @foreach($tags as $tag)
                   <a href="/tags?tag={{$tag->id}}" class="badge badge-secondary">{{$tag->name}}</a>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="catlist" type="square">
                    @foreach($types as $type)
                    <li>
                    <a href="/news?type={{$type->id}}" style="text-decoration: none;">{{$type->name}}</a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>


          <!-- Comments Widget -->
          <div class="card my-4">
            <h5 class="card-header">Comments</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  @foreach($comments as $comment)
                  <div class="media comlist px-3">
                  <div class="media-body">
                    <h6 class="mt-0">
                     @if($comment->user_id != 0)
                      {{$comment->user->name}}
                     @endif

                     @if($comment->member_id != 0)
                      {{$comment->member->name}}
                     @endif
                    </h6>
                    <p><i class="fas fa-fw fa-comment"></i><a href="/posts/{{$comment->post->id}}" style="text-decoration: none;">{!!str_limit(strip_tags($comment->body),50)!!}</a></p>
                  </div>
                </div>
                @endforeach
                </div>
              </div>
            </div>
          </div>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Latest News</h5>
            <div class="card-body">
              @foreach($latests as $latest)
              <div class="row mb-4">
                <div class="col-lg-4"><a href="/posts/{{$latest->id}}" class="post-img"><img src="{{$latest->image}}" class="card-img-top" alt="news image"></a></div>
                <div class="col-lg-8"><h6><a href="/posts/{{$latest->id}}" class="post-title">{{$latest->title}}</a></h6></div>
              </div>
              @endforeach
            </div>
          </div>

        </div>