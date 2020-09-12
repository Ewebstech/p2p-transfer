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
          
        @if (!session('status'))
          <div class="col-lg-12 text-center mt-5">
            <h2 class="text-8">Click to Select Wallet Funding  Method</h2>
          </div>
        @endif
          <div class="col-lg-8 col-xl-8 mx-auto mt-3">
            <div class="bg-light shadow-sm rounded p-4">
              <div class="row">
                <div class="col-md-12 col-lg-12 order-1 order-md-0">
                  
                  @if (session('status'))
                      
                      <div class="alert alert-success " style="font-weight: bold; font-size: 14px; text-align: center; margin-bottom: 150px; margin-top: 150px;" >
                        {{ session('status') }}
                      </div>
                  
                    @else
                    <ul class="nav nav-tabs mb-4 nav-fill" id="myTab" role="tablist">
                      <li class="nav-item" id="clickme"> <a class="nav-link active" id="first-tab" data-toggle="tab" href="#firstTab" role="tab" aria-controls="firstTab" aria-selected="true">Credit/Debit Cards</a> </li>
                      <li class="nav-item"> <a class="nav-link" id="second-tab" data-toggle="tab" href="#secondTab" role="tab" aria-controls="secondTab" aria-selected="false">Direct Bank Transfer</a> </li>
                    </ul>
                    <div class="tab-content my-3" id="myTabContentVertical"> 
                      <!-- Cards Details
                      ============================================= -->
                      <div class="tab-pane fade show active" id="firstTab" role="tabpanel" aria-labelledby="first-tab">
                        <p class="text-info mb-1"><i class="fas fa-info-circle"></i> Your wallet will be credited instantly</p>
                        <form id="payment" method="post">
                          {{csrf_field()}}
                          <div class="form-group input-group">
                            <div class="input-group-prepend"> <span class="input-group-text">&#8358;</span> </div>
                            <input class="form-control" id="amount" name="amount" placeholder="Enter Amount" required type="text">
                          </div>
  
                          <div class="form-group">
                            <div id="pay-msg" style="font-size: 13px !important; margin-bottom: 10px; font-weight: 600"></div>
                          </div>
                         
                          <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-lock"></i> Proceed to Pay</button>
                        </form>
                      </div>
                      <!-- Cards Details end --> 
                      
                      <!-- Pay via Paypal
                      ============================================= -->
                      {{-- <div class="tab-pane fade" id="secondTab" role="tabpanel" aria-labelledby="second-tab"> <img class="img-fluid" src="images/paypal-logo.png" alt="Paypal Logo" title="Pay easily, fast and secure with PayPal.">
                        <p class="lead">Pay easily, fast and secure with PayPal.</p>
                        <p class="text-info mb-4"><i class="fas fa-info-circle"></i> You will be redirected to PayPal to complete your payment securely.</p>
                        <a class="btn btn-primary btn-block d-flex align-items-center justify-content-center" href="recharge-payment-success.html"><i class="fab fa-paypal fa-2x mr-2"></i> Pay via PayPal</a> 
                      
                      </div> --}}
                      <!-- Pay via Paypal end --> 
                    </div>

                    @endif
                
                
                </div>
              
              </div>
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
      submit_payment_form('payment', "{{ route('takePayment') }}", 'pay-msg', true);
  });
</script>

@endpush