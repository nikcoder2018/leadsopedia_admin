@extends('layouts.auth')

@section('content')
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth theme-one">
      <div class="row w-100">
        <div class="col-lg-4 mx-auto">
        <h2 class="text-center mb-4">Login</h2>
          <div class="auto-form-wrapper">
            <form method="POST" action="{{ route('login') }}">
                @csrf
              <div class="form-group">
                <label class="label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <label class="label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="************" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="form-group">
                <button class="btn btn-primary submit-btn btn-block">Login</button>
              </div>
              <div class="form-group d-flex justify-content-between">
                <div class="form-check form-check-flat mt-0">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" checked>
                    Keep me signed in
                  </label>
                </div>
                <a href="{{ route('password.request') }}" class="text-small forgot-password text-black">Forgot Password</a>
              </div>
            </form>
          </div>
          <ul class="auth-footer">
            <li><a href="#">Conditions</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="#">Terms</a></li>
          </ul>
          <p class="footer-text text-center">Copyright © {{date('Y')}} Leadsopedia. All rights reserved.</p>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
</div>
<!-- page-body-wrapper ends -->
@endsection
