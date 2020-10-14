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
                  <h3 class="card-title mb-0">0</h3>
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
                <p class="card-text mb-0">Users</p>
                <div class="fluid-container">
                  <h3 class="card-title mb-0">0</h3>
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
                  <h3 class="card-title mb-0">0</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7 grid-margin stretch-card">
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
      <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-4">
              <h5 class="card-title mb-0">New Accounts</h5>
              <small class="text-gray d-none d-sm-block">Last activity was 2 days ago</small>
            </div>
            <div class="new-accounts">
              <ul class="chats">
                <li class="chat-persons">
                  <a href="#">
                    <span class="pro-pic"><img src="https://placehold.it/100x100" alt="profile image"></span>
                    <div class="user">
                      <p class="u-name">David</p>
                      <p class="u-designation">Python Developer</p>
                    </div>
                    <p class="joined-date">30 Mins ago</p>
                  </a>
                </li>
                <!-- list person -->
                <li class="chat-persons">
                  <a href="#">
                    <span class="pro-pic"><img src="https://placehold.it/100x100" alt="profile image"></span>
                    <div class="user">
                      <p class="u-name">Stella Johnson</p>
                      <p class="u-designation">SEO Expert</p>
                    </div>
                    <p class="joined-date">2 Days ago</p>
                  </a>
                </li>
                <!-- list person -->
                <li class="chat-persons">
                  <a href="#">
                    <span class="pro-pic"><img src="https://placehold.it/100x100" alt="profile image"></span>
                    <div class="user">
                      <p class="u-name">Marina Michel</p>
                      <p class="u-designation">Business Development</p>
                    </div>
                    <p class="joined-date">4 Days ago</p>
                  </a>
                </li>
                <!-- list person -->
                <li class="chat-persons">
                  <a href="#">
                    <span class="pro-pic"><img src="https://placehold.it/100x100" alt="profile image"></span>
                    <div class="user">
                      <p class="u-name">Edward Fletcher</p>
                      <p class="u-designation">UI/UX Designer</p>
                    </div>
                    <p class="joined-date">5 Days ago</p>
                  </a>
                </li>
                <!-- list person -->
                <li class="chat-persons">
                  <a href="#">
                    <span class="pro-pic"><img src="https://placehold.it/100x100" alt="profile image"></span>
                    <div class="user">
                      <p class="u-name">Allen Donald</p>
                      <p class="u-designation">UI/UX Designer</p>
                    </div>
                    <p class="joined-date">5 Days ago</p>
                  </a>
                </li>
                <!-- list person -->
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
                    <th class="border-bottom-0">ID</th>
                    <th class="border-bottom-0">Assignee</th>
                    <th class="border-bottom-0">Task Details</th>
                    <th class="border-bottom-0">Payment Method</th>
                    <th class="border-bottom-0">Payment Status</th>
                    <th class="border-bottom-0">Amount</th>
                    <th class="border-bottom-0">Tracking Number</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#320</td>
                    <td>Mark C.Diaz</td>
                    <td>Support of thteme</td>
                    <td>Credit card</td>
                    <td><label class="badge badge-success">Approved</label></td>
                    <td>$12,245</td>
                    <td>JPBBN435893458</td>
                  </tr>
                  <tr>
                    <td>#321</td>
                    <td>Jose D</td>
                    <td>Verify your email address !</td>
                    <td>Internet banking</td>
                    <td><label class="badge badge-warning">Pending</label></td>
                    <td>$12,245</td>
                    <td>BDYBN435893325</td>
                  </tr>
                  <tr>
                    <td>#322</td>
                    <td>Philips T</td>
                    <td>Item support message send</td>
                    <td>Credit card</td>
                    <td><label class="badge badge-success">Approved</label></td>
                    <td>$12,245</td>
                    <td>JSNTN435884258</td>
                  </tr>
                  <tr>
                    <td>#323</td>
                    <td>Luke Pixel</td>
                    <td>New submission on website</td>
                    <td>Cash on delivery</td>
                    <td><label class="badge badge-danger">Rejected</label></td>
                    <td>$12,245</td>
                    <td>JPABT435893678</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="d-flex align-items-center mt-4">
              <p class="mb-0 d-none d-md-block text-dark">Showing 1 to 20 of 20 entries</p>
              <ul class="pagination mb-0 ml-auto">
                <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-left"></i></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a></li>
              </ul>
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