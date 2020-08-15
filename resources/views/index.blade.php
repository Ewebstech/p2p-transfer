@extends('layout.app')

@section('title', 'Home')

<!--Slides//-->	
@include('includes.slider')
     
@section('content')


<!--partners-->
<div class="w3layouts-partners">
        <h3>Our Services</h3>
            <div class="container">
                <ul>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/EKEDC-logo.jpg" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/ibadan-electric.png" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/kedco.png" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/enugu.png" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/abuja-electric.png" alt=""></a></li>
                </ul>
                <ul>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/Ikeja-Electricity.png" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/genesis.jpg" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/PHED.png" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/dstv.png" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/9mobile.jpg" alt=""></a></li>	
                </ul>
                <ul>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/airtel.jpeg" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/mtn.png" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/glo.png" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/gotv.png" alt=""></a></li>
                    <li><a href="/services"><img style="padding-right: 10px; padding-left: 10px; max-height: 70px;" class="img-responsive" src="images/services/startimes.jpg" alt=""></a></li>	
                </ul>
            </div>
        </div>	
    <!--//partners-->
<!--phone-->
<div class="phone" id="mobileappagileits">
    <div class="container">
        <div class="col-md-6" style="margin-top: -20px;">
            <img  src="images/paybills_blank_image.png" class="img-responsive" alt=""/>
        </div>
        <div class="col-md-6 phone-text">
            <h4>Simple And Faster Bill Payments</h4>
                <div class="text-1">
                    <h5 style="color: #fff905">Smart Recharge</h5>
                    <p>Airtime & Mobile Data Recharge <br> <b>(MTN, GLO, 9MOBILE, GLO ...)</b></p>
                </div>
                <div class="text-1">
                    <h5 style="color: #fff905">Pay Electricity Bills </h5>
                    <p>Pay your electricity bills easily <br> <b>(EKO, IKEJA, ENUGU, ABUJA, KANO, IBADAN ...)</b></p>
                </div>
                <div class="text-1">
                    <h5 style="color: #fff905">TV Subscriptions</h5>
                    <p>Subscribe for your favourte channels <br> <b>(GoTV, DSTV, Startimes ...)</b></p>
                </div>
                <div class="agileinfo-dwld-app">
                    <h6 style="color: #fff">Download The App : 
                        <a href="#"><i class="fa fa-apple"></i></a>
                        <a href="#"><i class="fa fa-windows"></i></a>
                        <a href="#"><i class="fa fa-android"></i></a>
                    </h6>
                </div>
        </div>
    </div>
</div>
<!--//phone-->
<!---728x90--->


<!-- Support content -->
<div class="w3l-support">
    <div class="container">
        
        <div class="col-md-12 col-sm-12 w3_agile_support_right" style="margin-top: -30px;">
            <h5>Blossom Pay</h5>
            <h3>24/7 Customer Service Support</h3>
            <p>We give instant and 24-hours support to service users, re-sellers and vend partners. We understand the essence of quick issues resolution.</p>
            <div class="agile_more" style="margin-bottom: 30px; margin-top: -25px;">
                <a href="#" class="type-4">
                    <span> Request Support </span>
                    <span> Request Support  </span>
                    <span> Request Support  </span>
                    <span> Request Support  </span>	
                    <span> Request Support  </span>
                    <span> Request Support  </span>
                </a>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //Support content -->


<!--offers-->
    <div class="w3-offers">
        <div class="container">
           
        </div>
    </div>
<!--//offers-->

@endsection