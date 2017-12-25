<div class="animatedParent animateOnce" data-sequence="500">
<div class="footer-top">
<div class="container text-left animated fadeInDownShort" data-id="1">
<h1 class="heading-title">Admission Enquiry</h1>
<h2 class="heading-title2">Take your education on a test drive as you learn to trade forex</h2>
<hr>
<div class="row">
<form action="" method="POST" id="getaddmissionform"> 
<div class="col-md-10">
<div class="row">
<div class="col-sm-4 col-md-4">
<input type="text" name="get_name" id="get_name" class="validate[required]" placeholder="Full name">
</div>
<div class="col-sm-4 col-md-4 top-sm-10">
<input type="text" name="get_email" id="get_email" class="validate[required]" placeholder="Email address">
</div>
<div class="col-sm-4 col-md-4 top-sm-10">
<input type="text" name="get_phone" id="get_phone" class="validate[required]" placeholder="Phone number">
</div>
</div>
</div>
<div class="col-md-2 top-md-10">
<button type="button" name="submitget" id="submitget" onclick="submitgetadmission();">Submit <i class="fa fa-caret-right"></i></button>
<button type="button" name="submitget" id="submitget1" style="display: none;"> <i class="fa fa-spinner"></i></button>
</div>
</form>
</div>
</div>
</div>
</div>
<!--//Foote Top-->

<!--footer-->
<div class="animatedParent animateOnce" data-sequence="500">
<div class="footer">
<div class="container">
<div class="row">

<div class="col-md-6">
<div class="row">
<div class="col-sm-6 col-md-6 box-1 animated fadeInDownShort" data-id="1">
<h3>NAVIGATION</h3>
<hr>
<ul class="list-unstyled">
<li><a href="index.php">Home</a></li>                    
<li><a href="classes.php">Classes</a></li>
<li><a href="paying-admission-fee.php">Get Admission</a></li>
<li><a href="predictions.php">Predictions</a></li>
<li><a href="reports.php">Reports</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>
</div>

<div class="col-sm-6 col-md-6 box-1 animated fadeInDownShort" data-id="2">
<h3>OUR COURSES</h3>
<hr>
<ul class="list-unstyled">
<li><a href="mt4.php">MT4 - Basics</a></li>
<li><a href="binary_option.php">Binary Option Trading - Basics</a></li>
<li><a href="basics.php">Forex Trading - Basics</a></li>
<li><a href="senior-secondary.php">Forex Trading - Senior Secondary</a></li>
<li><a href="graduation.php">Forex Trading - Graduation Level</a></li>
<li><a href="post-graduation.php">Forex Trading - Post Graduation</a></li>
<li><a href="javascript:;">Forex Trading - Researcher</a></li>
</ul>
</div>
</div>
</div>

<div class="col-md-6">
<div class="row">
<div class="col-sm-6 col-md-5 box-1 animated fadeInDownShort" data-id="3">
<h3>INFORMATION</h3>
<hr>
<ul class="list-unstyled">
<li><a href="proofs-of-profits.php">Proof of Profits</a></li>
<!-- <li><a href="feedback.php">Feedback</a></li> -->
<li><a href="glimpses-of-courses.php">Glimpse of Courses</a></li>
<li><a href="previous-results.php">Previous Results</a></li>
<li><a href="terms-&-conditions.php">Terms & Conditions</a></li>
<li><a href="privacy-policy.php">Privacy Policy</a></li>
</ul>
</div>

<div class="col-sm-6 col-md-6 col-md-offset-1 box-1 animated fadeInDownShort" data-id="4">
<h3>OUR LOCATION</h3>
<hr>
<div class="clearfix">
<div class="icon"><i class="fa fa-home"></i></div>
<div class="icon-text">Address</div>
<p>Forcica Commodity Solutions OPC Private Limited, 113-115, SS Plaza, Sector-1 Dwarka, New Delhi-110075</p>
</div>
<div class="clearfix top-marg">
<div class="icon"><i class="fa fa-phone"></i></div>
<div class="icon-text">Phone Number</div>
<p>+91-7042782924, +91-7042782925</p>
</div>
<div class="clearfix top-marg">
<div class="icon"><i class="fa fa-envelope"></i></div>
<div class="icon-text">E-Mail</div>
<p>support@forcica.com</p>
</div>
</div>
</div>
</div>

<div class="clearfix col-md-12 animated fadeInDownShort" data-id="5">
<div class="sep"></div>
</div>
<div class="col-md-12 disclosure animated fadeInDownShort" data-id="5">
<p><strong>Risk Disclosure:</strong> Forcica will not accept any liability for loss or damage as a result of reliance on the information contained within this website including data, quotes, charts and buy/sell signals. Please be fully informed regarding the risks and costs associated with trading the financial markets, it is one of the riskiest investment forms possible. Currency trading on margin involves high risk, and is not suitable for all investors. Before deciding to trade foreign exchange or any other financial instrument you should carefully consider your investment objectives, level of experience, and risk appetite.</p>
<p>Forcica would like to remind you that the data contained in this website is not necessarily real-time nor accurate. All CFDs (stocks, indexes, futures) and Forex prices are not provided by exchanges but rather by market makers, and so prices may not be accurate and may differ from the actual market price, meaning prices are indicative and not appropriate for trading purposes. Therefore Forcica doesn’t bear any responsibility for any trading losses you might incur as a result of using this data.</p>
</div>

</div>
</div>

<div id="footer-copyright">
<div class="container">
<div class="row">
<div class="left animated fadeInDownShort" data-id="6">
<div class="col-md-12">Copyright &copy; 2017, Forcica Commodity Solution OPC Pvt Ltd. All Rights Reserved</div>
</div>
</div>
</div>
</div>
</div>
</div>

<link href="css/validationEngine.jquery.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-en.js"></script>

<script>
$(document).ready(function() {

$('#get_phone').bind('keypress', function(e) { 
        return ( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) ? false : true ;
    });
 });
function submitgetadmission()
{
  

  if($("#getaddmissionform").validationEngine('validate'))
  {
    $('#submitget').hide('fast');
    $('#submitget1').show('fast');

    
    var name=$('#get_name').val();
    var phone=$('#get_phone').val();
    var email=$('#get_email').val();
    
	$.post("mail.php",{
    q:"getaddmissionform",
    name:name,
    phone:phone,
    email:email,
    },function(data){
      $('#submitget1').hide('fast');
      $('#submitget').show('fast');
      var des=data.split('^');
      alert(des[2]);
       if(des[1]=='save')
       {
        
         window.location.reload();
       }   
    });
      
    
  }else{
    return false;
  }

}
</script>