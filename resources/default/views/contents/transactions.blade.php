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
                    <button type="button" class="btn btn-outline-primary btn-fw"><i class="mdi mdi-download"></i>Export</button>
                    <button type="button" class="btn btn-outline-success btn-fw"><i class="mdi mdi-printer"></i>Print</button>
            </div>
        </div>
        <div class="card-body">
            <h4 class="card-title">All Transactions</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="transactions-table" class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice #</th>
                                    <th>Customer</th>
                                    <th>Payment Method</th>
                                    <th>Subscription</th>
                                    <th>Purchased Price</th>
                                    <th>Status</th>
                                    <th>Date</th>
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


@section('plugins_js')
<script src="{{asset('vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset('js/tooltips.js')}}"></script>
<script>
$(document).ready(function(){
    var t = $('#transactions-table').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
            url: "{{route('api.transactions.lists')}}",
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
        {"mData": "invoice_number"},
        {
            "mData": "customer",
            "mRender": function (data, type, row) {
                return row.customer.name;
            }
        },
        {
            "mData": "payment_method",
            "mRender": function(data, type, row){
                return row.method.name
            }
        },
        {
            "mData": "subscription_id",
            "mRender": function (data, type, row) {
                return row.subscription.title;
            }
        },
        {
            "mData": "amount",
            "mRender": function (data, type, row) {
                return `${row.currency} ${row.amount}`;
            }
        },
        {
            "mData": "status",
            "mRender": function (data, type, row) {
                return row.status;
            }
        },
        {
            "mData": "created_at",
            "mRender": function (data, type, row) {
                return moment(row.created_at).format("MMM DD,YYYY");
            }
        },
        {
            "mData": null,
            "sWidth": "10%",
            "mRender": function(data,type,row){
                return `
                    <a href="#" class="text-info view-transaction" data-id="${row.id}" data-toggle="tooltip" data-placement="left" title="Details"><i class="mdi mdi-format-list-bulleted icon-md"></i></a>
                    <a href="#" class="text-danger archive-transaction" data-id="${row.id}" data-toggle="tooltip" data-placement="left" title="Archive"><i class="mdi mdi-delete-sweep icon-md"></i></a>
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
    
    $('#transactions-table').on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#transactions-table').on('click', '.archive-transaction', function(){
        let trans_id = $(this).data('id');
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to archive this data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let goDelete = await $.ajax({
                    url: "{{route('transactions.archive')}}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: trans_id
                    }
                });

                if(goDelete.success){
                    Swal.fire({
                        title: "Success!",
                        text: goDelete.msg,
                        icon: "success",
                    }).then(()=>{
                        var tbody = $('#transactions-table tbody');
                        tbody.find('[data-id='+goDelete.id+']').parent().parent().fadeOut(600);
                        t.ajax.reload();
                    });
                }else{
                    Swal.fire('Failed',goDelete.msg,'error');
                }
                
            }
        });
    });
});
</script>
@endsection