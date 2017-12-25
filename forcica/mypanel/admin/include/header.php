<?php  
$pagenameacco = basename($_SERVER['PHP_SELF']);
$name=$_SESSION['name'];
$profile_image=$_SESSION['profile_image'];
$menupermission=explode(',',$_SESSION['userpermission']);
?>
<header>
      <a href="index.php" class="logo"><img src="<?php echo BASEPATH; ?>bootstrap/img/logo.png" /></a>
      <div id="mini-nav">
        <ul class="hidden-phone" >
            <li class="dropdown" style="display: none;">
                <a data-toggle="dropdown" class="dropdown-toggle" href="">
                  Master
                  <span class="caret icon-white"></span>
                </a>

                <ul class="dropdown-menu pull-right">
                    <li><a href=""><span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span> Manage Category</a></li>
                </ul>
            </li>
          
<!--            <li>
                <a href="../logout.php?cmd=admin" class="btn btn-info" style="color:#fff;">Back To Admin</a>
            </li>-->
            <li>
                <a href="#">
                    <div class="profile">
                        
                        
                        <b>Welcome  <?php echo ucfirst($name); ?></b>
                        
                        <?php if($profile_image=='') { ?>
                        <img src="user_images/default.png" style="width:40px; height:35px; border-radius:4px;">
                        <?php } else { ?>
                        <img src="user_images/<?php echo $profile_image; ?>" style="width:40px; height:35px; border-radius:4px;">
                        <?php } ?>
                    </div>
                </a>
            </li>
            <?php if($_SESSION['membertype']=='admin') { ?>
            <li>
              <a href="usermanagement.php" data-toggle="tooltip" data-original-title="Users" data-placement="bottom"><span class="fs1" aria-hidden="true" data-icon="&#xe075;"></span></a>
            </li>
            <li>
              <a href="websiteenquiry.php" data-toggle="tooltip" data-original-title="Enquiry" data-placement="bottom"><span class="fs1" aria-hidden="true" data-icon=""></span></a>
            </li>

            <li>
              <a href="websitefeedback.php" data-toggle="tooltip" data-original-title="Feedback" data-placement="bottom"><span class="fs1" aria-hidden="true" data-icon=""></span></a>
            </li>
            <?php } ?>
            <li>
              <a href="profile.php" data-toggle="tooltip" data-original-title="Profile" data-placement="bottom"><span class="fs1" aria-hidden="true" data-icon="&#xe090;"></span></a>
            </li>
            <li>
                <a href="<?php echo BASEPATH.'logout.php?cmd=logout'; ?>" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom"><span class="fs1" aria-hidden="true" data-icon="&#xe0b1;"></span></a>
            </li>
        </ul>
    <div class="clearfix"></div>
  </div>
</header>