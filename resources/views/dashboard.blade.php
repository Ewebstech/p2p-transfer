@extends('layout.app')

@section('title', 'Home')

@push('styles')
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.theme.default.min.css" />
@endpush

@include('includes.breadcrumb')
<div class="w3layouts-breadcrumbs text-center">
    <div class="container">
        <span class="agile-breadcrumbs"><a href="/"><i class="fa fa-home home_1"></i></a> / <span>Dashboard</span></span>
    </div>
</div>

@section('content')


<div class="container">

    <!--Vertical Tab-->
<!---728x90--->

<div class="section" style="margin-top: 70px; background-color: rgb(25, 34, 35, 0.1); padding-top: 20px; padding-bottom: 40px; border-radius: 10px;">
    <div class="col-md-12">
        <div class="col-md-6" >
            <h6 class="" style="padding-bottom: 20px;"><span class="text-dark mr-1">My Balance: </span>&#8358;{{$sessiondata['walletBalance']}}</h6>
        </div>
        <div class="col-md-6" style="float: right; ">
            <p class="text-md-right text-dark"><b>Wallet ID:</b> <span class="text-body">{{$sessiondata['walletID']}}</span></p>
        </div>
    </div>
</div>

  
  <!-- Content
  ============================================= -->
  <div id="content" style="margin-top: -30px;">
    
    <!-- Main Topics
    ============================================= -->
    <section class="section py-3 my-3 py-md-5 my-md-5" >
      <div class="container">
      <h2 class="text-9 text-center">Welcome back, {{$sessiondata['fullname']}}</h2>
        <p class="lead text-center mb-5">What do you want to do today?</p>
        <div class="row">
            <div class="col-sm-6 col-lg-3 mb-4">
                <a href="/services" style="text-decoration: none; color: #000">
                <div class="card shadow-sm border-1">
                    <div class="card-body">
                        <span class="d-block text-16 text-center text-primary my-4"><i class="fa fa-ticket fa-3x"></i></span>
                        <h5 class="card-title text-4 text-center">Recharge & Pay Bills</h5>
                    </div>
                    
                </div>
                </a>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
              <a href="/fundmywallet" style="text-decoration: none; color: #000">
                <div class="card shadow-sm border-1">
                    <div class="card-body">
                        <span class="d-block text-16 text-center text-primary my-4"><i class="fa fa-credit-card fa-3x"></i></span>
                        <h5 class="card-title text-4 text-center">Fund My Wallet</h5>
                    </div>
                    
                </div>
              </a>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
              <a href="/history" style="text-decoration: none; color: #000">
                <div class="card shadow-sm border-1">
                    <div class="card-body">
                        <span class="d-block text-16 text-center text-primary my-4"><i class="fa fa-history fa-3x"></i></span>
                        <h5 class="card-title text-4 text-center">Purchase History</h5>
                    </div>
                    
                </div>
              </a>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
              <a href="/profile" style="text-decoration: none; color: #000">
                <div class="card shadow-sm border-1">
                    <div class="card-body">
                        <span class="d-block text-16 text-center text-primary my-4"><i class="fa fa-user fa-3x"></i></span>
                        <h5 class="card-title text-4 text-center">My Profile</h5>
                    </div>
                    
                </div>
              </a>
            </div>

        </div>

        </div>
        
        <div class="row pt-md-3 mt-md-5">
          <div class="col-lg-6">
            <div class="bg-white shadow-sm rounded pl-4 pl-sm-0 pr-4 py-4">
              <div class="row no-gutters">
                <div class="col-12 col-sm-auto text-13 text-muted d-flex align-items-center justify-content-center"> <span class="px-4 ml-3 mr-2 mb-4 mb-sm-0"><i class="fa fa-envelope"></i></span> </div>
                <div class="col text-center text-sm-left">
                  <div class="">
                    <h5 class="text-3 text-body">Can't find what you're looking for?</h5>
                    <p class="text-muted mb-0">We want to answer all of your queries. Get in touch and we'll get back to you as soon as we can. <a class="btn-link" href="https://api.whatsapp.com/send?phone=2349023624623">Contact us<span class="text-1 ml-1"><i class="fa fa-whatsapp"></i></span></a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="bg-white shadow-sm rounded pl-4 pl-sm-0 pr-4 py-4">
              <div class="row no-gutters">
                <div class="col-12 col-sm-auto text-13 text-muted d-flex align-items-center justify-content-center"> <span class="px-4 ml-3 mr-2 mb-4 mb-sm-0"><i class="far fa-comment-alt"></i></span> </div>
                <div class="col text-center text-sm-left">
                  <div class="">
                    <h5 class="text-3 text-body">Technical questions</h5>
                    <p class="text-muted mb-0">Have some technical questions? Hit us up on live chat or whatever. <a class="btn-link" href="skype:live:ewebstech?chat">Click here<span class="text-1 ml-1"><i class="fa fa-skype"></i></span></a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Main Topics end -->
        
    <!-- Can't find
    ============================================= -->
    
    <!-- Can't find end -->
    
  </div>
  <!-- Content end --> 

<br clear="all"/>


@endsection