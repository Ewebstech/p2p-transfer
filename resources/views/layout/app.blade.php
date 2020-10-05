<!DOCTYPE html>
<!-- html -->
<html>
<!-- head -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title>BlossomPay NG | @yield('title')</title>
<link rel="stylesheet" href="/css/bootstrap-select.css"><!-- bootstrap-select-CSS -->
<link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /><!-- bootstrap-CSS -->
<link href="/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /><!-- Fontawesome-CSS -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type='text/javascript' src='/js/jquery-2.2.3.min.js'></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<!--meta data-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Paybills, Eko Electricity, Ikeja Electricity, Multichoice Subscrptions, Abuja Electricity, Kano Electricity, Ibadan Electricity" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--//meta data-->
<!-- online fonts -->
<link href="/fonts.googleapis.com/css73b5.css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
<link href="/fonts.googleapis.com/css578f.css?family=Oxygen:300,400,700&amp;subset=latin-ext" rel="stylesheet">
<link href="/fonts.googleapis.com/css9cb4.css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<!-- /online fonts -->
<!-- Web Fonts
============================================= -->
<link rel='stylesheet' href='../../../fonts.googleapis.com/css2a55.css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
@stack('styles')
       
</head>
<!-- //head -->


{{-- <script>
(function(){
	if(typeof _bsa !== 'undefined' && _bsa) {
  		// format, zoneKey, segment:value, options
  		_bsa.init('flexbar', 'CKYI627U', 'placement:w3layoutscom');
  	}
})();
</script>
<script>
(function(){
if(typeof _bsa !== 'undefined' && _bsa) {
	// format, zoneKey, segment:value, options
	_bsa.init('fancybar', 'CKYDL2JN', 'placement:demo');
}
})();
</script>
<script>
(function(){
	if(typeof _bsa !== 'undefined' && _bsa) {
  		// format, zoneKey, segment:value, options
  		_bsa.init('stickybox', 'CKYI653J', 'placement:w3layoutscom');
  	}
})();
</script> --}}
{{-- <script type="text/javascript" src="http://services.bilsyndication.com/adv1/?d=353" defer="" async=""></script>
<script> var vitag = vitag || {};vitag.gdprShowConsentTool=false;vitag.outStreamConfig = {type: "slider", position: "left" };</script> --}}

<body>
<!--header-->
<header>
	<div class="container">
		<!--logo-->
			<div class="logo">
				<h1><a href="/">Blossom Pay</a></h1>
			</div>
		<!--//logo-->
		    <div class="w3layouts-login">
          <?php if(isset($_SESSION['UserDetails'])){ 
            $adminSettings = env('admins', '813391845,7016484057');
            $admins = explode(",", $adminSettings);

            if(in_array($_SESSION['UserDetails']['walletID'],$admins)){
                $admin = "true";

            }             

            ?>
            
            <a style='margin-top: -5px;' href="/logout"><i class="glyphicon glyphicon-log-out"> </i> Logout</a>
        <?php } else { ?>
            <a style='margin-top: -5px;' href="/login"><i class="glyphicon glyphicon-user"> </i> Login/Register</a>
        <?php } ?>
        
        <?php if(isset($admin) && $admin == "true") { ?>
          <a href="/admin/manual-funding" style='margin-top: 5px;'><i class="glyphicon glyphicon-send"> </i> Admin</a>
        <?php } else { ?>
          <a href="/services" style='margin-top: 5px;'><i class="glyphicon glyphicon-send"> </i> Pay Bills</a>
        <?php } ?>
		    </div>    
			<div class="clearfix"></div>
    <!--Login modal-->
       
    <!--//Login modal-->
    </div>
</header>

<div class="content">
    @yield('content')
</div>
    
@include('includes.join_us')
<!--footer-->
<footer>
	<div class="w3l-footer-bottom">
		<div class="container-fluid">
			<div class="col-md-4 w3-footer-logo">
				<h2><a href="/">Blossom Pay</a></h2>
			</div>
			<div class="col-md-8 agileits-footer-class">
				<p>© 2019 Blossom Payment Solutions. All Rights Reserved </p>
			</div>
		<div class="clearfix"> </div>
	 	</div>
	</div>
</footer>
<!--//footer-->

<script src='/ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<!-- for bootstrap working -->
<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working --><!-- Responsive-slider -->
    <!-- Banner-slider -->
<script src="js/responsiveslides.min.js"></script>
   <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
    <!-- //Banner-slider -->
<!-- //Responsive-slider -->   
<!-- Bootstrap select option script -->
<script src="js/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<!-- //Bootstrap select option script -->
    
<!-- easy-responsive-tabs -->    
<link rel="stylesheet" type="text/css" href="/css/easy-responsive-tabs.css" />
<script src="/js/easyResponsiveTabs.js"></script>
<!-- //easy-responsive-tabs --> 
    <!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear' 
            };
        */
                            
        $().UItoTop({ easingType: 'easeOutQuart' });
                            
        });
</script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){		
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>
<!-- Scripts for Services Tabs -->
<script>
	$(document).ready(function() {
			$("#tab2").hide();
			$("#tab3").hide();
			$("#tab4").hide();
			$(".tabs-menu a").click(function(event){
					event.preventDefault();
					var tab=$(this).attr("href");
					$(".tab-grid").not(tab).css("display","none");
					$(tab).fadeIn("slow");
			});
	});
</script>

@stack('scripts')  <!-- Append more js scripts -->
<!-- start-smoth-scrolling -->
<!-- //here ends scrolling icon -->
</body>
<!-- //body -->
</html>
<!-- //html -->