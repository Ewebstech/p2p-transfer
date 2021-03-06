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

<!-- Content
  ============================================= -->
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
                
                <div class="col-4 step complete">
                  <div class="step-name">Confirmation/Payment</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
                
                <div class="col-4 step complete">
                  <div class="step-name">Done</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
            </div>
        </div>
		<!-- Steps Progress bar end --> 
		
       	<!-- Steps Progress bar end --> 
      <div class="col-lg-12 text-center mt-5">
        <p class="text-success text-16 line-height-07"><i class="fas fa-check-circle"></i></p>
          <h2 class="text-8">Recharge Successful</h2>
          
          <p class="lead">Your transaction have been processed and you will be notified via email.</p>
        </div>
          <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
            <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-4">
              <div class="row">
                <div class="col-sm text-muted">Transaction ID</div>
              <div class="col-sm text-sm-right font-weight-600">{{ $page['reference'] }}</div>
              </div>            
              <hr>
              <div class="row">
                <div class="col-sm text-muted">Date</div>
                <div class="col-sm text-sm-right font-weight-600">{{ $page['date'] }}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm text-muted">Mode of Payment</div>
                <div class="col-sm text-sm-right font-weight-600">Wallet</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm text-muted">Type</div>
                <div class="col-sm text-sm-right font-weight-600">{{ ucwords($page['category']) }} Recharge</div>
              </div>
              
              <hr>
              <div class="row">
                <div class="col-sm text-muted">Service</div>
                <div class="col-sm text-sm-right font-weight-600">{{ strtoupper($page['service']) }} </div>
              </div>

              <hr>
              <div class="row">
                <div class="col-sm text-muted">Transaction Status</div>
                <div class="col-sm text-sm-right font-weight-600 text-success">{{ ucwords($page['status']) }}</div>
              </div>
              <hr>

              <?php if(isset($page['category']) && $page['category'] == "tv") { ?>
                
                <div class="row">
                  <div class="col-sm text-muted">IUC/Smart Number</div>
                  <div class="col-sm text-sm-right font-weight-500">{{$page['iuc']}}</div>
                </div>

                <hr>
              <?php } ?>
              
              <div class="row">
                <div class="col-sm text-muted">Mobile No</div>
                <div class="col-sm text-sm-right font-weight-600">{{$page['phonenumber']}}</div>
              </div>
              
              <hr>
              <div class="row">
                <div class="col-sm text-muted">Payment Amount</div>
                <div class="col-sm text-sm-right text-6 font-weight-500">&#8358;{{$page['amount']}}</div>
              </div>

              
          </div>
          
          <div class="text-center">
          
              <a href="/dashboard" class="btn-link text-muted mx-3 my-2 align-items-center d-inline-flex"><span class="text-5 mr-2"><i class="fa fa-home"></i></span>Go to Dashboard</a>
             
              <p class="mt-4 mb-0"><a href="/services" class="btn btn-primary">Make Another Recharge</a></p>
              </div>
              
              
        </div>
    </div>
  </div><!-- Content end -->
  
 
  
</div><!-- Document Wrapper end -->


@endsection