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


<!--banner-->
<div class="inner-banner" style="background:url(images/contact-bg.jpg);"> 
<div class="container">
<h1>Contact us</h1>
<div class="breadcrumb"><a href="index.php"> HOME </a> / Contact us</div>
</div>   
</div>
<!--//banner-->

<!--contact-->
<div class="contact-wrap bg-grey">
<div class="container text-center">
<div class="row">
<div class="col-md-4">
<div class="bg-purple">
<div class="icon"><i class="fa fa-map-marker"></i></div>
<h4>ADDRESS</h4>
<p>Forcica Commodity Solutions OPC Private Limited, 113-115, SS Plaza, Sector-1 Dwarka, New Delhi-110075</p>
</div>
</div>
<div class="col-md-4 top-md-10">
<div class="bg-purple">
<div class="icon"><i class="fa fa-phone"></i></div>
<h4>Phone Number</h4>
<p>+91-7042782924<br>+91-7042782925</p>
</div>
</div>
<div class="col-md-4 top-md-10">
<div class="bg-purple">
<div class="icon"><i class="fa fa-envelope"></i></div>
<h4>E- Mail ID</h4>
<p>support@forcica.com<br>info@forcica.com</p>
</div>
</div>
</div>
</div>
</div>

<div class="contact-wrap">
<div class="container text-center">
<h1 class="heading-title">LET’S GET STARTED</h1>
<hr>
<p>We’re here to help answer your questions. our experts are on hand to help inform you of every aspect regarding your topic. We take great pride in using our expertise for you and look forward to hearing from you.</p>
<div class="row text-left">
<form class="form-box" action="" method="POST" id="contactform">
<div class="col-md-6 top-marg-2">
<input name="name" id="name" type="text" placeholder="Your Name" class="validate[required]">
</div>
<div class="col-md-6 top-marg-2">
<input name="phone" id="phone" type="text" placeholder="Your phone number" class="validate[required]">
</div>
<div class="col-md-6 top-marg-2">
<input name="email" id="email" type="text" placeholder="Your E-mail ID" class="validate[required,custom[email]]">
</div>
<div class="col-md-6 top-marg-2">
<input name="subject" id="subject" type="text" placeholder="Subject" class="validate[required]">
</div>
<div class="col-md-12 top-marg-2">
<textarea name="message" id="message" cols="" rows="3" placeholder="Your Message" class="validate[required]"></textarea>
</div>
<div class="col-md-6 top-marg-2">
<div class="row">
<div class="col-xs-8 col-sm-9">
<input name="captchatext" id="captchatext" type="text" placeholder="Captcha Code" class="validate[required]">
</div>
<div class="col-xs-4 col-sm-3">
<input type="hidden" name="captchahide" id="captchahide">
<div id="captcha"></div>
<!-- <img src="images/captcha_code.jpg"> -->
</div>
</div>
</div>
<div class="col-md-6 top-marg-2">
<input name="contactsubmit" onclick="return submitcontact();" type="button" value="Send Message" id="contactsubmit">
<input name="contactsubmit1" id="contactsubmit1" style="display: none;" type="button" value="Send Message">


</div>
</form>
</div>
</div>
</div>
<!--//contact-->

<div class="google-maps">
<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d112111.64001490815!2d77.00281083374028!3d28.585111013786882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x390d1b166d2d2471%3A0x80ba6309f445a999!2sForcica+Commodity+Solutions+OPC+Private+Limited%2C+113-115%2C+SS+Plaza%2C+Sector-1+Dwarka%2C+New+Delhi-110075!3m2!1d28.585129!2d77.0728511!5e0!3m2!1sen!2sin!4v1504182880084" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

<!--Footer-->
<?php include 'include/footer.php'; ?>
<!--//footer-->

<script>
$(document).ready(function() {
  $('#phone').bind('keypress', function(e) { 
        return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
    });
  
var a1 = Math.ceil(Math.random() * 9)+ '';
var b1 = Math.ceil(Math.random() * 9)+ '';
var c1 = Math.ceil(Math.random() * 9)+ '';
var d1= Math.ceil(Math.random() * 9)+ '';
var e1 = Math.ceil(Math.random() * 9)+ '';

var code = a1 + b1 + c1 + d1 + e1;
$('#captcha').html(code);
$('#captchahide').val(code);

 $("#contactform").validationEngine('attach');
});

function submitcontact()
{
  if($("#contactform").validationEngine('validate'))
  {
   

    var captchatext=$('#captchatext').val();
    var captchahide=$('#captchahide').val();
    var name=$('#name').val();
    var phone=$('#phone').val();
    var email=$('#email').val();
    var subject=$('#subject').val();
    var message=$('#message').val();


     if(captchahide==captchatext)
     {

       $('#contactsubmit').hide('fast');
       $('#contactsubmit1').show('fast');

        $.post("mail.php",{
        q:"contactform",
        name:name,
        phone:phone,
        email:email,
        subject:subject,
        message:message,
        },function(data){
         
          $('#contactsubmit1').hide('fast');
          $('#contactsubmit').show('fast');
          var des=data.split('^');
          alert(des[2]);
           if(des[1]=='save')
           {
            
             window.location.reload();
           }

        });
      
     }else{
      alert('Invalid Captcha Code !!!');
      return false;
     }
  }else{
    return false;
  }

}




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
    function doAnimations( elems ) {
        var animEndEv = 'webkitAnimationEnd animationend';
        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }
    var $myCarousel = $('#carousel-example-generic'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
    $myCarousel.carousel();
    doAnimations($firstAnimatingElems);
    $myCarousel.carousel('pause');
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
</body>
</html>	

<style>
#captcha
{
    font-size: 35px;
    font-weight: 700;
    margin-top: 10px;
}
</style>
