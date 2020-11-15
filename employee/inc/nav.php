<?php 
$loginName=Session::get("last_name");
$loggedRole=Session::get("loggedRole");
$photo=Session::get("photo");
 ?>
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
<header class="navbar navbar-fixed">
            <!-- Navbar Header Start -->
            <div class="navbar--header">
                <!-- Logo Start -->
                <a href="<?php echo $baseUrl.'employee/index.php' ?>" class="logo">
                    <!-- <img src="<?php echo $baseUrl?>/assets/img/logo.png" alt=""> -->
                    <!-- <img src="<?php echo $baseUrl?>/assets/img/logo.png" alt=""> -->
                    <span>Nahid Hasan Limon</span>
                </a>
                <!-- Logo End -->

                <!-- Sidebar Toggle Button Start -->
                <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- Sidebar Toggle Button End -->
            </div>
            <!-- Navbar Header End -->

            <!-- Sidebar Toggle Button Start -->
            <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <!-- Sidebar Toggle Button End -->

            <!-- Navbar Search Start -->
            <div class="navbar--search">
                <form action="search-results.html">
                    <input type="search" name="search" class="form-control" placeholder="Search Something..." required>
                    <button class="btn-link"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <!-- Navbar Search End -->

            <div class="navbar--nav ml-auto">
                <ul class="nav">
                     <!-- <li class="nav-item">
                        <a href="mailbox_inbox.html" class="nav-link">
                            <i class="fa fa-envelope"></i>
                            <span class="badge text-white bg-blue">4</span>
                        </a>
                    </li> -->

                    <!-- notification -->
                    <?php if (Session::get("loggedRole")==3 || Session::get("loggedRole")==2 ) {  ?>
                    <li class="nav-item dropdown no-arrow">
                        <a href="#" class="nav-link  dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <?php if ($totalUnapprovedDays>0) {
                               echo '<span class="badge text-white bg-blue">'.$totalUnapprovedDays.'</span>';
                            } ?>
                            
                        </a>
                         <div class="dropdown-list dropdown-menu " aria-labelledby="messagesDropdown">
                <?php 
                
                if ($unApproved_attendanceDate) {
                   ?>
                <a class="dropdown-item d-flex r" href="<?php echo $baseUrl.'admin/'; ?>v_approve_attendance_<?php echo Session::get("loggedRole")?>.php">
                   <?php echo $totalUnapprovedDays; ?>&nbsp;Un Approved Attendance
                </a>
                 <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Check More Unapproved Date</a> -->
                <?php }
                else{
                  echo '<div class="small text-gray-500">No notification</div>';
                }
                  ?>   
              </div>
                    </li>
                          <!-- notification -->
                    <?php } ?>
                     <!-- notification -->

                   

                    <!-- Nav Language Start -->
                    <li class="nav-item dropdown nav-language">
                       

                        <ul class="dropdown-menu">
                            <li>
                                <a href="">
                                    <img src="<?php echo $baseUrl?>/assets/img/flags/de.png" alt="">
                                    <span>German</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <img src="<?php echo $baseUrl?>/assets/img/flags/fr.png" alt="">
                                    <span>French</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <img src="<?php echo $baseUrl?>/assets/img/flags/us.png" alt="">
                                    <span>English</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Nav Language End -->

                    <!-- Nav User Start -->
                    <li class="nav-item dropdown nav--user online">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <img src="<?php echo $baseUrl.'photo/'.$photo ?>" alt="" class="rounded-circle">
                            <span><?php  echo $loginName; ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $baseUrl.'employee/'?>v_profile.php"><i class="far fa-user"></i>Profile</a></li>
                            <li><a href="<?php echo $baseUrl.'employee/'?>v_logged_attendance_details.php"><i class="far fa-calendar"></i>Attendance Details</a></li>
  <!--                           <li><a href="mailbox_inbox.html"><i class="far fa-envelope"></i>Inbox</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock Screen</a></li> -->
                            <li><a href="?action=logout"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </li>
                    <!-- Nav User End -->
                </ul>
            </div>
        </header>