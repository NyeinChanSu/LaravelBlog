@extends('adminpanel.main')

@section('content')

<div class="row justify-content-center">
	
	<div class="col-md-12 my-5">

    @if(Session::has('userCreateMsg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {!! Session::get('userCreateMsg') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    @if(Session::has('userDeleteMsg'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {!! Session::get('userDeleteMsg') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

		<!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Users</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>User Role</th>
                      <th>Posts</th>
                      <th>Edit</th>
                      <th>Delete</th>            
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>User Role</th>
                      <th>Posts</th>
                      <th>Edit</th>
                      <th>Delete</th>            
                    </tr>
                  </tfoot>
                  <tbody>
                  	@foreach($users as $user)
                    <tr>                
          						<td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{strtoupper($user->role)}}</td>
                      <td>{{$user->posts->count()}}</td>
          						<td>
                        @if((Auth::check() && Auth::user()->id ==$user->id) || (Auth::check() && Auth::user()->role == 'admin'))
                        <a href="/user/edit/{{$user->id}}" class="btn btn-warning btn-sm">Edit</a>
                        @endif
                      </td> 
          						<td>
                        @if((Auth::check() && Auth::user()->id ==$user->id) || (Auth::check() && Auth::user()->role == 'admin'))
                        <a href="#" class="btn btn-danger btn-sm delete" data-toggle="modal" data-id="{{$user->id}}">Delete</a>
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
      <form action="/userDelete" method="post">
      <div class="modal-header">Are you sure you want to delete?</div>
        {{csrf_field()}}
        <div class="modal-body">
          <input type="hidden" name="deleteid" id="userid">
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
        $('#userid').val(id);
        $('#delete').modal('show');
      })
    })
  </script>
@endsection