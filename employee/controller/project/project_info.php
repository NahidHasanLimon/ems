<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/employee/classes/Project.php');
$pro= new Project();
?>
 <?php  
 if(!empty($_POST))
 {
  if (empty($_POST['project_id']) ) {
    echo "field can not be empty";
  }else{
    $project_id=$_POST['project_id'];
     $result=$pro->find_project_details($project_id);
     $status_track_result=$pro->project_status_track($project_id);
     if($result){
      $output = '';  
    $output .='<table class="table responsive table-striped table-dark table table-bordered text-left"> 
          <tbody>';
    while($row =$result->fetch_assoc()){ 
       $output .='
                <tr>
                  <td>Project</td>
                  <td>'. $row["name"].'</td>
                </tr>
                 <tr>
                  <td>Created By</td>
                  <td>'. $row["created_by_name"].'</td>
                </tr>
                 <tr>
                  <td>Assigned to</td>
                  <td>'. $row["assigned_to_name"].'</td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td>'. $row["description"].'</td>
                </tr>
                <tr>
                  <td>Category</td>
                  <td>'. $row["project_category_name"].'</td>
                </tr>
                <tr>
                  <td>Client</td>
                  <td>'. ($row["client_name"] ? $row['client_name']  : 'In House' ).'</td>
                </tr>
                <tr>
                  <td>Start Date</td>
                  <td>'. ($row['start_date'] ? date('d F, Y', strtotime($row['start_date'])) : '') .'</td>
                </tr>
                <tr>
                  <td>End Date</td>
                  <td>'. ($row['end_date'] ? date('d F, Y', strtotime($row['end_date'])) : '') .'</td>
                </tr>
                
                 <tr>
                  <td>Actual Start Date</td>
                  <td>'.($row['actual_start_date'] ? date('d F, Y', strtotime($row['actual_start_date'])) : '').'</td>
                </tr>
                <tr>
                  <td>Actual End Date</td>
                  <td>'.($row['actual_end_date'] ? date('d F, Y', strtotime($row['actual_end_date'])) : '') .'</td>
                </tr> 
                <tr>
                  <td>Updated Status</td>
                  <td>'.$row['status'].'</td>
                </tr>
                '; 
           $output  .= '<tr>';  
        if($row['income']>0){
          $output .='
                  <td><span class="label label-success">income</span></td>
                  <td><span class="label label-success">'. number_format($row["income"]).'<span></td>
               ';}
               else{
          $output .='
                   <td><span class="label label-danger">Loss</span></td>
                  <td><span class="label label-danger">'. number_format($row["income"]).'<span></td>
               ';
               }

        
      if($row['approved_status']!=0){
         $output  .= '<span class="label label-success">Approved</span>';  
          $output .='
                <tr>
                  <td>Approved By</td>
                  <td>'. $row["approved_by_name"].'</td>
                </tr>
                ';  

        }else{
           $output .= '<span class="label label-danger"> Not Approved </span>';

        }
      
        $output.='</tbody> </table>';
          $output.='<button id="projectHistoryBtn" class="btn btn-rounded btn-success">See Status Changes History</button> ';
     
    
    // echo json_encode($output);
    }
    // end of while
  }
  // end of if
    else{
        echo 'error';
    }
    // end of else
   
}
// end of main else 
// start of status track
 if ($status_track_result){
 $output .='<div class="table-responsive mt-2" id="projectHistoryDiv" style="display:none;">
 <table class="table responsive table-striped table-dark table table-bordered text-left">
              <thead>
              <th>Status</th>
              <th>Updated by</th>
              <th>Updated at</th>
              </thead>
          <tbody>';
     while($row_status_track =$status_track_result->fetch_assoc()){ 
       $output .='
                <tr>
                  <td>'. $row_status_track["project_status"].'</td>
                  <td>'. $row_status_track["updated_by_name"].'</td>
                  <td>'. ($row_status_track['updated_at'] ? date('M,d,Y h:i:s A', strtotime($row_status_track['updated_at'])) : '').'</td>
                </tr>';
  
  }
  // end of status track while
  $output.='</tbody> </table></div>';
    }
  // End  of status tracking if
  echo $output; 
}
// end of empty checking if
  ?>

  