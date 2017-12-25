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
$flagDSA=FALSE;

$objM=new Member();

$resC=$objM->getCountry();

$resCPA=$objM->checkPA($_SESSION['studentuserid']);

if($resCPA->num_rows>0) { $flagPA=TRUE; $resCDSA=$objM->checkDSA($_SESSION['studentuserid']); if($resCDSA->num_rows>0) { $flagDSA=TRUE; } }

if(isset($_POST['submit']))
{
    if(!$flagDSA)
    {
        $validdsa=$_POST['validdsa'];
        if($validdsa==1)
        {
            $uid=$_POST['user_id'];
            $country=explode('^',$_POST['country']);
            $pincode=$_POST['pincode'];

            $bankname=$_POST['bankname'];

            $branchcode=$_POST['branchcode'];
            $accountname=$_POST['accountname'];

            $email=$_POST['email'];
            $accountnumber=$_POST['accountnumber'];
            $ifsccode=$_POST['ifsccode'];

            $pancardatt=$_POST['pancardatt'];

            $resP=$obj->saveStudentasDSA($uid,$bankname,$branchcode,$accountname,$email,$accountnumber,$ifsccode,$pancardatt,$pincode,$country[1]);

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
              <h2>Apply For Direct Selling Agent</h2>
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

        <?php if(!$flagPA) { ?>
            <h4>Please firstly apply for Marketing Division.</h4>
        <?php } else if($flagDSA) { ?>
            <h4>You have already registered your Application.</h4>
        <?php } else { ?>
        <div class="row-fluid">
            <div class="span12">
              <div class="widget">
                <div class="widget-header">
                  <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe098;"></span> Apply For Direct Selling Agent
                  </div>
                </div>
                
                <div class="widget-body">
                   <form class="form-horizontal no-margin" method="post" name="prform" id="prform" action="" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $data['ID']; ?>">
                    <input type="hidden" name="validdsa" id="validdsa" value="0">
                    <div class="row-fluid">
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Email *</label>
                          <div class="controls">
                              <input type="text" name="email" id="email" class="span12" value="<?php echo $data['user_email']; ?>" readonly/>
                          </div>
                        </div>
                        <div class="control-group span6 left-0">
                            <label class="control-label" for="password5">Country *</label>
                            <div class="controls">
                                <select name="country" id="country" class="span12">
                                      <option value="">Select Country</option>
                                      <?php
                                      while($rowC=$resC->fetch_assoc())
                                      {
                                      ?> 
                                      <option value="<?php echo $rowC['country_id'].'^'.$rowC['name']; ?>" <?php if($rowC['name']==$data['country']) { echo 'selected'; } ?>><?php echo $rowC['name']; ?></option>
                                      <?php
                                      }
                                      ?>
                                  </select>
                            </div>
                        </div>
                        <div class="control-group span6 left-0">
                          <label class="control-label" for="password5">Pincode *</label>
                          <div class="controls">
                              <input type="text" name="pincode" id="pincode" class="span12" placeholder="Enter Pincode"  value="" onblur="checkPincode();"/>
                          </div>
                        </div>
                    </div>
                    <div id="data"></div>
                    <div class="row-fluid" style="display:none;" id="dsadetails">
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
                        <h4>Direct Selling Agent Agreement</h4>
                        <hr>
                        <div class="control-group span12 left-0" style="border: 1px solid #e0e0e0; overflow: auto; max-height: 300px; ">
                        <div style="margin: 10px;">
                            <p>NOW, THEREFORE, in consideration of the mutual promises contained herein, the parties agree as follows:<br>
		1. Definitions<br>
		As used herein, the following terms shall have the meanings set forth below:<br>
		A. "Services" shall mean the Company's services to be sold by Direct Selling Agent and such services as may be communicated by the Company in writing or published on the official website of the Company to the Direct Selling Agent from time to time.<br>
		B. "Territory" shall be allocated during time of engagement by the Company in writing to the Direct Selling Agent.  Any change in "Territory" shall be communicated by the Company in writing to the Direct Selling Agent from time to time.<br>
		C. Direct Selling Agent will have the title of "Direct Selling Agent."<br>
		2. Appointment<br>
		Company hereby appoints Direct Selling Agent as its non-exclusive selling agent for the services in the territory, and Direct Selling Agent hereby accepts such appointment. Direct Selling Agent's sole authority shall be to solicit customers for the services in the territory in accordance with the terms of this agreement. Direct Selling Agent shall not have the authority to make any commitments whatsoever on behalf of Company.<br>
		3. General Duties<br>
		Direct Selling Agent shall use his best efforts to promote the services and maximize the sale of the services in the territory. Direct Selling Agent shall also provide reasonable assistance to Company in promotional activities in the territory. Direct Selling Agent will assist the company by taking part in all promotional events, use the marketing inputs judiciously for maximizing orders for the company.<br>
		4. Reserved Rights<br>
		Company reserves the right to solicit/engage other Agents, Direct Selling Agents directly from businesses within the territory. Direct Selling Agent's task is to solicit customers from all potential businesses in the territory.<br>
		5. Conflict of Interest<br>
		Direct Selling Agent warrants to Company that it does not currently represent or promote any Services that compete with the Company's Services. During the term of this Agreement, Direct Selling Agent shall not represent, promote or otherwise try to sell within the Territory any Services that, in Company's judgment, compete with the Services covered by this Agreement.<br>
		6. Independent Contractor<br>
		Direct Selling Agent is an independent contractor, and nothing contained in this Agreement shall be construed to<br>
		(i) give either party the power to direct and control the day-to-day activities of the other,<br>
		(ii) constitute the parties as partners, joint ventures, co- owners or otherwise, or<br>
		(iii) allow Direct Selling Agent to create or assume any obligation on behalf of Company for any purpose whatsoever. Direct Selling Agent is not an employee of Company and is not entitled to any employee benefits. Direct Selling Agent shall be responsible for paying all income taxes and other taxes charged to Direct Selling Agent on amounts earned hereunder. All financial and other obligations associated with Direct Selling Agent's business are the sole responsibility of Direct Selling Agent.<br>
		7. Indemnification by Direct Selling Agent<br>
		Direct Selling Agent shall indemnify and hold Company free and harmless from any and all claims, damages or lawsuits (including reasonable attorneys' fees) arising out of negligence or malfeasant acts of Direct Selling Agent or misrepresentation or breach of any obligations under this agreement.<br>
		8. Commission<br>
		A. Sole Compensation<br>
		The Company shall pay the Direct Selling Agent a commission at such rate as may be communicated by the Company in writing to the Direct Selling Agent, for whole or part of the services hereto, based on the Maximum Retailing Price of the product as fixed by the company on every new order. This commission will be subjected to the relevant taxes as applicable. The Company reserves its right to revise the rate of commission from time to time and the same shall be intimated to the Direct Selling Agent in writing by the Company.<br>
		B. Basis of Commission<br>
		The Commission shall apply to all sales orders from customers solicited by Direct Selling Agent. (Customers defined as an individual or a company who have bought the product/services from the Direct Selling Agent for their own use.)<br>
		No commissions shall be paid on<br>
		(i) orders solicited directly by Company within the Territory;<br>
		(ii) orders received from outside the Territory unless otherwise agreed in writing by Company. (iii) No commission will be paid to the Direct Selling Agent until 100% payment pertaining to the order is received. The company reserves the right to change the commission / prices on products as and when required.<br>
		C. Time of Payment<br>
		The commission on all PAID ORDERS shall be due and payable within seven working days after the date of raising invoice.<br>
		D. Monthly Statements<br>
		The Direct Selling Agent shall submit to the company the monthly statements of commissions due and payable to Direct Selling Agent under the terms of this Agreement.<br>
		9. Sale of the Services<br>
		A. Prices and Terms of Sale<br>
		Company shall provide Direct Selling Agent with copies of its current market price and this is subject to change and the sole discretion of the same lies with the company, its payment schedules, and all Rules and Regulations and other material available for sales presentation and customer's information. Direct Selling Agent shall quote to Customers only those authorized prices, payment schedules, and terms and conditions as informed by Company either in wring or published on the official website of the Company. The services will be activated only after receipt of 100% payment pertaining to the order. The company will not refund any money in part or in full after payment on order is once received.<br>
		B. Acceptance<br>
		All requests for service obtained by Direct Selling Agent shall be subject to acceptance by Company and all quotations by Direct Selling Agents shall contain a statement to that effect. Direct Selling Agents shall have no authority to make any acceptance or commitments to customers. Company specifically reserves the right to reject any request for service or any part thereof for any reason.<br>
		C. Collection<br>
		Full responsibility for collection of payment from customers’ rests with Direct Selling Agent.<br>
		10. Additional Responsibilities of Direct Selling Agent<br>
		A. Expense of Doing Business<br>
		Direct Selling Agent shall bear the cost and expense of conducting its business in accordance with the terms of this Agreement. This would include salaries for the staff of the Direct Selling Agent who are engaged in the business of selling the products of the Company, expenses related to communications, telecommunication, mailing, conveyance and business entertainment if required. The company will not entertain any reimbursement on any expense made by the Direct Selling Agent other than the commissions.<br>
		B. Promotion of the Products<br>
		Direct Selling Agent shall make efforts to promote the sale of and stimulate demand for the Services within the Territory by direct solicitation. In no event, shall Direct Selling Agent make any representation, guarantee or warranty concerning the Services except as expressly authorized by Company. The Company will take care of all online promotions on their website and ensure lead generations. Use of company logo, product logo, any advertising / promotion / marketing activity conceived originally by the Direct Selling Agent should be first approved in writing by Company before being implemented.<br>
		C. Agents &amp; Customer Service<br>
		Direct Selling Agent shall inform and assist customers on Company's Services, and shall perform such additional customer services by e-mail, phone and fax, whenever needed, as good salesmanship requires and as Company may reasonably request.<br>
		D. Books and Records<br>
		Direct Selling Agent shall notify Company of any Customer's complaints regarding either the Services or Company and immediately forward to Company the information regarding those complaints.<br>
		11. Additional Obligations of Company<br>
		A. Assistance in Promotion<br>
		Company shall, at its own expense, promptly provide Direct Selling Agent with marketing and technical information, training concerning the Services, brochures, instructional material, advertising literature, and other product data.<br>
		B. Assistance in Technical Problems<br>
		Company shall, at its own expense, assist Direct Selling Agent and customers of the Services in all ways deemed reasonable by Company in the solution of any problems relating to the Services.<br>
		C. New Developments<br>
		Company shall inform Direct Selling Agent of new Products or Services that are competitive with Company's Products Services and other market information and competitive information as discovered from time to time.<br>
		12. Trademarks and Tradenames<br>
		During the term of this Agreement, Direct Selling Agent shall have the right to indicate to the public that it is an authorized Direct Selling Agent of Company's Services. Nothing herein shall grant Direct Selling Agent any right, title, or interest in Company's Trademarks. At no time during or after the term of this Agreement Shall Direct Selling Agent challenge or assist others to challenge Company's Trademarks or the registration thereof or attempt to register any trademarks, marks or trade names confusingly similar to those of Company.<br>
		13. Non-Compete<br>
		For a period of 12 months after the Direct Selling Agent is no longer in agreement with the Company, the Direct Selling Agent will not, directly or indirectly, either as proprietor, stockholder, partner, officer, employee or otherwise, distribute, sell, offer to sell, or solicit any orders for the purchase or distribution of any products or services which are similar to those distributed, sold or provided by the Company.<br>
		14. Term and Termination<br>
		A. Term.<br>
		This Agreement shall commence on the date first written above for a period of 2 years unless terminated earlier as provided herein below.<br>
		B. Termination.<br>
		Either party to this agreement shall have the right to terminate this agreement with or without cause with a thirty 30 days written notice to the other party.<br>
		C. Return of Materials.<br>
		 All of Company's trademarks, trade names, data, photographs, literature, and sales aids, customer related database of every kind shall remain the property of Company within five (5) days after the termination of this Agreement, Direct Selling Agent shall return all such items to company. Direct Selling Agent shall not make or retain any copies of any confidential items or information that may have been entrusted to it. Effective upon the termination of this Agreement, Direct Selling Agent shall cease to use all trademarks, marks and trade name of Company.<br>
		D. This agreement will be reviewed by the company after a period of [12 months]. Any Direct Selling Agent not performing to the full satisfaction of the company in terms of securing new orders and company's policies, is liable to be terminated<br>
		15. Limitation on Liability<br>
		In the event of termination by either party in accordance with any of the provisions of this Agreement, neither party shall be liable to the other, because of the termination for compensation, reimbursement or damages on account of the loss of prospective profits or anticipated sales or on account of expenditures or commitments in connection with the business or goodwill of Company or Direct Selling Agent.<br>
		16. Confidentiality<br>
		Direct Selling Agent acknowledges that by reason of its relationship to Company hereunder it will have access to certain information and materials concerning Company's business plans, customers, technology, and products/services that is confidential and of substantial value to Company, which value would be impaired if such information were disclosed to third parties. Direct Selling Agent agrees that it shall not use in any way for its own account or the account of any third party, nor disclose to any third party, any such confidential information revealed to it by the Company. Company shall advise Direct Selling Agent whether or not it considers any particular information or materials to be confidential. Direct Selling Agent shall not publish any description of the Products/Services beyond the description published by Company and without the prior written consent of the Company. In the event of termination of this Agreement, there shall be no use or disclosure by Direct Selling Agent of any confidential information of Company.<br>
		17. Governing Law and Jurisdiction<br>
		This Agreement will be governed by and construed in accordance with the laws of Republic of India. Each Party irrevocably and unconditionally submits to the exclusive jurisdiction of the Delhi High Court.<br>
		18. Entire Agreement<br>
		This Agreement sets forth the entire agreement and understanding of the parties relating to the subject matter herein and supersedes any prior discussions or agreements between them. No modification of or amendment to neither this Agreement, nor any waiver of any rights under this Agreement to be done unilaterally and it shall be effective unless in writing signed by the party to be charged.<br>
		19. Notices<br>
		Any notices required or permitted by this Agreement shall be deemed given if sent by certified mail, postage prepaid, return receipt requested or by recognized overnight delivery service.<br>
		20. Non-Assignability and Binding Effect<br>
		A mutually agreed consideration for Company's entering into this Agreement is the reputation, business standing, and goodwill already honored and enjoyed by Company under its present ownership, and, accordingly, Direct Selling Agent agrees that its rights and obligations under this Agreement may not be transferred or assigned directly or indirectly. Subject to the foregoing, this Agreement shall be binding upon and insure to the benefit of the parties hereto, their successors and assigns.<br>
		21. Severability<br>
		If any provision of this Agreement is held to be invalid by a court of competent jurisdiction, then the remaining provisions shall nevertheless remain in full force and effect.<br>
		22. Headings<br>
		Headings used in this Agreement are provided for convenience only and all not be used to construe meaning or intent.
		</p>
                            </div>
                        </div>
                        <div class="span12">
                            <input type="checkbox" name="term_con[]" id="term_con" value="1"> <span style="padding-top:5px;"></span> I Accept The Terms & Conditions
                        </div>    
                            
                    </div>
                    <div class="form-actions no-margin">
                        <span class="form-errors" id="onetimeerror"></span>
                        <input type="submit" name="submit" class="btn btn-info pull-right" onclick="return saveDSA()" value="Submit">
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
    
    function checkPincode()
    {
        var pincode = $("#pincode").val();
        
        var pincodeLen = pincode.toString().length;
    	if(pincodeLen == 6) 
        {
            $("#data").html('<img src="../bootstrap/img/ajax-loader.gif">');
            $.post("../ajax/ajax-member.php",{
                q:'checkPincode',
                pincode:pincode,
            },function(data){
                var ret=data.split('^');
                if(ret[1]=='exist') 
                {
                    $("#dsadetails").hide();
                    $("#data").html('');
                    $("#validdsa").val('0');
                    $('#data').fadeIn();
                    $("#data").html('Already enrolled for this pincode.');
                } 
                else 
                {
                    $("#data").html('');
                    $("#validdsa").val('1');
                    $("#dsadetails").show();
                }
            });
        }
        else 
        {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Pincode must be of 6 digits.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            $("#validdsa").val('0');
            $("#dsadetails").hide();
        }
    }
    
    function saveDSA()
    {
        var bankname=$("#bankname").val();
        var country=$("#country").val();
        var pincode=$("#pincode").val();
        var validdsa=$("#validdsa").val();
        var branchcode=$("#branchcode").val();
        var accountname=$("#accountname").val();
        var accountnumber=$("#accountnumber").val();
        var ifsccode=$("#ifsccode").val();
        var pancardatt=$("#pancardatt").val();
        
        var term_con=0;
        if($("#term_con").is(":checked")) { term_con=1; }
        
        
        if(country=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please select country.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(pincode=='') {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter pincode.');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(validdsa==0) {
            $('#onetimeerror').fadeIn();
            $("#onetimeerror").html('Please enter valid pincode');
            setTimeout(function() {
                $('#onetimeerror').fadeOut();
            }, 5000 );
            return false;
        }
        else if(bankname=='') {
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
    
function goToByScroll(id){
      // Remove "link" from the ID
    //id = id.replace("link", "");
      // Scroll
    $('html,body').animate({
        scrollTop: $("#"+id).offset().top},
        'slow');
}
</script>
    
  </body>
</html>