<?php
require_once("config.php");

class User {
    
    public function getLicenceDuration() 
    {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * FROM forc_crm_licenseduration where Id='1'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function checkLicence() 
    {
        try {
            $cdate=date('Y-m-d');
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * FROM forc_crm_licenseduration where valid_to < '$cdate'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function getStudentappliedCourses($user_id,$catId) 
    {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select flp.* FROM forc_crm_levels_payment flp left join forc_crm_courses fc on flp.post_id=fc.Id where flp.user_id='$user_id' and fc.catId='$catId'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function checkUserEmail($email) 
    {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * FROM forc_crm_users where user_email='$email'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function checkUserLogin($username,$pass) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select fu.*,fsd.first_name,fsd.last_name,fsd.profile_image FROM forc_crm_users fu left join forc_crm_student_details fsd on fu.ID=fsd.user_id where fu.user_login='$username' and fu.user_pass_text='$pass' and fu.user_status='0'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function getUserDetailsById($Id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * FROM forc_crm_users where ID='$Id'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function getPredictionReportData() {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * FROM forc_crm_prediction_report";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function getPredictionReportDataById($Id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * FROM forc_crm_prediction_report where Id='$Id'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function getStudentUserDetailsById($Id) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select fu.*,fsd.*,cp.catId FROM forc_crm_users fu left join forc_crm_student_details fsd on fu.ID=fsd.user_id left join forc_crm_courses cp on fsd.current_courseId=cp.Id where fu.ID='$Id'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function updateUserProfile($uid,$password,$name,$email,$image) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            if($password!='') {
            $sql = "update forc_crm_users set user_pass_text='".sha1($password)."', user_nicename='".$name."',user_email='".$email."',user_image='".$image."' where ID='$uid'";
            } else {
            $sql = "update forc_crm_users set user_nicename='".$name."',user_email='".$email."',user_image='".$image."' where ID='$uid'";    
            }
            
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    
    public function savePredictionReport($rId,$title,$rtype,$image) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            if($rId=='') 
            {
                $sql = "insert into forc_crm_prediction_report set title='".$title."', rtype='".$rtype."',image='".$image."'";
            } 
            else 
            {
                $sql = "update forc_crm_prediction_report set title='".$title."', rtype='".$rtype."',image='".$image."' where Id='$rId'";    
            }
            
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function updateStudentUserProfile($uid,$password,$email) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            if($password!='') {
            $sql = "update forc_crm_users set user_pass_text='".sha1($password)."', user_email='".$email."' where ID='$uid'";
            } else {
            $sql = "update forc_crm_users set user_email='".$email."' where ID='$uid'";  
            }
            
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    
    
    public function updateStudentDetailsProfile($uid,$first_name,$las_name,$phone1,$dob,$state,$city,$country,$address1,$address2,$profile_image,$address_proof,$education_certificate,$gender) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $sql = "update forc_crm_student_details set first_name='".$first_name."', last_name='".$las_name."', phone1='".$phone1."', dob='".$dob."', state='".$state."', city='".$city."', country='".$country."', address1='".$address1."', address2='".$address2."', profile_image='".$profile_image."', address_proof='".$address_proof."', education_certificate='".$education_certificate."', gender='".$gender."' where user_id='$uid'";
            
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    
    public function updateStudentDetailsProfileAdmin($uid,$first_name,$las_name,$phone1,$dob,$state,$city,$country,$address1,$address2,$profile_image,$address_proof,$education_certificate,$gender,$courseid,$totFee,$service_tax) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            $sql = "update forc_crm_student_details set first_name='".$first_name."', last_name='".$las_name."', phone1='".$phone1."', dob='".$dob."', state='".$state."', city='".$city."', country='".$country."', address1='".$address1."', address2='".$address2."', profile_image='".$profile_image."', address_proof='".$address_proof."', education_certificate='".$education_certificate."', gender='".$gender."',current_courseId='".$courseid."',current_fee='".$totFee."',current_servicetax='".$service_tax."' where user_id='$uid'";
            
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    
    public function saveUserProfile($uid,$username,$password,$name,$email,$image,$userpermission) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            
            if($uid!='') {
                if($password!='') {
                $sql = "update forc_crm_users set user_pass_text='".$password."', user_nicename='".$name."',user_email='".$email."',user_image='".$image."', userpermission='$userpermission' where ID='$uid'";
                } else {
                $sql = "update forc_crm_users set user_nicename='".$name."',user_email='".$email."',user_image='".$image."', userpermission='$userpermission' where ID='$uid'";    
                }
            } else {
                $sql = "insert into forc_crm_users set user_login='".$username."',user_pass_text='".$password."',user_nicename='".$name."',user_email='".$email."',user_image='".$image."',membertype='user', userpermission='$userpermission'";    
            }
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function getAllUsers() {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * FROM forc_crm_users where membertype='user'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function checkusernameExist($username) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "select * FROM forc_crm_users where user_login='$username'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function changeStatusById($userId,$status) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "update forc_crm_users set user_status='$status' where ID='$userId'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function updateStudentBankDetails($userId,$bank_name,$bank_ac,$ifsc,$cityofbranch,$panno) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "update forc_crm_agency set bank_name='$bank_name',account_no='$bank_ac',bank_code='$cityofbranch',ifsc_code='$ifsc',pan='$panno' where user_id='$userId'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function saveStudentasPA($uid,$bankname,$branchcode,$accountname,$email,$accountnumber,$ifsccode,$pancardatt) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "insert into forc_crm_agency set user_id='$uid', name='".$accountname."', email='".$email."', pan='".$pancardatt."', account_no='".$accountnumber."', ifsc_code='".$ifsccode."', bank_name='".$bankname."', bank_code='".$branchcode."', term_con='1'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function saveStudentasDSA($uid,$bankname,$branchcode,$accountname,$email,$accountnumber,$ifsccode,$pancardatt,$pincode,$country) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "insert into forc_crm_agency_dsa set user_id='$uid', name='".$accountname."', email='".$email."', pan='".$pancardatt."', account_no='".$accountnumber."', ifsc_code='".$ifsccode."', bank_name='".$bankname."', bank_code='".$branchcode."', term_con='1', city_applied='".$country."', pincode='".$pincode."'";
            $query = $mysqli->query($sql);
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
        return $query;
    }
    public function updateStudentCourseRequest($paymentId,$course_id,$coursename,$fee,$service_tax,$totalfee,$paymentMode,$payment_type,$cheque,$utrno,$date1,$bank,$amount,$cashrecipt) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "update forc_crm_levels_payment set post_id='".$course_id."',level_name='".$coursename."',fee='".$totalfee."',payment_mode='".$paymentMode."',offline_paymet='".$payment_type."',cheque_no='".$cheque."',bank_name='".$bank."',cheque_amount='".$amount."',transaction_date='".$date1."',transaction_reference_no='".$utrno."',cash_deposit_slip='".$cashrecipt."', service_tax='".$service_tax."' where id='$paymentId'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }

    public function updatePasswordByUserNamenPass($username,$email,$password) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "UPDATE forc_crm_users SET user_pass='$password' WHERE user_login='$username' and user_email='$email'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }

    public function savefeedback($sid,$message,$category) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
            $sql = "insert into forc_crm_feedback SET sid='$sid',message='$message',category='$category'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }

     public function updatefeedback($message,$fid) {
        try {
            $mysqli = new mysqli(MYSQLDB_HOST, MYSQLDB_USER, MYSQLDB_PASS, MYSQLDB_DATABASE);
           $sql = "update forc_crm_feedback SET message='$message' where id='$fid'";
            $query = $mysqli->query($sql);
            
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        return $query;
    }
    
}
?>