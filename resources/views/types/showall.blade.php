@extends('adminpanel.main')

@section('content')

<div class="row justify-content-center">
	
	<div class="col-md-12 my-5">

    @if(Session::has('typeUpdateMsg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {!! Session::get('typeUpdateMsg') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    @if(Session::has('typeDeleteMsg'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {!! Session::get('typeDeleteMsg') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              All Categories</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      @if(Auth::check() && Auth::user()->role == 'admin')
                      <th>Edit</th>
                      <th>Delete</th> 
                      @endif           
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      @if(Auth::check() && Auth::user()->role == 'admin')
                      <th>Edit</th>
                      <th>Delete</th> 
                      @endif           
                    </tr>
                  </tfoot>
                  <tbody>
                  	@foreach($types as $type)
                    <tr>                
						<td>{{$type->name}}</td>
            @if(Auth::check() && Auth::user()->role == 'admin')
						<td><a href="#" class="btn btn-warning btn-sm edit" data-toggle="modal" data-id="{{$type->id}}" data-name="{{$type->name}}">Edit</a></td> 
						<td><a href="#" class="btn btn-danger btn-sm delete" data-toggle="modal" data-id="{{$type->id}}">Delete</a></td> 
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
      <form action="/typeEdit" method="post">
      <div class="modal-header">Edit Category</div>
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="editid" id="catid">

          <div class="form-group">
          	<label>Category Name:</label>
          	<input type="text" class="form-control" name="typename" id="catname">
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
      <form action="/typeDelete" method="post">
      <div class="modal-header">Are you sure you want to delete?</div>
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="deleteid" id="typeid">
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
      	$('#catid').val(id);
      	$('#catname').val(name);

      	$('#edit').modal('show');
      })

      $('#dataTable').on('click','.delete',function(){
        var id=$(this).data('id');
        $('#typeid').val(id);
        $('#delete').modal('show');
      })
    })
  </script>
@endsection