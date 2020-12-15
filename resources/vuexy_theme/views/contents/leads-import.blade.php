@extends('layouts.main')

@section('stylesheets')
    <style>
        .import-start-column{
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 15px;
        }

        .import-start-column svg.ficon{
            height: 1.5rem;
            width: 1.5rem;
            font-size: 1.5rem;
        }
        
    </style>
@endsection
@section('header')
<div class="content-header-left col-md-9 col-12 mb-2">
    @include('partials.breadcrumbs', ['title' => $title])
</div>
@endsection

@section('content')
<section class="form-control-repeater">
    <div class="row">
        <!-- Invoice repeater -->
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom p-1">
                    <div class="head-label">
                        <h5 class="mb-0">New Data</h5>
                    </div>
                    <div class="text-right">
                        <div class="dt-buttons d-inline-flex"> 
                            <button class="dt-button btn-save btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#modals-slide-in">
                                Save Data
                            </button> 
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="spinner-container d-flex justify-content-center align-items-center" style="height:500px"></div>
                    <div class="table-responsive">
                        @php 
                            $totalheaders = count($header);
                            $widthtable = $totalheaders*20;
                            $widthpercent = $totalheaders/2;
                        @endphp
                        <table class="table table-import d-none" style="width:{{$widthtable}}% !important" data-file-id="{{$file_id}}">
                            <thead>
                                <tr>
                                    <th width="1%">
                                        <div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll"><label class="custom-control-label" for="checkboxSelectAll"></label></div>
                                    </th>
                                    <form>
                                    @foreach($header as $h)
                                        <th width="{{$widthpercent}}%">
                                            <select name="{{$h}}" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($header_options as $option)
                                                <option value="{{$option}}" @if($h==$option) selected @endif>{{$option}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                    @endforeach
                                    </form>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach($body as $k=>$b)
                                <tr>
                                    <td class="import-start-column">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" value="" id="checkbox{{$k}}">
                                            <label class="custom-control-label" for="checkbox{{$k}}"></label>
                                        </div>
                                        
                                    </td>
                                    @foreach($b as $col)
                                    <form>
                                        <td>
                                            <input type="text" name="fields[]" class="form-control" value="{{$col}}">
                                        </td>
                                    </form>
                                    @endforeach
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Invoice repeater -->
    </div>
</section> 

@endsection


@section('external_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
@endsection
@section('scripts')
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-leads-import.js')}}"></script>
@endsection