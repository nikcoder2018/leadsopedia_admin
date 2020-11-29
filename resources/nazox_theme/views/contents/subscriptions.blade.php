@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <button type="button" class="btn btn-outline-info btn-fw btn-create"><i class="mdi mdi-upload"></i>Create</button>
            </div>
        </div>
        <div class="card-body">
            <h4 class="card-title">Subscription Plans</h4>
            <div class="row">
                <div class="col-12">
                    @if(count($plans) > 0)
                    <div class="table-responsive">
                        <table id="subscription-table" class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plans as $plan)
                                    <tr data-id="{{$plan->id}}">
                                        <td>{{$plan->title}}</td>
                                        <td>{{$plan->description}}</td>
                                        <td>{{$plan->months}} Month(s)</td>
                                        <td>{{App\Setting::GetValue('currency_symbol')}} {{$plan->price}}</td>
                                        <td>
                                            <a href="#" class="text-primary edit-subscription" data-id="{{$plan->id}}" data-toggle="tooltip" data-placement="left" title="Edit Data"><i class="mdi mdi-pencil icon-md"></i></a>
                                            <a href="#" class="text-danger delete-subscription" data-id="{{$plan->id}}" data-toggle="tooltip" data-placement="left" title="Delete Data"><i class="mdi mdi-delete icon-md"></i></a>                    
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else 
                    <h5>There's no subscription plans created yet!</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<div class="modal fade" id="createSubscriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Create subscription plan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-create-subscription" action="{{route('subscriptions.store')}}" method="POST">
            @csrf
            <div class="modal-body pt-0">
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
                        <label for="months">Months <sup>*</sup></label>
                        <input type="number" class="form-control" name="months" placeholder="Subscription Duration">
                    </div>
                    <div class="col">
                        <label for="price">Price <sup>*</sup></label>
                        <input type="number" class="form-control" name="price" step="0.01" placeholder="Amount">
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
                <div class="card px-3">
                    <div class="card-body">
                        <h4 class="card-title">Priviledges</h4>
                        <div class="add-items d-flex">
                            <input type="text" class="form-control priviledges-list-input"  placeholder="Whare are the features included to this plan?">
                            <button class="add btn btn-primary font-weight-bold priviledges-list-add-btn" id="add-task">Add</button>
                        </div>
                        <div class="list-wrapper">
                            <ul class="d-flex flex-column-reverse priviledges-list">
                                
                            </ul>
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
                    <label for="description">Description <sup>*</sup></label>
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
                <div class="card px-3">
                    <div class="card-body">
                        <h4 class="card-title">Priviledges</h4>
                        <div class="add-items d-flex">
                            <input type="text" class="form-control priviledges-list-input"  placeholder="Whare are the features included to this plan?">
                            <button class="add btn btn-primary font-weight-bold priviledges-list-add-btn" id="add-task">Add</button>
                        </div>
                        <div class="list-wrapper">
                            <ul class="d-flex flex-column-reverse priviledges-list">
                                
                            </ul>
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

