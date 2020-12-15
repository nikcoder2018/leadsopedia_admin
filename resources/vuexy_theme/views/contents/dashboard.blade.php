@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/charts/apexcharts.css')}}">
@endsection
@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/dashboard-ecommerce.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/charts/chart-apex.css')}}">
@endsection
@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal">
                <div class="card-body">
                    <h5>{{$greetings}}</h5>
                    <p class="card-text font-small-3">This is our current sales today!</p>
                    <h3 class="mb-75 mt-2 pt-50 text-success">
                        <a href="javascript:void(0);" id="today-sales">$0</a>
                    </h3>
                    <a href="{{route('transactions.index')}}" class="btn btn-primary">View Sales</a>
                </div>
            </div>
        </div>
        <!--/ Medal Card -->

        <!-- Statistics Card -->
        <div class="col-xl-8 col-md-6 col-12">
            <div class="card card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Statistics</h4>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-primary mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0" id="total-sales">$0</h4>
                                    <p class="card-text font-small-3 mb-0">Sales</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-info mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0" id="total-customers">0</h4>
                                    <p class="card-text font-small-3 mb-0">Customers</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                            <div class="media">
                                <div class="avatar bg-light-danger mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="box" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0" id="total-data">0</h4>
                                    <p class="card-text font-small-3 mb-0">Data</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="media">
                                <div class="avatar bg-light-success mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="search" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0" id="total-searches">0</h4>
                                    <p class="card-text font-small-3 mb-0">Searches</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics Card -->
    </div>

    <div class="row match-height">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Credits Balance</h4>
                    <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
                </div>
                <div class="card-body p-0">
                    <div id="credits-radial-bar-chart" class="my-2"></div>
                    <div class="row border-top text-center mx-0">
                        <div class="col-6 border-right py-1">
                            <p class="card-text text-muted mb-0">Obtained</p>
                            <h3 class="font-weight-bolder mb-0" id="credits-obtained">0</h3>
                        </div>
                        <div class="col-6 py-1">
                            <p class="card-text text-muted mb-0">Used</p>
                            <h3 class="font-weight-bolder mb-0" id="credits-used">0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Revenue Report Card -->
        <div class="col-lg-8 col-12">
            <div class="card card-revenue-budget">
                <div class="row mx-0">
                    <div class="col-md-12 col-12 revenue-report-wrapper">
                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title mb-50 mb-sm-0">Sales Report</h4>
                        </div>
                        <div id="sales-report-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Revenue Report Card -->
    </div>

    <div class="row match-height">
        <!-- Company Table Card -->
        <div class="col-lg-8 col-12">
            <div class="card card-company-table">
               
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-transactions">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Company Table Card -->

        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-transaction">
                <div class="card-header">
                    <h4 class="card-title">New Accounts</h4>
                </div>
                <div class="card-body list-new-accounts">
                    
                </div>
            </div>
        </div>

        
    </div>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendors_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/dashboard.js')}}"></script>   
@endsection