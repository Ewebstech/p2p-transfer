@extends('layout.app')

@push('styles')
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.theme.default.min.css" />
  <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
@endpush

@section('title', 'Sign Up')

@include('includes.breadcrumb')
<div class="w3layouts-breadcrumbs text-center">
    <div class="container">
        <span class="agile-breadcrumbs"><a href="/"><i class="fa fa-user home_1"></i></a> / <span>Signup</span></span>
    </div>
</div>

@section('content')

<div class="container" style="margin-top: 30px; margin-bottom: 30px;">
    <div id="login-signup-page" class="bg-light shadow-md rounded mx-auto p-4">
      
      <div class="tab-content pt-4">

        <div class="form-group">
          <div style="font-size: 24px !important; margin-bottom: 10px; font-weight: 700;">Blossom Pay NG</div>
          <hr>
        </div>
       
          <form id="registration" action="#"  method="post">
            
            {{csrf_field()}}
            
            <div class="form-group">
              <div id="reg-msg" style="font-size: 10px !important; margin-bottom: 10px;"></div>
            </div>

            <div class="form-group">
              <label for="loginMobile">Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" required placeholder="First & Last Name">
            </div>

            <div class="form-group">
              <label for="loginMobile">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" required placeholder="Email Address">
            </div>

            <div class="form-group">
              <label for="loginMobile">Mobile Number</label>
              <input type="number" class="form-control" id="phonenumber" name="phonenumber" required placeholder="Mobile Number">
            </div>

            <div class="form-group">
              <label for="loginPassword">Password</label>
              <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
            </div>

            <div class="form-group">
              <label for="loginPassword">Re-Type Password</label>
              <input type="password" class="form-control" id="retypepassword" name="retypepassword" required placeholder="Retype Password">
            </div>
        
            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-user"></i> Sign Up</button>

          </form>
 
        <div class="d-flex align-items-center my-4">
          <hr class="flex-grow-1">
          <span class="mx-2">OR</span>
          <hr class="flex-grow-1">
        </div>
        <div class="form-row">
          
          <div class="col-sm-12">
            <a href="./login" class="btn btn-block btn-sm btn-outline-danger shadow-none"><i class="fa fa-sign-in"></i> Sign In</a>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection




@push('scripts')

  <script src="js/ajax.js"></script>

  <script>
    $("#registration").submit(function (e) {
        e.preventDefault();
        submit_reg_form('registration', "{{ route('signup') }}", 'reg-msg', true);
    });
  </script>

  {{-- <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/owl.carousel/owl.carousel.min.js"></script> 
  <script src="js/theme.js"></script>  --}}


@endpush