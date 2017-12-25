<!DOCTYPE html>
<html>
<head>
<title>School Of Forex Trading, Commodity Trading, Binary Options Trading</title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<link href="css/bootsnav.css" type="text/css" rel="stylesheet" media="all">
<link href="css/font-awesome.css" type="text/css" rel="stylesheet" media="all">
<link href="css/owl.theme.default.css" type="text/css" rel="stylesheet" media="all">
<link href="css/owl.carousel.css" type="text/css" rel="stylesheet" media="all">
<link href="css/animations.css" rel="stylesheet" type="text/css" />
<!--web-font-->
<!--<link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700|Muli:200,300,400,600,700,800,900|Roboto:300,400,500,700,900" rel="stylesheet">-->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<!--//web-font-->
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- //Custom Theme files -->
<!-- js -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootsnav.js"></script>
<!-- <script src="js/modernizr.custom.js"></script> -->
<script src="js/owl.carousel.js"></script>

<!-- //js -->
</head>
<body>
<!--header-->
<?php include 'include/header.php'; ?>
<!--//header-->
<?php
$obj=new User();
$res=$obj->getPredictionReportDataById(2);
$data=$res->fetch_assoc();
?>

<!--banner-->
<div class="inner-banner" style="background:url(images/reports-bg.jpg);"> 
<div class="container">
<h1>Reports</h1>
<div class="breadcrumb"><a href="index.php"> HOME </a> / Reports</div>
</div>   
</div>
<!--//banner-->

<!--Predictions-->
<div class="predictions-wrap">
<div class="container text-center">
<h1 class="heading-title"><?php echo $data['title']; ?></h1>
<hr>
<img src="mypanel/admin/predictionreport/<?php echo $data['image']; ?>" class="img-responsive" />
</div>
</div>
<!--//Predictions-->

<!--reports-->
<div class="reports-wrap" style="display: none;">
<div class="container text-left">
<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-striped">
  <thead class="thead-default">
    <tr>
      <th>Name</th>
      <th>Type</th>
      <th>5 Minutes</th>
      <th>15 Minutes</th>
	  <th>Hourly</th>
      <th>Daily</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td rowspan="3"><span class="currency">AUD / USD</span><br><span class="currency-status">0.7413</span></td>
      <td><strong>Moving Averages:</strong></td>
      <td>Sell</td>
	  <td>Buy</td>
      <td>Buy</td>
      <td>Sell</td>
    </tr>
    <tr>
      <td><strong>Indicators:</strong></td>
      <td>Buy</td>
	  <td>Sell</td>
      <td>Strong Sell</td>
      <td>Strong Sell</td>
    </tr>
    <tr>
      <td><strong>Summary:</strong></td>
      <td><span class="neutral">Neutral</span></td>
	  <td><span class="neutral">Neutral</span></td>
      <td><span class="neutral">Neutral</span></td>
      <td><span class="sell">Strong Sell</span></td>
    </tr>
	
	<tr>
      <td rowspan="3"><span class="currency">EUR / GBP</span><br><span class="currency-status">0.8511</span></td>
      <td><strong>Moving Averages:</strong></td>
      <td>Neutral</td>
	  <td>Buy</td>
      <td>Strong Buy</td>
      <td>Buy</td>
    </tr>
    <tr>
      <td><strong>Indicators:</strong></td>
      <td>Sell</td>
	  <td>Strong Buy</td>
      <td>Strong Buy</td>
      <td>Strong Buy</td>
    </tr>
    <tr>
      <td><strong>Summary:</strong></td>
      <td><span class="neutral">Neutral</span></td>
	  <td><span class="buy">Strong Buy</span></td>
      <td><span class="buy">Strong Buy</span></td>
      <td><span class="buy">Strong Buy</span></td>
    </tr>
	
	<tr>
      <td rowspan="3"><span class="currency">USD / CAD</span><br><span class="currency-status">1.3636</span></td>
      <td><strong>Moving Averages:</strong></td>
      <td>Neutral</td>
	  <td>Sell</td>
      <td>Sell</td>
      <td>Buy</td>
    </tr>
    <tr>
      <td><strong>Indicators:</strong></td>
      <td>Sell</td>
	  <td>Sell</td>
      <td>Sell</td>
      <td>Strong Sell</td>
    </tr>
    <tr>
      <td><strong>Summary:</strong></td>
      <td><span class="neutral">Neutral</span></td>
	  <td><span class="sell">Sell</span></td>
      <td><span class="sell">Sell</span></td>
      <td><span class="neutral">Neutral</span></td>
    </tr>
	
	<tr>
      <td rowspan="3"><span class="currency">NZD / USD</span><br><span class="currency-status">0.6885</span></td>
      <td><strong>Moving Averages:</strong></td>
      <td>Neutral</td>
	  <td>Neutral</td>
      <td>Sell</td>
      <td>Sell</td>
    </tr>
    <tr>
      <td><strong>Indicators:</strong></td>
      <td>Strong Buy</td>
      <td>Strong Sell</td>
      <td>Sell</td>
      <td>Strong Sell</td>
    </tr>
    <tr>
      <td><strong>Summary:</strong></td>
      <td><span class="buy">Buy</span></td>
	  <td><span class="sell">Sell</span></td>
      <td><span class="sell">Sell</span></td>
      <td><span class="sell">Strong Sell</span></td>
    </tr>
   
  </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<!--//reports-->