@section('scripts')
    <script>
        $('.btn-create').on('click', function(){
            $('#createSubscriptionModal').modal('toggle');
            let form = $('#form-create-subscription');
            let priviledges_list = form.find('.priviledges-list');
            priviledges_list.empty();
        });
        $('#form-create-subscription').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data:  $(this).serialize(),
                success: function(resp){
                    if(resp.success){
                        $('#createSubscriptionModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: resp.msg,
                            icon: 'Success'
                        }).then(()=>{
                            var tbody = $('#subscription-table tbody');
                            tbody.append(`
                                <tr data-id="${resp.details.id}">
                                    <td>${resp.details.title}</td>
                                    <td>${resp.details.description}</td>
                                    <td>${resp.details.months} Month(s)</td>
                                    <td>${resp.currency} ${resp.details.price}</td>
                                    <td>
                                        <a href="#" class="text-primary edit-subscription" data-id="${resp.details.id}" data-toggle="tooltip" data-placement="left" title="Edit Data"><i class="mdi mdi-pencil icon-md"></i></a>
                                        <a href="#" class="text-danger delete-subscription" data-id="${resp.details.id}" data-toggle="tooltip" data-placement="left" title="Delete Data"><i class="mdi mdi-delete icon-md"></i></a>                    
                                    </td>
                                </tr>
                            `).fadeIn(300);
                        });
                    }else{
                        Swal.fire({
                            title: 'Failed',
                            text: resp.msg,
                            icon: 'error'
                        });
                    }
                },
                error: function(resp){
                    let form = $('#form-create-subscription');
                    $.each(resp.responseJSON.errors, function(name, error){
                        form.find('#input-'+name).siblings('.invalid-feedback').remove();
                        form.find('#input-'+name).siblings('.valid-feedback').remove();
                        form.find('#input-'+name).siblings('.invalid-feedback.valid-feedback').remove();
                        form.find('#input-'+name).addClass('is-invalid');
                        form.find('#input-'+name).after(`
                            <div class="invalid-feedback">
                            ${error}
                            </div>
                        `);
                    });
                }
            });
        });

        $('#subscription-table').on('click', '.edit-subscription',async function(){
            let form = $('#form-edit-subscription');
            let priviledges_list = form.find('.priviledges-list');
            let modal = $('#editSubscriptionModal');
            let subplan_id = $(this).data('id');
            let subscription = await $.ajax({
                url: "{{route('subscriptions.edit')}}",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: subplan_id
                }
            });
            modal.modal('show');
            priviledges_list.empty();

            form.find('input[name=id]').val(subscription.id);
            form.find('input[name=title]').val(subscription.title);
            form.find('textarea[name=description]').val(subscription.description);
            form.find('input[name=months]').val(subscription.months);
            form.find('input[name=price]').val(subscription.price);
            form.find('input[name=search_limits]').val(subscription.search_limits);
            form.find('input[name=search_leads_limits]').val(subscription.search_leads_limits);
            form.find('input[name=credits]').val(subscription.credits);
            form.find('input[name=css_class]').val(subscription.css_class);
            form.find('input[name=css_btn_class]').val(subscription.css_btn_class);
            
            $.each(subscription.priviledges, function(index, item){
                let checked = '';
                if(item.enabled == 1){
                    checked = 'checked'
                }
                priviledges_list.append(`
                    <li counter='${index}'>
                        <div class='form-check'>
                            <input type='hidden' name='priviledges[${index}][description]' value='${item.description}'/>
                            <label class='form-check-label'><input class='checkbox' ${checked} name='priviledges[${index}][enabled]' type='checkbox'/>${item.description}<i class='input-helper'></i></label>
                        </div>
                        <i class='remove mdi mdi-close-circle-outline'></i>
                    </li>
                `);
            });
        });

        $('#form-edit-subscription').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data:  $(this).serialize(),
                success: function(resp){
                    if(resp.success){
                        $('#editSubscriptionModal').modal('hide');
                        Swal.fire({
                            title: 'Success!',
                            text: resp.msg,
                            icon: 'success'
                        }).then(()=>{
                            var tbody = $('#subscription-table tbody');
                            tbody.append(`
                                <tr data-id="${resp.details.id}">
                                    <td>${resp.details.title}</td>
                                    <td>${resp.details.description}</td>
                                    <td>${resp.details.months} Month(s)</td>
                                    <td>${resp.currency} ${resp.details.price}</td>
                                    <td>
                                        <a href="#" class="text-primary edit-subscription" data-id="${resp.details.id}" data-toggle="tooltip" data-placement="left" title="Edit Data"><i class="mdi mdi-pencil icon-md"></i></a>
                                        <a href="#" class="text-danger delete-subscription" data-id="${resp.details.id}" data-toggle="tooltip" data-placement="left" title="Delete Data"><i class="mdi mdi-delete icon-md"></i></a>                    
                                    </td>
                                </tr>
                            `).fadeIn(300);
                        });
                    }else{
                        Swal.fire({
                            title: 'Failed',
                            text: resp.msg,
                            icon: 'error'
                        });
                    }
                },
                error: function(resp){
                    let form = $('#form-edit-subscription');
                    $.each(resp.responseJSON.errors, function(name, error){
                        form.find('#input-'+name).siblings('.invalid-feedback').remove();
                        form.find('#input-'+name).siblings('.valid-feedback').remove();
                        form.find('#input-'+name).siblings('.invalid-feedback.valid-feedback').remove();
                        form.find('#input-'+name).addClass('is-invalid');
                        form.find('#input-'+name).after(`
                            <div class="invalid-feedback">
                            ${error}
                            </div>
                        `);
                    });
                }
            });
        });

        $('#subscription-table').on('click','.delete-subscription', function(){
            let subplan_id = $(this).data('id');
            Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this plan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        let goDelete = await $.ajax({
                            url: "{{route('subscriptions.destroy')}}",
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: subplan_id
                            }
                        });

                        if(goDelete.success){
                            Swal.fire({
                                title: "Success!",
                                text: goDelete.msg,
                                icon: "success",
                            }).then(()=>{
                                var tbody = $('#subscription-table tbody');
                                tbody.find('tr[data-id='+goDelete.id+']').hide().fadeOut(1000);
                            });
                        }else{
                            Swal.fire('Failed',goDelete.msg,'error');
                        }
                        
                    }
            });
        });
    </script>
@endsection