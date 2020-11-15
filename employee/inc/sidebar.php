<?php $loginName=Session::get("last_name");$loggedRole=Session::get("loggedRole");$photo=Session::get("photo");$looged_emp_id=Session::get("emp_id");?>
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
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_add_task.php';?>">Request a Task</a></li>
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_all_task.php';?>">All Task</a></li>
                                    <!-- <li><a href="<?php echo $baseUrl.'employee/task/v_add_task.php';?>">Approve Task Requests</a></li> -->
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_pending_task.php';?>">View/Edit Pending Tasks</a></li>
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_on_process_task.php';?>">View/Edit On Process Tasks</a></li>
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_up_coming_task.php';?>">View Upcoming Tasks</a></li>
                           
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Task Reports</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_add_task.php';?>">View Daily Task Report</a></li>
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_add_task.php';?>">View Monthly Task Report</a></li>
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_add_task.php';?>">View Task Report by Date Range</a></li>
                                </ul>
                            </li> -->
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
                                    <?php if ($looged_emp_id==33) { ?>
                                       <li><a href="<?php echo $baseUrl.'employee/project/v_add_project.php';?>">Add Projects</a></li>
                                   <?php } ?>
                                    <li><a href="<?php echo $baseUrl.'employee/project/v_project_processing.php';?>">On process project</a></li>
                                </ul>
                            </li>
                             <!-- 
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Project Reports</span>
                                </a>

                                <ul>
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_add_task.php';?>">Weekly Report</a></li>
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_add_task.php';?>">Monthly Report</a></li>
                                    <li><a href="<?php echo $baseUrl.'employee/task/v_add_task.php';?>">Custom Date Range Report</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                    <!-- end of project management -->   

            

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