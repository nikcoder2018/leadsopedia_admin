@extends('layouts.main2')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/editors/quill/katex.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/vendors/css/forms/select/select2.min.css') }}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Roboto+Slab&amp;family=Slabo+27px&amp;family=Sofia&amp;family=Ubuntu+Mono&amp;display=swap">
@endsection

@section('external_css')
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/core/menu/menu-types/vertical-menu.css"') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/forms/form-quill-editor.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('APP_THEME', 'default') . '/app-assets/css/pages/app-email.css') }}">
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content email-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content email-app-sidebar">
                        <div class="email-app-menu">
                            <div class="form-group-compose text-center compose-btn">
                                <button type="button" class="compose-email btn btn-primary btn-block" data-backdrop="false" data-toggle="modal" data-target="#compose-mail">
                                    Send Message
                                </button>
                            </div>
                            <div class="sidebar-menu-list">
                                <div class="list-group list-group-messages">
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action active" data-tab="inbox">
                                        <i data-feather="mail" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Inbox</span>
                                        <span class="badge badge-light-primary badge-pill float-right">{{$unreadMessages}}</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" data-tab="sent">
                                        <i data-feather="send" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Sent</span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" data-tab="trash">
                                        <i data-feather="trash" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Trash</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <!-- Email list Area -->
                        <div class="email-app-list">
                            <!-- Email search starts -->
                            <div class="app-fixed-search d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-lg-none ml-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                                <div class="d-flex align-content-center justify-content-between w-100">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="email-search" placeholder="Search message" aria-label="Search..." aria-describedby="email-search" />
                                    </div>
                                </div>
                            </div>
                            <!-- Email search ends -->

                            <!-- Email actions starts -->
                            <div class="app-action">
                                <div class="action-left">
                                    <div class="custom-control custom-checkbox selectAll">
                                        <input type="checkbox" class="custom-control-input" id="selectAllCheck" />
                                        <label class="custom-control-label font-weight-bolder pl-25" for="selectAllCheck">Select All</label>
                                    </div>
                                </div>
                                <div class="action-right">
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item mail-delete">
                                            <span class="action-icon"><i data-feather="trash-2" class="font-medium-2"></i></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Email actions ends -->

                            <!-- Email list starts -->
                            <div class="email-user-list">
                                
                            </div>
                            <!-- Email list ends -->
                        </div>
                        <!--/ Email list Area -->
                        <!-- Detailed Email View -->
                        <div class="email-app-details">
                            
                        </div>
                        <!--/ Detailed Email View -->

                        <!-- compose email -->
                        <div class="modal modal-sticky" id="compose-mail">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content p-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Send Message</h5>
                                        <div class="modal-actions">
                                            <a class="text-body" href="javascript:void(0);" data-dismiss="modal" aria-label="Close"><i data-feather="x"></i></a>
                                        </div>
                                    </div>
                                    <div class="modal-body flex-grow-1 p-0">
                                        <form class="compose-form" action="{{route('messages.send')}}" method="POST">
                                            @csrf
                                            <div class="compose-mail-form-field select2-primary">
                                                <label for="email-to" class="form-label">To: </label>
                                                <div class="flex-grow-1">
                                                    <input type="text" id="input-email" class="form-control" placeholder="Email" name="to" />
                                                </div>
                                            </div>
                                            
                                            <div class="compose-mail-form-field">
                                                <label for="input-subject">Subject: </label>
                                                <input type="text" id="input-subject" class="form-control" placeholder="Subject" name="subject" />
                                            </div>
                                            <div id="message-editor">
                                                <div class="editor" data-placeholder="Type message..."></div>
                                                <div class="compose-editor-toolbar">
                                                    <span class="ql-formats mr-0">
                                                        <button class="ql-bold"></button>
                                                        <button class="ql-italic"></button>
                                                        <button class="ql-underline"></button>
                                                        <button class="ql-link"></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="compose-footer-wrapper">
                                                <div class="btn-wrapper d-flex align-items-center">
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ compose email -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('vendors_js')
<script src="{{ asset(env('APP_THEME', 'default') .'/app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
<script src="{{ asset(env('APP_THEME', 'default') .'/app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
<script src="{{ asset(env('APP_THEME', 'default') .'/app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
<script src="{{ asset(env('APP_THEME', 'default') .'/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
@endsection

@section('external_js')
<script src="{{ asset(env('APP_THEME', 'default') .'/app-assets/js/scripts/pages/app-message.js') }}"></script>
@endsection