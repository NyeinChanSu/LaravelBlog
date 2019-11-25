@extends('adminpanel.main')

@section('content')

<div class="row justify-content-center">
	
	<div class="col-md-12 my-5">

    @if(Session::has('tagUpdateMsg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {!! Session::get('tagUpdateMsg') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    @if(Session::has('tagDeleteMsg'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {!! Session::get('tagDeleteMsg') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              All Tags</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Number of Posts</th>
                      @if(Auth::check() && Auth::user()->role == 'admin')
                      <th>Edit</th>
                      <th>Delete</th> 
                      @endif           
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Number of Posts</th>
                      @if(Auth::check() && Auth::user()->role == 'admin')
                      <th>Edit</th>
                      <th>Delete</th> 
                      @endif           
                    </tr>
                  </tfoot>
                  <tbody>
                  	@foreach($tags as $tag)
                    <tr>                
						<td>{{$tag->name}}</td>
            <td>{{$tag->posts->count()}}</td>
            @if(Auth::check() && Auth::user()->role == 'admin')
						<td><a href="#" class="btn btn-warning btn-sm edit" data-toggle="modal" data-id="{{$tag->id}}" data-name="{{$tag->name}}">Edit</a></td> 
						<td><a href="#" class="btn btn-danger btn-sm delete" data-toggle="modal" data-id="{{$tag->id}}">Delete</a></td> 
            @endif             
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


<div class="modal fade" id="edit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/tagEdit" method="post">
      <div class="modal-header">Edit Tag</div>
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="editid" id="tagid">

          <div class="form-group">
          	<label>Tag Name:</label>
          	<input type="text" class="form-control" name="tagName" id="tagname">
          </div>

        </div>
      <div class="modal-footer">
        <input type="submit" name="btnsave" class="btn btn-success" value="Save">
        <button class="btn btn-default close" data-dismiss="modal">No</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="delete" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/tagDelete" method="post">
      <div class="modal-header">Are you sure you want to delete?</div>
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="deleteid" id="tagdelid">
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

      $('#dataTable').on('click','.edit',function(){
      	var id=$(this).data('id');
      	var name =$(this).data('name');
      	$('#tagid').val(id);
      	$('#tagname').val(name);

      	$('#edit').modal('show');
      })

      $('#dataTable').on('click','.delete',function(){
        var id=$(this).data('id');
        $('#tagdelid').val(id);
        $('#delete').modal('show');
      })
    })
  </script>
@endsection