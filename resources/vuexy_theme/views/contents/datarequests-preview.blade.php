@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')}}">
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/app-list.css')}}">
@endsection

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content')
<section class="datarequest-list-wrapper list-wrapper">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datarequestpreview-list-table list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Industry</th>
                        <th>Phone</th>
                        <th>Website</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Region</th>
                        <th>Country</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section> 
@endsection

@section('external_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection

@section('scripts')
<script>
    $(function(){
        'use strict';
        var API_TOKEN = $('[name=api-token]').attr('content');

        var t = $('.datarequestpreview-list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/datarequests/{{$sample_data_id}}/preview-data',
                type: "GET",
                data: {
                    api_token: API_TOKEN
                }
            }, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'title' },
                { data: 'company' },
                { data: 'industry' },
                { data: 'phone' },
                { data: 'website' },
                { data: 'street' },
                { data: 'city' },
                { data: 'state' },
                { data: 'region' },
                { data: 'country' },
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    targets: 0
                }
            ],
            order: [
                [1, 'desc']
            ],
            dom: '<"row d-flex justify-content-between align-items-center m-1"' +
                '<"col-lg-8 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-lg-right text-left "B>>' +
                '<"col-lg-4 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"invoice_status ml-sm-2">>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            buttons: [],
            scrollX: true,
            displayLength: 10,
            ordering: false,
            order: [
                [1, 'desc']
            ],
        });

    });
</script>
@endsection
