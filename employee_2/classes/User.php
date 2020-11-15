<?php
   $filepath = realpath(dirname(__FILE__));
	include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Session.php');
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/helpers/Format.php'); 
  include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php');


class User
{

 private $db;
 private $fm;

public function __construct()
   {
 $this->db = new Database();
 $this->fm = new Format();



   }
    public function all_employee_details()
   {
   $query= "SELECT * FROM employee ";
     $result=$this->db->select($query);
     return $result;

   }
    public function find_employee_info($employee_id)
   {
   $query= "SELECT * FROM employee  WHERE emp_id='$employee_id' ";
     $result=$this->db->select($query);
     return $result;
   } 
    
   public function delete_employee($employee_id)
   {
   $query= "DELETE FROM employee WHERE emp_id='$employee_id'";
     $result=$this->db->delete($query);
     return $result;
   } 

   public function find_an_active_employee_details($employee_id)
   {
   $query= "SELECT * FROM employee  WHERE emp_id='$employee_id' ";
     $result=$this->db->select($query);
     return $result;

   }
    public function all_active_employee_details()
   {
   $query= "SELECT * FROM employee  WHERE status='1' 
   ";
     $result=$this->db->select($query);
     return $result;

   } 
  
   public function current_jobs_endDateisNull_all_employee_details()
   {
   $query= "SELECT emp.*,GROUP_CONCAT(r2.des_name) as all_des
    FROM (
    SELECT r1.*,dep.dep_name,dep.comp_id
    FROM (
    SELECT ejr.id as jobRoleID,ejr.emp_id,ejr.job_nature,ejr.start_date,ejr.end_date,ejr.salary,ejr.notes,ejr.des_id,des.des_name,des.dep_id
    FROM `emp_job_role`  ejr
    INNER JOIN designation des ON des.des_id=ejr.des_id
        ) r1
     INNER JOIN department dep ON r1.dep_id = dep.dep_id
        ) r2
        INNER JOIN company com ON r2.comp_id= com.comp_id
        LEFT JOIN employee emp ON emp.emp_id= r2.emp_id
        WHERE r2.dep_id!=30 AND r2.dep_id!=33
        GROUP BY emp.emp_id
   ";
     $result=$this->db->select($query);
     return $result;

   }
   public function all_unEmployed_employee_details()
   {
   $query= "SELECT * FROM employee WHERE emp_id  NOT IN( 
            SELECT DISTINCT emp_id 
            FROM emp_job_role  
            WHERE end_date IS  NULL
        ) 
   ";
     $result=$this->db->select($query);
     return $result;

   } 
    public function all_assigned_jobs_employee_details()
   {
   $query= "SELECT emp.emp_id,emp.first_name,emp.last_name,emp.photo
          FROM employee emp
          INNER JOIN emp_job_role ejr 
          ON emp.emp_id = ejr.emp_id
          GROUP BY emp.emp_id, emp.last_name";
     $result=$this->db->select($query);
     return $result;
     exit();

   }   
   public function all_assigned_jobs_active_employee_details()
   {
   $query= "SELECT emp.emp_id,emp.first_name,emp.last_name,emp.photo
          FROM employee emp
          INNER JOIN emp_job_role ejr 
          ON emp.emp_id = ejr.emp_id
          WHERE emp.status=1
          GROUP BY emp.emp_id, emp.last_name";
     $result=$this->db->select($query);
     return $result;
     exit();

   }
    public function all_currentAssigned_jobs_active_employee_details()
   {
   $query= "SELECT emp.emp_id,emp.first_name,emp.last_name,emp.photo
          FROM employee emp
          INNER JOIN emp_job_role ejr 
          ON emp.emp_id = ejr.emp_id
          WHERE emp.status=1 
          AND ejr.end_date is NULL
          GROUP BY emp.emp_id, emp.last_name";
     $result=$this->db->select($query);
     return $result;
     exit();

   }  

 public function checkJobAssignedorNot($employee_id)
   {
   $query= "SELECT * FROM emp_job_role WHERE emp_id='$employee_id' ";
     $result=$this->db->select($query);
     return $result;
     exit();

   }
   public function checkCurrentJobAssignedorNot($employee_id)
   {
   $query= "SELECT * FROM emp_job_role WHERE emp_id='$employee_id' AND end_date IS NULL ";
     $result=$this->db->select($query);
     return $result;
     exit();

   }
    public function update_employee_role($employee_id,$role)
   {

   $PresenetRolequery= "SELECT role FROM employee WHERE emp_id='$employee_id'";
   $resultPresentRole= $this->db->select($PresenetRolequery);
   if ($resultPresentRole) {
     $currentRole=$resultPresentRole->fetch_assoc()['role'];
     if ($currentRole==$role) {

      echo "nothing to update";
     }
     else{
            $query= "UPDATE employee
           SET role='$role'
           WHERE emp_id='$employee_id' ";
           $result=$this->db->update($query);
           if ($result) {
             echo "success";
           }
           else{
            echo "error";
           }

     }
   }
   else{
    echo "error";

   }


   }
