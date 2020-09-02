@extends('layout.app')

@push('styles')
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.theme.default.min.css" />
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
@endpush

@section('title', 'Login')

@include('includes.breadcrumb')
<div class="w3layouts-breadcrumbs text-center">
    <div class="container">
        <span class="agile-breadcrumbs"><a href="/"><i class="fa fa-sign-in home_1"></i></a> / <span>Account Login</span></span>
    </div>
</div>

@section('content')

<div class="container" style="margin-top: 30px; margin-bottom: 30px;">
    <div id="login-signup-page" class="bg-light shadow-md rounded mx-auto p-4">
      
      <div class="tab-content pt-4">
          @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
          <form id="loginForm" method="post">
            {{csrf_field()}}
            
            <div class="form-group">
              <div id="login-msg" style="font-size: 10px !important; margin-bottom: 10px;"></div>
            </div>

            <div class="form-group">
              <label for="loginMobile">Mobile or Email ID</label>
              <input type="text" class="form-control" id="loginparam" name="loginparam" required placeholder="Mobile or Email ID">
            </div>

            <div class="form-group">
              <label for="loginPassword">Password</label>
              <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
            </div>

            <div class="row mb-4">
              <div class="col-sm">
                <div class="form-check custom-control custom-checkbox">
                  <input id="remember-me" name="remember" class="custom-control-input" type="checkbox">
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div>
              <div class="col-sm text-right"> <a class="justify-content-end" href="#">Forgot Password ?</a> </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Login</button>
          </form>
 
        <div class="d-flex align-items-center my-4">
          <hr class="flex-grow-1">
          <span class="mx-2">OR</span>
          <hr class="flex-grow-1">
        </div>
        <div class="form-row">
          
          <div class="col-sm-12">
            <a href="./signup" class="btn btn-block btn-sm btn-outline-danger shadow-none"><i class="fa fa-user"></i> Sign Up</a>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection

@push('scripts')
<script src="js/ajax.js"></script>

<script>
  $("#loginForm").submit(function (e) {
      e.preventDefault();
      submit_form('loginForm', "{{ route('login') }}", 'login-msg', true);
  });
</script>

@endpush