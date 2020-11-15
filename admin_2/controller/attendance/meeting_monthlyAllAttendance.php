<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/admin/classes/Attendance.php'); 
  $atn= new Attendance();
   // <!-- This page request comes from find employee page vi ajax Request -->
  ?>

 <?php  

  if(isset($_POST["employee_id"]))  
 {  
    $employee_id=$_POST['employee_id'];
    $startDate=$_POST['start_date'];
    // print_r($startDate);
    // print_r($atn->an_employee_everyDate_attendance($employee_id,$startDate));



   
      $result = $atn->everyDate_meeting_attendance($startDate,$employee_id);
      if(!$result){ 
    echo "No Attendance Available";
    
      }
      else {
       $output = '';  
      $totalMeal=0; 
      $output .= '  
            <div class="table-responsive">  
            <table class="table table-bordered">
            <td width="20%">Date</td> 
            <td width="20%">Day</td> 
            <td width="20%">Status</td>
            ';  


      while($row = mysqli_fetch_array($result))  
      {  
       
        $output .= '  
                <tr>  
                     
                     <td width="20%">'.$row["mydate"].'</td>  
                     <td width="20%">'.DATE('l',strtotime($row["mydate"])).'</td>  
      
               
           ';  

        if ($row['status']!=NULL) {

          $output .= '
                    
                     <td width="10%" class="text-bold">'.strtoupper($row["status"]).'</td>

                     
               
           '; 
            
                 
        }
        else{

           $output .= '  
                     <td width="10%" class="text-danger">No Data</td>  
                    
                    </tr>       
           '; 

        }
           
      }  
      echo $output;  
 
  } 
   }



 ?>