public function empoyees_all_info_with_jobrole_details($employee_id)
   {

     $jobAssignedorNot= $this->checkJobAssignedorNot($employee_id);
     if ($jobAssignedorNot) {
     $empDetails= $this->an_employees_assigned_jobs_details_based_on_designation($employee_id);
     return($empDetails);
     exit();
     }
     else{
      $empDetails= $this->find_employee_info($employee_id);
        return($empDetails);
        exit();
     }
   }
   public function empoyees_all_info_with_current_jobrole_details($employee_id)
   {

     $jobAssignedorNot= $this->checkCurrentJobAssignedorNot($employee_id);
     if ($jobAssignedorNot) {
   $empDetails= $this->an_employees_assigned_jobs_details_based_on_designation_endDate_isNull($employee_id);
   return($empDetails);
   exit();
     }
     else{
      $empDetails= $this->find_employee_info($employee_id);
        return($empDetails);
        exit();
     }


   }

 public function an_employees_assigned_jobs_details($employee_id)
   {
   $query= "SELECT *
        FROM (
        SELECT ejr.id,ejr.emp_id,emp.first_name,emp.last_name,emp.mobileNo,emp.address,emp.email,emp.nid,emp.dob,emp.gender,emp.status,emp.role,emp.created_at,ejr.salary,emp.photo,ejr.des_id,ejr.start_date,ejr.dep_id,ejr.comp_id,ejr.end_date
        FROM  emp_job_role ejr 
        INNER JOIN employee emp
        ON ejr.emp_id= emp.emp_id
        WHERE ejr.emp_id='$employee_id' AND
        ejr.end_date IS NULL
            ) r
          INNER JOIN designation des ON des.des_id =  r.des_id
          INNER JOIN company comp ON comp.comp_id =  r.comp_id
          INNER JOIN department dep ON dep.dep_id =  r.dep_id ";
     $result=$this->db->select($query);
     return $result;
     exit();

   } 

    public function an_employees_assigned_jobs_details_based_on_designation_endDate_isNull($employee_id)
   {
   $query= "SELECT r2.*,com.comp_name,emp.*
    FROM (
    SELECT r1.*,dep.dep_name,dep.comp_id
    FROM (
    SELECT ejr.id as jobRoleID,ejr.emp_id,ejr.job_nature,ejr.start_date,ejr.end_date,ejr.salary,ejr.notes,ejr.des_id,des.des_name,des.dep_id
    FROM `emp_job_role`  ejr
    INNER JOIN designation des ON des.des_id=ejr.des_id
        ) r1
     INNER JOIN department dep ON r1.dep_id = dep.dep_id
        ) r2
        INNER JOIN company com ON r2.comp_id= com.comp_id
        LEFT JOIN employee emp ON emp.emp_id= r2.emp_id
        WHERE emp.emp_id='$employee_id' AND r2.end_date IS NULL";
     $result=$this->db->select($query);
     return $result;
     exit();

   } 
   public function an_employees_assigned_jobs_details_based_on_designation_endDate_is_not_Null($employee_id)
   {
   $query= "SELECT r2.*,com.comp_name
    FROM (
    SELECT r1.*,dep.dep_name,dep.comp_id
    FROM (
    SELECT ejr.id as jobRoleID,ejr.emp_id,ejr.job_nature,ejr.start_date,ejr.end_date,ejr.salary,ejr.notes,ejr.des_id,des.des_name,des.dep_id
    FROM `emp_job_role`  ejr
    INNER JOIN designation des ON des.des_id=ejr.des_id
        ) r1
     INNER JOIN department dep ON r1.dep_id = dep.dep_id
        ) r2
        INNER JOIN company com ON r2.comp_id= com.comp_id
        WHERE r2.emp_id='$employee_id' AND r2.end_date IS NOT NULL";
     $result=$this->db->select($query);
     return $result;
     exit();

   }

   public function an_employees_assigned_jobs_details_based_on_designation($employee_id)
   {
   $query= "SELECT r2.*,com.comp_name,emp.*, GROUP_CONCAT(des_name) as all_des
    FROM (
    SELECT r1.*,dep.dep_name,dep.comp_id
    FROM (
    SELECT ejr.id as jobRoleID,ejr.emp_id,ejr.job_nature,ejr.start_date,ejr.end_date,ejr.salary,ejr.notes,ejr.des_id,des.des_name,des.dep_id
    FROM `emp_job_role`  ejr
    INNER JOIN designation des ON des.des_id=ejr.des_id
        ) r1
     INNER JOIN department dep ON r1.dep_id = dep.dep_id
        ) r2
        INNER JOIN company com ON r2.comp_id= com.comp_id
        LEFT JOIN employee emp ON emp.emp_id= r2.emp_id
        WHERE emp.emp_id='$employee_id' ORDER BY r2.end_date ASC";
     $result=$this->db->select($query);
     return $result;
     exit();

   }
   public function find_an_employee_By_Company($company_id)
   {
   $query= "SELECT DISTINCT emp.emp_id,emp.first_name,emp.last_name
    FROM (
    SELECT r1.*,dep.dep_name,dep.comp_id
    FROM (
    SELECT ejr.id as jobRoleID,ejr.emp_id,ejr.job_nature,ejr.start_date,ejr.end_date,ejr.salary,ejr.notes,ejr.des_id,des.des_name,des.dep_id
    FROM `emp_job_role`  ejr
    INNER JOIN designation des ON des.des_id=ejr.des_id
        ) r1
     INNER JOIN department dep ON r1.dep_id = dep.dep_id
        ) r2
        INNER JOIN company com ON r2.comp_id= com.comp_id
        LEFT JOIN employee emp ON emp.emp_id= r2.emp_id
        WHERE com.comp_id='$company_id'";
     $result=$this->db->select($query);
     return $result;
     exit();

   }   
    public function find_an_employee_By_Company_and_department($company_id,$department_id)
   {
   $query= "SELECT DISTINCT emp.emp_id,emp.first_name,emp.last_name
    FROM (
    SELECT r1.*,dep.dep_name,dep.comp_id
    FROM (
    SELECT ejr.id as jobRoleID,ejr.emp_id,ejr.job_nature,ejr.start_date,ejr.end_date,ejr.salary,ejr.notes,ejr.des_id,des.des_name,des.dep_id
    FROM `emp_job_role`  ejr
    INNER JOIN designation des ON des.des_id=ejr.des_id
        ) r1
     INNER JOIN department dep ON r1.dep_id = dep.dep_id
        ) r2
        INNER JOIN company com ON r2.comp_id= com.comp_id
        LEFT JOIN employee emp ON emp.emp_id= r2.emp_id
        WHERE com.comp_id='$company_id' AND r2.dep_id='$department_id'";
     $result=$this->db->select($query);
     return $result;
     exit();

   } 
   public function find_an_employee_By_Company_department_designation($company_id,$department_id,$designation_id)
   {
   $query= "SELECT DISTINCT r2.emp_id,emp.first_name,emp.last_name
    FROM (
    SELECT r1.*,dep.dep_name,dep.comp_id
    FROM (
    SELECT ejr.id as jobRoleID,ejr.emp_id,ejr.job_nature,ejr.start_date,ejr.end_date,ejr.salary,ejr.notes,ejr.des_id,des.des_name,des.dep_id
    FROM `emp_job_role`  ejr
    INNER JOIN designation des ON des.des_id=ejr.des_id
        ) r1
     INNER JOIN department dep ON r1.dep_id = dep.dep_id
        ) r2
        INNER JOIN company com ON r2.comp_id= com.comp_id
        LEFT JOIN employee emp ON emp.emp_id= r2.emp_id
        WHERE com.comp_id='$company_id' AND r2.dep_id='$department_id' AND r2.des_id='$designation_id'";
     $result=$this->db->select($query);
     return $result;
     exit();

   }  


   public function an_employes_monthWise_summary_attendance_Report($employee_id,$startDate)
  {
   $date = new DateTime($startDate);
   $start_date=$date->modify('first day of this month')->format('Y-m-d');
   $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
   $query="SELECT fetch_at.emp_id , emp.first_name,emp.last_name ,emp.photo, fetch_at.Presents,fetch_at.Absents,fetch_at.CasualLeave,fetch_at.MeetingLate,fetch_at.SickLeave,fetch_at.OthersLate,fetch_at.Total_Attendance_Days FROM 
employee as emp
INNER JOIN (
select 
emp_id, count(distinct at_date) as Total_Attendance_Days, 
    sum(case when status= 'p' then 1 else 0 end) Presents,
    sum(case when status = 'a' then 1 else 0 end) Absents, 
    sum(case when status = 'cl' then 1 else 0 end) CasualLeave, 
    sum(case when status = 'ml' then 1 else 0 end) MeetingLate,
    sum(case when status = 'ol' then 1 else 0 end) OthersLate,
     sum(case when status = 'sl' then 1 else 0 end) SickLeave
  from emp_attendance tea
   WHERE tea.at_date >= '$start_date' + INTERVAL 0 MONTH AND tea.at_date < '$start_date' + INTERVAL 1 MONTH
    
    group by emp_id 
)  as fetch_at

ON fetch_at.emp_id= emp.emp_id
 WHERE emp.emp_id='$employee_id'";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
   }
    public function an_employes_monthWise_attendance_details($employee_id,$startDate)
  {
   $date = new DateTime($startDate);
   $start_date=$date->modify('first day of this month')->format('Y-m-d');
   $end_date=$date->modify('last day of this month')->format('Y-m-d');
   
   $query="select *
        from emp_attendance tea
         WHERE tea.at_date >= '$start_date' + INTERVAL 0 MONTH AND tea.at_date < '$start_date' + INTERVAL 1 MONTH
         AND tea.emp_id='$employee_id'";
$results=$this->db->select($query);
    if ($results) {
     return $results;
    }
    // else {
    //   echo "Data Not Available";
    // }
   }

 public function search_employee_by_name($employee_name)
   {

   $query=  "SELECT * FROM employee
    WHERE first_name LIKE '%{$employee_name}%' OR last_name LIKE '%{$employee_name}%'";
     $result=$this->db->select($query);
     return $result;
     exit();

   } 
   public function employees_attendance_for_particular_date_and_employee($employee_id,$at_date)
   {
      $query="SELECT * FROM emp_attendance
      WHERE at_date='$at_date' AND emp_id='$employee_id'";
     $result=$this->db->select($query);
     return $result;
   } 
    public function find_employee_info_by_mobileNo($mobileNo)
   {

   $query=  "SELECT * FROM employee
    WHERE mobileNo LIKE '%{$mobileNo}%' OR last_name LIKE '%{$mobileNo}%'";
     $result=$this->db->select($query);
     return $result;
     exit();

   } 
   public function email_exist_or_not_without_this_employee($email,$employee_id)
   {

   $query=  "SELECT * FROM `employee` WHERE email='$email' AND emp_id!='$employee_id'";
     $result=$this->db->select($query);
     return $result;
   }






  

   
   //Update Employee
   public function update_employee($employee_id,$firstName,$lastName,$email,$password,$mobileNo,$address,$gender,$nid,$dob,$photoName)
   {
      $firstName= $this->fm->validation($firstName);
      $lastName= $this->fm->validation($lastName);
      $email= $this->fm->validation($email);
      $password= $this->fm->validation($password);
      $address= $this->fm->validation($address);
      $mobileNo= $this->fm->validation($mobileNo);
      $dob= $this->fm->validation($dob);
      // $role= $this->fm->validation($role);
      // $status= $this->fm->validation($status);
      
     // $img_name= $this->fm->validation($img_name);

      $firstName= mysqli_real_escape_string($this->db->link,$firstName);
      $lastName= mysqli_real_escape_string($this->db->link,$lastName);
      $email=mysqli_real_escape_string($this->db->link,$email);
      $password=mysqli_real_escape_string($this->db->link,$password);
      $address=mysqli_real_escape_string($this->db->link,$address);
      $mobileNo=mysqli_real_escape_string($this->db->link,$mobileNo);
      $dob=mysqli_real_escape_string($this->db->link,$dob);
      // $role=mysqli_real_escape_string($this->db->link,$role);
      // $status=mysqli_real_escape_string($this->db->link,$status);

      

      if (empty($photoName)){
        $update_user_query_withOutPhoto=" UPDATE employee SET  first_name='$firstName',
                                             last_name='$lastName',
                                             email='$email',
                                             password='$password',
                                             address='$address',
                                             mobileNo='$mobileNo',
                                             gender='$gender',
                                             nid='$nid',
                                           
                                             dob='$dob'      
                                                    
                                WHERE  emp_id ='$employee_id'";
    $checkSameEmail= $this->email_exist_or_not_without_this_employee($email,$employee_id);
          if ($checkSameEmail) {
           echo "Email address Allready Exist";
          }else{
             $updated_user_result=$this->db->update($update_user_query_withOutPhoto);

          if ($updated_user_result) {
              echo "success";

          exit();
          }
         else {
          echo "failed";
                  exit();
                 }
          }
        
      }
      // End of Empty PHoto
      else{
            // print_r("Photo not Empty");
        $update_user_query_WithPhoto=" UPDATE employee SET  first_name='$firstName',
                                             last_name='$lastName',
                                             email='$email',
                                             address='$address',
                                             mobileNo='$mobileNo',
                                             gender='$gender',
                                             nid='$nid',
                                             dob='$dob',
                                             photo='$photoName'      
                                                    
                                WHERE  emp_id ='$employee_id'";

         $checkSameEmail= $this->email_exist_or_not_without_this_employee($email,$employee_id);
          if ($checkSameEmail) {
           echo "Email address Allready Exist";
          }else{
             $updated_user_result=$this->db->update($update_user_query_WithPhoto);

          if ($updated_user_result) {
              echo "success";

          exit();
          }
         else {
          echo "failed";
                  exit();
                 }
          }       

      }
           
     }
