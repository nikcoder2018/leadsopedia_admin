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
            <table class="datarequest-list-table list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Request #</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Data Set</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="cell-fit">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section> 
@endsection

@section('modals')
<div class="vertical-modal-ex">
    <div class="modal fade" id="process-request-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Process Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Request Details</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>Name: </b>
                                            <span class="detail-name"></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Phone: </b>
                                            <span class="detail-phone"></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Email: </b>
                                            <span class="detail-email"></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Data Set: </b>
                                            <span class="detail-dataset"></span>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Target: </b>
                                            <span class="detail-target"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Generate Sample</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('datarequests.generate')}}" id="form-generate" method="POST">
                                        @csrf
                                        <input type="hidden" name="request_id">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="keyword">Keyword</label>
                                                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Enter Keyword">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="industry">Industry</label>
                                                <select name="industry[]" id="industry" class="select2 form-control" multiple data-filter="industry"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select name="country[]" id="country" class="select2 form-control" data-filter="country" multiple></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="region">Region</label>
                                                <select name="region[]" id="region" class="select2 form-control" data-filter="region" multiple></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select name="state[]" id="state" class="select2 form-control" data-filter="state" multiple></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select name="city[]" id="city" class="select2 form-control" data-filter="city" multiple></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="street">Street</label>
                                                <select name="street[]" id="street" class="select2 form-control" data-filter="street" multiple></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Generate</button>
                                            <button type="button" class="btn btn-info" disabled>Preview</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" disabled>Send Sample</button>
                </div>
            </div>
        </div>
    </div>
</div>           
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
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-datarequests.js')}}"></script>
@endsection