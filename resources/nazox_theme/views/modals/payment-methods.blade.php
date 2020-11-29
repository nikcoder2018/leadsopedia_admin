<div class="modal fade" id="addPaymentMethodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 650px !important" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Add Payment Method</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-add-payment" action="{{route('payment-methods.store')}}" method="POST">
            @csrf
            <div class="modal-body pt-0">
                <div class="form-group">
                    <label for="title">Name <sup>*</sup></label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Attributes</h4>
                        <div class="add-items d-flex">
                            <button type="button" class="add btn btn-primary font-weight-bold attributes-list-add-btn">Add</button>
                        </div>
                        <div class="list-wrapper attribute-lists">
  
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
  <div class="modal fade" id="editPaymentMethodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 650px !important" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Edit Payment Method</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-edit-payment" action="{{route('payment-methods.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-body pt-0">
                <div class="form-group">
                    <label for="title">Name <sup>*</sup></label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Attributes</h4>
                        <div class="add-items d-flex">
                            <button type="button" class="add btn btn-primary font-weight-bold attributes-list-add-btn">Add</button>
                        </div>
                        <div class="list-wrapper attribute-lists">
  
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