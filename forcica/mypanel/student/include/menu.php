<div id="main-nav" class="hidden-phone hidden-tablet">
    <ul>
        <li>
            <a href="<?php echo BASEPATH.'student/index.php'; ?>" <?php if($pagenameacco=='index.php') { ?>class="selected"<?php } ?>><span class="fs1" aria-hidden="true" data-icon="&#xe0a0;"></span> Dashboard</a></li>
        <li>
            <a href="<?php echo BASEPATH.'student/applyForMarketingDivision.php'; ?>" <?php if($pagenameacco=='applyForMarketingDivision.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Publicity Agent</a>
        </li>
        <li>
            <a href="<?php echo BASEPATH.'student/DSA-Agreement.php'; ?>" <?php if($pagenameacco=='DSA-Agreement.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Direct Selling Agent</a>
        </li>
        <li>
            <a href="<?php echo BASEPATH.'student/greenfieldinfo.php'; ?>" <?php if($pagenameacco=='greenfieldinfo.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Green Field Info</a>
        </li>
        <li>
            <a href="<?php echo BASEPATH.'student/courses_category.php'; ?>" <?php if($pagenameacco=='courses_category.php' || $pagenameacco=='courses.php' || $pagenameacco=='apply_courses.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Courses</a>
        </li>

        <li>
            <a href="<?php echo BASEPATH.'student/feedback.php'; ?>" <?php if($pagenameacco=='feedback.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Feedback</a>
        </li>
        <li>
            <a href="<?php echo BASEPATH.'student/askme.php'; ?>" <?php if($pagenameacco=='askme.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Ask Me</a>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>