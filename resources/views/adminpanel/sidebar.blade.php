<!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        @if(Auth::check() && Auth::user()->role == 'admin')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Categories</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
            <a class="dropdown-item" href="/type/showall">All Categories</a>
            <a class="dropdown-item" href="/type/create">Add New Category</a>
          </div>
        </li>
        @endif
         @if(Auth::check() && Auth::user()->role == 'admin')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="tagsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Tags</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="tagsDropdown">
            <a class="dropdown-item" href="/tag/showall">All Tags</a>
            <a class="dropdown-item" href="/tag/index">Add New Tag</a>
          </div>
        </li>
        @endif
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="postsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-thumbtack"></i>
            <span>Posts</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="postsDropdown">
            <a class="dropdown-item" href="/post/showall">All Posts</a>
            <a class="dropdown-item" href="/post/create">Add New Post</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/comment/showall">
            <i class="fas fa-fw fa-comments"></i>
            <span>Comments</span></a>
        </li>
        @if(Auth::check() && Auth::user()->role == 'admin')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
          <div class="dropdown-menu" aria-labelledby="usersDropdown">
            <a class="dropdown-item" href="/user/showall">All Users</a>
            <a class="dropdown-item" href="/user/create">Add New User</a>
          </div>
        </li>
        @endif
        @if(Auth::check() && Auth::user()->role == 'editor')
        <li class="nav-item">
          <a class="nav-link" href="/user/edit/{{Auth::user()->id}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
        </li>
        @endif
      </ul>