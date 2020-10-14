@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/dropify/dropify.min.css')}}">
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
                    <button type="button" class="btn btn-outline-info btn-fw" data-toggle="modal" data-target="#importDataModal"><i class="mdi mdi-upload"></i>Import</button>
                    <button type="button" class="btn btn-outline-primary btn-fw" data-toggle="modal" data-target="#addCategoryModal"><i class="mdi mdi-plus"></i>Add</button>
            </div>
        </div>
        <div class="card-body">
            <h4 class="card-title">All Categories</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="categories-table" class="table" width="100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select_all" value="1" id="select-all"></th>
                                    <th>Category Name</th>
                                    <th>Category ID</th>
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
  </div>
@endsection

@section('modals')
<div class="modal fade" id="importDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Import Categories</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-import-data" action="{{route('categories.import')}}" method="POST">
            @csrf
            <div class="modal-body">
                <p>Supported File Format : CSV</p>
                <input type="file" name="file" class="dropify" />
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-add-category" action="{{route('categories.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Category ID</label>
                            <input type="text" name="cat_id" class="form-control">
                        </div>
                    </div>
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
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-edit-category" action="{{route('categories.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Category ID</label>
                            <input type="text" name="cat_id" class="form-control">
                        </div>
                    </div>
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
<script src="{{asset('https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/dropify/dropify.min.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset('js/tooltips.js')}}"></script>
<script>
$(document).ready(function(){
    var t = $('#categories-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{route('api.categories')}}",
        "aoColumns": [
            {
                "mData": "id",
                "mTargets": 0,
                "mRender": function (data, type, row, meta) {
                    return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                }
            },
            {"mData": "name"},
            {"mData": "cat_id"},
            {
                "mData": null,
                "sWidth": "10%",
                "mRender": function(data,type,full){
                    return `
                        <a href="#" class="text-primary edit-data" data-id="${full.id}" data-toggle="tooltip" data-placement="left" title="Edit Data"><i class="mdi mdi-pencil icon-md"></i></a>
                        <a href="#" class="text-danger delete-data" data-id="${full.id}" data-toggle="tooltip" data-placement="left" title="Delete Data"><i class="mdi mdi-delete icon-md"></i></a>
                    `
                }
            }
        ],
        "preDrawCallback": function() {
            $('#leads-table tbody td').addClass("blurry");
        },
        "drawCallback": function() {
            $('#leads-table tbody td').addClass("blurry");
            setTimeout(function(){
                $('#leads-table tbody td').removeClass("blurry");
            },600);
        },
        responsive: true,
        lengthMenu: [
            [5, 10, 15, -1],
            [5, 10, 15, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
            search: ""
        },
        "ordering": false,
        "order": [[1, "asc"]],
        
    });

    $('#categories-table').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });

    $('#categories-table').on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#form-import-data').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#form-import-data').find('button[type=submit]').prop('disabled', true);
            },
            success:function(resp){
                if(resp.success){
                    Swal.fire(
                        'Success!',
                        resp.msg,
                        'success'
                    ).then(result=>{
                        if(result){
                            $('#importDataModal').modal('hide');
                            t.ajax.reload();
                        }
                    });
                }else{
                    Swal.fire(
                        'Failed!',
                        resp.msg,
                        'error'
                    );
                    $('#form-import-data').find('button[type=submit]').prop('disabled', false);
                }
            }
        })
    });

    $('#form-add-category').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: $(this).serialize(),
            success: function(resp){
                if(resp.success){
                    Swal.fire(
                        'Success!',
                        resp.msg,
                        'success'
                    ).then(result=>{
                        if(result){
                            $('#addCategoryModal').modal('hide');
                            t.ajax.reload();
                        }
                    });
                }else{
                    Swal.fire(
                        'Failed!',
                        resp.msg,
                        'error'
                    )
                }
            }
        });
    });

    // Handle click on "Select all" control
    $('#select-all').on('click', function(){
        // Get all rows with search applied
        var rows = t.rows({ 'search': 'applied' }).nodes();
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        $('#categories-table_filter').prepend('<button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete all</button>');
    });

    $('#categories-table').on('click','.edit-data', async function(){
        let edit_modal = $('#editCategoryModal');
           let form = edit_modal.find('form');
           let id = $(this).data().id;
           edit_modal.modal();
           const category = await $.ajax({
               url: "{{ route('categories.edit') }}",
               type: 'POST',
               data: {
                   _token: "{{ csrf_token() }}",
                   id
               }
           });

           form.find('input[name=id]').val(category.id);
           form.find('input[name=name]').val(category.name);
           form.find('input[name=cat_id]').val(category.cat_id);
    });

    $('#form-edit-category').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                if(resp.success){
                    Swal.fire(
                        'Success!',
                        resp.msg,
                        'success'
                    ).then(result=>{
                        if(result){
                            $('#editCategoryModal').modal('hide');
                            t.ajax.reload();
                        }
                    });
                }else{
                    Swal.fire(
                        'Failed!',
                        resp.msg,
                        'error'
                    )
                }
            }
        })
     }); 

    $('#categories-table').on('click','.delete-data', function(){
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                const deleteData = await $.ajax({
                    url: "{{route('categories.destroy')}}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id
                    }
                });
                
                if(deleteData.success){
                    Swal.fire(
                        'Deleted!',
                        deleteData.msg,
                        'success'
                    ).then(result=>{
                        if(result){
                            t.ajax.reload();
                        }
                    });
                }
            }
        })
    });
});
</script>
<script src="{{asset('js/dropify.js')}}"></script>
@endsection