<?php 
include_once('../controls/config.php');
include_once('../controls/clsAlerts.php');
include_once('../controls/clsUser.php');
include_once('../controls/clsMember.php');

if(isset($_SESSION['studentloggedin'])) {
    
} else {
    header('location: ../index.php');
}

//print_r($_SESSION);
$obj=new User();

$flagPA=FALSE;

$objM=new Member();
$resC=$objM->checkPA($_SESSION['studentuserid']);

if($resC->num_rows>0) { $flagPA=TRUE; }

if(isset($_POST['submit']))
{
    if(!$flagPA) 
    {
        $uid=$_POST['user_id'];
        $bankname=$_POST['bankname'];

        $branchcode=$_POST['branchcode'];
        $accountname=$_POST['accountname'];

        $email=$_POST['email'];
        $accountnumber=$_POST['accountnumber'];
        $ifsccode=$_POST['ifsccode'];

        $pancardatt=$_POST['pancardatt'];

        $resP=$obj->saveStudentasPA($uid,$bankname,$branchcode,$accountname,$email,$accountnumber,$ifsccode,$pancardatt);

        if($resP)
        {
            $_SESSION['SuccessMessage']='Your Application has been submitted successfully';
        }
        else 
        {
            $_SESSION['ErrorMessage']='Error occured while submitting application';
        }
    }
    else 
    {
        $_SESSION['ErrorMessage']='You have already registered your Application';
    }
}

$res=$obj->getStudentUserDetailsById($_SESSION['studentuserid']);
$data=$res->fetch_assoc();



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Forcica School Of Trading</title>
    <meta name="author" content="" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="description" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/html5-trunk.js"></script>
    <link href="<?php echo BASEPATH; ?>bootstrap/icomoon/style.css" rel="stylesheet" />
    
    <!-- NVD graphs css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/nvd-charts.css" rel="stylesheet" />

    <!-- Bootstrap css -->
    <link href="<?php echo BASEPATH; ?>bootstrap/css/main.css" rel="stylesheet" />
    <link rel="icon" href="<?php echo BASEPATH;; ?>bootstrap/images/admin-logo.png" type="image/x-icon">
    <!-- fullcalendar css -->
    
    </head>
  <body>
    <?php include_once('include/header.php'); ?>
    <div class="container-fluid">
      <?php // include_once('include/left-navigation.php'); ?>
    <div class="dashboard-wrapper no-margin">
        <?php include_once('include/menu.php'); ?>
        <div class="main-container">
          <div class="navbar hidden-desktop">
            <div class="navbar-inner">
              <div class="container">
                <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
<!--                <div class="nav-collapse collapse navbar-responsive-collapse">
                  <ul class="nav">
                    <li>
                      <a href="index.html">Dashboard</a>
                    </li>
                    
                    <li>
                      <a href="form.html">form</a>
                    </li>
                    <li>
                      <a href="list.html">list</a>
                    </li>
                    
                  </ul>
                </div>-->
              </div>
            </div>
          </div>
          <div class="page-header">
            <div class="pull-left">
              <h2>Apply For Marketing Division</h2>
            </div>
            <div class="pull-right">
              <ul class="stats">
