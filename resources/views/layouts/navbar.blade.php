<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-nav fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/"><strong>Bloggie News</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            @foreach($types as $type)
            <li class="nav-item">
              <a class="nav-link" href="/news?type={{$type->id}}">{{$type->name}}</a>
            </li>
            @endforeach
            
            @if(Auth::check())
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/homeLogout">Logout</a>
              </div>
            </li>
            @elseif(Auth::guard('member')->user())
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{Auth::guard('member')->user()->name}}</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/memberlogout">Logout</a>
              </div>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="/member/create"><i class="fas fa-fw fa-user"></i>Register</a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>