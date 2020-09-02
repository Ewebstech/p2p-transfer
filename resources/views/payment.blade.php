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
        <span class="agile-breadcrumbs"><a href="/dashboard"><i class="fa fa-home home_1"></i></a> / <span>Services</span></span>
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
                <div class="col-3 step complete">
                  <div class="step-name">Purchase</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="/services" class="step-dot"></a>
                </div>
                
                <div class="col-3 step complete">
                  <div class="step-name">Summary</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
                
                <div class="col-3 step active">
                  <div class="step-name">Payment</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
                
                <div class="col-3 step disabled">
                  <div class="step-name">Done</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
            </div>
        </div>
		<!-- Steps Progress bar end --> 
		
        <div class="col-lg-12 text-center mt-5">
            <h2 class="text-8">Select a Payment Mode</h2>
          </div>
          <div class="col-lg-10 col-xl-9 mx-auto mt-3">
            <div class="bg-light shadow-sm rounded p-4">
              <div class="row">
                <div class="col-md-7 col-lg-7 order-1 order-md-0">
                  <ul class="nav nav-tabs mb-4 nav-fill" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" >Wallet</a> </li>
                    <li class="nav-item"> <a class="nav-link " >PayPal</a> </li>
                  </ul>
                  <div class="my-3"> 
                    
                    <div class="tab-pane" > 
                      <p class="lead" style="text-align: center;">Please enter your Wallet PIN</p>
                      <p class="text-info mb-4"><i class="fas fa-info-circle"></i> Your default wallet PIN is the last 4 digits of your Wallet ID.</p>
                      <a class="btn btn-primary btn-block d-flex align-items-center justify-content-center" href="recharge-payment-success.html"><i class="fab fa-pay fa-2x mr-2"></i> Pay </a> 
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-5 col-lg-5 order-0 order-md-1"> 
                  
                  <!-- Payable Amount
                    ============================================= -->
                  <div class="bg-light-2 rounded p-4 mb-4">
                    <h3 class="text-4 mb-4">Payable Amount</h3>
                    <ul class="list-unstyled">
                        <li class="mb-2">Service <span class="float-right text-4 font-weight-500 text-dark">Airtime (MTN)</span></li>
                      <li class="mb-2">Amount <span class="float-right text-4 font-weight-500 text-dark">&#8358;0</span></li>
                      <li class="mb-2">VAT <span class="text-success">(0%)</span> <span class="float-right text-4 font-weight-500 text-dark">&#8358;0</span></li>
                    </ul>
                    <hr>
                    <div class="text-dark text-4 font-weight-500 py-1"> Total Amount<span class="float-right text-7">&#8358;0</span></div>
                  </div>
                  <!-- Payable Amount end --> 
                  
                  <!-- Pay via Paypal
                    ============================================= -->
                  <div class="bg-light-2 rounded p-4 d-none d-md-block">
                    <p class="mb-2">We value your Privacy.</p>
                    <p class="text-1 mb-0">We will not sell or distribute your information. Read our <a href="#">Privacy Policy</a>.</p>
                  </div>
                  <!-- Cards Details end --> 
                </div>
              </div>
            </div>
          </div>
    </div>
  </div><!-- Content end -->
  
 
  
</div><!-- Document Wrapper end -->


@endsection