@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default') . '/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">   
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/app-permissions-list.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection
@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
@endsection
@section('content')
<!-- users edit start -->
<section class="app-user-edit">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                        <i data-feather="user"></i><span class="d-none d-sm-block">Account</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                        <i data-feather="info"></i><span class="d-none d-sm-block">Information</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                        <i data-feather="share-2"></i><span class="d-none d-sm-block">Social</span>
                    </a>
                </li>
            </ul>
            <form class="form-validate customers-create-form" action="{{route('customers.store')}}" method="POST">
                @csrf
                <div class="tab-content">
                    <!-- Account Tab starts -->
                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                        <!-- users edit account form start -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email" id="email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <input type="text" class="form-control" name="company" placeholder="Company name" id="company" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="password_confirmation" />
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="card border rounded mt-1">
                                        <div class="card-header">
                                            <h6 class="font-medium-2">
                                                <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                                <span class="align-middle">Subscriptions Plan</span>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="subscription_id">Subscription Plan</label>
                                                        <select name="subscription_id" id="subscription_id" class="form-control select2">
                                                            <option value="-1">Enterprise</option>
                                                            @foreach($subscription_plans as $plan)
                                                                <option value="{{$plan->id}}">{{$plan->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="date_ends">Date Ends</label>
                                                        <input type="text" name="date_ends" id="date_ends" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="search_limits">Search Limits</label>
                                                        <input type="number" name="search_limits" id="search_limits" class="form-control" placeholder="Search Limits" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="search_leads_limits">Search Leads Limits</label>
                                                        <input type="number" name="search_leads_limits" id="search_leads_limits" class="form-control" placeholder="Search Leads Limits" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="credits">Credits</label>
                                                        <input type="number" name="credits" id="credits" class="form-control" placeholder="Credit Limits" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
                        <!-- users edit account form ends -->
                    </div>
                    <!-- Account Tab ends -->

                    <!-- Information Tab starts -->
                    <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                        <!-- users edit Info form start -->
                            <div class="row mt-1">
                                <div class="col-12">
                                    <h4 class="mb-1">
                                        <i data-feather="user" class="font-medium-4 mr-25"></i>
                                        <span class="align-middle">Personal Information</span>
                                    </h4>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" type="text" class="form-control" name="name" placeholder="Enter name here..."/>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="birthday">Birth date</label>
                                        <input id="birthday" type="text" class="form-control flatpickr-basic" name="birthday" placeholder="YYYY-MM-DD" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input id="mobile" type="text" class="form-control" name="mobile" />
                                    </div>
                                </div>
                            
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label class="d-block mb-1">Gender</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="male" value="male" name="gender" class="custom-control-input" />
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" value="female" name="gender" class="custom-control-input" checked />
                                            <label class="custom-control-label" for="female">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-10">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input id="address" type="text" class="form-control" name="address" />
                                    </div>
                                </div>

                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
                        <!-- users edit Info form ends -->
                    </div>
                    <!-- Information Tab ends -->

                    <!-- Social Tab starts -->
                    <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                        <!-- users edit social form start -->
                            <div class="row">
                                <div class="col-lg-4 col-md-6 form-group">
                                    <label for="twitter-input">Twitter</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">
                                                <i data-feather="twitter" class="font-medium-2"></i>
                                            </span>
                                        </div>
                                        <input id="twitter-input" type="text" name="social_twitter" class="form-control" placeholder="https://www.twitter.com/" aria-describedby="basic-addon3" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group">
                                    <label for="facebook-input">Facebook</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon4">
                                                <i data-feather="facebook" class="font-medium-2"></i>
                                            </span>
                                        </div>
                                        <input id="facebook-input" type="text" class="form-control" name="social_facebook" placeholder="https://www.facebook.com/" aria-describedby="basic-addon4" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group">
                                    <label for="instagram-input">Instagram</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon5">
                                                <i data-feather="instagram" class="font-medium-2"></i>
                                            </span>
                                        </div>
                                        <input id="instagram-input" type="text" class="form-control" name="social_instagram" placeholder="https://www.instagram.com/" aria-describedby="basic-addon5" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group">
                                    <label for="google-input">Google</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon9">
                                                <i data-feather="mail" class="font-medium-2"></i>
                                            </span>
                                        </div>
                                        <input id="google-input" type="text" class="form-control" name="social_google" placeholder="https://www.gmail.com/" aria-describedby="basic-addon9" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group">
                                    <label for="linkedin-input">Linkedin</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon12">
                                                <i data-feather="linkedin" class="font-medium-2"></i>
                                            </span>
                                        </div>
                                        <input id="linkedin-input" type="text" class="form-control" name="social_linkedin" placeholder="https://www.linkedin.com/" aria-describedby="basic-addon12" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group">
                                    <label for="qoura-input">Qoura</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon11">
                                                <i data-feather="qoura" class="font-medium-2"></i>
                                            </span>
                                        </div>
                                        <input id="qoura-input" type="text" class="form-control" name="social_qoura" placeholder="https://www.qoura.com/" aria-describedby="basic-addon11" />
                                    </div>
                                </div>

                                <div class="col-12 d-flex flex-sm-row flex-column mt-2">
                                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
                        <!-- users edit social form ends -->
                    </div>
                    <!-- Social Tab ends -->
                </div>
            </form>
        </div>
    </div>
</section>
<!-- users edit ends -->   
@endsection

@section('vendor_js')
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection
@section('external_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection
@section('scripts')
<script>
    $(function(){
        'use strict'

        var basicPickr = $('.flatpickr-basic'),
            isRtl = $('html').attr('data-textdirection') === 'rtl',
            form = $('.customers-create-form');

        if (basicPickr.length) {
            basicPickr.flatpickr();
        }

        form.on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                beforeSend: function(){
                    form.find('button[type=submit]').prop('disabled', true);
                },
                success: function(resp) {
                    form.find('button[type=submit]').prop('disabled', false);
                    if (resp.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: resp.msg,
                            icon: 'success'
                        }).then(()=>{
                            location.href="{{route('customers.index')}}";
                        })
                    }
                },
                error: function(xhr, status, error) {
                    form.find('button[type=submit]').prop('disabled', false);
                    $.each(xhr.responseJSON.errors, function(i, v) {
                        toastr['error'](v[0], 'Error!', {
                            closeButton: true,
                            tapToDismiss: false,
                            rtl: isRtl
                        });
                    });
                }
            })
        });
    })
</script>
@endsection