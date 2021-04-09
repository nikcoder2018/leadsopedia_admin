@extends('layouts.main')


@section('vendors_css')
@endsection
@section('external_css')
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset(env('APP_THEME','default').'/app-assets/css/pages/app-invoice.css')}}">
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
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
                            <div class="logo-wrapper mb-2">
                                <img src="{{asset(env('APP_THEME').'/images/logo-new-full.svg')}}" width="300">
                            </div>
                            <p class="card-text mb-25">Company #13145058</p>
                            <p class="card-text mb-25">Suite 9, 2 Bicycle Mews, London</p>
                            <p class="card-text mb-25">SW4 6FE, United Kingdom</p>
                            <p class="card-text mb-0">+44 20 7097 8642</p>
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="invoice-title">
                                Invoice
                                <span class="invoice-number">#{{$transaction->invoice_number}}</span>
                            </h4>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Date Issued:</p>
                                <p class="invoice-date">{{$transaction->created_at->format('d-m-Y')}}</p>
                            </div>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Due Date:</p>
                                <p class="invoice-date">{{$transaction->created_at->format('d-m-Y')}}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>

                <hr class="invoice-spacing" />

                <!-- Address and Contact starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row invoice-spacing">
                        <div class="col-xl-7 p-0">
                            <h6 class="mb-2">Invoice To:</h6>
                            <h6 class="mb-25">{{@$transaction->customer->name}}</h6>
                            <p class="card-text mb-25">{{@$transaction->customer->company}}</p>
                            <p class="card-text mb-25">{{@$transaction->customer->address}}</p>
                            <p class="card-text mb-25">{{@$transaction->customer->mobile}}</p>
                            <p class="card-text mb-0">{{@$transaction->customer->email}}</p>
                        </div>
                        <div class="col-xl-5 p-0 mt-xl-0 mt-2">
                            <h6 class="mb-2">Payment Details:</h6>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pr-1">Total Due:</td>
                                        <td><span class="font-weight-bold">{{App\Setting::GetValue('currency_symbol')}} {{$transaction->amount}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-1">Payment Gateway:</td>
                                        <td>{{$transaction->method->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="pr-1">Status:</td>
                                        <td>{{$transaction->status}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Address and Contact ends -->

                <!-- Invoice Description starts -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="py-1">Description</th>
                                <th class="py-1">Price</th>
                                <th class="py-1">Qty</th>
                                <th class="py-1">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-1">
                                    <p class="card-text font-weight-bold mb-25">{{$item->description}}</p>
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold">{{App\Setting::GetValue('currency_symbol')}} {{$item->amount}}</span>
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold">{{$item->qty}}</span>
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold">{{App\Setting::GetValue('currency_symbol')}} {{$item->amount}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-body invoice-padding">
                    <div class="row invoice-sales-total-wrapper">
                        <div class="col-md-12 d-flex justify-content-end order-md-2 order-1">
                            <div class="invoice-total-wrapper">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Subtotal:</p>
                                    <p class="invoice-total-amount">{{App\Setting::GetValue('currency_symbol')}} {{$item->amount}}</p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Discount:</p>
                                    <p class="invoice-total-amount">$0</p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Tax:</p>
                                    <p class="invoice-total-amount">0%</p>
                                </div>
                                <hr class="my-50" />
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Total:</p>
                                    <p class="invoice-total-amount">{{App\Setting::GetValue('currency_symbol')}} {{$item->amount}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Invoice Description ends -->
            </div>
        </div>
        <!-- /Invoice -->
        <div id="pdf-handler"></div>
        <!-- Invoice Actions -->
        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('transactions.download', $transaction->id)}}" class="btn btn-outline-primary btn-block btn-download-invoice mb-75" id="download-invoice"><i data-feather='download'></i> Download</a>
                </div>
            </div>
        </div>
        <!-- /Invoice Actions -->
    </div>
</section>
@endsection

@section('external_js')
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/extensions/moment.min.js')}}"></script>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/vendors/js/printThis/printThis.js')}}"></script>
<script src="{{asset(env('APP_THEME','default').'/app-assets/js/scripts/pages/app-transactions.js')}}"></script>
<script>
    var btnDownloadInvoice = $('#download-invoice'),
        btnPrintInvoice = $('#print-invoice');

    btnPrintInvoice.on('click', function() {
        $('.invoice-preview-card').printThis({
            debug: false, // show the iframe for debugging
            importCSS: true, // import parent page css
            importStyle: false, // import style tags
            printContainer: true, // print outer container/$.selector
            loadCSS: "", // path to additional css file - use an array [] for multiple
            pageTitle: "", // add title to print page
            removeInline: false, // remove inline styles from print elements
            removeInlineSelector: "*", // custom selectors to filter inline styles. removeInline must be true
            printDelay: 333, // variable print delay
            header: null, // prefix to html
            footer: null, // postfix to html
            base: false, // preserve the BASE tag or accept a string for the URL
            formValues: true, // preserve input/form values
            canvas: false, // copy canvas content
            doctypeString: '...', // enter a different doctype for older markup
            removeScripts: false, // remove script tags from print content
            copyTagClasses: false, // copy classes from the html & body tag
            beforePrintEvent: null, // function for printEvent in iframe
            beforePrint: null, // function called before iframe is filled
            afterPrint: null // function called before iframe is removed
        });
    });

    var doc = new jsPDF();
    var specialElementHandlers = {
        '#pdf-handler': function(element, renderer) {
            return true;
        }
    };
    btnDownloadInvoice.on('click', function() {
        doc.fromHTML($('.invoice-preview-card').html(), 15, 15, {
            'width': 170,
            'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });
</script>
@endsection