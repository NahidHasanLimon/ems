<?php $loginName=Session::get("last_name");$loggedRole=Session::get("loggedRole");$photo=Session::get("photo");?>
        <aside class="sidebar" data-trigger="scrollbar">
            <!-- Sidebar Profile Start -->
            <div class="sidebar--profile">
                <div class="profile--img">
                    <a href="v_profile.php">
                        <img src="<?php echo '/../ems/photo/'.$photo ?>" alt="" class="rounded-circle">
                    </a>
                </div>

                <div class="profile--name">
                    <a href="v_profile.php" class="btn-link"><?php echo $loginName ?></a>
                </div>

                <div class="profile--nav">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="v_profile.php" class="nav-link" title="User Profile">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="lock-screen.html" class="nav-link" title="Lock Screen">
                                <i class="fa fa-lock"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="mailbox_inbox.html" class="nav-link" title="Messages">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?action=logout" class="nav-link" title="Logout">
                                <i class="fa fa-sign-out-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Sidebar Profile End -->

            <!-- Sidebar Navigation Start -->
            <div class="sidebar--nav">
                <ul>
                    <li>
                        <ul>
                            <li>
                                <a href="index.php">
                                    <i class="fa fa-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                          <!--   <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Ecommerce</span>
                                </a>

                                <ul>
                                    <li><a href="ecommerce.html">Dashboard</a></li>
                                    <li><a href="products.html">Products</a></li>
                                    <li><a href="products-edit.html">Edit Products</a></li>
                                    <li><a href="orders.html">Orders</a></li>
                                    <li><a href="order-view.html">Order View</a></li>
                                </ul>
                            </li> -->

                        </ul>
                    </li>

                    <li>
                        <a href="#">Human Resource</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Daily Attendance</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/v_insert_daily_attendance.php';?>">Add Daily Attendance</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_edit_single_attendance.php';?>">View/Edit Daily Attendance</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_approve_attendance_3.php';?>">Approve Daily Attendance</a></li>
                                </ul>
                            </li>
                             <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>HR Reports</span>
                                </a>

                            <ul>
                            <li><a href="<?php echo $baseUrl.'admin/v_month_wise_attendance_report.php';?>">View Monthly Report</a></li>
                            <li><a href="<?php echo $baseUrl.'admin/v_dateRange_wise_attendance.php';?>">View Date Range Report</a></li>
                            <li><a href="<?php echo $baseUrl.'admin/v_monthly_attendance_sheet.php';?>">View Monthly Attendance Sheet</a></li>
                            <li><a href="<?php echo $baseUrl.'admin/v_meeting_month_wise_attendance_report.php';?>">View Monthly Meeting Report</a></li>
                            <li><a href="<?php echo $baseUrl.'admin/v_salary_calculation2.php';?>">View Monthly Salary Report</a></li>
                            </ul>
                            </li> 
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Find Employees</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/v_employee_list.php';?>">View/Edit Current Employees</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_find_employee.php';?>">Search all employees</a></li>
                                </ul>
                            </li>  
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Manage Employees</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/v_manage_employee_role.php';?>">Assign/Manage Admins</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_manage_password.php';?>">Change Employee Passwords</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_add_employee.php';?>">Add Employee</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_add_employee_appointment.php';?>">Appoint Unappointed Employees</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_promote_edit_employe.php';?>">Promote/Edit Employee Role</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_end_Employee_role.php';?>">End Employee Role</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_terminate_employee.php';?>">Terminate Employee</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Manage HR Structure</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/v_company.php';?>">View/Manage Companies</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_department.php';?>">View/Manage Departments</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_designation.php';?>">View/Manage Designations</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/v_company.php';?>">View/Manage Organograms</a></li>
                                </ul>
                            </li>  
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Holidays</span>
                                </a>

                                <ul>
                                    <li><a href="blank.php">#</a></li>
                                
                                </ul>
                            </li>

                           

                        </ul>
                    </li>
