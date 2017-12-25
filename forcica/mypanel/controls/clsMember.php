<?php
require_once("config.php");

class Member {
    
    public function getCountry() {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "SELECT country_id, name FROM forc_crm_country where status='1'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function getStateByCountryId($countryId) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "SELECT zone_id, name FROM forc_crm_state where status=1 and country_id='$countryId'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkPA($user_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "SELECT Id FROM forc_crm_agency where user_id='$user_id'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkDSA($user_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "SELECT Id FROM forc_crm_agency_dsa where user_id='$user_id'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkDSAPincode($pincode) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "SELECT Id FROM forc_crm_agency_dsa where pincode='$pincode'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkAlreadyApplied($user_id,$course_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
         echo   $sql = "SELECT Id FROM forc_crm_levels_payment where user_id='$user_id' and post_id='$course_id'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkPACR($user_id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "SELECT Id FROM forc_crm_levels_payment where user_id='$user_id' and status='0'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function checkUser($columnname,$value) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "SELECT Id FROM forc_crm_users where $columnname='".$value."'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function saveStudentCourseRequest($user_id,$course_id,$coursename,$fee,$service_tax,$totalfee,$paymentMode,$payment_type,$cheque,$utrno,$date1,$bank,$amount,$cashrecipt,$status) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "INSERT INTO forc_crm_levels_payment (post_id,user_id,level_name,fee,payment_mode,offline_paymet,cheque_no,bank_name,cheque_amount,transaction_date,transaction_reference_no,cash_deposit_slip, payment_response, service_tax,status) VALUES ('$course_id','$user_id','".$coursename."','$totalfee','".$paymentMode."','".$payment_type."','".$cheque."','".$bank."','$amount','".$date1."','".$utrno."','".$cashrecipt."','','$service_tax',$status)";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function saveStudent($username,$password,$user_nicename,$user_email,$display_name,$pincode, $status) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "Insert into forc_crm_users set user_login='".$username."', user_pass_text='".sha1($password)."', user_nicename='".$user_nicename."', user_email='".$user_email."', user_registered=NOW(), user_status='".$status."', display_name='".$display_name."', pincode='".$pincode."', membertype='student'";
            $query = $mysqli->query($sql);
            $user_id=$mysqli->insert_id;
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $user_id;
    }
    public function saveStudentDetails($user_id,$first_name,$last_name,$phone1,$dob,$state,$city,$country,$gender,$address1,$address2,$refno,$profiledocname,$eduCertificatedocname,$addressproofdocname,$courseid,$totFee,$service_tax) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "Insert into forc_crm_student_details set user_id='$user_id', first_name='".$first_name."', last_name='".$last_name."', phone1='".$phone1."', dob='".$dob."', state='".$state."', city='".$city."', country='".$country."', gender='".$gender."', address1='".$address1."', address2='".$address2."', student_parent_id='".$refno."', profile_image='".$profiledocname."', education_certificate='".$eduCertificatedocname."', address_proof='".$addressproofdocname."', current_courseId='".$courseid."', current_fee='".$totFee."', current_servicetax='".$service_tax."'";
            $query = $mysqli->query($sql);
          
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    public function savePADetails($user_id,$name,$user_email,$panno,$bank_ac,$ifsc,$bank_name,$cityofbranch) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "insert into forc_crm_agency set user_id='$user_id', name='$name', email='".$user_email."', pan='".$panno."', account_no='".$bank_ac."', ifsc_code='".$ifsc."', bank_name='".$bank_name."', bank_code='".$cityofbranch."', created_on=NOW()";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
	
	
	
}