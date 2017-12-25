<?php  
$pagenameacco = basename($_SERVER['PHP_SELF']);
$name=$_SESSION['name'];
$profile_image=$_SESSION['profile_image'];
?>
<header>
      <a href="dashboard.php" class="logo"><img src="<?php echo BASEPATH; ?>bootstrap/img/logo.png" /></a>
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
          
            <li>
                <a href="#">
                    <div class="profile">
                        
                        
                        <b>Welcome  <?php echo ucfirst($name); ?></b>
                        
                        <?php if($profile_image=='') { ?>
                        <img src="user_images/default.png" style="width:40px; height:35px; border-radius:4px;">
                        <?php } else { ?>
                        <img src="../userdocs/<?php echo $_SESSION['studentuserid']; ?>/<?php echo $profile_image; ?>" style="width:40px; height:35px; border-radius:4px;">
                        <?php } ?>
                    </div>
                </a>
            </li>
            <li>
              <a href="profile.php" data-toggle="tooltip" data-original-title="Profile" data-placement="bottom"><span class="fs1" aria-hidden="true" data-icon="&#xe090;"></span></a>
            </li>
            <li>
                <a href="<?php echo BASEPATH.'logout.php?cmd=logout'; ?>"><span class="fs1" aria-hidden="true" data-icon="&#xe0b1;"></span></a>
            </li>
        </ul>
    <div class="clearfix"></div>
  </div>
</header>