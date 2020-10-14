@extends('layouts.app')
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
                    <button type="button" class="btn btn-outline-info btn-fw" data-toggle="modal" data-target="#addNewAdminModal"><i class="mdi mdi-account-plus"></i>Add new</button>
            </div>
        </div>
        <div class="card-body">
            <h4 class="card-title">Admin Accounts</h4>
            <div class="row">
            <div class="col-12 table-responsive">
                <table id="customers-table" class="table " width="100%">
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

@section('plugins_js')
<script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset('js/tooltips.js')}}"></script>
<script>
    $(document).ready(function(){
        var t = $('#customers-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "{{route('customer.lists')}}",
            type: "GET",
            data: {
                api_token: 2432424252
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
            {"mData": "created_at"},
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
                $('#customers-table tbody td').addClass("blurry");
            },
            "drawCallback": function() {
                $('#customers-table tbody td').addClass("blurry");
                setTimeout(function(){
                    $('#customers-table tbody td').removeClass("blurry");
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

        $('#customers-table').on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });
</script>
@endsection