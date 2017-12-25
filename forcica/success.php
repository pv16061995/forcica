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
/* require_once 'trupay/ApiCalls.php'; */

require_once 'trupay/Request.php';
ini_set("display_errors",'1');

$obj=new Common();

//$request = new Request();
//$request->setMERCH_ORDER_ID($_SESSION['orderId']);

if(isset($_SESSION['orderId']))
{
$curl = curl_init();

$arr=array();
$arr['MERCH_ORDER_ID']=$_SESSION['orderId'];
$arr['REQUEST_ID']=$_SESSION['orderId'];

$postfield= json_encode($arr);

////// hash code ////
$hash='f06e5da4';
$secureHash = hash('sha512', $arr['MERCH_ORDER_ID']."||".$hash);

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://uatm.trupay.in/merchant/api/ver1/txn/status",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $postfield,
  CURLOPT_HTTPHEADER => array(
    "accept-encoding: application/json",
    "authorization: Bearer b9fe552d-af25-49ff-b5f8-7db54f66321a",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: b8227a68-cf0d-aeba-2f61-aaeea1de6694",
    "securehash: ".$secureHash
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


if ($err) {
  echo "cURL Error #:" . $err;
} else {
   $final_res=json_decode($response);
   $carr=array();
  foreach($final_res as $key=>$data)
  {
    $carr[$key]=$data;

  }
} 

  $txn_id=$carr['TXN_ID']; 
  $amt=$carr['TXN_AMOUNT'];

  $savedetail=$obj->updatepaymentdetail($_SESSION['orderId'],$txn_id,$amt);

  $getdetail=$obj->getdetailBYOrderId($_SESSION['orderId']);
  $stu_detail=$getdetail->fetch_assoc();
  $pass=$_SESSION['tru_pid'];

  $name=ucfirst(strtolower($stu_detail['first_name'].' '.$stu_detail['last_name']));
  $level_name=$stu_detail['categoryname'].'-'.$stu_detail['coursename'];

    $to = $stu_detail['user_email'];
    $subject = 'New Admission - Forcica';
    $message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
    $message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
    $message .='<b>Dear '.$name.',</b><br><br>';
    $message .="we are highly pleased to inform you that your request for admission in the course '".$level_name."' has been accepted and your submitted information have been duly verfied. Kindly complete the rest formalities and start learning.<br><br>";
    $message .='Your Login details given below: <br><br>';
    $message .='<b>Username :</b>'.trim($stu_detail['user_login']).'<br><b>Password :</b>'.$pass.'  <br><br>';
    $message .='Kindly use the same for future references.<br><br>';
    $message .='With Best Regards<br>Administration<br>www.forcica.com<br>
    info@forcica.com<br>+91-7042782924';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: Forcica  <support@forcica.com> \r\n";
    @mail($to, $subject, $message, $headers);
    
    
    
    $to = 'support@forcica.com';
    $subject = 'New Admission Payment Confirmation - Forcica';
    $message='<div style="width:500px;height:950px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;background-image: url('.BASEPATH.'bootstrap/img/mail-img.jpg);">';
    $message .='<div style="margin-top: 60%;width: 50%;margin-left: 45%;">';
    $message .='<b>Dear Admin,</b><br><br>';
    $message .="New admission payment has been received from '.$name.' for course '".$level_name."'. Payment details are as follows :<br><br> Order Id - ".$_SESSION['orderId']."<br> Transaction No - ".$txn_id."";
    $message .='With Best Regards<br>Forcica';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: Forcica  <support@forcica.com> \r\n";
    @mail($to, $subject, $message, $headers);

    unset($_SESSION['orderId']);
    unset($_SESSION['tru_pid']);
    unset($_SESSION['tru_user_id']);
}
else 
{
  header('location: index.php');
}

?>

<!--banner-->
<div class="inner-banner" style="background:url(images/reports-bg.jpg);"> 
<div class="container">
<h1>Payment Success</h1>
<div class="breadcrumb"><a href="index.php"> HOME </a> / Payment Success</div>
</div>   
</div>
<!--//banner-->

<!--Predictions-->
<div class="predictions-wrap">
<div class="container text-center">
<img src="images/payment_success.png" class="img-responsive success-img" />

<h1 class="payment-title">Thank You!</h1>

<h1 class="heading-title">Payment Id : <?php echo $txn_id;?></h1>
<h2 class="sub-msg">Your payment has been received and we will contact you soon.</h2>
</div>
</div>
<!--//Predictions-->

<!--reports-->

<!--//reports-->

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