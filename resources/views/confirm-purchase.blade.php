@extends('layout.app')

@section('title', 'Home')

@push('styles')
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.theme.default.min.css" />
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />
@endpush

@include('includes.breadcrumb')
<div class="w3layouts-breadcrumbs text-center">
    <div class="container">
        <span class="agile-breadcrumbs"><a href="/dashboard"><i class="fa fa-home home_1"></i> Dashboard</a> / <span>Services</span></span>
    </div>
</div>

@section('content')


<!-- Content ============================================= -->
  <div id="content">
    <div class="container">
      <div class="row my-5">
	  <div class="col-lg-11 mx-auto">
	  <!-- Steps Progress bar
      ============================================= -->
        <div class="row widget-steps">
                <div class="col-4 step complete">
                  <div class="step-name">Purchase</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="/services" class="step-dot"></a>
                </div>
                
                <div class="col-4 step active">
                  <div class="step-name">Confirmation/Payment</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
                
                <div class="col-4 step disabled">
                  <div class="step-name">Done</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
            </div>
        </div>
		<!-- Steps Progress bar end --> 
		
      <div class="col-lg-12 text-center mt-3">
       
        <p class="lead" style="font-weight: 600;">Confirm Purchase Details</p>
      </div>
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">

          <div class="form-group">
            <div id="pay-msg" style="font-size: 13px !important; margin-bottom: 10px; font-weight: 600"></div>
          </div>

		    <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-0 mb-sm-4">

            <?php if($category == "airtime"){ ?>
              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Mobile Number:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ $phone }}</p>
              </div>
              
              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Network:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ strtoupper($network ? $network : "") }} </p>
              </div>
              
            <?php } ?>

            <?php if($category == "data"){ ?>
              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Mobile Number:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ $phone }}</p>
              </div>
              
              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Network:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ strtoupper($network ? $network : "") }} </p>
              </div>

              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Description:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ $description }}</p>
              </div>
              
            <?php } ?>

            <?php if($category == "tv"){ ?>

              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Account Status:</p>
                <p class="col-sm text-sm-right font-weight-500"><b>{{ $validationData['accountStatus'] }}</b></p>
              </div>

              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Customer Name:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ $validationData['firstName'] }} {{ $validationData['lastName'] }}</p>
              </div>

              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Customer Type:</p>
                <p class="col-sm text-sm-right font-weight-500"> {{ $validationData['customerType'] }}</p>
              </div>

              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">IUC/Smart Number:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ $iuc }}</p>
              </div>

              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Due Date:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ date('jS-M-Y', strtotime($validationData['dueDate'])) }}</p>
              </div>
              
              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">TV Service:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ strtoupper($tvservice) }} </p>
              </div>

              <div class="row">
                <p class="col-sm text-muted mb-0 mb-sm-3">Description:</p>
                <p class="col-sm text-sm-right font-weight-500">{{ $description }}</p>
              </div>
              
            <?php } ?>

            
            <div class="row">
              <p class="col-sm text-muted mb-0 mb-sm-3">Type:</p>
              <p class="col-sm text-sm-right font-weight-500">{{strtoupper($network ? $network : "")}} {{ ucwords($category) }}</p>
            </div>
           
            <div class="bg-light-4 rounded p-3">
            <div class="row">
              <div class="col-sm text-3 font-weight-600">Payment Amount</div>
              <div class="col-sm text-sm-right text-5 font-weight-500">&#8358;{{ $amount }}.00</div>
            </div>
            </div>
           
            
            <p class="lead text-muted" style="text-align: center; align-content: center; margin-top: 10px; ">Please enter your Wallet PIN</p>
            <p class="text-info" style="text-align: center; margin-top: -20px; align-content: center;"><i class="fas fa-info-circle"></i> Your wallet PIN is the last 4 digits of your registered phonenumber.</p>

            <form id="payment" method="post">
              {{csrf_field()}}
              <p style="text-align: center; margin-top: 10px; align-content: center;">
                <input type="password" id="pin" name="pin" required />
              </p>

              <input type="hidden" name="data" value="{{ json_encode($data) }}" />

              <p class="mt-4 mb-0"><button type="submit" class="btn btn-primary btn-block">Make Payment</button></p>

            </form>
        </div>
      </div>
    </div>
  </div><!-- Content end -->
  
 
  
</div><!-- Document Wrapper end -->


@endsection

@push('scripts')
<script src="js/ajax.js"></script>

<script>
  $("#payment").submit(function (e) {
      e.preventDefault();
      submit_payment_form('payment', "{{ route('payment') }}", 'pay-msg', true);
  });
</script>

@endpush