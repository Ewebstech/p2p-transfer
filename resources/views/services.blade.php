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
        <span class="agile-breadcrumbs"><a href="/dashboard"><i class="fa fa-home home_1"></i> Dashboard</a> / <span>Services</span></span>
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
                                @if (session('error'))
                                    <div class="alert alert-danger" >
                                        {{ session('error') }}
                                    </div>
                                @endif
                            <form action="/confirm-purchase" method="post" id="signup">
                                {{csrf_field()}}
                            <ol>							
                                <li >
                                    <h4>Select Mobile Network</h4>
                                    <div class="agileits-select">
                                    <select class="form-control" data-live-search="true" name="network"  id="network" onchange="setTimeout(ajax, 1,'datanetwork','network','dataPlansMSG');" required="required" >
                                        <option value="">Select Mobile Network</option>
                                        <option value="airtel">Airtel</option>
                                        <option value="mtn">MTN</option>
                                        <option value="9mobile">9mobile</option>
                                        <option value="glo">Glo</option>
                                    </select>
                                    </div>
                                    
                                </li>

                                <li>
                                    <div class="agileits-select" id="dataPlansMSG"></div>
                                </li>
                                <li>
                                    <h4>Mobile Number</h4>
                                    <input type="number" id="phone" class="form-control" name="phone" pattern="\d{10}" placeholder="Enter Mobile Number" required="required" />
                                
                                </li>
                            
                                <input type="hidden" name="category" value="data"/>
                                <li>
                                    <input type="submit" class="submit" value="Buy Data" />
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

@push('scripts')

  <script src="js/ajax.js"></script>

  <script>
    
    var xmlhttp = new XMLHttpRequest();

    function ajax(whr, val, output) {
        document.getElementById(output).innerHTML = "Please wait, we are verifying your details...";
        var serverPage = "{{ route('getPlans') }}" + "?" + whr + "=" + document.getElementById(val).value;
        console.log(serverPage);
        xmlhttp.open("GET", serverPage);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(output).innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.send(null);
    }
  </script>

  {{-- <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/owl.carousel/owl.carousel.min.js"></script> 
  <script src="js/theme.js"></script>  --}}


@endpush