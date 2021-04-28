@extends('layouts.pdf')

@section('content')
<div class="card invoice-preview-card">
    <div class="card-body invoice-padding pb-0">
        <!-- Header starts -->
        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
            <div>
                <div class="logo-wrapper mb-2">
                    <img src="http://localhost:8082/vuexy_theme/images/logo-new-full.svg" width="300">
                </div>
                <p class="card-text mb-25">Company #13145058</p>
                <p class="card-text mb-25">Suite 9, 2 Bicycle Mews, London</p>
                <p class="card-text mb-25">SW4 6FE, United Kingdom</p>
                <p class="card-text mb-0">+44 20 7097 8642</p>
            </div>
            <div class="mt-md-0 mt-2">
                <h4 class="invoice-title">
                    Invoice
                    <span class="invoice-number">#20210001</span>
                </h4>
                <div class="invoice-date-wrapper">
                    <p class="invoice-date-title">Date Issued:</p>
                    <p class="invoice-date">27-01-2021</p>
                </div>
                <div class="invoice-date-wrapper">
                    <p class="invoice-date-title">Due Date:</p>
                    <p class="invoice-date">27-01-2021</p>
                </div>
            </div>
        </div>
        <!-- Header ends -->
    </div>

    <hr class="invoice-spacing">

    <!-- Address and Contact starts -->
    <div class="card-body invoice-padding pt-0">
        <div class="row invoice-spacing">
            <div class="col-xl-7 p-0">
                <h6 class="mb-2">Invoice To:</h6>
                <h6 class="mb-25">Nick Jay Baguio</h6>
                <p class="card-text mb-25">nikcoder.com</p>
                <p class="card-text mb-25"></p>
                <p class="card-text mb-25"></p>
                <p class="card-text mb-0">b.nickjay05@gmail.com</p>
            </div>
            <div class="col-xl-5 p-0 mt-xl-0 mt-2">
                <h6 class="mb-2">Payment Details:</h6>
                <table>
                    <tbody>
                        <tr>
                            <td class="pr-1">Total Due:</td>
                            <td><span class="font-weight-bold">$ 30</span></td>
                        </tr>
                        <tr>
                            <td class="pr-1">Payment Gateway:</td>
                            <td>stripe</td>
                        </tr>
                        <tr>
                            <td class="pr-1">Status:</td>
                            <td>succeeded</td>
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
                        <p class="card-text font-weight-bold mb-25"></p>
                    </td>
                    <td class="py-1">
                        <span class="font-weight-bold">$ 30</span>
                    </td>
                    <td class="py-1">
                        <span class="font-weight-bold">0</span>
                    </td>
                    <td class="py-1">
                        <span class="font-weight-bold">$ 30</span>
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
                        <p class="invoice-total-amount">$ 30</p>
                    </div>
                    <div class="invoice-total-item">
                        <p class="invoice-total-title">Discount:</p>
                        <p class="invoice-total-amount">$0</p>
                    </div>
                    <div class="invoice-total-item">
                        <p class="invoice-total-title">Tax:</p>
                        <p class="invoice-total-amount">0%</p>
                    </div>
                    <hr class="my-50">
                    <div class="invoice-total-item">
                        <p class="invoice-total-title">Total:</p>
                        <p class="invoice-total-amount">$ 30</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Invoice Description ends -->
</div>
@endsection