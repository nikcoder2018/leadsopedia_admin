@extends('layouts.app')

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
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
                    <button type="button" class="btn btn-outline-primary btn-fw"><i class="mdi mdi-download"></i>Export</button>
                    <button type="button" class="btn btn-outline-success btn-fw"><i class="mdi mdi-printer"></i>Print</button>
            </div>
        </div>
        <div class="card-body">
            <h4 class="card-title">All Leads Data</h4>
            <div class="row">
                <div class="col-12">
                    <table id="leads-table" class="table table-responsive" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Category</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th>Address</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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
          <h5 class="modal-title" id="exampleModalLabel-2">Import Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-import-data" action="{{route('api.leads-import')}}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="file" name="file" class="dropify" />
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow=""
                aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                0%
                </div>
            </div>
            <div id="success">

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
<script src="{{asset('vendors/dropify/dropify.min.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset('js/tooltips.js')}}"></script>
<script>
$(document).ready(function(){
    var t = $('#leads-table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
            url: "{{route('api.leads')}}",
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
        {"mData": "first_name"},
        {"mData": "last_name"},
        {"mData": "title"},
        {"mData": "company_name"},
        {"mData": "category"},
        {
            "mData": "email",
            "mRender": function (data, type, row) {
                return `
                    <a href="#" data-toggle="tooltip" data-placement="left" title="${data}"><i class="mdi mdi-email icon-md"></i></a>
                `;
            }
        },
        {
            "mData": "phone",
            "mRender": function (data, type, row) {
                return `
                    <a href="#" data-toggle="tooltip" data-placement="left" title="${data}"><i class="mdi mdi-cellphone-android icon-md"></i></a>
                `;
            }
        },
        {
            "mData": "website",
            "mRender": function (data, type, row) {
                return `
                    <a href="#" data-toggle="tooltip" data-placement="left" title="${data}"><i class="mdi mdi-web icon-md"></i></a>
                `;
            }
        },
        {
            "mData": "address",
            "mRender": function (data, type, full) {
                return `
                    <a href="#" data-toggle="tooltip" data-placement="left" title="${full.address},${full.city},${full.country}"><i class="mdi mdi-map-marker icon-md"></i></a>
                `;
            }
        },
        {
            "mData": null,
            "sWidth": "10%",
            "mRender": function(data,type,full){
                return `
                    <a href="#" class="text-primary edit-data" data-id="${full._id}" data-toggle="tooltip" data-placement="left" title="Edit Data"><i class="mdi mdi-pencil icon-md"></i></a>
                    <a href="#" class="text-danger delete-data" data-id="${full._id}" data-toggle="tooltip" data-placement="left" title="Delete Data"><i class="mdi mdi-delete icon-md"></i></a>
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
    
    $('#leads-table').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');


    });

    $('#leads-table').on('draw.dt', function () {
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
            beforeSend:function(){
                $('#success').empty();
            },
            uploadProgress:function(event, position, total, percentComplete){
                $('.progress-bar').text(percentComplete + '%');
                $('.progress-bar').css('width', percentComplete + '%');
            },
            success:function(data){
                if(!data.success){
                    $('.progress-bar').text('0%');
                    $('.progress-bar').css('width', '0%');
                    $('#success').html('<span class="text-danger"><b>'+data.msg+'</b></span>');
                }else{
                    $('.progress-bar').text('Uploaded');
                    $('.progress-bar').css('width', '100%');
                    $('#success').html('<span class="text-success"><b>'+data.msg+'</b></span><br /><br />');
                }
            }
        })
    });

    $('#leads-table').on('click','.delete-data', function(){
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
                    url: "{{route('leads.delete')}}",
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