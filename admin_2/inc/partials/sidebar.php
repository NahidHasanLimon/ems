  <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">7TEEN EMS</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
     

      <!-- Heading -->
     

      <!-- Nav Item - Pages Collapse Menu -->
    

      <!-- Nav Item - Utilities Collapse Menu -->
     

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
     
<!-- <li class="dropdown-submenu">
    <a tabindex="-1" href="#">More options</a>
    <ul class="dropdown-menu">
      ...
    </ul>
  </li> -->
       <!-- Employee Managemment -->
       

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEmployee" aria-expanded="true" aria-controls="collapsePagesEmployee">
          <i class="fas fa-fw fa-folder"></i>
          <span>Employee</span>
        </a>
        <div id="collapsePagesEmployee" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Employee</h6>
            <?php   if  (Session::get("loggedRole")==2 || Session::get("loggedRole")==3) { ?>
            <!--<a class="collapse-item" href="v_add_employee.php">Add Employee</a>-->
            <!--<a class="collapse-item" href="v_add_employee_appointment.php">Appoint Employee</a>-->
            <a class="collapse-item" href="v_manage_employee_role.php">Manage Role</a>
            <a class="collapse-item" href="v_manage_password.php">Change Password</a>
          <?php } ?>
            <!-- <a class="collapse-item" href="v_add_employee_appointment.php">Add Employee Role</a> -->
            <a class="collapse-item" href="v_employee_list.php">See Employee List</a>
              <a class="collapse-item" href="v_find_employee.php">Find Employee</a>
              <a class="collapse-item" href="v_add_employee.php">Add Employee</a>
              <a class="collapse-item" href="v_add_employee_appointment.php">Appoint Employee</a>
            <!-- <a class="collapse-item" href="v_edit_employee.php">Edit Employee</a> -->
          </div>
        </div>
      </li>
 <?php 
              if  (Session::get("loggedRole")==2 || Session::get("loggedRole")==3) {
             ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesEmployeeRole" aria-expanded="true" aria-controls="collapsePagesEmployeeRole">
          <i class="fas fa-fw fa-folder"></i>
          <span>Employee Role</span>
        </a>
        <div id="collapsePagesEmployeeRole" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Employee Role</h6>


            <a class="collapse-item" href="v_add_employee_job_role.php">Add Employee Role</a>
            <a class="collapse-item" href="v_promote_edit_employe.php">Promote/Edit Employee</a>
            <a class="collapse-item" href="v_end_Employee_role.php">End Employee Role</a>
            <a class="collapse-item" href="v_terminate_employee.php">Terminate Employee</a>
            <!-- <a class="collapse-item" href="v_edit_employee.php">Edit Employee</a> -->
          </div>
        </div>
      </li>
<?php } ?>

        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesAttendance" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Attendance</span>
        </a>
         <div id="collapsePagesAttendance" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Attendance</h6>
            <a class="collapse-item" href="v_insert_daily_attendance.php">Add Daily Attendance</a>
            <a class="collapse-item" href="v_insert_single_attendance.php">Add Single Attendance</a>
            <a class="collapse-item" href="v_edit_single_attendance.php">Edit Single Attendance</a>
            <?php
             // $loggedRole=Session::get("loggedRole");
             if  (Session::get("loggedRole")==3) {
              ?>
              <a class="collapse-item" href="v_approve_attendance_3.php">Approve Attendance(SA)</a>
             
           <?php  } ?>

            <?php
             // $loggedRole=Session::get("loggedRole");
             if  (Session::get("loggedRole")==2) {
              ?>
              <a class="collapse-item" href="v_approve_attendance_2.php">Approve Attendance( Admin) </a>
             
           <?php  } ?>

<!--             <a class="collapse-item" href="v_dailyWise_attendance.php">Daily Report</a>
            <a class="collapse-item" href="v_week_wise_attendance.php">Weekly Report</a>
            <a class="collapse-item" href="v_month_wise_attendance_report.php">Monthly Report</a>
            <a class="collapse-item" href="v_dateRangeWise_Attendance.php">Date Range Report</a>
            <a class="collapse-item" href="v_monthly_attendance_sheet.php">Monthly Attendance Sheet</a> -->
           
          </div>
        </div>
          </li>
           <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesReport" aria-expanded="true" aria-controls="collapsePagesReport">
          <i class="fas fa-fw fa-folder"></i>
          <span>Report</span>
        </a>
         <div id="collapsePagesReport" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Report</h6>
            <a class="collapse-item" href="v_dailyWise_attendance.php">Daily Report</a>
            <a class="collapse-item" href="v_week_wise_attendance.php">Weekly Report</a>
            <a class="collapse-item" href="v_month_wise_attendance_report.php">Monthly Report</a>
            <a class="collapse-item" href="v_dateRange_wise_attendance.php">Date Range Report</a>
            <a class="collapse-item" href="v_monthly_attendance_sheet.php">Monthly Attendance Sheet</a>
            <a class="collapse-item" href="v_meeting_month_wise_attendance_report.php">Meeting</a>
          </div>
        </div>
      </li>
          <?php 
              if  (Session::get("loggedRole")==2 || Session::get("loggedRole")==3) {
             ?>
           <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesHR_Structure" aria-expanded="true" aria-controls="collapsePagesHR_Structure">
          <i class="fas fa-fw fa-folder"></i>
          <span>HR Structure</span>
        </a>
         <div id="collapsePagesHR_Structure" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">HR Structure</h6>
            <a class="collapse-item" href="v_company.php">Company(CRUD)</a>
            <a class="collapse-item" href="v_department.php">Department(CRUD) </a>
            <a class="collapse-item" href="v_designation.php">Designation(CRUD)</a>
          </div>
        </div>
      </li>   
             
        <!-- <div id="collapsePagesEmployee" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Employee</h6>
            <a class="collapse-item" href="v_add_employee.php">Add Employee</a>
            <a class="collapse-item" href="v_edit_employee.php">Promote/Edit Employee</a>
            <a class="collapse-item" href="v_end_employee_role.php">End Employee Role</a>
            <a class="collapse-item" href="v_terminate_employee.php">Terminate Employee</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div> -->
      </li>
    <?php } ?>
     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesHoliday" aria-expanded="true" aria-controls="collapsePagesHoliday">
          <i class="fas fa-fw fa-folder"></i>
          <span>Holiday</span>
        </a>
        <div id="collapsePagesHoliday" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Holiday</h6>
            <!-- <a class="collapse-item" href="v_holiday.php">Holiday</a> -->
            <a class="collapse-item" href="404.php">Holiday</a>
          
            <!-- <a class="collapse-item" href="v_edit_employee.php">Edit Employee</a> -->
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesSalary" aria-expanded="true" aria-controls="collapsePagesSalary">
          <i class="fas fa-fw fa-folder"></i>
          <span>Salary</span>
        </a>
        <div id="collapsePagesSalary" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Salary</h6>
            <!-- <a class="collapse-item" href="v_Salary.php">Salary</a> -->
            <!--<a class="collapse-item" href="v_salary_calculation.php">Salary</a>-->
            <a class="collapse-item" href="404.php">Salary</a>
          
            <!-- <a class="collapse-item" href="v_edit_employee.php">Edit Employee</a> -->
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      

      <!-- Nav Item - Tables -->
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
   