//Updae Password 
     public function update_password($curPass,$newPass,$employee_id)
   {
    
    
      $curPass= $this->fm->validation($curPass);
      $newPass= $this->fm->validation($newPass);
      $employee_id= $this->fm->validation($employee_id);
      $curPass=mysqli_real_escape_string($this->db->link,$curPass);
      $newPass=mysqli_real_escape_string($this->db->link,$newPass);
      $employee_id=mysqli_real_escape_string($this->db->link,$employee_id);
    if ($curPass == "" || $newPass == ""||$employee_id == ""){
      echo "empty";
      exit();
    }
    else{
      $checkCurPassQuery="SELECT password FROM employee WHERE emp_id='$employee_id'";
      $resCheckCurPass=$this->db->select($checkCurPassQuery);
      if ($resCheckCurPass) {
       $currentPassword=$resCheckCurPass->fetch_assoc()['password'];
       if ($currentPassword==$curPass) {
          if ($curPass==$newPass) {
           echo "same";
          }
          else{
             $query = "UPDATE employee SET 
              password='$newPass'
         WHERE  emp_id ='$employee_id' ";
         $result=$this->db->update($query);
         if ($result) {
           echo "success";
              exit();
         }
         else{
           echo "error";
              exit();
          }
         }
        
       }
       else{
        echo "wrong";
           exit();
       }
      }

    }

     

}
   
 public function User_forget_password($user_email)

