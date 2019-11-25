@extends('adminpanel.main')

@section('content')

<div class="row justify-content-center">
	
	<div class="col-md-12 my-5">

    @if(Session::has('commentUpdMsg'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {!! Session::get('commentUpdMsg') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if(Session::has('commentDelMsg'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {!! Session::get('commentDelMsg') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              All Comments</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Author</th>
                      <th>Comment</th>
                      <th>In Response To</th>
                      <th>Submitted On</th>
                      <th>Updated On</th>
                      <th>Edit</th>
                      <th>Delete</th>            
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Author</th>
                      <th>Comment</th>
                      <th>In Response To</th>
                      <th>Submitted On</th>
                      <th>Updated On</th>
                      <th>Edit</th>
                      <th>Delete</th>            
                    </tr>
                  </tfoot>
                  <tbody>
                  	@foreach($comments as $comment)
                    <tr>                
          						<td>
                        @if($comment->user_id != 0)
                          {{$comment->user->name}}
                        @endif

                        @if($comment->member_id != 0)
                          {{$comment->member->name}}
                        @endif
                        <p>
                          <small class="text-primary">
                            @if($comment->user_id != 0)
                              {{$comment->user->email}}
                            @endif

                            @if($comment->member_id != 0)
                              {{$comment->member->email}}
                            @endif
                        </small>
                      </p>
                      </td>
                      <td>{!!str_limit(strip_tags($comment->body),50)!!}</td>
                      <td>{{$comment->post->title}}</td>
                      <td>{{$comment->created_at->toFormattedDateString()}}</td>
                      <td>{{$comment->updated_at->toFormattedDateString()}}</td>
          						<td>
                        @if((Auth::check() && Auth::user()->id ==$comment->user_id) || (Auth::check() && Auth::user()->role == 'admin'))
                        <a href="/comment/edit/{{$comment->id}}" class="btn btn-warning btn-sm">Edit</a>
                        @endif
                      </td> 
          						<td>
                        @if((Auth::check() && Auth::user()->id ==$comment->user_id) || (Auth::check() && Auth::user()->role == 'admin'))
                        <a href="#" class="btn btn-danger btn-sm delete" data-toggle="modal" data-id="{{$comment->id}}">Delete</a>
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
      <form action="/commentDelete" method="post">
      <div class="modal-header">Are you sure you want to delete?</div>
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="deleteid" id="commentid">
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
        $('#commentid').val(id);
        $('#delete').modal('show');
      })
    })
  </script>
@endsection