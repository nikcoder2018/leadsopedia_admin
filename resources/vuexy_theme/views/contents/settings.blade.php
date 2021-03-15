@extends('layouts.main')
@section('vendors_css')
    <link href="{{ asset('css/quill/quill.snow.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection
@section('external_css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
    <style>
        .ql-toolbar.ql-snow {
            border: 0;
            padding: 0px;

        }

        .ql-toolbar.ql-snow .ql-formats {
            padding: 2px;
            border: 1px solid #d6d6d68a;
            border-radius: 3px;
        }

        .editor {
            margin-top: 10px;
            border: 1px solid #d6d6d68a !important;
            border-radius: 3px;
            height: 500px;
        }

    </style>
@endsection

@section('content')
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column nav-left">
                    <!-- general -->
                    <li class="nav-item">
                        <a class="nav-link active" id="pill-general" data-toggle="pill" href="#general"
                            aria-expanded="true">
                            <i data-feather="user" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">General</span>
                        </a>
                    </li>
                    <!-- Payments -->
                    <li class="nav-item">
                        <a class="nav-link" id="pill-payments" data-toggle="pill" href="#payments" aria-expanded="false">
                            <i data-feather="credit-card" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">Payments</span>
                        </a>
                    </li>
                    <!-- Integrations -->
                    <li class="nav-item">
                        <a class="nav-link" id="pill-integrations" data-toggle="pill" href="#integrations"
                            aria-expanded="false">
                            <i data-feather="code" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">Integrations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pill-integrations" data-toggle="pill" href="#email-templates"
                            aria-expanded="false">
                            <i data-feather="mail" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">Email Templates</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pill-credit-package" data-toggle="pill" href="#credit-packages"
                            aria-expanded="false">
                            <i data-feather="box" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">Credit Packages</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pill-seo" data-toggle="pill" href="#seo"
                            aria-expanded="false">
                            <i data-feather='search' class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">SEO</span>
                        </a>
                    </li>
                    <!-- notification -->
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="pill-notifications" data-toggle="pill" href="#notifications"
                            aria-expanded="false">
                            <i data-feather="bell" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">Notifications</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
            <!--/ left menu section -->

            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- general tab -->
                            <div role="tabpanel" class="tab-pane active" id="general" aria-labelledby="pill-general"
                                aria-expanded="true">
                                <!-- form -->
                                <form class="general-form mt-2" action="{{ route('settings.general.update') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="landing_web_title">Landing Web Title</label>
                                                <input type="text" class="form-control" name="landing_web_title" value=""
                                                    placeholder="E.g Leadsopedia">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="front_web_title">Front Web Title</label>
                                                <input type="text" class="form-control" name="front_web_title" value=""
                                                    placeholder="E.g Leadsopedia">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="backoffice_web_title">Backoffice Web Title</label>
                                                <input type="text" class="form-control" name="backoffice_web_title" value=""
                                                    placeholder="E.g Leadsopedia">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Language</label>
                                                <select class="form-control" name="language">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Currency</label>
                                                <select class="form-control" name="currency">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>TimeZone</label>
                                                <select class="form-control" name="timezone">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                            <!--/ general tab -->
                            <!-- seo tab -->
                            <div role="tabpanel" class="tab-pane" id="seo" aria-labelledby="pill-seo"
                                aria-expanded="true">
                                <div class="card">
                                    <div class="card-datatable table-responsive">
                                        <table class="table table-seo">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Path</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Keywords</th>
                                                    <th class="cell-fit">Actions</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--/ seo tab -->

                            <!-- payments -->
                            <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="pill-payments"
                                aria-expanded="false">
                                <div class="card">
                                    <div class="card-datatable table-responsive">
                                        <table class="table table-payments">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Payment Methods</th>
                                                    <th>Description</th>
                                                    <th class="cell-fit">Actions</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--/ payments -->

                            <!-- integrations -->
                            <div class="tab-pane fade" id="integrations" role="tabpanel" aria-labelledby="pill-integrations"
                                aria-expanded="false">
                                <div class="card">
                                    <div class="card-datatable table-responsive">
                                        <table class="table table-integrations">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Integrations</th>
                                                    <th>Group</th>
                                                    <th>Status</th>
                                                    <th class="cell-fit">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--/ integrations -->
                            <div role="tabpanel" class="tab-pane" id="email-templates"
                                aria-labelledby="pill-email-templates" aria-expanded="false">
                                <div class="card">
                                    <div class="card-datatable table-responsive">
                                        <table class="table table-email-templates">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Subject</th>
                                                    <th class="cell-fit">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="credit-packages"
                                aria-labelledby="pill-credit-packages" aria-expanded="false">
                                <div class="card">
                                    <div class="card-datatable table-responsive">
                                        <table class="table table-credit-packages">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Credits</th>
                                                    <th>Price</th>
                                                    <th class="cell-fit">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- notifications -->
                            <div class="tab-pane fade" id="notifications" role="tabpanel"
                                aria-labelledby="pill-notifications" aria-expanded="false">
                                <div class="row">
                                    <h6 class="section-label mx-1 mb-2">Activity</h6>
                                    <div class="col-12 mb-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" checked
                                                id="accountSwitch1" />
                                            <label class="custom-control-label" for="accountSwitch1">
                                                Email me when someone comments onmy article
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" checked
                                                id="accountSwitch2" />
                                            <label class="custom-control-label" for="accountSwitch2">
                                                Email me when someone answers on my form
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="accountSwitch3" />
                                            <label class="custom-control-label" for="accountSwitch3">Email me hen someone
                                                follows me</label>
                                        </div>
                                    </div>
                                    <h6 class="section-label mx-1 mt-2">Application</h6>
                                    <div class="col-12 mt-1 mb-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" checked
                                                id="accountSwitch4" />
                                            <label class="custom-control-label" for="accountSwitch4">News and
                                                announcements</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" checked
                                                id="accountSwitch6" />
                                            <label class="custom-control-label" for="accountSwitch6">Weekly product
                                                updates</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-75">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="accountSwitch5" />
                                            <label class="custom-control-label" for="accountSwitch5">Weekly blog
                                                digest</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <!--/ notifications -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/ right content section -->
        </div>
    </section>
@endsection

@section('modals')
    <div class="modal fade" id="delete-email-template-modal" tabindex="-1" role="dialog"
        aria-labelledby="deleteEmailTempalteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEmailTempalteModalLabel">Delete Email Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this email template?
                </div>
                <div class="modal-footer">
                    <button type="button" id="delete-email-template-button" data-id="-1" class="btn btn-danger btn-sm"
                        data-dismiss="modal">Confirm</button>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view-email-template-modal" tabindex="-1" role="dialog"
        aria-labelledby="viewEmailTempalteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewEmailTempalteModalLabel">View Email Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 id="email-template-title"></h3>
                    <p id="email-template-subject"></p>
                    <div id="email-template-body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-email-template-modal" tabindex="-1" role="dialog"
        aria-labelledby="addEmailTemplateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmailTemplateModalLabel">Add Email Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ url('/api/settings/email-templates') }}" id="add-email-template-form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" placeholder="Subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <div id="snow-wrapper">
                                <div id="snow-container">
                                    <div class="editor">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="new-payment-method-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 650px !important" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Add Payment Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="form-add-payment" action="{{ route('payment-methods.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name <sup>*</sup></label>
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                        <h4 class="card-title">Attributes</h4>
                        <div class="attribute-lists">
                            <div data-repeater-list="attributes">
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="itemname">Name</label>
                                                <input type="text" class="form-control" id="itemname"
                                                    name="attributes[][name]" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="itemvalue">Value</label>
                                                <input type="text" class="form-control" id="itemvalue"
                                                    name="attributes[][value]" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12 mb-50">
                                            <div class="form-group">
                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete
                                                    type="button">
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
                                        <span>Add New</span>
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
    <div class="modal fade" id="edit-payment-method-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 650px !important" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Add Payment Method</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="form-edit-payment" action="{{ route('payment-methods.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name <sup>*</sup></label>
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                        <h4 class="card-title">Attributes</h4>
                        <div class="attribute-lists-edit">
                            <div data-repeater-list="attributes">

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                        <i data-feather="plus" class="mr-25"></i>
                                        <span>Add New</span>
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
    <div class="modal fade" id="new-integration-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 650px !important" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Add Integration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="form-add-integration" action="{{ route('integrations.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name <sup>*</sup></label>
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="title">App Key <sup>*</sup></label>
                            <input type="text" class="form-control" name="app_key" placeholder="app_key" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="enabled">Enabled</option>
                                <option value="disabled">Disabled</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="group_id">Group</label>
                                <select name="group_id" class="form-control">
                                    <option value="">Select Group</option>
                                    @foreach ($integration_groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="scope">Scope</label>
                                <select name="scope" class="form-control">
                                    <option value="backend">Backend</option>
                                    <option value="frontend">Frontend</option>
                                </select>
                            </div>
                        </div>
                        <h4>Attribute Keys</h4>
                        <div class="list-wrapper attribute-lists">
                            <div data-repeater-list="attributes">
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="itemkey">Key</label>
                                                <input type="text" class="form-control" id="itemkey" name="keys[][key]"
                                                    placeholder="Eg. app_key" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="itemname">Name</label>
                                                <input type="text" class="form-control" id="itemname" name="keys[][name]"
                                                    placeholder="Eg. App Key" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12 mb-50">
                                            <div class="form-group">
                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete
                                                    type="button">
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
                                        <span>Add New</span>
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
    <div class="modal fade" id="edit-integration-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 650px !important" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Edit Integration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="form-edit-integration" action="{{ route('integrations.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name <sup>*</sup></label>
                            <input type="text" class="form-control" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label for="title">App Key <sup>*</sup></label>
                            <input type="text" class="form-control" name="app_key" placeholder="app_key" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="enabled">Enabled</option>
                                <option value="disabled">Disabled</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="group_id">Group</label>
                                <select name="group_id" class="form-control">
                                    <option value="">Select Group</option>
                                    @foreach ($integration_groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="scope">Scope</label>
                                <select name="scope" class="form-control">
                                    <option value="backend">Backend</option>
                                    <option value="frontend">Frontend</option>
                                </select>
                            </div>
                        </div>
                        <h4>Attributes</h4>
                        <div class="list-wrapper attribute-lists">
                            <div data-repeater-list="attributes">
                                <div data-repeater-item>
                                    <div class="row d-flex align-items-end">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label>Key</label>
                                                <input type="text" class="form-control" name="keys[][key]"
                                                    placeholder="Eg. app_key" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="keys[][name]"
                                                    placeholder="Eg. App Key" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12 mb-50">
                                            <div class="form-group">
                                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete
                                                    type="button">
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
                                        <span>Add New</span>
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
    <div class="modal fade" id="new-credit-packages-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 650px !important" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="form-add-cpackage" action="{{ route('creditpackages.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Credits <sup>*</sup></label>
                            <input type="number" class="form-control" name="credits" placeholder="Credits" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Price <sup>*</sup></label>
                            <input type="number" class="form-control" name="price" step="0.01" placeholder="Price" required>
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
    <div class="modal fade" id="edit-credit-packages-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 650px !important" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="form-add-cpackage" action="{{ route('creditpackages.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Credits <sup>*</sup></label>
                            <input type="number" class="form-control" name="credits" placeholder="Credits" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Price <sup>*</sup></label>
                            <input type="number" class="form-control" name="price" placeholder="Price" step="0.01" required>
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
    <div class="modal fade" id="new-seo-page-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 650px !important" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Add SEO Page Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-add-seo" action="{{ route('seo-pages.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="path">path <sup>*</sup></label>
                        <input type="text" class="form-control" name="path" placeholder="Path" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="Title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keywords">Keywords</label>
                        <input type="text" name="keywords" placeholder="Keywords" class="form-control">
                        <small>Separate keywords by comma (,)</small>
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
<div class="modal fade" id="edit-seo-page-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 650px !important" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Edit Page SEO Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-edit-seo" action="{{ route('seo-pages.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="path">path <sup>*</sup></label>
                        <input type="text" class="form-control" name="path" placeholder="Path" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="Title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keywords">Keywords</label>
                        <input type="text" name="keywords" placeholder="Keywords" class="form-control">
                        <small>Separate keywords by comma (,)</small>
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
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.min.js') }}">
    </script>
    <script
        src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}">
    </script>
    <script
        src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}">
    </script>
    <script
        src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}">
    </script>
    <script
        src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js') }}">
    </script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}">
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('js/quill/quill.js') }}"></script>
    <script src="{{ asset(env('APP_THEME', 'default') . '/app-assets/js/scripts/pages/app-settings.js') }}"></script>
@endsection
