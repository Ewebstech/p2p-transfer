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
        <span class="agile-breadcrumbs"><a href="/dashboard"><i class="fa fa-home home_1"></i></a> / <span>Services</span></span>
    </div>
</div>

@section('content')


<div class="container">

    <!--Vertical Tab-->
<!---728x90--->

<div class="categories-section main-grid-border" id="mobilew3layouts">

    <div class="container" style="font-size: 12px !important; margin-top: 40px; margin-bottom: -40px;">
            <div class="category-list">
                <div id="parentVerticalTab">
                    <div class="agileits-tab_nav">
                    <ul class="resp-tabs-list hor_1" >
                        <li style="font-size: 18px !important;"><i class="icon fa fa-mobile" aria-hidden="true" ></i>Airtime</li>
                        <li style="font-size: 18px !important;"><i class="icon fa fa-television" aria-hidden="true"></i>Mobile Data</li>
                       
                    </ul>
                    </div>

                    <div class="resp-tabs-container hor_1" style="background-color: rgb(25, 34, 35, 0.05); !important;">
                        <!-- tab1 -->
                    <div>
                    <div class="tabs-box">
              
                    <div class="clearfix"> </div>
                    <div class="tab-grids">
                        <div id="tab1" class="tab-grid">  
                        
                            <div class="login-form">	
                                @if (session('error'))
                                    <div class="alert alert-danger" >
                                        {{ session('error') }}
                                    </div>
                                @endif
                            <form action="/confirm-purchase" method="post" id="signup">
                                {{csrf_field()}}
                            <ol>							
                                <li >
                                    <div class="agileits-select">
                                    <select class="form-control" data-live-search="true" name="network"  required="required" >
                                        <option value="">Select Mobile Network</option>
                                        <option value="airtel">Airtel</option>
                                        <option value="mtn">MTN</option>
                                        <option value="9mobile">9mobile</option>
                                        <option value="glo">Glo</option>
                                    </select>
                                    </div>
                                </li>
                                <li>
                                    <h4>Mobile Number</h4>
                                    <input type="number" id="phone" class="form-control" name="phone" pattern="\d{10}" placeholder="Enter Mobile Number" required="required" />
                                
                                </li>
                            
                                <li>
                                    <div class="mobile-right ">
                                        <h4>Amount To Recharge?</h4>
                                        <div class="mobile-rchge">
                                            <input type="number" class="form-control" placeholder="&#8358; " name="amount" required="required"  />	
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                    </div>
                                </li>

                                <input type="hidden" name="category" value="airtime"/>
                                <li>
                                    <input type="submit" class="submit" value="Recharge Now" />
                                </li>
                            </ol>
                        </form>	
                                                                                            
                        </div>	
    
                    </div>
                    </div>
                    
                    <div class="clearfix"> </div>
                    </div>

                </div>
                
                    
                <div>
                    <div class="login-form">
                        <i class="icon fa fa-television inner-icon" aria-hidden="true"></i>
                            <form action="https://demo.w3layouts.com/demos_new/template_demo/06-05-2017/online_recharge-demo_Free/889104376/web/pay.html" method="post" id="signup">
                            
                            <ol>	
                            <li>
                                <div class="agileits-select">
                                <select class="selectpicker show-tick" data-live-search="true">
                                    <option data-tokens="Select Operator">DTH Operator</option>
                                    <option data-tokens="Airtel">Airtel</option>
                                    <option data-tokens="Aircel">Aircel</option>
                                    <option data-tokens="BSNL">BSNL</option>
                                    <option data-tokens="Tata Docomo">Tata Docomo</option>
                                    <option data-tokens="Reliance GSM">Reliance GSM</option>
                                    <option data-tokens="Reliance CDMA">Reliance CDMA</option>
                                    <option data-tokens="Telenor">Telenor</option>
                                    <option data-tokens="Jio">Jio</option>
                                    <option data-tokens="Vodafone">Vodafone</option>
                                    <option data-tokens="Idea">Idea</option>
                                    <option data-tokens="MTS">MTS</option>
                                </select>
                                </div>
                            </li>
                            <li>
                                <input type="text" id="customer" value="Enter Customer ID" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Customer ID';}" required="">	
                            </li>
                            <li>
                                <div class="mobile-right ">
                                    <div class="mobile-rchge">
                                        <input type="text" placeholder="Enter amount" name="amount" required="required"  />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                            <li>
                                <input type="submit" class="submit" value="Recharge Now" />
                            </li>
                        </ol>
                        </form>	
                                                                                            
                        </div>	
                </div>  

              </div>
            </div>
        </div>
    </div>

</div>

</div>

    <!---728x90--->
    
    <!--Plug-in Initialisation-->
    <script type="text/javascript">
    $(document).ready(function() {
    
        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
    </script>
    <!-- //Categories -->
    
    
		
</div>


@endsection