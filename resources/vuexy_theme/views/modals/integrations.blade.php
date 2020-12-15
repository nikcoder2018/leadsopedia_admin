<div class="modal fade" id="addIntegrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 650px !important" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Add Integration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-add-integration" action="{{route('integrations.store')}}" method="POST">
            @csrf
            <div class="modal-body pt-0">
                <div class="form-group">
                    <label for="title">Name <sup>*</sup></label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="title">App Key <sup>*</sup></label>
                    <input type="text" class="form-control" name="app_key" placeholder="app_key" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="group_id">Group</label>
                        <select name="group_id" class="form-control">
                            <option value="">Select Group</option>
                            @foreach($groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="scope">Scope</label>
                        <select name="scope" class="form-control">
                            <option value="backend">Backend</option>
                            <option value="frontend">Frontend</option>
                        </select>
                    </div>
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

<div class="modal fade" id="editIntegrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 650px !important" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Edit Integration</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-edit-integration" action="{{route('integrations.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-body pt-0">
                <div class="form-group">
                    <label for="title">Name <sup>*</sup></label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="title">App Key <sup>*</sup></label>
                    <input type="text" class="form-control" name="app_key" placeholder="app_key" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" cols="30" rows="6" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label for="group_id">Group</label>
                        <select name="group_id" class="form-control">
                            <option value="">Select Group</option>
                            @foreach($integration_groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="scope">Scope</label>
                        <select name="scope" class="form-control">
                            <option value="backend">Backend</option>
                            <option value="frontend">Frontend</option>
                        </select>
                    </div>
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

<div class="modal fade" id="updateIntegrationGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 650px !important" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel-2">Groups</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-update-integrationgroup" action="{{route('integrationgroups.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-body pt-0">
                <div class="card">
                    <div class="card-body">
                        <div class="add-items d-flex">
                            <input type="text" class="form-control integrations-group-list-input"  placeholder="Name">
                            <button class="add btn btn-primary font-weight-bold integrations-group-list-add-btn">Add</button>
                        </div>
                        <div class="list-wrapper">
                            <ul class="d-flex flex-column-reverse integrations-group-list">
                                @php $counter = 0; @endphp
                                @foreach($groups as $group)
                                <li counter="{{$counter++}}" class='justify-content-between'>
                                    <div style='width:80%'>
                                        <input type='hidden' class='form-control' name='id' value='{{$group->id}}'/>
                                        <input type='hidden' class='form-control' name='name' value='{{$group->name}}'/>
                                        <label class='form-check-label'>{{$group->name}}<i class='input-helper'></i></label>
                                    </div>
                                    <div>
                                        <i class='save mdi mdi-checkbox-marked-circle-outline' style='display:none'></i>
                                        <i class='edit mdi mdi-pencil-circle-outline'></i>
                                        <i class='remove mdi mdi-close-circle-outline'></i>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>

