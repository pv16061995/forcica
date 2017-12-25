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
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootsnav.js"></script>
<script src="js/owl.carousel.js"></script>
</head>
<body>
<!--header-->
<?php include 'include/header.php'; ?>
<!--//header-->


<!--banner-->
<div class="inner-banner" style="background:url(images/course-bg.jpg);"> 
<div class="container">
<h1>Courses</h1>
<div class="breadcrumb"><a href="index.php"> HOME </a> / Courses</div>
</div>   
</div>
<!--//banner-->

<!--Courses-->
<div class="courses-wrap">
<div class="container text-left">
<div class="row text-left">

<div class="box box-border clearfix">
<div class="col-sm-3 col-md-3 box-border-right">
<p>Courses</p>
</div>
<div class="col-sm-9 col-md-9">
<div class="row">

<div class="col-sm-3 col-md-3 box-border-right">
<p>Levels</p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p>Fees in India</p>
</div>
<div class="col-sm-3 col-md-3 box-border-right">
<p>Service Tax(15%)</p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p>Total Fee</p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p>Pay Now</p>
</div>
</div>
</div>
</div>

<?php 
$objM=new Common();
$Courses=$objM->getCoursesListWithCategory();
while($course_list=$Courses->fetch_assoc())
{?>

<div class="box box-bdr-top clearfix">
<div class="col-sm-3 col-md-3 box-border-right">
<p class="head-bg"><strong><?php echo $course_list['categoryname'];?></strong></p>
</div>

<div class="col-sm-9 col-md-9">
<div class="row">
<div class="col-sm-4 col-md-3 box-border-right">
<p class="head-bg"><strong><?php echo $course_list['coursename'];?></strong></p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Fees in India</span> Rs. <?php echo $price=$course_list['price'];?></p>
</div>
<div class="col-sm-4 col-md-3 box-border-right">
<p><span>Service Tax(15%)</span>Rs. <?php $per=($course_list['price']*15)/100; echo number_format($per,2);?></p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Total Fee</span> Rs. <?php $total=$price+$per; echo number_format($total,2);?></p>
</div>
<div class="col-sm-2 col-md-2 text-right">
<a href="paying-admission-fee.php?cat=<?php echo base64_encode($course_list['catId']);?>&cou=<?php echo base64_encode($course_list['Id']);?>" role="button">Pay Now</a>
</div>
</div>
</div>
</div>

<?php 
}
?>

<!-- <div class="box clearfix bg-grey">
<div class="col-sm-3 col-md-3 box-border-right">
<p class="head-bg"><strong>MT4 Operation</strong></p>
</div>

<div class="col-sm-9 col-md-9">
<div class="row">
<div class="col-sm-4 col-md-3 box-border-right">
<p class="head-bg"><strong>MT4 Operation</strong></p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Fees in India</span> Rs. 5,000</p>
</div>
<div class="col-sm-4 col-md-3 box-border-right">
<p><span>Service Tax(15%)</span> Rs. 750</p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Total Fee</span> Rs. 5,750</p>
</div>
<div class="col-sm-2 col-md-2 text-right">
<a href="paying-admission-fee.php" role="button">Pay Now</a>
</div>
</div>
</div>
</div>

<div class="box clearfix">
<div class="col-sm-3 col-md-3 box-border-right">
<p class="head-bg"><strong>Senior Secondary</strong></p>
</div>

<div class="col-sm-9 col-md-9">
<div class="row">
<div class="col-sm-4 col-md-3 box-border-right">
<p class="head-bg"><strong>Senior Secondary</strong></p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Fees in India</span> Rs. 100,000</p>
</div>
<div class="col-sm-4 col-md-3 box-border-right">
<p><span>Service Tax(15%)</span> Rs. 15,000</p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Total Fee</span> Rs. 115,000</p>
</div>
<div class="col-sm-2 col-md-2 text-right">
<a href="paying-admission-fee.php" role="button">Pay Now</a>
</div>
</div>
</div>
</div>

<div class="box clearfix bg-grey">
<div class="col-sm-3 col-md-3 box-border-right">
<p class="head-bg"><strong>Graduation Level</strong></p>
</div>
<div class="col-sm-9 col-md-9">
<div class="row">
<div class="col-sm-4 col-md-3 box-border-right">
<p class="head-bg"><strong>Graduation Level</strong></p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Fees in India</span> Rs. 150,000</p>
</div>
<div class="col-sm-4 col-md-3 box-border-right">
<p><span>Service Tax(15%)</span> Rs. 22,500</p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Total Fee</span> Rs. 172,500</p>
</div>
<div class="col-sm-2 col-md-2 text-right">
<a href="paying-admission-fee.php" role="button">Pay Now</a>
</div>
</div>
</div>
</div>

<div class="box clearfix">
<div class="col-sm-3 col-md-3 box-border-right">
<p class="head-bg"><strong>Post Graduation</strong></p>
</div>
<div class="col-sm-9 col-md-9">
<div class="row">
<div class="col-sm-4 col-md-3 box-border-right">
<p class="head-bg"><strong>Post Graduation</strong></p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Fees in India</span> Rs. 250,000</p>
</div>
<div class="col-sm-4 col-md-3 box-border-right">
<p><span>Service Tax(15%)</span> Rs. 37,500</p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Total Fee</span> Rs. 287,500</p>
</div>
<div class="col-sm-2 col-md-2 text-right">
<a href="paying-admission-fee.php" role="button">Pay Now</a>
</div>
</div>
</div>
</div>

