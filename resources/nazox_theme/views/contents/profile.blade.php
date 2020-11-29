@extends('layouts.main')
@section('stylesheets')
    <style>
        .profile-options{
            position: absolute;
            bottom: 0;
            right: 0;
        }
        .profile-info{
            position: absolute;
            bottom: 0;
        }
        .profile-header{
            position: relative;
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row profile-page">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            @php 
              if(auth()->user()->cover != null)
              $coverImage = asset(auth()->user()->cover);
              else 
              $coverImage = 'https://placehold.it/1055x215';
            @endphp
            <div class="profile-header text-white" style="background: url({{$coverImage}}) no-repeat center center">
              <div class="d-flex justify-content-start">
                <div class="profile-info d-flex align-items-center">
                    @if(auth()->user()->avatar != null)
                        <img class="rounded-circle img-lg" src="{{asset(auth()->user()->avatar)}}" alt="profile image">
                    @else 
                        <img class="rounded-circle img-lg" src="https://placehold.it/100x100" alt="profile image">
                    @endif
                  <div class="wrapper pl-4">
                    <p class="profile-user-name">{{auth()->user()->name}}</p>
                    <div class="wrapper d-flex align-items-center">
                      <p class="profile-user-designation">Admin</p>
                    </div>
                  </div>
                </div>
                <div class="profile-options">
                    <button class="btn btn-primary btn-sm" id="btn-change-avatar" data-toggle="tooltip" data-placement="left" title="Change Avatar"><i class="fa fa-camera"></i></button>
                    <button class="btn btn-primary btn-sm" id="btn-change-cover" data-toggle="tooltip" data-placement="left" title="Change Cover Photo"><i class="fa fa-camera-retro"></i></button>
                    <button class="btn btn-primary btn-sm btn-change-password" data-toggle="tooltip" data-placement="left" title="Change Password"><i class="fa fa-lock"></i></button>
                    <button class="btn btn-primary btn-sm" id="btn-update-profile" data-toggle="tooltip" data-placement="left" title="Update Profile"><i class="fa fa-user"></i></button>
                </div>
              </div>
            </div>
            <div class="profile-body">
              <ul class="nav tab-switch" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="user-profile-info-tab" data-toggle="pill" href="#user-profile-info" role="tab" aria-controls="user-profile-info" aria-selected="true">Profile</a>
                </li>
              </ul>
              <div class="row">
                <div class="col-md-9">
                  <div class="tab-content tab-body" id="profile-log-switch">
                    <div class="tab-pane fade show active pr-3" id="user-profile-info" role="tabpanel" aria-labelledby="user-profile-info-tab">
                      <table class="table table-borderless w-100 mt-4">
                        <tr>
                          <td><strong>Name :</strong> {{auth()->user()->name}}</td>
                          <td><strong>Email :</strong> {{auth()->user()->email}}</td>
                        </tr>
                        <tr>
                          <td><strong>Status :</strong> {{auth()->user()->status}}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>    
@endsection
<div class="modal fade" id="changeAvatarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel-2">Change Avatar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="form-change-avatar" action="{{route('profile.change.avatar')}}" method="POST">
          @csrf
          <div class="modal-body">
              <div class="row portfolio-grid">
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                  <input type="file" name="image" class="input-change-avatar" />
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                  <figure class="avatar-preview">
                    @if(auth()->user()->avatar != null)
                      <img src="{{asset(auth()->user()->avatar)}}" alt="image">
                    @else 
                      <img src="https://placehold.it/300x300" alt="image">
                    @endif
                  </figure>
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
<div class="modal fade" id="changeCoverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel-2">Change Cover</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="form-change-cover" action="{{route('profile.change.cover')}}" method="POST">
          @csrf
          <div class="modal-body">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <input type="file" name="image" class="input-change-cover" />
                </div>
              </div>
              <div class="row portfolio-grid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                  <figure class="cover-preview">
                    @if(auth()->user()->cover != null)
                    <img src="{{asset(auth()->user()->cover)}}" alt="image">
                    @else 
                      <img src="https://placehold.it/1055x215" alt="image">
                    @endif
                  </figure>
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

<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel-2">Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="form-update-profile" action="{{route('profile.update')}}" method="POST">
          @csrf
          <div class="modal-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{auth()->user()->name}}">
              </div>
              <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email"  value="{{auth()->user()->email}}">
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
@section('modals')
    
@endsection
@section('scripts')
<script src="{{asset('js/tooltips.js')}}"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip();

    $('#btn-change-avatar').on('click', function(){
      let changeAvatarModal = $('#changeAvatarModal');
      changeAvatarModal.modal('toggle');
    });
    $('#btn-change-cover').on('click', function(){
      let changeCoverModal = $('#changeCoverModal');
      changeCoverModal.modal('toggle');
    });
    
    $('#btn-update-profile').on('click', function(){
      let updateProfileModal = $('#updateProfileModal');
      updateProfileModal.modal('toggle');
    });

    $('#form-change-avatar').on('submit', function(e){
      e.preventDefault();
      $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data:  new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          success: function(resp){
            if(resp.success){
              $('#changeAvatarModal').modal('hide');
              Swal.fire(
                  'Success!',
                  resp.msg,
                  'success'
              ).then(result=>{
                  if(result){
                     location.reload();
                  }
              });
            }
          }
      })
    });
    $('#form-change-cover').on('submit', function(e){
      e.preventDefault();
      $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data:  new FormData(this),
          contentType: false,
          cache: false,
          processData:false,
          success: function(resp){
            if(resp.success){
              $('#changeCoverModal').modal('hide');
              Swal.fire(
                  'Success!',
                  resp.msg,
                  'success'
              ).then(result=>{
                  if(result){
                     location.reload();
                  }
              });
            }
          }
      })
    });
    
    $('#form-update-profile').on('submit', function(e){
      e.preventDefault();
      $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data:  $(this).serialize(),
          success: function(resp){
            if(resp.success){
              $('#updateProfileModal').modal('hide');
              Swal.fire(
                  'Success!',
                  resp.msg,
                  'success'
              ).then(result=>{
                  if(result){
                     location.reload();
                  }
              });
            }
          },
          error: function(resp){
            let form = $('#form-update-profile')
            $.each(resp.responseJSON.errors, function(name, error){
                form.find('#'+name).siblings('.invalid-feedback').remove();
                form.find('#'+name).siblings('.valid-feedback').remove();
                form.find('#'+name).siblings('.invalid-feedback.valid-feedback').remove();
                form.find('#'+name).addClass('is-invalid');
                form.find('#'+name).after(`
                    <div class="invalid-feedback">
                    ${error}
                    </div>
                `);
            });
          }
      });
    });

    $('.input-change-avatar').on('change', function(){
        var fileUpload = $(this).get(0).files;
        readURL(this, ".avatar-preview img");
    });
    $('.input-change-cover').on('change', function(){
        var fileUpload = $(this).get(0).files;
        readURL(this, ".cover-preview img");
    });
    //Preview image
    function readURL(inputFile, imgId) {
        if (inputFile.files && inputFile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(imgId).attr('src', e.target.result);
            }
            reader.readAsDataURL(inputFile.files[0]);
        }
    }
</script>
@endsection