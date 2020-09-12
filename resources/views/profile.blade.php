@extends('layout.app')

@section('title', 'Profile')

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
        <span class="agile-breadcrumbs"><a href="/dashboard"><i class="fa fa-home home_1"></i><span> Dashboard</span></a> / <span>My Profile</span></span>
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
          
          <!-- Personal Information
          ============================================= -->
          <div class="row">
            <div class="col-lg-8">
              <h4 class="mb-4">My Profile</h4>
              <form id="personalInformation" action="#">
                <div class="mb-3">
                  {{-- <div class="custom-control custom-radio custom-control-inline">
                    <input id="male" name="profile" class="custom-control-input" checked="" required type="radio">
                    <label class="custom-control-label" for="male">Male</label>
                  </div> --}}
                  {{-- <div class="custom-control custom-radio custom-control-inline">
                    <input id="female" name="profile" class="custom-control-input" required type="radio">
                    <label class="custom-control-label" for="female">Female</label>
                  </div> --}}
                </div>
                <div class="form-group">
                  <label for="fullName">Full Name</label>
                  <input type="text" value="{{$sessiondata['fullname']}}" class="form-control" data-bv-field="fullName" id="fullName" required placeholder="Full Name">
                </div>
                <div class="form-group">
                  <label for="mobileNumber">Mobile Number</label>
                  <input type="text" value="{{$sessiondata['phonenumber']}}" class="form-control" data-bv-field="mobilenumber" id="mobileNumber" required placeholder="Mobile Number">
                </div>
                <div class="form-group">
                  <label for="emailID">Email ID</label>
                <input type="text" value="{{ $sessiondata['email'] }}" class="form-control" data-bv-field="emailid" id="emailID" required placeholder="Email ID">
                </div>
               
                <button class="btn btn-primary" disabled>Update Record</button>
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
          <!-- Personal Information end --> 
        
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