<!--                <li class="color-first hidden-phone">
                  <span class="fs1" aria-hidden="true" data-icon="&#xe037;"></span>
                  <div class="details">
                    <span class="big">$879,89</span>
                    <span>Balance</span>
                  </div>
                </li>-->
                <li class="color-second">
                  <span class="fs1" aria-hidden="true" data-icon="&#xe052;"></span>
                  <div class="details" id="date-time">
                    <span>Date </span>
                    <span>Day, Time</span>
                  </div>
                </li>
              </ul>
            </div>
            <div class="clearfix"></div>
            <?php ShowAlerts(); ?>
          </div>

        <?php if($flagPA) { ?>
            <h4>You have already registered your Application</h4>
        <?php } else { ?>
        <div class="row-fluid">
            <div class="span12">
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Apply For Marketing Division 
                  </div>
                </div>
                
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $data['ID']; ?>">
                    
                    <div class="row-fluid">
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">Bank Name *</label>
                          <div class="controls">
                            <input type="text" name="bankname" id="bankname" class="span12" placeholder="Enter Bank Name" value="" />
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="email1">Branch Area *</label>
                          <div class="controls">
                            <input type="text" name="branchcode" id="branchcode" class="span12" placeholder="Enter Branch Area" value="" />
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Account Name *</label>
                          <div class="controls">
                              <input type="text" name="accountname" id="accountname" class="span12" placeholder="Enter Account Name"  value="<?php echo $data['first_name'].' '.$data['last_name']; ?>" />
                              
                              <input type="hidden" name="email" id="email" class="span12" value="<?php echo $data['user_email']; ?>"/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Account Number *</label>
                          <div class="controls">
                            <input type="text" name="accountnumber" id="accountnumber" class="span12" placeholder="Enter Account Number"  value=""/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">IFSC Code *</label>
                          <div class="controls">
                              <input type="text" name="ifsccode" id="ifsccode" class="span12" placeholder="Enter IFSC Code"  value="" />
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">PAN Card*</label>
                          <div class="controls">
                            <input type="text" name="pancardatt" id="pancardatt" class="span12" placeholder="Enter PAN Card"  value=""/>
                          </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <h4>Publicity Services Agreement</h4>
                        <hr>
                        <div class="control-group span12 left-0" style="border: 1px solid #e0e0e0; overflow: auto; max-height: 300px; ">
                        <div style="margin: 10px;">
                            <p>NOW, THEREFORE, in consideration of the mutual promises contained herein, the parties agree as follows:</p>
                            <ol>
                            <li><strong><u> Definitions</u></strong></li>
                            </ol>
                            <p>As used herein, the following terms shall have the meanings set forth below:</p>
                            <ol>
				<li><strong> "Services" </strong>shall mean the publicity of the Company\'s services to be rendered by Publicity Service Agent and such services as may be communicated by the Company in writing or published on the official website of the Company to the Publicity Service Agent from time to time.</li>
				<li><strong> "Territory</strong>" shall be allocated during time of engagement by the Company in writing to the Publicity Service Agent. Any change in "Territory" shall be communicated by the Company in writing to the Publicity Service Agent from time to time.</li>
				<li><strong> Publicity Service Agent </strong>will have the title of "Publicity Service Agent."</li>
				<li><strong><u> Appointment</u></strong></li>
				</ol>
				<p>Company hereby appoints Publicity Service Agent for the services in the territory, and Publicity Service Agent hereby accepts such appointment. Publicity Service Agent\'s sole authority shall be to aware prospective customers about the services in the territory in accordance with the terms of this agreement. Publicity Service Agent shall not have the authority to make any commitments whatsoever on behalf of Company.</p>
				<ol start="3">
				<li><strong><u> General Duties</u></strong></li>
				</ol>
				<p>Publicity Service Agent shall use his best efforts to promote the services and maximize the awareness of the services in the territory. Publicity Service Agent shall also provide reasonable assistance to Company in promotional activities in the territory.</p>
				<ol start="4">
				<li><strong><u> Reserved Rights</u></strong></li>
				</ol>
				<p>Company reserves the right to solicit/engage other Publicity Service Agents directly from businesses within the territory.</p>
				<ol start="5">
				<li><strong><u> Conflict of Interest</u></strong></li>
				</ol>
				<p>Publicity Service Agent warrants to Company that it does not currently represent or promote any Services that compete with the Company\'s Services. During the term of this Agreement, Publicity Service Agent shall not represent, promote or otherwise try to sell within the Territory any Services that, in Company\'s judgment, compete with the Services covered by this Agreement.</p>
				<ol start="6">
				<li><strong><u> Independent Contractor</u></strong></li>
				</ol>
				<p>Publicity Service Agent is an independent contractor, and nothing contained in this Agreement shall be construed to</p>
				<p>(i) give either party the power to direct and control the day-to-day activities of the other,</p>
				<p>(ii) constitute the parties as partners, joint ventures, co- owners or otherwise, or</p>
				<p>(iii) allow Publicity Service Agent to create or assume any obligation on behalf of Company for any purpose whatsoever. Publicity Service Agent is not an employee of Company and is not entitled to any employee benefits. Publicity Service Agent shall be responsible for paying all income taxes and other taxes charged to Publicity Service Agent on amounts earned hereunder. All financial and other obligations associated with Publicity Service Agent\'s business are the sole responsibility of Publicity Service Agent.</p>
				<ol start="7">
				<li><strong><u> Indemnification by Publicity Service Agent</u></strong></li>
				</ol>
				<p>Publicity Service Agent shall indemnify and hold Company free and harmless from any and all claims, damages or lawsuits (including reasonable attorneys\' fees) arising out of negligence or malfeasant acts of Publicity Service Agent or misrepresentation or breach of any obligations under this agreement.</p>
				<ol start="8">
				<li><strong><u> Fee</u></strong></li>
				<li><strong> Sole Compensation</strong></li>
				</ol>
				<p>The Company shall pay the Publicity Service Agent a fee at such rate as may be communicated by the Company in writing to the Publicity Service Agent, for whole or part of the services hereto, based on the policies of the company. This fee will be subjected to the relevant taxes as applicable. The Company reserves its right to revise the fee from time to time and the same shall be intimated to the Publicity Service Agent in writing by the Company.</p>
				<ol>
				<li><strong><u> Time of Payment</u></strong></li>
				</ol>
				<p>The fee shall be due and payable every 10<sup>th</sup>, 20<sup>th</sup> ad last day of the month and shall be credited in the FCS wallet which can be withdrawn at any time.</p>
				<ol start="9">
				<li><strong><u> Services to be provided</u></strong></li>
				</ol>
				<p>Publicity Service Agent shall render the following services to the Company:</p>
				<ul>
				<li>To explain the concepts and benefits relating to services provided by the company;</li>
				<li>To follow the publicity strategies as to be directed to be implemented by the Company;</li>
				<li>To make strategies to increase the publicity of Company’s services, to get them approved and implement them;</li>
				</ul>
				<ol start="10">
				<li><strong> Additional Responsibilities of Publicity Service Agent</strong></li>
				<li><strong> Expense of Doing Business</strong></li>
				</ol>
				<p>Publicity Service Agent shall bear the cost and expense in making publicity in accordance with the terms of this Agreement. This would include expenses related to communications, telecommunication, mailing, conveyance and business entertainment if required. The company will not entertain any reimbursement on any expense made by the Publicity Service Agent other than the fee as decided.</p>
				<ol>
				<li><strong> Promotion of the Products</strong></li>
				</ol>
				<p>Publicity Service Agent shall make efforts to promote the services of and stimulate demand for the Services within the Territory by direct solicitation. In no event, shall Publicity Service Agent make any representation, guarantee or warranty concerning the Services except as expressly authorized by Company. The Company will take care of all online promotions on their website and ensure lead generations. Use of company logo, product logo, any advertising / promotion / marketing activity conceived originally by the Publicity Service Agent should be first approved in writing by Company before being implemented.</p>
				<ol start="11">
				<li><strong><u> Additional Obligations of Company</u></strong></li>
				<li><strong> Assistance in Promotion</strong></li>
				</ol>
				<p>Company shall, promptly provide Publicity Service Agent with marketing and technical information, training concerning the Services, brochures, instructional material, advertising literature, and other product data.</p>
				<ol>
				<li><strong> Assistance in Technical Problems</strong></li>
				</ol>
				<p>Company shall, at its own expense, assist Publicity Service Agent and customers of the Services in all ways deemed reasonable by Company in the solution of any problems relating to the Services.</p>
				<ol>
				<li><strong> New Developments</strong></li>
				</ol>
				<p>Company shall inform Publicity Service Agent of new Products or Services that are competitive with Company\'s Products Services and other market information and competitive information as discovered from time to time.</p>
				<ol start="12">
				<li><strong> Trademarks and Tradenames</strong></li>
				</ol>
				<p>During the term of this Agreement, Publicity Service Agent shall have the right to indicate to the public that it is an authorized Publicity Service Agent of Company\'s Services. Nothing herein shall grant Publicity Service Agent any right, title, or interest in Company\'s Trademarks. At no time during or after the term of this Agreement shall Publicity Service Agent challenge or assist others to challenge Company\'s Trademarks or the registration thereof or attempt to register any trademarks, marks or trade names confusingly similar to those of Company.</p>
				<ol start="13">
				<li><strong> Non-Compete</strong></li>
				</ol>
				<p>For a period of 12 months after the Publicity Service Agent is no longer in agreement with the Company, the Publicity Service Agent will not, directly or indirectly, either as proprietor, stockholder, partner, officer, employee or otherwise, distribute, sell, offer to sell, or solicit any orders for the purchase or distribution of any products or services which are similar to those distributed, sold or provided by the Company.</p>
				<ol start="14">
				<li><strong> Term and Termination</strong></li>
				<li><strong> Term. </strong></li>
				</ol>
				<p>This Agreement shall commence on the date first written above for a period of one year unless terminated earlier as provided herein below.</p>
				<ol>
				<li><strong> Termination. </strong></li>
				</ol>
				<p>Either party to this agreement shall have the right to terminate this agreement on breach of any terms and conditions mentioned in this agreement at any time before the agreed term as above.</p>
				<ol>
				<li><strong> Return of Materials.</strong></li>
				</ol>
				<p>All of Company\'s trademarks, trade names, data, photographs, literature, and sales aids, customer related database of every kind shall remain the property of Company within five (5) days after the termination of this Agreement, Publicity Service Agent shall return all such items to company. Publicity Service Agent shall not make or retain any copies of any confidential items or information that may have been entrusted to it. Effective upon the termination of this Agreement, Publicity Service Agent shall cease to use all trademarks, marks and trade name of Company.</p>
				<ol>
				<li>This agreement will be reviewed by the company after a period of Six months. Any Publicity Service Agent not performing to the full satisfaction of the company in terms of nvcompany\'s policies, is liable to be terminated</li>
				<li><strong><u> Limitation on Liability</u></strong></li>
				</ol>
				<p>In the event of termination by either party in accordance with any of the provisions of this Agreement, neither party shall be liable to the other, because of the termination for compensation, reimbursement or damages on account of the loss of prospective profits or anticipated sales or on account of expenditures or commitments in connection with the business or goodwill of Company or Publicity Service Agent.</p>
				<ol start="16">
				<li><strong><u> Confidentiality</u></strong></li>
				</ol>
				<p>Publicity Service Agent acknowledges that by reason of its relationship to Company hereunder it will have access to certain information and materials concerning Company\'s business plans, customers, technology, and products/services that is confidential and of substantial value to Company, which value would be impaired if such information were disclosed to third parties. Publicity Service Agent agrees that it shall not use in any way for its own account or the account of any third party, nor disclose to any third party, any such confidential information revealed to it by the Company. Company shall advise Publicity Service Agent whether or not it considers any particular information or materials to be confidential. Publicity Service Agent shall not publish any description of the Products/Services beyond the description published by Company and without the prior written consent of the Company. In the event of termination of this Agreement, there shall be no use or disclosure by Publicity Service Agent of any confidential information of Company.</p>
				<ol start="17">
				<li><strong><u> Governing Law and Jurisdiction</u></strong></li>
				</ol>
				<p>This Agreement will be governed by and construed in accordance with the laws of Republic of India. Each Party irrevocably and unconditionally submits to the exclusive jurisdiction of the Delhi High Court.</p>
				<ol start="18">
				<li><strong><u> Entire Agreement</u></strong></li>
				</ol>
				<p>This Agreement sets forth the entire agreement and understanding of the parties relating to the subject matter herein and supersedes any prior discussions or agreements between them. No modification of or amendment to neither this Agreement, nor any waiver of any rights under this Agreement to be done unilaterally and it shall be effective unless in writing signed by the party to be charged.</p>
				<ol start="19">
				<li><strong><u> Notices</u></strong></li>
				</ol>
				<p>Any notices required or permitted by this Agreement shall be deemed given if sent by certified mail, postage prepaid, return receipt requested or by recognized overnight delivery service.</p>
				<ol start="20">
				<li><strong><u> Non-Assignability and Binding Effect</u></strong></li>
				</ol>
				<p>A mutually agreed consideration for Company\'s entering into this Agreement is the reputation, business standing, and goodwill already honored and enjoyed by Company under its present ownership, and, accordingly, Publicity Service Agent agrees that its rights and obligations under this Agreement may not be transferred or assigned directly or indirectly. Subject to the foregoing, this Agreement shall be binding upon and insure to the benefit of the parties hereto, their successors and assigns.</p>
				<ol start="21">
				<li><strong><u> Severability</u></strong></li>
				</ol>
				<p>If any provision of this Agreement is held to be invalid by a court of competent jurisdiction, then the remaining provisions shall nevertheless remain in full force and effect.</p>
				<ol start="22">
				<li><strong><u> Headings</u></strong></li>
				</ol>
				<p>Headings used in this Agreement are provided for convenience only and all not be used to construe meaning or intent.</p>
                            </div>
                        </div>
                        <div class="span12">
                            <input type="checkbox" name="term_con[]" id="term_con" value="1"> <span style="padding-top:5px;"></span> I Accept The Terms & Conditions
                        </div>    
                            
                    </div>
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <input type="submit" name="submit" class="btn btn-info pull-right" onclick="return savePA()" value="Submit">
                      <div class="clearfix">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div><!-- dashboard-container -->
    </div><!-- container-fluid -->

    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.min.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/moment.js"></script>

    <script src="<?php echo BASEPATH; ?>js/jquery.validate.min.js"></script>
    
    <script src="<?php echo BASEPATH; ?>bootstrap/js/validatesubmit.js"></script>
    
    <!-- Google Visualization JS -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    <!-- Easy Pie Chart JS -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/pie-charts/jquery.easy-pie-chart.js"></script>

    <!-- Tiny scrollbar js -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/tiny-scrollbar.js"></script>
    
    <!-- Sparkline charts -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/sparkline.js"></script>

    <!-- Datatables JS -->
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery.dataTables.js"></script>

    <script src="<?php echo BASEPATH; ?>bootstrap/js/theming.js"></script>
    <script src="<?php echo BASEPATH; ?>bootstrap/js/custom.js"></script>
    
    <link href='<?php echo BASEPATH; ?>bootstrap/css/jquery-ui.css' rel='stylesheet' />
    <script src="<?php echo BASEPATH; ?>bootstrap/js/jquery-ui-date.js"></script>
    
    
<script>
    $(document).ready(function() {
        $(".custom-dt").datepicker({dateFormat:'yy-mm-dd',});
    });
    
    function savePA()
    {
        var bankname=$("#bankname").val();
        var branchcode=$("#branchcode").val();
        var accountname=$("#accountname").val();
        var accountnumber=$("#accountnumber").val();
        var ifsccode=$("#ifsccode").val();
        var pancardatt=$("#pancardatt").val();
        
        var term_con=0;
        if($("#term_con").is(":checked")) { term_con=1; }
        
        if(bankname=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter bank name.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(branchcode=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter branch area.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(accountname=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter account name.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if($("#accountnumber").val()=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter mobile number.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(isNaN(parseInt(accountnumber))) {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter correct account number.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(accountnumber.length<10) {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('incorrect account number.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(ifsccode=='')
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter IFSC code.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(pancardatt=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter pancard');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(term_con==0) 
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please accept terms & condiotions');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else 
        {
            return true;
        }
    }
</script>
    
  </body>
</html>