<!-- start of task managemnat  -->
                    <li>
                        <a href="#">TASK MANAGEMENT</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Manage Task</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">Add Tasks</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_approve_task.php';?>">Approve Task Requests</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_pending_task.php';?>">View/Edit All Pending Tasks</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_all_task.php';?>">View/Edit All Tasks</a></li>
                                    <!-- <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">View/Edit Tasks by Person</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">View/Edit Tasks by Categorys</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">View/Edit Tasks by Client</a></li> -->
                                </ul>
                            </li>
                             <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Manage Task Structure</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_task_category.php';?>">Manage Task Category</a></li>
                                    
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Task Reports</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">View Daily Task Report</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">View Monthly Task Report</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">View Task Report by Date Range</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- end of task management -->

                    <!-- start of project MANAGEMENT -->
                    <li>
                        <a href="#">PROJECT MANAGEMENT</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Manage Projects</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/project/v_add_project.php';?>">Add Projects</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/project/v_all_projects.php';?>">View All Projects</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/project/v_approve_project.php';?>">Approve Project Requests</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/project/v_project_processing.php';?>">On Process Project</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Manage Project Structure</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/project/v_project_category.php';?>">Manage Project Category</a></li>
                                </ul>
                            </li> 
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Project Reports</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">Weekly Report</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">Monthly Report</a></li>
                                    <li><a href="<?php echo $baseUrl.'admin/task/v_add_task.php';?>">Custom Date Range Report</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- end of project management -->   

                     <!-- start of Clients MANAGEMENT -->
               <li>
                        <a href="#">Clients MANAGEMENT</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Manage Clients</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'admin/client/v_client.php';?>">Manage Clients</a></li>
                                   
                                </ul>
                            </li>

                        </ul>
                    </li>

                        <ul>
                            <!-- <li>
                                <a href="#">
                                    <i class="far fa-newspaper"></i>
                                    <span>UI Elements</span>
                                </a>

                                <ul>
                                    <li><a href="buttons.html">Buttons</a></li>
                                    <li><a href="pagination.html">Pagination</a></li>
                                    <li><a href="progress-bars.html">Progress Bars</a></li>
                                    <li><a href="tabs-accordions.html">Tabs &amp; Accordions</a></li>
                                    <li><a href="modals.html">Modals</a></li>
                                    <li><a href="ui-slider.html">UI Slider</a></li>
                                    <li><a href="sweet-alerts.html">Sweet Alerts</a></li>
                                    <li><a href="timeline.html">Timeline</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-wpforms"></i>
                                    <span>Form</span>
                                </a>

                                <ul>
                                    <li><a href="form-elements.html">Form Elements</a></li>
                                    <li><a href="form-wizard.html">Form Wizard</a></li>
                                    <li><a href="dropzone.html">Dropzone</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </li>
                    <!-- end of Finance management -->

                   <!--  <li>
                        <a href="#">Apps and Charts</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="far fa-envelope"></i>
                                    <span>Mailbox</span>
                                </a>

                                <ul>
                                    <li><a href="mailbox_inbox.html">Inbox</a></li>
                                    <li><a href="mailbox_compose.html">Compose</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="calendar.html">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>Calendar</span>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <i class="far fa-comments"></i>
                                    <span>Chat</span>
                                </a>
                            </li>
                            <li>
                                <a href="contacts.html">
                                    <i class="far fa-address-book"></i>
                                    <span>Contacts</span>
                                </a>
                            </li>
                            <li>
                                <a href="notes.html">
                                    <i class="far fa-sticky-note"></i>
                                    <span>Notes</span>
                                </a>
                            </li>
                            <li>
                                <a href="todo-list.html">
                                    <i class="fa fa-tasks"></i>
                                    <span>Todo List</span>
                                </a>
                            </li>
                            <li>
                                <a href="search-results.html">
                                    <i class="fa fa-search"></i>
                                    <span>Search Results</span>
                                </a>
                            </li>
                        </ul>
                    </li> -->
<!-- 
                    <li>
                        <a href="#">Extra</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    <span>Extra Pages</span>
                                </a>

                                <ul>
                                    <li><a href="pricing-tables.html">Pricing Tables</a></li>
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="invoice.html">Invoice</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="forgot-password.html">Forgot Password</a></li>
                                    <li><a href="lock-screen.html">Lock Screen</a></li>
                                    <li><a href="404.html">404 Error</a></li>
                                    <li><a href="500.html">500 Error</a></li>
                                    <li><a href="maintenance.html">Maintenance</a></li>
                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
            <!-- Sidebar Navigation End -->

            <!-- Sidebar Widgets Start -->
            <!-- sidebar  deleted widgets from this -->
            <!-- Sidebar Widgets End -->
        </aside>