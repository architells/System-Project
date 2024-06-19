<?php
// Start the PHP session
session_start();

// Check if the user is logged in
if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM | Announcements</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="shortcut icon" href="dumbbell.png">
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
  </head>

  <body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->


        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="dashboard-Student.php" class="brand-link">
          <img src="dumbbell.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">STUDENT</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <?php
            if (isset($_SESSION['Profile_picture']) && !empty($_SESSION['Profile_picture'])) {
              $Profile_pic = "upload/" . $_SESSION['Profile_picture'];
            } else {
              $Profile_pic = "default.jpg";
            }
            ?>
            <div class="image">
              <img src="<?php echo $Profile_pic; ?>" class="img-circle elevation-3" alt="User Image"
                style="height: 2.3rem; width: 2.3rem; border-radius: 50%; object-fit: cover;">
            </div>
            <div class="info">
              <a href="profile.php"
                class="d-block"><?php echo $_SESSION['fname']; ?></a>
            </div>
          </div>

          <!-- SidebarSearch Form -->


          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

              <li class="nav-item">
                <a href="dashboard-Student.php" class="nav-link">
                  <i class="bi bi-speedometer2"></i>
                  <p>&nbsp;&nbsp;Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Qr_code.php" class="nav-link">
                  <i class="bi bi-qr-code"></i>
                  <p>&nbsp;&nbsp;Qr Code</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="student-updates.php" class="nav-link">
                  <i class="bi bi-megaphone-fill"></i>
                  <p>&nbsp;&nbsp;Announcements</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Trainor.php" class="nav-link">
                  <i class="bi bi-person-raised-hand"></i>
                  <p>&nbsp;&nbsp;Trainer</p>
                </a>
              </li>

              <li class="nav-item">
                <a id="logout-link" class="nav-link">
                  <i class="bi bi-door-open"></i>
                  <p>&nbsp;&nbsp;Logout</p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper"
        style="background: url('GYM-IMG-4.jpg') no-repeat center center fixed; background-size: cover;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 style="color: white;">Announcements</h1>
              </div>
              <div class="col-sm-6">
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
          <?php
          include "db_conn.php";
          // Get the current date and subtract 7 days
          $one_week_ago = date('Y-m-d H:i:s', strtotime('-1 week'));

          // Updated SQL query to fetch announcements within the last week
          $sql = "SELECT event_name, description, Created_At FROM announcement WHERE Created_At >= '$one_week_ago' ORDER BY Created_At DESC LIMIT 1";
          $result = $conn->query($sql);

          if ($result === false) {
            ?>
            <div class="container mt-4">
              <div class="card">
                <div class="card-header">
                  Error executing the query: <?php echo $conn->error; ?>
                </div>
              </div>
            </div>
            <?php
          } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetch the first (and only) row
            // Format the Created_At field
            $date = new DateTime($row["Created_At"]);
            $formattedDate = $date->format('Y-m-d h:i A');
            ?>
            <div class="container mt-4">
              <div class="card">
                <div class="card-header">
                  Latest Announcement
                </div>

                <div class="card-body">
                  <label for="event_name">Event Name: </label>
                  <p><?php echo $row["event_name"]; ?></p>
                </div>

                <div class="card-body">
                  <label for="description">Description: </label>
                  <p><?php echo $row["description"]; ?></p>
                </div>

                <div class="card-body">
                  <label for="published">Date of Publication: </label>
                  <p><?php echo $formattedDate; ?></p>
                </div>
              </div>
            </div>
            <?php
          } else {
            ?>
            <div class="container mt-4">
              <div class="card">
                <div class="card-header">
                  No announcements found.
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </section>

        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
          <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>

  </html>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const navlinks = document.querySelectorAll('.nav-link');

      navlinks.forEach(link => {
        link.addEventListener('click', function () {
          navlinks.forEach(nav => nav.classList.remove('active'));
          this.classList.add('active');
        });
      });
    });

    document.getElementById('logout-link').addEventListener('click', function (event) {
      event.preventDefault(); // Prevent the default action
      Swal.fire({
        title: 'Are you sure you want to logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout'
      }).then((result) => {
        if (result.isConfirmed) {
          // Redirect to the logout page
          window.location.href = 'logout-students.php';
        }
      })
    });
  </script>

  <?php
} else {
  // If the user is not logged in, redirect to the login page
  header("Location: Login.php");
  exit();
}
?>