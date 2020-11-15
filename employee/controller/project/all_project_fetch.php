<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/ems/lib/Database.php'); 
$db = new Database();

$columns = array('name', 'description');

$query = "SELECT pro.id, pro.name,pro.description,pro.approved_status,pro.start_date,pro.end_date,pro.actual_start_date,pro.actual_end_date,pro.expense,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,cl.name as client_name,pcategory.name as project_category_name
       FROM `Projects` as pro 
       LEFT JOIN employee emp1 ON emp1.emp_id=pro.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=pro.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=pro.assigned_to
       LEFT JOIN project_categories pcategory ON pcategory.id=pro.category_id
       LEFT JOIN clients cl ON cl.id=pro.client_id

       ";

// if(isset($_POST["search"]["value"]))
// {
//  $query .= '
//   AND (pro.name LIKE "%'.$_POST["search"]["value"].'%" 
//  OR pro. description LIKE "%'.$_POST["search"]["value"].'%" 
//  )';
// }
// // if(isset($_POST['filter_client']) && $_POST['filter_client'] != '')
// {
// 	$cl_id=$_POST['filter_client'];
// 	 $query .= 'WHERE cl.id='.$cl_id.' 
//  ';
// }

// Start Data Filtering
if(isset($_POST['filterFormData']) && $_POST['filterFormData'] != '')
{
	$get = explode('&', $_POST['filterFormData'] ); // explode with and
	foreach ( $get as $key => $value) {
	  $filteredData[substr( $value, 0 , strpos( $value, '=' ) ) ] =  substr( $value, strpos( $value, '=' ) + 1 ) ;
	}
	if (isset($filteredData['filter_month_picker']) ) {
		 $startDate=$filteredData['filter_month_picker'].'-01';
	}
	

	// 1 only for filter by month Picker
	if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		// $f_client_id=$filteredData['filter_client'];

		 // $query .= 'WHERE pro.start_date >= '.$startDate.' + INTERVAL 0 MONTH AND pro.start_date < '.$startDate.' + INTERVAL 1 MONTH ';
		 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH ';
	}
	
   // 2 only for filter by Client 
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' ';
	}
	//3 only for filter by categories
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.category_id='.$filteredData['filter_categories'].' ';
	}
	
	//4 only for filter by assigned to 
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.assigned_to='.$filteredData['filter_assigned_to'].' ';
	}
	//5 only for filter by approval status
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
	//6 only for filter by completion status
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	// end of single filter
	// two filter

	//7 filter by month Picker & client
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		
		 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.client_id='.$filteredData['filter_client'].' ';
	}
   //8 filter by month Picker & Category
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		
		 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.category_id='.$filteredData['filter_categories'].' ';
	}
	//9 filter by month Picker & Assigned to
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		
		 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.assigned_to='.$filteredData['filter_assigned_to'].' ';
	}
   //10 filter by month Picker &  Approve Status
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		
		 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}

   //11 filter by month Picker &  Completion Status
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
		
		 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//12 filter by Client &  category
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		 pro.category_id='.$filteredData['filter_categories'].' ';
	}
   
   //13 filter by Client &  assigned to 
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		 pro.assigned_to='.$filteredData['filter_assigned_to'].' ';
	}
	//14 filter by Client &  approval status 
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		 pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
	//15 filter by Client &  Completion  status 
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//16 filter by category &  assigned to
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.category_id='.$filteredData['filter_categories'].' AND 
		 pro.assigned_to='.$filteredData['filter_assigned_to'].' ';
	}
	//17 filter by category &  Approval status to
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.category_id='.$filteredData['filter_categories'].' AND 
		 pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
	//18 filter by category &  Completion status to
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.category_id='.$filteredData['filter_categories'].' AND 
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//19 filter by Assigned to &  approval status to
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.assigned_to='.$filteredData['filter_assigned_to'].' AND 
		 pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
	//20 filter by Assigned to &  Completion status to
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.assigned_to='.$filteredData['filter_assigned_to'].' AND 
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//21 filter by Approval Status to &  Completion status
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
		 $query .= 'WHERE pro.approved_status='.$filteredData['filter_approval_status'].' AND 
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}

	// Three Filter

	//22 filter by Month Picker & Client & Category
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.client_id='.$filteredData['filter_client'].' AND pro.category_id='.$filteredData['filter_categories'].' ';
	}
//23 filter by Month Picker & Client & Assigned to
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.client_id='.$filteredData['filter_client'].' AND pro.assigned_to='.$filteredData['filter_assigned_to'].' ';
	}

