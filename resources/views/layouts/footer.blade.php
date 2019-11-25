<!-- Footer -->
    <footer class="bg-footer">
      <div class="footer-bottom-area">
      	<div class="container">
      		<div class="row">
      			<div class="col-md-4">
      				<h4>About Bloggie News</h4>
      				<p>Maecenas mauris elementum, est morbi interdum cursus at elite imperdiet libero. Proin odios dapibus integer an nulla augue pharetra cursus.</p>
      				<p>
      					<ul class="social-links list-unstyled">
      						<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
      						<li><a href="#"><i class="fab fa-twitter"></i></a></li>
      						<li><a href="#"><i class="fab fa-fw fa-google-plus"></i></a></li>
      						<li><a href="#"><i class="fab fa-fw fa-instagram"></i></a></li>
      					</ul>
      				</p>
      			</div>
      			<div class="col-md-4">
      				<h4>Quick Links</h4>
      				<ul class="list-unstyled">
	      				@foreach($types as $type)
			            <li>
			              <a href="/news?type={{$type->id}}">{{$type->name}}</a>
			            </li>
			            @endforeach
		       		</ul>
      				
      			</div>
      			<div class="col-md-4">
      				<h4>Latest News</h4>
      				<ul class="custom-list">
      					@foreach($latests as $latest)
      					<li><a href="/posts/{{$latest->id}}">{{$latest->title}}</a></li>
      					@endforeach
      				</ul>
      			</div>
      		</div>
      </div>
  	  </div>
  	  <div class="copyright-area">
      <div class="container">
      	<div class="row">
      		<div class="col-md-12">
      			<p class="m-0 text-center">Copyright &copy; <span style="color:#F70D28;">bloggienews</span> 2018</p>
      		</div>
      	</div>
      </div>
  	  </div>
      <!-- /.container -->
    </footer>