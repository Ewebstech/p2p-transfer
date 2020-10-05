@extends('layout.app')

@section('title', 'Fund Manual')

@push('styles')

<link rel="stylesheet" type="text/css" href="../vendor/font-awesome/css/all.min.css" />

<link rel="stylesheet" type="text/css" href="../css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../vendor/font-awesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="../vendor/owl.carousel/assets/owl.carousel.min.css" />
<link rel="stylesheet" type="text/css" href="../vendor/owl.carousel/assets/owl.theme.default.min.css" />
<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css" />

@endpush

@include('includes.breadcrumb')
<div class="w3layouts-breadcrumbs text-center">
    <div class="container">
        <span class="agile-breadcrumbs"><a href="/dashboard"><i class="fa fa-home home_1"></i> Dashboard</a> / <span>Admin</span> / <span>Manual Funding</span></span>
    </div>
</div>

@section('content')


<div id="content" style="margin-top: 30px; margin-bottom: 30px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-3"> 
        @include('admin.inner-menu')
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
              <h4 class="mb-4">Fund Wallet Manually</h4>

              

              <form id="manualFund"  method="post">
                {{csrf_field()}}

                <div class="form-group">
                  <label for="existingPassword">Wallet ID</label>
                  <input type="text" class="form-control" data-bv-field="" name="walletID" required placeholder="Please provide a Wallet ID">
                </div>

                <div class="form-group">
                  <label for="existingPassword">Amount to Credit</label>
                  <input type="number" class="form-control" data-bv-field="" name="amount" required placeholder="&#8358; ">
                </div>
                <div class="form-group">
                  <label for="newPassword">Transaction Type </label>
                  <select name="type" class="form-control" required>
                    <option value="">Select Transaction Type</option>
                    <option value="refund">REFUND</option>
                    <option value="manualfund">MANUAL-FUND</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="existingPassword">Remark/Reference</label>
                  <input type="text" class="form-control" data-bv-field="" name="reference" required placeholder="Add a reference or unique remark for this transaction">
                </div>
                <div class="form-group">
                  <label for="existingPassword">Please enter your PIN to confirm it's really you</label>
                  <input type="password" class="form-control" data-bv-field="confirmgpassword" maxlength="4" name="pin" required placeholder="Enter 4-Digits Transaction PIN">
                </div>

                <div class="form-group">
                  <div id="mf-msg" style="font-size: 13px !important; margin-bottom: 10px; font-weight: 600"></div>
                </div>

                <button class="btn btn-primary" type="submit">Process Instantly</button>
              </form>
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

<script src="../js/ajax.js"></script>
<script>
  $("#manualFund").submit(function (e) {
      e.preventDefault();
      submit_payment_form('manualFund', "{{ route('fundRequest') }}", 'mf-msg', true);
  });
</script>

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