//24 filter by Month Picker & Client & Approval status
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.client_id='.$filteredData['filter_client'].' AND pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
//25 filter by Month Picker & Client & Completion Status
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.client_id='.$filteredData['filter_client'].' AND pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//26 filter by Month Picker & Category & Assigned to
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.category_id='.$filteredData['filter_categories'].' AND pro.assigned_to='.$filteredData['filter_assigned_to'].' ';
	}
	//27 filter by Month Picker & Category & Approval Status
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.category_id='.$filteredData['filter_categories'].' AND pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
	//28 filter by Month Picker & Category & Completion  Status
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.category_id='.$filteredData['filter_categories'].' AND pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//29 filter by Month Picker & Assigned to & approval  Status
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.assigned_to='.$filteredData['filter_assigned_to'].' AND pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
	//30 filter by Month Picker & Assigned to & completion  Status
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.assigned_to='.$filteredData['filter_assigned_to'].' AND pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//31 filter by Month Picker & Approval  & completion  Status
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.approved_status='.$filteredData['filter_approval_status'].' AND pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//32 filter by Client & category  & assigned to
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		 pro.category_id='.$filteredData['filter_categories'].' AND pro.assigned_to='.$filteredData['filter_assigned_to'].' ';
	}
//33 filter by Client & category  & approval Status
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		 pro.category_id='.$filteredData['filter_categories'].' AND pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
//34 filter by Client & category  & Completion Status
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		 pro.category_id='.$filteredData['filter_categories'].' AND pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//35 filter by Client & Assigned to approval status 
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		 pro.assigned_to='.$filteredData['filter_assigned_to'].' AND pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
		//36 filter by Client & approval status  & Completion Status
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		 pro.approved_status='.$filteredData['filter_approval_status'].' AND pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//37 filter by category  & assigned to & approval  Status
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.category_id='.$filteredData['filter_categories'].' AND 
		 pro.assigned_to='.$filteredData['filter_assigned_to'].' AND pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}

	//38 filter by category  & assigned to & completion  Status
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.category_id='.$filteredData['category_id'].' AND 
		 pro.assigned_to='.$filteredData['filter_assigned_to'].' AND pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//39 filter by category  & approval status & completion  Status
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.category_id='.$filteredData['filter_categories'].' AND 
		 pro.approved_status='.$filteredData['filter_approval_status'].' AND pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	//40 filter by Assigned  & approval status & completion  Status
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.assigned_to='.$filteredData['filter_assigned_to'].' AND 
		 pro.approved_status='.$filteredData['filter_approval_status'].' AND pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
	// Four Layer  filter

//41 filter by Month Picker & Client & Category & Assigned to 
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.client_id='.$filteredData['filter_client'].' AND 
		  pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' ';
	}
//42 filter by Month Picker & Client & Category & Approval
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			$query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.client_id='.$filteredData['filter_client'].' AND
		  pro.category_id='.$filteredData['filter_categories'].' AND
		 pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
//43 filter by Month Picker & Client & Category & Completion
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		 pro.client_id='.$filteredData['filter_client'].' AND
		  pro.category_id='.$filteredData['filter_categories'].' AND
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//44 filter by Month Picker  & Category & Assigned to & approval
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		  pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		 pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
//45 filter by Month Picker  & Category & Assigned to & Completion 
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		  pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//46 filter by Month Picker  & Category  & approval & Completion
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		  pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//47 filter by Month Picker  & Client & Assigned to & approval
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		  pro.client_id='.$filteredData['filter_client'].' AND
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		 pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
//48 filter by Month Picker  & Client &  approval & Compeltion
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		  pro.client_id='.$filteredData['filter_client'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//49 filter by Month Picker  & Assigned to  approval & Compeltion
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}

//50 filter by Client & Category & Assigned to & approval

	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		  pro.category_id='.$filteredData['filter_categories'].' AND
		 pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
//51 filter by Client & Category & Completion & approval
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		  pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//52 filter by Category & Assigned to &    approval & Completion
	else if (!isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		 pro.project_status='.$filteredData['filter_completion_status'].' ';
	}

	// Five Filter
//53 filter by Month Picker & client & Category & Assigned to &  approval  Status
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& !isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		pro.client_id='.$filteredData['filter_client'].' AND
		pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' ';
	}
//54 filter by Month Picker & client & Category & Assigned to &  Completion  Status
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && !isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		pro.client_id='.$filteredData['filter_client'].' AND
		pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		  pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//55 filter by Month Picker & client & Category & Approval &  Completion  Status
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && !isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		pro.client_id='.$filteredData['filter_client'].' AND
		pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		  pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//56 filter by Month Picker & client & assigned t0 & Approval &  Completion  Status
	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && !isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		pro.client_id='.$filteredData['filter_client'].' AND
		pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		  pro.project_status='.$filteredData['filter_completion_status'].' ';
	}
