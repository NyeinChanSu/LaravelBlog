@extends('adminpanel.main')

@section('content')

<div class="row justify-content-center">
	
	<div class="col-md-12 my-5">

    @if(Session::has('postDelMsg'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {!! Session::get('postDelMsg') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              All Posts</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Category</th>
                      <th>Author</th>
                      <th>Created Date</th>
                      <th>Updated Date</th>
                      <th>Edit</th>
                      <th>Delete</th>            
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Category</th>
                      <th>Author</th>
                      <th>Created Date</th>
                      <th>Updated Date</th>
                      <th>Edit</th>
                      <th>Delete</th>           
                    </tr>
                  </tfoot>
                  <tbody>
                  	@foreach($posts as $post)
                    <tr>                
						<td>{{$post->title}}</td>
						<td>{!!str_limit(strip_tags($post->body),50)!!}</td>
						<td><img src="{{$post->image}}" class="img-responsive" style="width:120px;height:80px;"></td>
						<td>{{optional($post->type)->name}}</td>
						<td>{{$post->user->name}}</td>
						<td>{{$post->created_at->toFormattedDateString()}}</td>
						<td>{{$post->updated_at->toFormattedDateString()}}</td>
						<td>
							@if((Auth::check() && Auth::user()->id ==$post->user->id) || (Auth::check() && Auth::user()->role == 'admin'))
							<a href="/post/edit/{{$post->id}}" class="btn btn-warning btn-sm">Edit</a>
							@endif
						</td> 
						<td>
							@if((Auth::check() && Auth::user()->id ==$post->user->id) || (Auth::check() && Auth::user()->role == 'admin'))
							<a href="#" class="btn btn-danger btn-sm delete" data-toggle="modal" data-id="{{$post->id}}">Delete</a>
							@endif
						</td>              
                   </tr>  
                    @endforeach                   
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

	</div>
</div>

<div class="modal fade" id="delete" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/delete" method="post">
      <div class="modal-header">Are you sure you want to delete?</div>
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="deleteid" id="postid">
        </div>
      <div class="modal-footer">
        <input type="submit" name="btnsubmit" class="btn btn-success" value="Yes">
        <button class="btn btn-default close" data-dismiss="modal">No</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#dataTable').on('click','.delete',function(){
        var id=$(this).data('id');
        $('#postid').val(id);
        $('#delete').modal('show');
      })
    })
  </script>
@endsection