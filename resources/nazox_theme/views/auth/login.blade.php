@extends('layouts.auth')

@section('content')
<div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
  <div class="w-100">
      <div class="row justify-content-center">
          <div class="col-lg-9">
              <div>
                  <div class="text-center">
                      <div>
                          <a href="{{route('home')}}" class="logo"><img src="{{asset('images/logo-default.png')}}" height="20" alt="logo"></a>
                      </div>

                      <h4 class="font-size-18 mt-4">Welcome Back!</h4>
                      <p class="text-muted">Sign in to Leasopedia Admin Panel</p>
                  </div>

                  <div class="p-2 mt-5">
                      <form class="form-horizontal" method="POST" action="{{route('login')}}">
                        @csrf
                          <div class="form-group auth-form-group-custom mb-4">
                              <i class="ri-user-2-line auti-custom-input-icon"></i>
                              <label for="email">Email</label>
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
  
                          <div class="form-group auth-form-group-custom mb-4">
                              <i class="ri-lock-2-line auti-custom-input-icon"></i>
                              <label for="password">Password</label>
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
  
                          <div class="custom-control custom-checkbox">
                              <input type="checkbox" name="remember_me" value="1" class="custom-control-input" id="customControlInline">
                              <label class="custom-control-label" for="customControlInline">Remember me</label>
                          </div>

                          <div class="mt-4 text-center">
                              <button type="submit" class="btn btn-primary w-md waves-effect waves-light">Log In</button>
                          </div>

                          <div class="mt-4 text-center">
                              <a href="{{route('password.request')}}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                          </div>
                      </form>
                  </div>

                  <div class="mt-5 text-center">
                      <p>© {{date('Y')}} Leadsopedia.com | All Rights Reserved.</p>
                  </div>
              </div>

          </div>
      </div>
  </div>
</div>
@endsection
