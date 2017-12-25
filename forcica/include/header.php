<?php 
require_once 'mypanel/controls/clsCommon.php';
require_once 'mypanel/controls/clsUser.php';
require_once 'mypanel/controls/clsMember.php';
?>
<header class="header">
<nav class="navbar navbar-default bootsnav">
<div class="container">  
<div class="attr-nav">
<ul>
<li><a href="<?php echo BASEPATH;?>"><i class="fa fa-sign-in"></i> LOGIN</a></li>
</ul>
</div>    
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
<i class="fa fa-bars"></i></button>
<a class="navbar-brand" href="index.php"><img src="images/logo-2.png" class="img-responsive" ></a></div>

<div class="collapse navbar-collapse" id="navbar-menu">
<ul class="nav navbar-nav navbar-right" data-in="" data-out="">
<li class="active"><a href="index.php">HOME</a></li>  
<li class="dropdown"><a href="classes.php" class="dropdown-toggle" data-toggle="dropdown">Courses</a>
<ul class="dropdown-menu">
<li><a href="mt4.php">MT4 - Basics</a></li>
<li><a href="binary_option.php">Binary Option Trading - Basics</a></li>
<li><a href="basics.php">Forex Trading - Basics</a></li>
<li><a href="senior-secondary.php">Forex Trading - Senior Secondary</a></li>
<li><a href="graduation.php">Forex Trading - Graduation Level</a></li>
<li><a href="post-graduation.php">Forex Trading - Post Graduation</a></li>
<li><a href="javascript:;">Forex Trading - Researcher</a></li>
</ul>
</li>                  
<li><a href="paying-admission-fee.php">GET ADMISSION</a></li>
<li><a href="predictions.php">PREDICTIONS</a></li>
<li><a href="reports.php">REPORTS</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" >LEGAL DOCUMENTS</a>
<ul class="dropdown-menu">
<li><a href="pancard.php">Pancard</a></li>
<li><a href="incorporation-certificate.php">Incorporation Certificate</a></li>
</ul>
</li>
<li><a href="contact.php">CONTACT</a></li>
</ul>
</div>
</div>   
</nav>
</header>