//57 filter by Month Picker & Category & assigned t0 & Approval &  Completion  Status
	else if (isset($filteredData['filter_month_picker']) && !isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.start_date >= "'.$startDate.'" + INTERVAL 0 MONTH AND pro.start_date <"'.$startDate.'" + INTERVAL 1 MONTH AND 
		pro.category_id='.$filteredData['filter_categories'].' AND
		pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		  pro.project_status='.$filteredData['filter_completion_status'].' ';
	}

//58 filter by  client & Category & Assigned to & approval status &  Completion  Status
	else if (!isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		  pro.project_status='.$filteredData['filter_completion_status'].' ';
	}

	// Six Layer Filter
	 // 59. Filter By ALL

	else if (isset($filteredData['filter_month_picker']) && isset($filteredData['filter_client']) && isset($filteredData['filter_categories']) && isset($filteredData['filter_assigned_to'])  && isset($filteredData['filter_approval_status'])&& isset($filteredData['filter_completion_status']) ) {
			 $query .= 'WHERE pro.client_id='.$filteredData['filter_client'].' AND 
		  pro.client_id='.$filteredData['filter_client'].' AND
		  pro.category_id='.$filteredData['filter_categories'].' AND
		  pro.assigned_to='.$filteredData['filter_assigned_to'].' AND
		  pro.approved_status='.$filteredData['filter_approval_status'].' AND
		  pro.project_status='.$filteredData['filter_completion_status'].' ';
	}

	
	
}
//End Data Filtering
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
// else
// {
//  $query .= 'ORDER BY id ASC ';
// }

$query1 = '';
if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
if ($number_filter=$db->select($query) ) {
	$number_filter_row = mysqli_num_rows($number_filter);
}else{
	$number_filter_row=0;
}

// var_dump($query . $query1);
$result = $db->select($query . $query1);

$data = array();
$i=0;

if ($result) {
	while($row = mysqli_fetch_array($result))
	{
		$i++;
		$sub_array = array();
		if ($row['approved_status']!=0) {
			$aStatus="Aprroved";
			$sIconClass="check";
			$sIconColor="#2bb3c0";
		}else{$aStatus="Un Appr.";$sIconClass="exclamation-triangle";$sIconColor="#ff4747";}
		if (!is_null($row['actual_start_date'])&& !is_null($row['actual_end_date'])) {
			$tStatus="Completed";
			$tClass="info bg-green";
		}else if (!is_null($row['actual_start_date'])&& is_null($row['actual_end_date'])) {
			$tStatus="Working";
			$tClass="primary";
		}else if(!is_null($row['actual_start_date'])&& is_null($row['actual_end_date'])) {
			$tStatus="Pending";
			$tClass="danger";
		}else{
			$tStatus="Pending";
			$tClass="danger";
		}
	

	$sub_array[] = '<td><i class="fas fa-'.$sIconClass.'"style="color:'.$sIconColor.';"></i></td>';
	// $sub_array[] = '<td><span class="label label-'.$sIconClass.'">'.$aStatus.'</span></td>';
	$sub_array[] = '<td>'. $row["name"] . '</td>';
	$sub_array[] = '<td>' . $row["client_name"] . '</td>';
	$sub_array[] = '<td>' . $row["assigned_to_name"] . '</td>';
	$sub_array[] = '<td>' . $row["project_category_name"] . '</td>';
	$sub_array[] = '<td>' . $row["expense"] . '</td>';
	// $sub_array[] = '<td>' . $row["created_by_name"] . '</td>';
	// $sub_array[] = '<td><span class="label label-'.$tClass.'">'.$tStatus.'</span></td>';
	$sub_array[] = '<td> <button type="button" class="btn btn-rounded btn-info viewProject" id="'.$row["id"].'"><i class="fa fa-eye" aria-hidden="true"></i></button>
	 <button type="button" class="btn btn-rounded btn-danger deleteProject" id="'.$row["id"].'"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
	$data[] = $sub_array;
	}
}


function get_all_data($db)
{
 $query = "SELECT pro.id, pro.name,pro.description,pro.approved_status,pro.start_date,pro.end_date,pro.actual_start_date,pro.actual_end_date,CONCAT(emp1.first_name,' ',emp1.last_name) as approved_by_name, CONCAT(emp2.first_name,' ',emp2.last_name) as created_by_name,CONCAT(emp3.first_name,' ',emp3.last_name) as assigned_to_name,cl.name as client_name,pcategory.name as project_category_name
       FROM `Projects` as pro 
       LEFT JOIN employee emp1 ON emp1.emp_id=pro.approved_by
       LEFT JOIN employee emp2 ON emp2.emp_id=pro.created_by 
       LEFT JOIN employee emp3 ON emp3.emp_id=pro.assigned_to
       LEFT JOIN project_categories pcategory ON pcategory.id=pro.category_id
       LEFT JOIN clients cl ON cl.id=pro.client_id";
 if ($result = $db->select($query) ) {
 return mysqli_num_rows($result);
 }
 

}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($db),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
