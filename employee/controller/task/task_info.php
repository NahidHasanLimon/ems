<?php 
$filepath = realpath(dirname(__FILE__));
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/employee/classes/Task.php');
$tsk= new Task();
?>
 <?php  
 if(!empty($_POST))
 {
  if (empty($_POST['task_id']) ) {
    echo "field can not be empty";
  }else{
    $task_id=$_POST['task_id'];
     $result=$tsk->find_task_details($task_id);
     $resultTaskHistory=$tsk->find_task_history_details($task_id);
     if($result){
      $output = '';  
    $output .='<table class="table responsive table-striped table-dark table table-bordered text-left"> 
          <tbody>';
    while($row =$result->fetch_assoc()){ 
       $output .='
                <tr>
                  <td>Name</td>
                  <td>'. $row["name"].'</td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td>'. $row["description"].'</td>
                </tr>
                <tr>
                  <td>Assigned To</td>
                  <td>'. $row["assigned_to_name"].'</td>
                </tr>
                <tr>
                  <td>Start Date</td>
                  <td>'.($row['start_date'] ? date('d F, Y', strtotime($row['start_date'])) : '') .'</td>
                </tr>
                <tr>
                  <td>End Date</td>
                  <td>'. ($row['end_date'] ? date('d F, Y', strtotime($row['end_date'])) : '') .'</td>
                </tr>
                <tr>
                  <td>Category</td>
                  <td>'. ($row["task_category_name"] ? $row['task_category_name']  : 'In House' ).'</td>
                </tr> 
                <tr>
                 <tr>
                  <td>Project</td>
                  <td>'. ($row["project_name"] ? $row['project_name']  : 'In House' ).'</td>
                </tr> 
                <tr>
                  <td>Client</td>
                  <td>'. ($row["client_id"] ? $row['client_name']  : 'In House' ).'</td>
                </tr>
                 <tr>
                  <td>Created By</td>
                  <td>'. $row["created_by_name"].'</td>
                </tr>
                 <tr>
                  <td>Created at</td>
                  <td>'.($row['created_at'] ? date('M,d,Y h:i:s A', strtotime($row['created_at'])) : '') .'</td>
                </tr>
                ';   

      if($row['approved_status']!=0){
         $output  .= '<span class="label label-success ml-2 mb-2">Approved</span>';  
          $output .='
                <tr>
                  <td>Approved By</td>
                  <td>'. $row["approved_by_name"].'</td>
                </tr> 
                <tr>
                  <td>Approved At</td>
                 <td>'.($row['approved_at'] ? date('M,d,Y h:i:s A', strtotime($row['approved_at'])) : '') .'</td>
                </tr>
                <tr>
                  <td>Actual Start Date</td>
                  <td>'.($row['actual_start_date'] ? date('d F, Y', strtotime($row['actual_start_date'])) : '').'</td>
                </tr>
                <tr>
                  <td>Actual End Date</td>
                  <td>'.($row['actual_end_date'] ? date('d F, Y', strtotime($row['actual_end_date'])) : '') .'</td>
                </tr>
    
                ';  

        }else{
           $output .= '<span class="label label-danger ml-2 mb-2"> Not Approved </span>';

        }
        if(!is_null($row['actual_start_date'])){

         $output  .= '<tr>
                  <td colspan="2"> <button  type="button" class="btn btn-rounded btn-primary viewTaskHistory" id="taskHistoryBtn"><i class="fa fa-paper-plane" aria-hidden="true"></i>Show Task History</button></td>
                </tr>
               ';
       }
     }
     // end of while
        $output.='</tbody> </table>';
        // for task history
}
// if result
 else{
        echo 'error';
    }
     $output.='<div class="container" id="taskHistoryDiv" style="display:none;>';
        if($resultTaskHistory){ 

        $output.='<table class="table responsive table-striped table-dark table table-borderless text-center" id="all_task_table">
        <thead> '; //         
//           $output .='<table class="table responsive table-striped table-dark table table-bordered text-left >';

    while($rowTaskHistory =$resultTaskHistory->fetch_assoc()){ 
      if ($rowTaskHistory['status_id']==1) {
       $status='Status 1';
      }else if ($rowTaskHistory['status_id']==1) {
       $status='Status 1';
      }
      else if ($rowTaskHistory['status_id']==2) {
       $status='Status 2';
      } else if ($rowTaskHistory['status_id']==3) {
       $status='Status 3';
      } else if ($rowTaskHistory['status_id']==4) {
       $status='Status 4';
      } 

      $output.='<tbody>
                  <li>'.($rowTaskHistory['updated_at'] ? date('M,d,Y h:i:s A', strtotime($rowTaskHistory['updated_at'])) : '' ) .' '.$status.'</li>

                  </tbody>';


}

}else{
  $output .='</table><span> not task Status History </span>  ';

}
$output .='</div></table> ';
// for task history
      
        echo $output; 
     

    
    // echo json_encode($output);
    }

   
  
  

}
  ?>

  