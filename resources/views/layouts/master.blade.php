<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bloggie News - Standard News Site</title>

    <!-- Custom fonts for this template-->
    <link href="/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/blog-home.css" rel="stylesheet">

  </head>

  <body>

    @include('layouts.navbar')

    <!-- Page Content -->
    <div class="content">
    <div class="container">

      @yield('content')

    </div>
    <!-- /.container -->
    </div>

    @include('layouts.footer')

    <!-- Bootstrap core JavaScript -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">CKEDITOR.replace('body');</script>

    @yield('script')

  </body>

</html>
