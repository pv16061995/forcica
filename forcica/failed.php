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
require_once 'trupay/ApiCalls.php';
require_once 'trupay/Request.php';

$obj=New Common();

$request = new Request();
$res=$request->setMERCH_ORDER_ID($_SESSION['orderId']); 
if(isset($res))
{
  $apiCalls = new ApiCalls();
  $response =  $apiCalls->getRequestStatus($apiCalls); 
  $txn_id=$response->TXN_ID;
  $order_id=$_SESSION['orderId'];
  $pid=$_SESSION['tru_pid'];
 
  unset($_SESSION['orderId']);
  $getdetail=$obj->getdetailBYOrderId($order_id);
  $stu_detail=$getdetail->fetch_assoc();

  $user_id=$stu_detail['ID'];

    
}
?>

<!--banner-->
<div class="inner-banner" style="background:url(images/reports-bg.jpg);"> 
<div class="container">
<h1>Payment Failed</h1>
<div class="breadcrumb"><a href="index.php"> HOME </a> / Payment Failed</div>
</div>   
</div>
<!--//banner-->

<!--Predictions-->
<div class="predictions-wrap">
<div class="container text-center">
<img src="images/payment_failed.png" class="img-responsive success-img" />

<h1 class="payment-title">Your Transaction failed!</h1>

<!-- <h1 class="heading-title">Payment Id : 123456789</h1> -->
<h2 class="sub-msg">Your payment has been failed if you are doing again payment click this link. </h2>
<a href="trupay_payment.php" class="payment-again">Payment Again</a>
</div>
</div>
<!--//Predictions-->



<!--proof-->
<?php include 'include/proof.php';?>
<!--//proof-->

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