@extends('layout.app')

@section('title', 'Change Password')

@push('styles')

<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />

<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.theme.default.min.css" />
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css" />

@endpush

@include('includes.breadcrumb')
<div class="w3layouts-breadcrumbs text-center">
    <div class="container">
        <span class="agile-breadcrumbs"><a href="/dashboard"><i class="fa fa-home home_1"></i> Dashboard</a> / <span>Change Password</span></span>
    </div>
</div>

@section('content')


<div id="content" style="margin-top: 30px; margin-bottom: 30px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-3"> 
        @include('includes.inner-menu')
      </div>
      
      <div class="col-lg-8">
        <div class="bg-light shadow-md rounded p-4" style="padding: 30px !important;"> 
          
           <!-- Change Password
          ============================================= -->
          <?php if(isset($success)) { ?>
            <div class="alert alert-success" >
             {{$success}}
            </div>
          <?php } ?>

          <?php if(isset($error)) { ?>
            <div class="alert alert-danger" >
             {{$error}}
            </div>
          <?php } ?>

          <div class="row">
            <div class="col-lg-8">
              <h4 class="mb-4">Change Password</h4>
              <form id="changePassword" action="/change-password" method="post">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="existingPassword">Existing Password</label>
                  <input type="password" class="form-control" data-bv-field="existingpassword" name="existingPassword" required placeholder="Existing Password">
                </div>
                <div class="form-group">
                  <label for="newPassword">New Password</label>
                  <input type="password" class="form-control" data-bv-field="newpassword" name="newPassword" required placeholder="New Password">
                </div>
                <div class="form-group">
                  <label for="existingPassword">Confirm Password</label>
                  <input type="password" class="form-control" data-bv-field="confirmgpassword" name="confirmPassword" required placeholder="Confirm Password">
                </div>
                <div class="form-group">
                  <label for="existingPassword">Choose new 4-DIGITS Pin</label>
                  <input type="text" class="form-control" data-bv-field="confirmgpassword" maxlength="4" name="pin" required placeholder="Choose new 4-Digits Transaction PIN">
                </div>
                <button class="btn btn-primary" type="submit">Update Password</button>
              </form>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0 ">
              <div class="bg-light-2 p-3">
                <p class="mb-2">We value your Privacy.</p>
                <p class="text-1 mb-0">We will not sell or distribute your contact information. Read our <a href="#">Privacy Policy</a>.</p>
                <hr>
                <p class="mb-2">Billing Enquiries</p>
                <p class="text-1 mb-0">Do not hesitate to reach our <a href="#">support team</a> if you have any queries.</p>
              </div>
            </div>
          </div>
          <!-- Change Password end --> 
        
        </div>
      </div>
    </div>
  </div>
  <!-- Content end --> 
  

  
</div>


@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>




<script>
  $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
</script>


@endpush