<div class="box clearfix bg-grey">
<div class="col-sm-3 col-md-3 box-border-right">
<p class="head-bg"><strong>Researcher</strong></p>
</div>
<div class="col-sm-9 col-md-9">
<div class="row">
<div class="col-sm-4 col-md-3 box-border-right">
<p class="head-bg"><strong>Researcher</strong></p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Fees in India</span> Rs. 500,000</p>
</div>
<div class="col-sm-4 col-md-3 box-border-right">
<p><span>Service Tax(15%)</span> Rs. 75,000</p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Total Fee</span> Rs. 575,000</p>
</div>
<div class="col-sm-2 col-md-2 text-right">
<a href="paying-admission-fee.php" role="button">Pay Now</a>
</div>
</div>
</div>
</div>

<div class="box clearfix">
<div class="col-sm-3 col-md-3 box-border-right">
<p class="head-bg"><strong>Binary Option Trading</strong></p>
</div>
<div class="col-sm-9 col-md-9">
<div class="row">
<div class="col-sm-4 col-md-3 box-border-right">
<p class="head-bg"><strong>Binary Option Trading</strong></p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Fees in India</span> Rs. 15,000</p>
</div>
<div class="col-sm-4 col-md-3 box-border-right">
<p><span>Service Tax(15%)</span> Rs. 2,250</p>
</div>
<div class="col-sm-2 col-md-2 box-border-right">
<p><span>Total Fee</span> Rs. 17,250</p>
</div>
<div class="col-sm-2 col-md-2 text-right">
<a href="paying-admission-fee.php" role="button">Pay Now</a>
</div>
</div>
</div>
</div> -->

</div>
</div>
</div>
<!--//Courses-->

<!--Testimonials-->
<div class="test-sec rep-sec-bg">
<div class="container text-center">
<h1 class="heading-title animated">What Our Students Are Saying Now</h1>
<hr>
<div class="row text-left">

<div class="col-md-6 top-marg-3">
<div class="row">
<div class="col-xs-6 col-sm-6 col-md-6 text-center">
<div class="box">
<div class="rating-star">
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star"></i>
<i class="fa fa-star-half"></i>
</div>
<div class="rating-text"><strong>4.72</strong> out of <strong>5</strong></div>
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6 text-center">
<div class="box">
<div class="review-num">
140,609
</div>
<div class="review-text">REVIEWS</div>
</div>
</div>
</div>
</div>

<div class="col-md-6 top-marg-3">
<div class="row">
<div class="col-md-12">
<div id="testi" class="owl-carousel owl-theme">
	
<div class="item">
<div class="box2">
<p>I have seen tens of trading systems & I have implemented them on the market, but no one of these systems has come near to Strategic. While implementing the system, it is as if you are standing on the market cliff and seeing all the possibilities that the market presents, It also helps to steer clear of the pit falls in the market.</p>
</div>
<div class="auther-box clearfix">
<img src="images/auther-1.png">
<span><strong>Abiola Aderibigbe</strong> Student Feedback</span>
</div>
</div>

<div class="item">
<div class="box2">
<p>I used so many indicators before. None of them made consistent results. I follow economic calendar and trade from the exact time the news is released. All of my strategy isnt working for me. My trading style doesn’t fit to what indicators i used. I also spend a lot of time on screen to see all the movements of the market.</p>
</div>
<div class="auther-box clearfix">
<img src="images/auther-2.png">
<span><strong>Anthony Santos</strong> Student Feedback</span>
</div>
</div>

<div class="item">
<div class="box2">
<p>I came here with no knowledge about trading and now  I am still can"t believe everything I learned through these classes. I really enjoy the classes and all the tools we can use to succeed in the trading. I was extremely impressed and always felt the primary focus were my interests. I really recommend this program.</p>
</div>
<div class="auther-box clearfix">
<img src="images/auther-3.jpg">
<span><strong>Mary O. Randle</strong> Student Feedback</span>
</div>
</div>

</div>
</div>
</div>

</div>
</div>
</div>
</div>
<!--//Testimonials-->

<!--proof-->
<div class="proof-sec">
<div class="container text-left">
<div class="row">

<div class="col-md-4">
<h1 class="heading-title">PROOF OF PROFITS</h1>
<hr>
<p>This is something like profit making machine. We have tried to show you our worthiness that what we are teaching, we are capable for doing the same. We have no difference in wht we say and what we do.</p>
</div>

<div class="col-md-8">
<div id="proof" class="owl-carousel owl-theme">
	
<div class="item">
<div class="videoWrapper">
<iframe title="YouTube video player" src="http://www.youtube.com/embed/jaj5Qbs73u0?wmode=transparent&autoplay=0" frameborder="0" width="600" height="360" allowfullscreen></iframe>
</div>
</div>

<div class="item">
<div class="videoWrapper">
<iframe title="YouTube video player" src="http://www.youtube.com/embed/92aJxyysheE?wmode=transparent&autoplay=0" frameborder="0" width="600" height="360" allowfullscreen></iframe>
</div>
</div>

<div class="item">
<div class="videoWrapper">
<iframe title="YouTube video player" src="http://www.youtube.com/embed/AuzVnfVqV7M?wmode=transparent&autoplay=0" frameborder="0" width="600" height="360" allowfullscreen></iframe>
</div>
</div>

<div class="item">
<div class="videoWrapper">
<iframe title="YouTube video player" src="http://www.youtube.com/embed/JDuPg8QWplE?wmode=transparent&autoplay=0" frameborder="0" width="600" height="360" allowfullscreen></iframe>
</div>
</div>

</div>
</div>

</div>
</div>
</div>
<!--//proof-->

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