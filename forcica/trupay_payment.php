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

<?php 
$flag=false;
$obj=New Common();
if(isset($_SESSION['tru_user_id']))
{
 $flag=true;
 $uid=$_SESSION['tru_user_id'];


 $student=$obj->getStudentDetailByUid($uid);
 $detail=$student->fetch_assoc();


 $order_id=rand(9999,99999999);
 $update_order=$obj->getUpdateOrderIdByUid($uid,$order_id);
 $_SESSION['orderId']=$order_id;
 
}else{
	header("location:index.php");
}

?>





<!--banner-->
<div class="inner-banner" style="background:url(images/admission-bg.jpg);"> 
<div class="container">
<h1>Online Payment</h1>
<div class="breadcrumb"><a href="index.php"> HOME </a> / Online Payment</div>
</div>   
</div>
<!--//banner-->

<!--Admission-->
<div class="admission-wrap">
<div class="container text-left">
<div class="form-box">
<form id="msform" class="clearfix" id="paymentform" action="" enctype="multipart/form-data" method="POST">
<div class="row text-left">
<div class="col-xs-12 col-sm-6 col-md-6">
<label>First Name *</label>
<input name="first_name" id="first_name" type="text"  placeholder="Enter First Name" readonly value="<?php if($flag){ echo $detail['first_name'];}?>"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Last Name *</label>
<input name="last_name" id="last_name" type="text"  placeholder="Enter Last Name" readonly value="<?php if($flag){ echo $detail['last_name'];}?>"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>E-mail ID *</label>
<input name="email" id="email" type="text"  placeholder="Enter E-mail ID" readonly value="<?php if($flag){ echo $detail['email'];}?>"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Mobile Number *</label>
<input name="phone" id="phone" type="text" maxlength="15" placeholder="Your Mobile Number" readonly value="<?php if($flag){ echo $detail['phone'];}?>"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Total Fee *</label>
<input name="total_fee" id="total_fee" type="text" placeholder="Enter Your Total Fee" readonly value="<?php if($flag){ echo $detail['fee'];}?>"></div>
<div class="col-xs-12 col-sm-6 col-md-6">
<label>Payment Id</label>
<input name="order_id" id="order_id" type="text" placeholder="Enter Payment Id *" readonly  value="<?php if($flag){ echo $order_id;}?>"></div>

</div>
<div id="trupayPaymentFrame"></div>

<button type="button" id="submitButton" onclick="getWebSessionKey('<?php echo base64_encode($order_id);?>','<?php echo base64_encode($detail['fee']);?>','<?php echo base64_encode($detail['email']);?>','<?php echo base64_encode($detail['phone']);?>')" class="pay_btn">Submit</button>

</form>
</div>
</div>
</div>
<!--  Trupay   -->
<!--//Admission-->

<!--Footer-->
<?php include 'include/footer.php'; ?>
<!--//footer-->
<script>
  
  <?php 
  if(isset($_GET))
  {
    ?>
    $(document).ready(function() {
      $("#submitButton").trigger("click");
    });
  <?php } ?>

   



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
<script src="js/jquery.easing.min.js" type="text/javascript"></script>
</body>
</html>	
<style type="text/css">
.form-errors{
	text-align: left;
    color: #ea1313;
    font-size: 15px;
    font-weight: 500;
}

#tst_fieldset2,#tst_fieldset1,#tst_fieldset3
{
  display: block !important;
} 
</style>
<script src="https://uat.trupay.in/TrupayPaymentGateway/js/trupay-web-payment.js" type="text/javascript"></script>
<script type="text/javascript" src="trupay/client.js"></script>