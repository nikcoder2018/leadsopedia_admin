@extends('layouts.main')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <style>
        .blurry{
            filter: blur(3px);
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                    <button type="button" class="btn btn-outline-info btn-fw" data-toggle="modal" data-target="#createAdminModal"><i class="mdi mdi-account-plus"></i>Add new</button>
            </div>
        </div>
        <div class="card-body">
            <h4 class="card-title">Admin Accounts</h4>
            <div class="row">
            <div class="col-12 table-responsive">
                <table id="admins-table" class="table " width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Created</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
  </div>
@endsection

@section('modals')
<div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Create new account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-create-account" action="{{route('admins.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" >
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter confirm password" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
</div>   
<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Create new account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-edit-account" action="{{route('admins.update')}}" method="POST">
            <input type="hidden" name="id">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
</div> 
<div class="modal fade" id="changeAdminPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-change-adminpassword" action="{{route('profile.change.password')}}" method="POST">
            <input type="hidden" name="id">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label>Current Password</label>
                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Enter password">
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter password">
              </div>
              <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" class="form-control" name="new_confirm_password" id="new_confirm_password" placeholder="Enter password">
              </div> 
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('plugins_js')
<script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset('js/tooltips.js')}}"></script>
<script>
    $(document).ready(function(){
        var t = $('#admins-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "{{route('api.admin.lists')}}",
            type: "GET",
            data: {
                api_token: "{{auth()->user()->api_token}}"
            }
        },
        "aoColumns": [
            {
                "mData": "id",
                "mRender": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {"mData": "name"},
            {"mData": "email"},
            {
                "mData": "created_at",
                "mRender": function (data, type, row) {
                    return moment(row.created_at).format("MMM DD,YYYY");
                }
            },
            {
                "mData": null,
                "sWidth": "10%",
                "mRender": function(data,type,full){
                    return `
                        <a href="#" class="text-primary edit-admin" data-id="${full.id}" data-toggle="tooltip" data-placement="left" title="Edit Data"><i class="mdi mdi-pencil icon-md"></i></a>
                        <a href="#" class="text-info changepassword-admin" data-id="${full.id}" data-toggle="tooltip" data-placement="left" title="Change Password"><i class="mdi mdi-lock icon-md"></i></a>
                        <a href="#" class="text-danger delete-admin" data-id="${full.id}" data-toggle="tooltip" data-placement="left" title="Delete Data"><i class="mdi mdi-delete icon-md"></i></a>
                    `
                }
            }
        ],
            "preDrawCallback": function() {
                $('#admins-table tbody td').addClass("blurry");
            },
            "drawCallback": function() {
                $('#admins-table tbody td').addClass("blurry");
                setTimeout(function(){
                    $('#admins-table tbody td').removeClass("blurry");
                },600);
            },
            responsive: true,
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "All"]
            ],
            "iDisplayLength": 10,
            "language": {
                search: ""
            },
            "ordering": false,
            "order": [[1, "asc"]]
        });

        $('#admins-table').on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('#admins-table').on('click', '.edit-admin',async function(){
            let editAdminModal = $('#editAdminModal');
            let formEditAccount = $('#form-edit-account');
            let id = $(this).data('id');
            editAdminModal.modal('toggle');

            const user = await $.ajax({
                url: "{{route('admins.edit')}}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id
                }
            });

            formEditAccount.find('input[name=id]').val(user.id);
            formEditAccount.find('input[name=name]').val(user.name);
            formEditAccount.find('input[name=email]').val(user.email);

        });

        $('#admins-table').on('click', '.changepassword-admin',async function(){
            let changeAdminPasswordModal = $('#changeAdminPasswordModal');
            let formChangePassword = $('#form-change-password');
            let id = $(this).data('id');
            changeAdminPasswordModal.modal('toggle');

            const user = await $.ajax({
                url: "{{route('admins.edit')}}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id
                }
            });
            changeAdminPasswordModal.find('.modal-title').text(`Change Password of ${user.name}`);
            formChangePassword.find('input[name=id]').val(user.id);
        });
        
        $('#admins-table').on('click', '.delete-admin', function(){
            let id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to archive this account?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let goDelete = await $.ajax({
                        url: "{{route('admins.destroy')}}",
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id
                        }
                    });

                    if(goDelete.success){
                        Swal.fire({
                            title: "Success!",
                            text: goDelete.msg,
                            icon: "success",
                        }).then(()=>{
                            var tbody = $('#admins-table tbody');
                            tbody.find('[data-id='+goDelete.id+']').parent().parent().fadeOut(600);
                            t.ajax.reload();
                        });
                    }else{
                        Swal.fire('Failed',goDelete.msg,'error');
                    }
                    
                }
            });
        });

        $('#form-edit-account').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp){
                    if(resp.success){
                        $('#editAdminModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: resp.msg,
                            icon: 'success'
                        }).then(()=>{
                            $('#form-edit-account')[0].reset();
                            t.ajax.reload();
                        });
                    }
                },
                error: function(resp){
                    let form = $('#form-edit-account')
                    $.each(resp.responseJSON.errors, function(name, error){
                        form.find('#'+name).siblings('.invalid-feedback').remove();
                        form.find('#'+name).siblings('.valid-feedback').remove();
                        form.find('#'+name).siblings('.invalid-feedback.valid-feedback').remove();
                        form.find('#'+name).addClass('is-invalid');
                        form.find('#'+name).after(`
                            <div class="invalid-feedback">
                            ${error}
                            </div>
                        `);
                    });
                }
            });
        });

        $('#form-create-account').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp){
                    if(resp.success){
                        $('#createAdminModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: resp.msg,
                            icon: 'success'
                        }).then(()=>{
                            $('#form-create-account')[0].reset();
                            t.ajax.reload();
                        });
                    }
                },
                error: function(resp){
                    let form = $('#form-create-account')
                    $.each(resp.responseJSON.errors, function(name, error){
                        form.find('#'+name).siblings('.invalid-feedback').remove();
                        form.find('#'+name).siblings('.valid-feedback').remove();
                        form.find('#'+name).siblings('.invalid-feedback.valid-feedback').remove();
                        form.find('#'+name).addClass('is-invalid');
                        form.find('#'+name).after(`
                            <div class="invalid-feedback">
                            ${error}
                            </div>
                        `);
                    });
                }
            });
        });

        $('#form-change-adminpassword').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data:  $(this).serialize(),
                success: function(resp){
                    if(resp.success){
                    $('#changeAdminPasswordModal').modal('hide');
                    Swal.fire(
                        'Success!',
                        resp.msg,
                        'success'
                    ).then(result=>{
                        if(result){
                            location.reload();
                        }
                    });
                    }
                },
                error: function(resp){
                    let form = $('#form-change-adminpassword')
                    $.each(resp.responseJSON.errors, function(name, error){
                        form.find('#'+name).siblings('.invalid-feedback').remove();
                        form.find('#'+name).siblings('.valid-feedback').remove();
                        form.find('#'+name).siblings('.invalid-feedback.valid-feedback').remove();
                        form.find('#'+name).addClass('is-invalid');
                        form.find('#'+name).after(`
                            <div class="invalid-feedback">
                            ${error}
                            </div>
                        `);
                    });
                }
            });
        });
        $('#form-change-adminpassword').on('change keypress', 'input', function(){
            $(this).removeClass("is-invalid is-valid");
            $(this).siblings('.invalid-feedback').remove();
            $(this).siblings('.valid-feedback').remove();
        });
    });
</script>
@endsection