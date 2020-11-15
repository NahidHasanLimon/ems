<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">7Teen User-Panel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="employees.php">Employees</a>
          </li>
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Attendance</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="monthWise_attendance_details.php">Month Attendance Details</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </li>
           <!--  <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
          </li>  -->

      <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle p-1" href="#" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="/ems/photo/<?php echo $_SESSION['photo'] ?>" class="rounded-circle z-depth-0"
            alt="avatar image" height="35">
        </a>
        <div class="dropdown-menu dropdown-menu-xs-right dropdown-secondary"
          aria-labelledby="navbarDropdownMenuLink-55">
          <a class="dropdown-item" href="profile.php">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Profile</a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout</a>
        </div>
      </li>

    </ul>
      </div>
    </div>
  </nav>