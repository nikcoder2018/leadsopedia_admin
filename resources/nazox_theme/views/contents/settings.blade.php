@extends('layouts.main')
@section('plugins_css')
<link rel="stylesheet" href="{{asset('vendors/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Settings</h4>
          <div class="row ml-md-0 mr-md-0 vertical-tab tab-minimal">
            <ul class="nav nav-tabs col-md-3 justify-content-start" role="tablist">
              <li class="nav-item mb-3">
                <a class="nav-link active" id="tab-2-1" data-toggle="tab" href="#general" role="tab" aria-controls="general-2-1" aria-selected="false"><i class="mdi mdi-speedometer"></i>General</a>
              </li>
              <li class="nav-item mb-3">
                <a class="nav-link" id="tab-2-2" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications-2-2" aria-selected="false"><i class="mdi mdi-bell-outline"></i>Notifications</a>
              </li>
              <li class="nav-item mb-3">
                <a class="nav-link" id="tab-2-3" data-toggle="tab" href="#emailverification-api" role="tab" aria-controls="emailverification-api-2-3" aria-selected="false"><i class="mdi mdi-email"></i>Email Verification APIs</a>
              </li>
              <li class="nav-item mb-3">
                <a class="nav-link" id="tab-2-4" data-toggle="tab" href="#integrations" role="tab" aria-controls="integrations-2-4" aria-selected="true"><i class="mdi mdi-swap-horizontal-variant"></i>Integrations</a>
              </li>
              <li class="nav-item mb-3">
                <a class="nav-link" id="tab-2-5" data-toggle="tab" href="#payments" role="tab" aria-controls="payments-2-5" aria-selected="false"><i class="mdi mdi-lightbulb-outline"></i>Payments</a>
              </li>
            </ul>
            <div class="tab-content col-md-9">
              <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="tab-2-1">
                <div class="row">
                  <div class="col-md-12">
                    <form class="form-settings-general" action="{{route('settings.general.update')}}">
                      @csrf
                      <div class="form-group">
                        <label for="landing_web_title">Landing Web Title</label>
                        <input type="text" class="form-control" name="landing_web_title" value="{{App\Setting::GetValue('landing_web_title')}}" placeholder="E.g Leadsopedia">
                      </div>
                      <div class="form-group">
                        <label for="front_web_title">Clients Web Title</label>
                        <input type="text" class="form-control" name="front_web_title" value="{{App\Setting::GetValue('front_web_title')}}" placeholder="E.g Leadsopedia">
                      </div>
                      <div class="form-group">
                        <label for="backoffice_web_title">Backoffice Web Title</label>
                        <input type="text" class="form-control" name="backoffice_web_title" value="{{App\Setting::GetValue('backoffice_web_title')}}" placeholder="E.g Leadsopedia">
                      </div>
                      <div class="form-group">
                        <label>Language</label>
                        <select class="select2-language" name="language" style="width:100%">
                          @foreach($languages as $language)
                              <option @if(App\Setting::GetValue('language') == $language->code) selected @endif value="{{$language->code}}">{{$language->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Currency</label>
                        <select class="select2-language" name="currency" style="width:100%">
                          @foreach($currencies as $currency)
                              <option @if(App\Setting::GetValue('currency') == $currency->abbreviation) selected @endif value="{{$currency->abbreviation}}">{{$currency->currency}} ({!!$currency->symbol!!})</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>TimeZone</label>
                        <select class="select2-language" name="timezone" style="width:100%">
                          @foreach($timezones as $timezone)
                              <option @if(App\Setting::GetValue('timezone') == $timezone->value) selected @endif value="{{$timezone->value}}">{{$timezone->text}}</option>
                          @endforeach
                        </select>
                      </div>
                      <button type="submit" class="btn btn-success mr-2">Save</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="tab-2-2">

              </div>
              <div class="tab-pane fade" id="emailverification-api" role="tabpanel" aria-labelledby="tab-2-3">

              </div>
              <div class="tab-pane fade" id="integrations" role="tabpanel" aria-labelledby="tab-2-4">
                <div class="float-right">
                  <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#updateIntegrationGroupModal"><i class="mdi mdi-plus"></i>Groups</button>
                  <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#addIntegrationModal"><i class="mdi mdi-plus"></i>Add</button>
                </div>
                <table class="table table-integrations">
                  <thead>
                    <tr>
                      <th>Integrations</th>
                      <th>Group</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($integrations as $integration)
                    <tr>
                      <td>{{ucfirst($integration->name)}}</td>
                      <td>{{ucfirst(@$integration->group->name ?? 'None')}}</td>
                      <td>{{ucfirst($integration->status)}}</td>
                      <td>
                          <a href="#" class="text-primary edit-integration" data-id="{{$integration->id}}" data-toggle="tooltip" data-placement="left" title="Edit Integration"><i class="mdi mdi-pencil icon-md"></i></a>
                          <a href="#" class="text-danger delete-integration" data-id="{{$integration->id}}" data-toggle="tooltip" data-placement="left" title="Delete Integration"><i class="mdi mdi-delete icon-md"></i></a>                    
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>  
              <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="tab-2-5">
                <div class="float-right">
                  <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#addPaymentMethodModal"><i class="mdi mdi-plus"></i>Add</button>
                </div>
                <table class="table table-payments">
                  <thead>
                    <tr>
                      <th>Payment Methods</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($payment_methods as $method)
                    <tr>
                      <td>{{ucfirst($method->name)}}</td>
                      <td>
                          <a href="#" class="text-primary edit-paymentmethod" data-id="{{$method->id}}" data-toggle="tooltip" data-placement="left" title="Edit Payment Method"><i class="mdi mdi-pencil icon-md"></i></a>
                          <a href="#" class="text-danger delete-paymentmethod" data-id="{{$method->id}}" data-toggle="tooltip" data-placement="left" title="Delete Payment Method"><i class="mdi mdi-delete icon-md"></i></a>                    
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('modals')
  @include('modals.payment-methods')
  @include('modals.integrations', ['groups' => $integration_groups])
@endsection
@section('plugins_js')
<script src="{{asset('vendors/select2/select2.min.js')}}"></script>
@endsection

@section('scripts')
    <script>
        $(".select2-language").select2();

        $('.form-settings-general').on('submit', function(e){
          e.preventDefault();
          $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                if(resp.success){
                  Swal.fire({
                    title: 'Success!',
                    text: resp.msg,
                    icon: 'success'
                  });
                } 
            }
          });
        });

        $('.attributes-list-add-btn').on('click', function(){
          let lists = $('.attribute-lists');
          lists.append(`
            <div class="list-items d-flex mb-2">
              <input type="text" style="width:30% !important" name="attributes[${lists.find('.list-items').length}][name]" class="form-control" placeholder="Name" required>
              <input type="text" style="width:70% !important" name="attributes[${lists.find('.list-items').length}][value]" class="form-control" placeholder="Value" required>
              <button class="btn btn-sm btn-danger btn-delete" type="button"><i class="fa fa-trash"></i></button>
            </div>
          `);
        });

        $('.attribute-lists').on('click', '.btn-delete', function(){
            $(this).parent().remove();
        });
    </script>
    @include('scripts.payment-methods')
    @include('scripts.integrations')
@endsection