@extends('layouts.main')

@section('vendors_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/editors/quill/katex.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/editors/quill/monokai-sublime.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/extensions/toastr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Roboto+Slab&amp;family=Slabo+27px&amp;family=Sofia&amp;family=Ubuntu+Mono&amp;display=swap">

@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/forms/form-quill-editor.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/app-email.css')}}">
@endsection

@section('stylesheets')
<style>
    #message-editor{
        height: 300px;
    }
</style>
@endsection
@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content_class') email-application @endsection
@section('content')
<section class="process-request">
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
                            <span class="detail-name">{{$rd->firstname}} {{$rd->lastname}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Phone: </b>
                            <span class="detail-phone">{{$rd->phone}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Email: </b>
                            <span class="detail-email">{{$rd->email}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Data Set: </b>
                            <span class="detail-dataset">{{$rd->dataset}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Target: </b>
                            <span class="detail-target">{{$rd->target}}</span>
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
                        <input type="hidden" name="request_id" value="{{$rd->id}}">
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
                        <div class="col-md-12 message-box">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-generate">Generate</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            @if(count($rd->samples) > 0)
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Samples Generated</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Number of Data</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rd->samples as $sample)
                                <tr>
                                    <td>{{$sample->id}}</td>
                                    <td>{{count(json_decode($sample->data))}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{route('datarequests.preview', $sample->id)}}" target="_blank">Preview</a>
                                        <button class="btn btn-success btn-sm btn-send" data-email="{{$rd->email}}" data-sample-id="{{$sample->id}}" data-request-id="{{$rd->id}}" @if($sample->sent) disabled @endif>Send</button>
                                        <button class="btn btn-danger btn-sm btn-delete" data-sample-id="{{$sample->id}}">Remove</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="send-sample-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Send Sample via Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('datarequests.send')}}" class="compose-form" id="form-send" method="POST">
                    @csrf
                    <input type="hidden" name="request_id">
                    <input type="hidden" name="sample_id">
                    <div class="modal-body">
                        <div class="compose-mail-form-field select2-primary">
                            <label for="email-to" class="form-label">To: </label>
                            <div class="flex-grow-1">
                                <input type="email" class="form-control" name="email" id="email" disabled>
                            </div>
                        </div>
                        <div id="message-editor" class="mb-2">
                            <input type="hidden" name="message">
                            <div class="editor" data-placeholder="Type message..."></div>
                            <div class="compose-editor-toolbar">
                                <span class="ql-formats mr-0">
                                    <select class="ql-font">
                                        <option selected>Sailec Light</option>
                                        <option value="sofia">Sofia Pro</option>
                                        <option value="slabo">Slabo 27px</option>
                                        <option value="roboto">Roboto Slab</option>
                                        <option value="inconsolata">Inconsolata</option>
                                        <option value="ubuntu">Ubuntu Mono</option>
                                    </select>
                                </span>
                                <span class="ql-formats mr-0">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> 
@endsection


@section('vendor_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection
@section('external_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection

@section('scripts')
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-email.js')}}"></script>
<script>
    $(function(){
        'use strict';
        var API_FILTER = '/datarequests/filters',
            formGenerate = $('#form-generate'),
            formSend = $('#form-send'),
            sendSampleModal = $('#send-sample-modal'),
            API_TOKEN = $('[name=api-token]').attr('content');

        formGenerate.on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                beforeSend: function(){
                    $('.btn-generate').prop('disabled', true);
                },
                success: function(resp) {
                    if (resp.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: resp.msg,
                            icon: 'success'
                        }).then(()=>{
                            $('.btn-generate').prop('disabled', false);
                            location.reload();
                        });
                    }else{
                        toastr['error'](resp.msg, 'Failed!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }
                }
            });
        });

        $('.btn-send').on('click', function(){
            var sample_id = $(this).data('sampleId'),
                request_id = $(this).data('requestId'),
                email = $(this).data('email'),
                sendSampleModal = $('#send-sample-modal');
            
            formSend.find('input[name=email]').val(email);
            formSend.find('input[name=sample_id]').val(sample_id);
            formSend.find('input[name=request_id]').val(request_id);
            sendSampleModal.modal('show');

        });
        
        $('.btn-delete').on('click', function(){
            var sample_id = $(this).data('sampleId');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(async function(result) {
                if (result.isConfirmed) {
                    const deleteData = await $.get(`/datarequests/${sample_id}/delete-sample`);
                    if (deleteData.success) {
                        toastr['success'](deleteData.msg, 'Deleted!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        location.reload()
                    }
                }
            });
        });
        formSend.on('submit', function(e){
            e.preventDefault();
            var quill_editor = $('.compose-form .ql-editor');
            formSend.find('input[name=message]').val(quill_editor[0].innerHTML);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                beforeSend: function(){
                    formSend.find('button[type=submit]').prop('disabled', true);
                },
                success: function(resp){
                    if(resp.success){
                        formSend.find('button[type=submit]').prop('disabled', false);
                        sendSampleModal.modal('hide');

                        toastr['success'](resp.msg, 'Deleted!', {
                            closeButton: true,
                            tapToDismiss: false
                        });

                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    }
                }
            })
        });
        $('.select2').each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent(),
                ajax: {
                    url: API_FILTER + '/' + $this.data('filter'),
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            api_token: API_TOKEN
                        }

                        return query;
                    }
                }
            });
        });
    });
</script>
@endsection