
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
$res=$obj->getPredictionReportDataById(1);
$data=$res->fetch_assoc();
?>
<!--banner-->
<div class="inner-banner" style="background:url(images/predictions-bg.jpg);"> 
<div class="container">
<h1>Predictions</h1>
<div class="breadcrumb"><a href="index.php"> HOME </a> / Predictions</div>
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

<!--courses-->
<?php include 'include/course-offered.php';?>

<!--//courses-->

<!--Our Instructors-->
<div class="ins-sec">
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
</div>
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
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>

</body>
</html>	
<style type="text/css">
  .course-sec{
    padding: 5em 0 4em 0;
  }
</style>