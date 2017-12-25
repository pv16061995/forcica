<?php 
$menupermission=explode(',',$_SESSION['userpermission']);
if($_SESSION['membertype']=='admin') { ?>
<div id="main-nav" class="hidden-phone hidden-tablet">
          <ul>
            <li><a href="<?php echo BASEPATH.'admin/index.php'; ?>" <?php if($pagenameacco=='index.php') { ?>class="selected"<?php } ?>><span class="fs1" aria-hidden="true" data-icon="&#xe0a0;"></span> Dashboard</a></li>
            <li>
                <a href="javascript:void(0);" <?php if($pagenameacco=='admission.php' || $pagenameacco=='manageStudent.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Manage Student</a>
                <ul>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/admission.php'; ?>" <?php if($pagenameacco=='admission.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Get Admission</a>
                    </li>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/manageStudent.php'; ?>" <?php if($pagenameacco=='manageStudent.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Student List</a>
                    </li>
                    
                </ul>
            </li>
            
            <li>
                <a href="<?php echo BASEPATH.'admin/manageCourse.php'; ?>" <?php if($pagenameacco=='manageCourse.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Manage Course</a>
				<ul>
					<li>
                        <a href="<?php echo BASEPATH.'admin/managequiz.php'; ?>" <?php if($pagenameacco=='managequiz.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Manage Quiz</a>
                    </li>
					
				</ul>
            </li>
            <li style="display: none;">
                <a href="javascript:void(0);" <?php if($pagenameacco=='pasclist.php' || $pagenameacco=='paclist.php' || $pagenameacco=='filist.php' || $pagenameacco=='lblist.php' || $pagenameacco=='sblist.php' ) { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>PA Income</a>
                <ul>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/pasclist.php'; ?>" <?php if($pagenameacco=='pasclist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>PASC</a>
                    </li>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/paclist.php'; ?>" <?php if($pagenameacco=='paclist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>PAC</a>
                    </li>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/filist.php'; ?>" <?php if($pagenameacco=='filist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>FI</a>
                    </li>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/lblist.php'; ?>" <?php if($pagenameacco=='lblist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>LB</a>
                    </li>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/sblist.php'; ?>" <?php if($pagenameacco=='sblist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>SB</a>
                    </li>
                    <li>
                        <a href="#"> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>FB</a>
                    </li>
                </ul>
            </li>
            
            <li>
                <a href="javascript:void(0);" <?php if($pagenameacco=='onetime.php' || $pagenameacco=='monthlytime.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Trading Support Service</a>
                <ul>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/onetime.php'; ?>" <?php if($pagenameacco=='onetime.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>One Time Input</a>
                    </li>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/monthlytime.php'; ?>" <?php if($pagenameacco=='monthlytime.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Monthly Input</a>
                    </li>
                    
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" <?php if($pagenameacco=='studentlist.php' || $pagenameacco=='greenfieldinfo.php' || $pagenameacco=='neftlist.php' || $pagenameacco=='servicetaxlist.php' || $pagenameacco=='tdslist.php' || $pagenameacco=='payoutreport.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;" ></span>Report</a>
                <ul>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/studentlist.php'; ?>" <?php if($pagenameacco=='studentlist.php' || $pagenameacco=='greenfieldinfo.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Student List</a>
                    </li>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/neftlist.php'; ?>" <?php if($pagenameacco=='neftlist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>NEFT List</a>
                    </li>
                    <!--<li>
                        <a href="<?php //echo BASEPATH.'admin/servicetaxlist.php'; ?>" <?php //if($pagenameacco=='servicetaxlist.php') { ?>class="selected"<?php //} ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Service Tax List</a>
                    </li>-->
                    <li>
                        <a href="<?php echo BASEPATH.'admin/tdslist.php'; ?>" <?php if($pagenameacco=='tdslist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>TDS List</a>
                    </li>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/payoutreport.php'; ?>" <?php if($pagenameacco=='payoutreport.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Payout Report</a>
                    </li>
                    
                </ul>
            </li>
            
            <li>
                <a href="<?php echo BASEPATH.'admin/callcenter.php'; ?>" <?php if($pagenameacco=='callcenter.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Call Center</a>
            </li>
            <li>
                <a href="<?php echo BASEPATH.'admin/courseRequest.php'; ?>" <?php if($pagenameacco=='courseRequest.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Upgrade Request</a>
            </li>
            <li>
                <a href="<?php echo BASEPATH.'admin/payout.php'; ?>" <?php if($pagenameacco=='payout.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Payout</a>
            </li>
            <li>
                <a href="<?php echo BASEPATH.'admin/result.php'; ?>" <?php if($pagenameacco=='result.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Result</a>
            </li>
            
            <li>
                <a href="javascript:void(0);" <?php if($pagenameacco=='predictionreport.php' || $pagenameacco=='predictionreport.php' || $pagenameacco=='askme.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Others</a>
                <ul>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/predictionreport.php'; ?>" <?php if($pagenameacco=='predictionreport.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Prediction / Report</a>
                    </li>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/askme.php'; ?>" <?php if($pagenameacco=='askme.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Asked Query</a>
                    </li>
                </ul>
            </li>
            
        </ul>
    <div class="clearfix"></div>
  </div>
<?php } else { ?>
<div id="main-nav" class="hidden-phone hidden-tablet">
          <ul>
            <li><a href="<?php echo BASEPATH.'admin/index.php'; ?>" <?php if($pagenameacco=='index.php') { ?>class="selected"<?php } ?>><span class="fs1" aria-hidden="true" data-icon="&#xe0a0;"></span> Dashboard</a></li>
            
            
            <?php if(in_array('11', $menupermission) || in_array('17', $menupermission)) { ?>
            <li style="display: none;">
                <a href="javascript:void(0);" <?php if($pagenameacco=='admission.php' || $pagenameacco=='manageStudent.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Manage Student</a>
                <ul>
                    <?php if(in_array('17', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/admission.php'; ?>" <?php if($pagenameacco=='admission.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Get Admission</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('11', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/manageStudent.php'; ?>" <?php if($pagenameacco=='manageStudent.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Student List</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            
            <?php if(in_array('12', $menupermission) || in_array('18', $menupermission)) { ?>
            <li>
                <a href="<?php echo BASEPATH.'admin/manageCourse.php'; ?>" <?php if($pagenameacco=='manageCourse.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Manage Course</a>
                    <ul>
                        <?php if(in_array('18', $menupermission)) { ?>
                        <li>
                            <a href="<?php echo BASEPATH.'admin/managequiz.php'; ?>" <?php if($pagenameacco=='managequiz.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Manage Quiz</a>
                        </li>
                        <?php } ?>
                    </ul>
            </li>
            <?php } ?>
                
            <?php if(in_array('9', $menupermission) || in_array('10', $menupermission) || in_array('13', $menupermission) || in_array('14', $menupermission) || in_array('15', $menupermission)) { ?>
            <li style="display: none;">
                <a href="javascript:void(0);" <?php if($pagenameacco=='pasclist.php' || $pagenameacco=='paclist.php' || $pagenameacco=='filist.php' || $pagenameacco=='lblist.php' || $pagenameacco=='sblist.php' ) { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>PA Income</a>
                <ul>
                    <?php if(in_array('9', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/pasclist.php'; ?>"> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>PASC</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('10', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/paclist.php'; ?>" <?php if($pagenameacco=='paclist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>PAC</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('13', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/filist.php'; ?>" <?php if($pagenameacco=='filist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>FI</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('14', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/lblist.php'; ?>" <?php if($pagenameacco=='lblist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>LB</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('15', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/sblist.php'; ?>" <?php if($pagenameacco=='sblist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>SB</a>
                    </li>
                    <?php } ?>
<!--                    <li>
                        <a href="#"> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>FB</a>
                    </li>-->
                </ul>
            </li>
            <?php } ?>
            <?php if(in_array('1', $menupermission) || in_array('2', $menupermission)) { ?>
            <li>
                <a href="javascript:void(0);" <?php if($pagenameacco=='onetime.php' || $pagenameacco=='monthlytime.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Trading Support Service</a>
                <ul>
                    <?php if(in_array('1', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/onetime.php'; ?>" <?php if($pagenameacco=='onetime.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>One Time Input</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('2', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/monthlytime.php'; ?>" <?php if($pagenameacco=='monthlytime.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Monthly Input</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <?php if(in_array('3', $menupermission) || in_array('4', $menupermission) || in_array('5', $menupermission) || in_array('6', $menupermission) || in_array('7', $menupermission)) { ?>
            <li>
                <a href="javascript:void(0);" <?php if($pagenameacco=='studentlist.php' || $pagenameacco=='greenfieldinfo.php' || $pagenameacco=='neftlist.php' || $pagenameacco=='servicetaxlist.php' || $pagenameacco=='tdslist.php' || $pagenameacco=='payoutreport.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;" ></span>Report</a>
                <ul>
                    <?php if(in_array('3', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/studentlist.php'; ?>" <?php if($pagenameacco=='studentlist.php' || $pagenameacco=='greenfieldinfo.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Student List</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('4', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/neftlist.php'; ?>" <?php if($pagenameacco=='neftlist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>NEFT List</a>
                    </li>
                    <?php } ?>
                    <?php //if(in_array('5', $menupermission)) { ?>
                    <!--<li>
                        <a href="<?php //echo BASEPATH.'admin/servicetaxlist.php'; ?>" <?php //if($pagenameacco=='servicetaxlist.php') { ?>class="selected"<?php //} ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Service Tax List</a>
                    </li>-->
                    <?php //} ?>
                    <?php if(in_array('6', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/tdslist.php'; ?>" <?php if($pagenameacco=='tdslist.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>TDS List</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('7', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/payoutreport.php'; ?>" <?php if($pagenameacco=='payoutreport.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Payout Report</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <?php if(in_array('8', $menupermission)) { ?>
            <li>
                <a href="<?php echo BASEPATH.'admin/callcenter.php'; ?>" <?php if($pagenameacco=='callcenter.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Call Center</a>
            </li>
            <?php } ?>
            <?php if(in_array('13', $menupermission)) { ?>
            <li>
                <a href="<?php echo BASEPATH.'admin/payout.php'; ?>" <?php if($pagenameacco=='payout.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Payout</a>
            </li>
            <?php } ?>
            <?php if(in_array('16', $menupermission)) { ?>
            <li>
                <a href="<?php echo BASEPATH.'admin/result.php'; ?>" <?php if($pagenameacco=='result.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Result</a>
            </li>
            <?php } ?>
            <?php if(in_array('19', $menupermission) || in_array('20', $menupermission)) { ?>
            <li>
                <a href="javascript:void(0);" <?php if($pagenameacco=='predictionreport.php' || $pagenameacco=='predictionreport.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Others</a>
                <ul>
                    <?php if(in_array('19', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/predictionreport.php'; ?>" <?php if($pagenameacco=='predictionreport.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Prediction / Report</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array('20', $menupermission)) { ?>
                    <li>
                        <a href="<?php echo BASEPATH.'admin/askme.php'; ?>" <?php if($pagenameacco=='askme.php') { ?>class="selected"<?php } ?>> <span class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></span>Asked Query</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
          </ul>
    <div class="clearfix"></div>
  </div>

<?php } ?>
