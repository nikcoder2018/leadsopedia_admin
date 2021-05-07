@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css')}}">
@endsection

@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content')
<section class="subsplans-list-wrapper">
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="subsplans-list-table table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Duration</th>
                        <th>Price</th>
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
    <div class="modal fade" id="new-subsplan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel-2">Create subscription plan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <form id="form-create-subscription" action="{{route('subscriptions.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title <sup>*</sup></label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description <sup>*</sup></label>
                        <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div class="custom-control custom-switch custom-control-inline">
                                <input type="checkbox" name="is_trial" class="custom-control-input" id="isTrialSwitch">
                                <label class="custom-control-label" for="isTrialSwitch">Free Trial</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col months">
                            <label for="months">Months <sup>*</sup></label>
                            <input type="number" class="form-control" name="months" placeholder="Subscription Duration">
                        </div>
                        <div class="col days d-none">
                            <label for="days">Days <sup>*</sup></label>
                            <input type="number" class="form-control" name="days" placeholder="Trial Days Duration">
                        </div>
                        <div class="col">
                            <label for="price">Price <sup>*</sup></label>
                            <input type="number" class="form-control" name="price" step="0.01" placeholder="Amount">
                        </div>
                        <div class="col">
                            <label for="price">Annual Price<sup>*</sup></label>
                            <input type="number" class="form-control" name="price_annual" step="0.01" placeholder="Amount">
                            <p class="text-muted">Put fixed price for annual </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="months">Search Limits <sup>*</sup></label>
                            <input type="number" class="form-control" name="search_limits" placeholder="Search Limits">
                        </div>
                        <div class="col">
                            <label for="search_limits">Search Leads Limits <sup>*</sup></label>
                            <input type="number" class="form-control" name="search_leads_limits" placeholder="Search Leads Limits">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="credits">Credits <sup>*</sup></label>
                            <input type="number" class="form-control" name="credits" placeholder="Credits">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="css_class">Card Box CSS <sup>optional</sup></label>
                            <input type="text" class="form-control" name="css_class">
                        </div>
                        <div class="col">
                            <label for="css_btn_class">Card Button CSS <sup>optional</sup></label>
                            <input type="text" class="form-control" name="css_btn_class">
                        </div>
                    </div>
                    <h4>Priviledges</h4>
                    <div class="list-wrapper attribute-lists">
                        <div data-repeater-list="attributes">
                        <div data-repeater-item>
                            <div class="row d-flex align-items-end">
                                <div class="col-md-10 col-12">
                                    <div class="form-group">
                                        <label>Text</label>
                                        <input type="text" class="form-control" name="attributes[][text]" placeholder="This will added to the pricing details"/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12 mb-50">
                                    <div class="form-group">
                                        <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                            <i data-feather="x" class="mr-25"></i>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                    <i data-feather="plus" class="mr-25"></i>
                                    <span>Add</span>
                                </button>
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

    <div class="modal fade" id="edit-subsplan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel-2">Edit subscription plan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <form id="form-create-subscription" action="{{route('subscriptions.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title <sup>*</sup></label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div class="custom-control custom-switch custom-control-inline">
                                <input type="checkbox" name="is_trial" class="custom-control-input" id="isTrialSwitch2">
                                <label class="custom-control-label" for="isTrialSwitch2">Free Trial</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col months">
                            <label for="months">Months <sup>*</sup></label>
                            <input type="number" class="form-control" name="months" placeholder="Subscription Duration">
                        </div>
                        <div class="col days d-none">
                            <label for="days">Days <sup>*</sup></label>
                            <input type="number" class="form-control" name="days" placeholder="Trial Days Duration">
                        </div>
                        <div class="col">
                            <label for="price">Price <sup>*</sup></label>
                            <input type="number" class="form-control" name="price" step="0.01" placeholder="Amount">
                        </div>
                        <div class="col">
                            <label for="price">Annual Price<sup>*</sup></label>
                            <input type="number" class="form-control" name="price_annual" step="0.01" placeholder="Amount">
                            <p class="text-muted">Put fixed price for annual </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="months">Search Limits <sup>*</sup></label>
                            <input type="number" class="form-control" name="search_limits" placeholder="Search Limits">
                        </div>
                        <div class="col">
                            <label for="search_limits">Search Leads Limits <sup>*</sup></label>
                            <input type="number" class="form-control" name="search_leads_limits" placeholder="Search Leads Limits">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="credits">Credits <sup>*</sup></label>
                            <input type="number" class="form-control" name="credits" placeholder="Credits">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="css_class">Card Box CSS <sup>optional</sup></label>
                            <input type="text" class="form-control" name="css_class">
                        </div>
                        <div class="col">
                            <label for="css_btn_class">Card Button CSS <sup>optional</sup></label>
                            <input type="text" class="form-control" name="css_btn_class">
                        </div>
                    </div>
                    <h4>Priviledges</h4>
                    <div class="list-wrapper attribute-lists">
                        <div data-repeater-list="attributes">
                        <div data-repeater-item>
                            <div class="row d-flex align-items-end">
                                <div class="col-md-10 col-12">
                                    <div class="form-group">
                                        <label>Text</label>
                                        <input type="text" class="form-control" name="attributes[][text]" placeholder="This will added to the pricing details"/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12 mb-50">
                                    <div class="form-group">
                                        <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                            <i data-feather="x" class="mr-25"></i>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                    <i data-feather="plus" class="mr-25"></i>
                                    <span>Add</span>
                                </button>
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
</div>
<div class="modal fade" id="editSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Edit subscription plan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-edit-subscription" action="{{route('subscriptions.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-body pt-0">
                <div class="form-group">
                    <label for="title">Title <sup>*</sup></label>
                    <input type="text" class="form-control" name="title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="months">Search Limits <sup>*</sup></label>
                        <input type="number" class="form-control" name="search_limits" placeholder="Search Limits">
                    </div>
                    <div class="col">
                        <label for="search_limits">Search Leads Limits <sup>*</sup></label>
                        <input type="number" class="form-control" name="search_leads_limits" placeholder="Search Leads Limits">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="credits">Credits <sup>*</sup></label>
                        <input type="number" class="form-control" name="credits" placeholder="Credits">
                    </div>
                    <div class="col">
                        <label for="months">Months <sup>*</sup></label>
                        <input type="number" class="form-control" name="months" placeholder="Months">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="credits">Price <sup>*</sup></label>
                        <input type="number" class="form-control" name="price" step="0.01" placeholder="Price">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="css_class">Card Box CSS <sup>optional</sup></label>
                        <input type="text" class="form-control" name="css_class">
                    </div>
                    <div class="col">
                        <label for="css_btn_class">Card Button CSS <sup>optional</sup></label>
                        <input type="text" class="form-control" name="css_btn_class">
                    </div>
                </div>
                <h4>Priviledges</h4>
                <div class="list-wrapper attribute-lists">
                    <div data-repeater-list="attributes">
                      <div data-repeater-item>
                          <div class="row d-flex align-items-end">
                              <div class="col-md-6 col-12">
                                  <div class="form-group">
                                      <label>Text</label>
                                      <input type="text" class="form-control" name="attributes[][text]" placeholder="This will added to the pricing details"/>
                                  </div>
                              </div>
                              <div class="col-md-2 col-12 mb-50">
                                  <div class="form-group">
                                      <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                          <i data-feather="x" class="mr-25"></i>
                                          <span>Delete</span>
                                      </button>
                                  </div>
                              </div>
                          </div>
                          <hr />
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                <i data-feather="plus" class="mr-25"></i>
                                <span>Add</span>
                            </button>
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

@section('external_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-subscriptions.js')}}"></script>
@endsection
