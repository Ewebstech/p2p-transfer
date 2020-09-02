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
                
                <div class="col-3 step active">
                  <div class="step-name">Summary</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
                
                <div class="col-3 step disabled">
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
		
      <div class="col-lg-12 text-center mt-3">
       
        <p class="lead" style="font-weight: 600;">Confirm Purchase Details</p>
      </div>
        <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
		  <div class="bg-light shadow-sm rounded p-3 p-sm-4 mb-0 mb-sm-4">
            <div class="row">
              <p class="col-sm text-muted mb-0 mb-sm-3">Mobile Number:</p>
              <p class="col-sm text-sm-right font-weight-500">(+91) 9898989898</p>
            </div>            
            <div class="row">
              <p class="col-sm text-muted mb-0 mb-sm-3">Operator/Circle:</p>
              <p class="col-sm text-sm-right font-weight-500">Vodafone | Gujarat</p>
            </div>
            <div class="row">
              <p class="col-sm text-muted mb-0 mb-sm-3">Plan:</p>
              <p class="col-sm text-sm-right font-weight-500">Mobile top-up</p>
            </div>
            <div class="row">
              <p class="col-sm text-muted mb-0 mb-sm-3">Validity:</p>
              <p class="col-sm text-sm-right font-weight-500">Talktime</p>
            </div>
            <div class="row">
              <p class="col-sm text-muted mb-0 mb-sm-3">Amount:</p>
              <p class="col-sm text-sm-right font-weight-500">$150</p>
            </div>
            <div class="row">
              <p class="col-12 text-muted mb-0">Plan Description:</p>
              <p class="col-12 text-1">Local calls free & STD calls free & Roaming Incoming & Outgoing calls free & 300 Local & National SMS & 1 GB 3G/4G Data & Data Validity 28 day(s) & For 3G/4G user - T&C apply</p>
            </div>
            
            
            <div class="bg-light-4 rounded p-3">
            <div class="row">
              <div class="col-sm text-3 font-weight-600">Payment Amount</div>
              <div class="col-sm text-sm-right text-5 font-weight-500">$150</div>
            </div>
            </div>
            
            <p class="text-center my-4"><a class="btn-link" data-toggle="collapse" href="#couponCode" aria-expanded="false" aria-controls="couponCode">Apply a Coupon Code</a></p>
            <div id="couponCode" class="bg-light-3 p-4 rounded collapse">
            <h3 class="text-4">Coupon Code</h3>
            <div class="input-group form-group mb-0">
                <input class="form-control" placeholder="Coupon Code" aria-label="Promo Code" type="text">
                <span class="input-group-append">
                <button class="btn btn-secondary" type="submit">APPLY</button>
                </span> </div>
            </div>
            
            
            <p class="mt-4 mb-0"><a href="recharge-payment.html" class="btn btn-primary btn-block">Make Payment</a></p>
        </div>
      </div>
    </div>
  </div><!-- Content end -->
  
 
  
</div><!-- Document Wrapper end -->


@endsection