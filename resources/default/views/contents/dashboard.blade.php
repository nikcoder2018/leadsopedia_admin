@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
              <div class="highlight-icon bg-light mr-3">
                <i class="mdi mdi-cube text-success icon-lg"></i>
              </div>
              <div class="wrapper">
                <p class="card-text mb-0">Leads</p>
                <div class="fluid-container">
                  <h3 class="card-title mb-0">{{$totalLeads}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
              <div class="highlight-icon bg-light mr-3">
                <i class="mdi mdi-cloud-search-outline text-primary icon-lg"></i>
              </div>
              <div class="wrapper">
                <p class="card-text mb-0">Searches</p>
                <div class="fluid-container">
                  <h3 class="card-title mb-0">{{$totalSearches}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
              <div class="highlight-icon bg-light mr-3">
                <i class="mdi mdi-account-multiple text-danger icon-lg"></i>
              </div>
              <div class="wrapper">
                <p class="card-text mb-0">Customers</p>
                <div class="fluid-container">
                  <h3 class="card-title mb-0">{{$totalCustomers}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
              <div class="highlight-icon bg-light mr-3">
                <i class="mdi mdi-currency-usd text-info icon-lg"></i>
              </div>
              <div class="wrapper">
                <p class="card-text mb-0">Sales</p>
                <div class="fluid-container">
                  <h3 class="card-title mb-0">{{$totalSales}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Total Revenue</h5>
            <div class="w-75 mx-auto">
              <div class="d-flex justify-content-between text-center mb-2">
                <div class="wrapper">
                  <h4>6,256</h4>
                  <small class="text-muted">Totel sales</small>
                </div>
                <div class="wrapper">
                  <h4>8569</h4>
                  <small class="text-muted">Open Compaign</small>
                </div>
              </div>
            </div>
            <div id="morris-line-example" style="height:250px;"></div>
            <div class="w-75 mx-auto">
              <div class="d-flex justify-content-between text-center mt-5">
                <div class="wrapper">
                  <h4>5136</h4>
                  <small class="text-muted">Online Sales</small>
                </div>
                <div class="wrapper">
                  <h4>4596</h4>
                  <small class="text-muted">Store Sales</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Credits Status</h5>
            <div class="row border-bottom pb-3 mb-3">
              <div class="col-12 py-4 my-3">
                <canvas id="DashboardBarChart-1" style="height:100px"></canvas>
              </div>
              <div class="col-12 mt-3">
                <div class="d-flex align-items-end">
                  <h1 class="display-4 font-weight-semibold mb-0">{{$totalUnusedCredits}}</h1>
                  <h5 class="ml-3 mb-2">Total Left Credits</h5>
                </div>
                <p class="mt-0 mb-2">{{$totalCredits}} Total Credits Collected</p>
                <div class="d-flex align-items-center">
                  <div class="progress progress-md w-100 mr-3">
                    @php 
                      if($totalUnusedCredits > 0)
                      $unused_percent = ($totalUnusedCredits/$totalCredits)*100; 
                      else
                      $unused_percent = 0;
                    @endphp
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$unused_percent}}%" aria-valuenow="{{$unused_percent}}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mb-0">{{$unused_percent}}%</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="d-flex align-items-end">
                  <h1 class="display-4 font-weight-semibold mb-0">{{$totalUsedCredits}}</h1>
                  <h5 class="ml-3 mb-2">Total Used Credits</h5>
                </div>
                <p class="mt-0 mb-2">Credits used by users</p>
                <div class="d-flex align-items-center">
                  <div class="progress progress-md w-100 mr-3">
                    @php 
                    if($totalUsedCredits > 0)
                      $used_percent = ($totalUsedCredits/$totalUnusedCredits)*100; 
                    else
                      $used_percent = 0;
                    @endphp
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{$used_percent}}%" aria-valuenow="{{$used_percent}}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mb-0">{{$used_percent}}%</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <h5 class="card-title mb-0">New Accounts</h5>
              <small class="text-gray d-none d-sm-block">New registered was {{Carbon\Carbon::parse($lastAccountRegisteredDate)->diffForHumans()}}</small>
            </div>
            <div class="new-accounts">
              <ul class="chats">
                @if(count($newAccounts) > 0)
                  @foreach($newAccounts as $account)
                  <li class="chat-persons">
                    <a href="#">
                      <span class="pro-pic"><img src="https://placehold.it/100x100" alt="profile image"></span>
                      <div class="user">
                        <p class="u-name">{{$account->name}}</p>
                        <p class="u-designation">{{$account->email}}</p>
                      </div>
                      <p class="joined-date">{{Carbon\Carbon::parse($account->created_at)->diffForHumans()}}</p>
                    </a>
                  </li>
                  @endforeach
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Lastest Purchase</h5>
            <div class="table-responsive">
              <table class="table center-aligned-table">
                <thead>
                  <tr>
                    <th class="border-bottom-0">Invoice #</th>
                    <th class="border-bottom-0">Customer</th>
                    <th class="border-bottom-0">Subscription</th>
                    <th class="border-bottom-0">Payment Method</th>
                    <th class="border-bottom-0">Payment Status</th>
                    <th class="border-bottom-0">Amount</th>
                    <th class="border-bottom-0">Date</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($latestTransactions) > 0)
                    @foreach($latestTransactions as $transaction)
                    <tr>
                      <td>{{$transaction->invoice_number}}</td>
                      <td>{{$transaction->customer->name}}</td>
                      <td>{{$transaction->subscription->title}}</td>
                      <td>{{ucfirst($transaction->method->name)}}</td>
                      <td>
                        <label class="badge {{App\PaymentMethod::GetStatusBadge($transaction->status)}}">{{ucfirst($transaction->status)}}</label>
                      </td>
                      <td>{{$transaction->currency}}{{$transaction->amount}}</td>
                      <td>{{Carbon\Carbon::parse($transaction->created_at)->diffForHumans()}}</td>
                    </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('plugins_js')
<script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendors/raphael/raphael.min.js')}}"></script>
<script src="{{asset('vendors/morris.js/morris.min.js')}}"></script>
@endsection