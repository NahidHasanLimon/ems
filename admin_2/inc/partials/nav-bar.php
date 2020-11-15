
<?php 
if (Session::get("loggedRole")==3 || Session::get("loggedRole")==2 ) {

              if (Session::get("loggedRole")==3) {
                  $unApproved_attendanceDate=$atn->unApproved_attendanceDate_role_3();
                }
                else if (Session::get("loggedRole")==2) {
                  $unApproved_attendanceDate=$atn->unApproved_attendanceDate_role_2();
                }
                 if ($unApproved_attendanceDate) {
                   $totalUnapprovedDays=mysqli_num_rows($unApproved_attendanceDate);
                  }
                  else{
                    $totalUnapprovedDays=0;
                  }
                }
                else {
                   $totalUnapprovedDays=0;
                }
                ?>

<!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
           

            <!-- Nav Item - Alerts -->
         

            <!-- Nav Item - Messages -->
<?php if (Session::get("loggedRole")==3 || Session::get("loggedRole")==2 ) {  ?>
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter"><?php echo $totalUnapprovedDays; ?></span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Un Approved Attendance
                </h6>
                <div class="small text-gray-500">Hi there! You have Un Approved Attendance Date.</div>
                <?php 
                
                if ($unApproved_attendanceDate) {
                 while($rowDate = mysqli_fetch_array($unApproved_attendanceDate)){
                   ?>
                <a class="dropdown-item d-flex align-items-center" href="v_approve_attendance_<?php echo Session::get("loggedRole")?>.php?at_date=<?php echo $rowDate['at_date'];?>">
                
                  <div class="font-weight-bold">
                    
                    <div class="text-truncate"><?php echo $rowDate['at_date']; ?></div>
                  </div>
                </a>
                 <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Check More Unapproved Date</a> -->
                <?php }} 
                else{
                  echo '<div class="small text-gray-500">No Date For Approved</div>';
                }
                  ?>   
              </div>
            </li>
<?php } ?>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php  
                 $loginName=Session::get("last_name"); 
                $loggedRole=Session::get("loggedRole");
                 echo $loginName;
                 $photo=Session::get("photo");
                  ?></span>
                <img class="img-profile rounded-circle" src="<?php echo '/../ems/photo/'.$photo ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="v_profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>   
                <a class="dropdown-item" href="v_logged_attendance_details.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Attendnace Details
                </a>
               <!--  <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->