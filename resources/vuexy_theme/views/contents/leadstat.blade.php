@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/charts/apexcharts.css')}}">
@endsection
@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/charts/chart-apex.css')}}">
@endsection
@section('content')
<section>
    <div class="row match-height">
        <!-- Statistics Card -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-sm-row flex-column justify-content-md-center align-items-start justify-content-center">
                    <div>
                        <p class="card-subtitle mb-25">Leads Statistics</p>
                        <h1 class="font-weight-bolder">{{number_format($total_leads)}}</h1>
                    </div>
                </div>
                <div class="card-body">
                    <div id="bar-chart"></div>
                </div>
            </div>
        </div>
        <!--/ Statistics Card -->
    </div>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendors_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-leads-stats.js')}}"></script>   
@endsection