<!--proof-->
<?php include 'include/proof.php';?>
<!--//proof-->

<!--Our Instructors-->
<!--<div class="ins-sec">
<div class="container text-left">
<div class="row">
<div class="col-sm-7 col-md-7">
<h1 class="heading-title">Our Instructors</h1>
<hr>
<p>At <strong>Forcica School Of Forex Trading</strong>, the learning is not just about what we teach. It is about what people understand and remember, and what they can use in the workplace. No ivory tower here...our investment courses are taught by expert instructors who are former market makers, brokers and business leaders. Each one is experienced in online stock trading and an active trader on their own account. The learning effect also heavily relies on how messages are delivered and if they are deemed trustworthy by the receiver.</p>
</div>
<div class="col-sm-5 col-md-5">
<img src="images/1a.png">
</div>
</div>
</div>
</div>  -->
<!--//Our Instructors-->

<!--Footer-->
<?php include 'include/footer.php'; ?>
<!--//footer-->

<script>
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 10) {
        $(".header").addClass("header-bg");
    } else {
        $(".header").removeClass("header-bg");
   }
});
</script>

<script>
		(function( $ ) {

    //Function to animate slider captions 
    function doAnimations( elems ) {
        //Cache the animationend event in a variable
        var animEndEv = 'webkitAnimationEnd animationend';
        
        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }
    
    //Variables on page load 
    var $myCarousel = $('#carousel-example-generic'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
        
    //Initialize carousel 
    $myCarousel.carousel();
    
    //Animate captions in first slide on page load 
    doAnimations($firstAnimatingElems);
    
    //Pause carousel  
    $myCarousel.carousel('pause');
    
    
    //Other slides to be animated on carousel slide event 
    $myCarousel.on('slide.bs.carousel', function (e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });  
    
})(jQuery);
		</script>
		<script>
		$('#carousel-example-generic').carousel({
  interval: 5000,
  cycle: true
}); 
		</script>	
<script>
            $(document).ready(function() {
              $('#testi').owlCarousel({
                loop: true,
                margin:0,
				autoplay: true,
                autoplayTimeout: 5000,
				dots:false,
				nav: true,
				navText: ["<img src='images/left.png'>","<img src='images/right.png'>"],
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true,
                  },
				  480: {
                    items: 1,
                    nav: true,
                  },
				  640: {
                    items: 1,
                    nav: true,
                  },
                  768: {
                    items: 1,
                    nav: true,
                  },
                  1000: {
                    items:1,
                    nav: true,
                  }
                }
              })
            })
</script>

<script>
            $(document).ready(function() {
              $('#proof').owlCarousel({
                loop: true,
                margin:15,
				autoplay: true,
                autoplayTimeout: 5000,
				dots:false,
				nav: true,
				navText: ["<img src='images/left.png'>","<img src='images/right.png'>"],
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false,
                  },
				  480: {
                    items: 1,
                    nav: false,
                  },
				  640: {
                    items:2,
                    nav: false,
                  },
                  768: {
                    items: 2,
                    nav: false,
                  },
                  1000: {
                    items:2,
                    nav: false,
                  }
                }
              })
            })
</script>

<script src="js/css3-animate-it.js"></script>	

<script type="text/javascript">
  		$(document).ready(function () {
		    $(".arrow-right").bind("click", function (event) {
		        event.preventDefault();
		        $(".vid-list-container").stop().animate({
		            scrollLeft: "+=336"
		        }, 750);
		    });
		    $(".arrow-left").bind("click", function (event) {
		        event.preventDefault();
		        $(".vid-list-container").stop().animate({
		            scrollLeft: "-=336"
		        }, 750);
		    });
		});
</script>

</body>
</html>	