{

      $email= $this->fm->validation($user_email);
     
      $email=mysqli_real_escape_string($this->db->link,$user_email);
      $loginQuery="SELECT * FROM user WHERE email='$email' ";
             $result= $this->db->select($loginQuery);

             if ($result !=false) {
              $rowcount=mysqli_num_rows($result);
               $login_value=$result->fetch_assoc();
               if($rowcount<=0){
                 //echo "Your Accound Has been Disabled...Contact With Admin.....";
                echo "Wrong Email OR  Profile Name ";
                exit();
               }
           else
           {
            $dataa= $login_value['password'];
              echo $dataa;

           }

     }
    
}

public function update_profile($employee_id,$firstName,$lastName,$email,$password,$mobileNo,$address,$gender,$nid,$dob,$photoName)
   {
      $firstName= $this->fm->validation($firstName);
      $lastName= $this->fm->validation($lastName);
      $email= $this->fm->validation($email);
      $password= $this->fm->validation($password);
      $address= $this->fm->validation($address);
      $mobileNo= $this->fm->validation($mobileNo);
      $dob= $this->fm->validation($dob);

      $firstName= mysqli_real_escape_string($this->db->link,$firstName);
      $lastName= mysqli_real_escape_string($this->db->link,$lastName);
      $email=mysqli_real_escape_string($this->db->link,$email);
      $password=mysqli_real_escape_string($this->db->link,$password);
      $address=mysqli_real_escape_string($this->db->link,$address);
      $mobileNo=mysqli_real_escape_string($this->db->link,$mobileNo);
      $dob=mysqli_real_escape_string($this->db->link,$dob);
      if (empty($photoName)){
        $update_user_query_withOutPhoto=" UPDATE employee SET  first_name='$firstName',
                                             last_name='$lastName',
                                             email='$email',
                                             password='$password',
                                             address='$address',
                                             mobileNo='$mobileNo',
                                             gender='$gender',
                                             nid='$nid',
                                           
                                             dob='$dob'      
                                                    
                                WHERE  emp_id ='$employee_id'";
    $checkSameEmail= $this->email_exist_or_not_without_this_employee($email,$employee_id);
          if ($checkSameEmail) {
           echo "Email address Allready Exist";
          }else{
             $updated_user_result=$this->db->update($update_user_query_withOutPhoto);

          if ($updated_user_result) {

            $login_value=$this->find_employee_info($employee_id)->fetch_assoc();
            Session::unsetLoggedDetailsWithoutPhoto();
            Session::set("first_name",$login_value['first_name']);
            Session::set("last_name",$login_value['last_name']);
            Session::set("email",$login_value['email']);
            Session::set("loggedRole",$login_value['role']);
              echo "success";

          exit();
          }
         else {
          echo "failed";
                  exit();
                 }
          }
        
      }
      // End of Empty PHoto
      else{
            // print_r("Photo not Empty");
        $update_user_query_WithPhoto=" UPDATE employee SET  first_name='$firstName',
                                             last_name='$lastName',
                                             email='$email',
                                             address='$address',
                                             mobileNo='$mobileNo',
                                             gender='$gender',
                                             nid='$nid',
                                             dob='$dob',
                                             photo='$photoName'                                                
                                WHERE  emp_id ='$employee_id'";

         $checkSameEmail= $this->email_exist_or_not_without_this_employee($email,$employee_id);
          if ($checkSameEmail) {
           echo "Email address Allready Exist";
          }else{
             $updated_user_result=$this->db->update($update_user_query_WithPhoto);

          if ($updated_user_result) {
            $login_value=$this->find_employee_info($employee_id)->fetch_assoc();
            Session::unsetLoggedDetailsWithPhoto();
            Session::set("first_name",$login_value['first_name']);
            Session::set("last_name",$login_value['last_name']);
            Session::set("email",$login_value['email']);
            Session::set("loggedRole",$login_value['role']);
            Session::set("photo",$login_value['photo']);
            echo "success";
          exit();
          }
         else {
          echo "failed";
                  exit();
                 }
          }       

      }
           
     }
   

   
//Fecth Department Selection

   public function department_list()
   {
   $query= "SELECT * FROM employee  ORDER BY dep_id ASC";
     $result=$this->db->select($query);
     return $result;

   }

//Fecth Designation for department Selection
   public function designation_list_for_department($dep_id)
   {
   $query= "SELECT * FROM designation where dep_id='$dep_id'  ORDER BY des_id ASC";
     $result=$this->db->select($query);
     return $result;

   }


  
    public function find_profile($user_id)
   {
   $query= "SELECT * FROM user  WHERE user_id='$user_id' ";
     $result=$this->db->class_select_option($query);
     return $result;

   }
  
   


   




}



?>
