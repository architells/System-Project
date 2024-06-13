<?php
// Start the PHP session
session_start();

// Check if the user is logged in
if (isset($_SESSION['ID'])) {
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="dumbbell.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <h2 class="m-0">Dashboard</h2>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
        </ul>
      </nav>

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="dashboard-Student.php" class="brand-link">
          <img src="dumbbell.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">STUDENT</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
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
              <a href="profile.php" class="d-block"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['mname'] . ' ' . $_SESSION['lname']; ?></a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="dashboard-Student.php" class="nav-link">
                  <i class="bi bi-speedometer2"></i>
                  <p>&nbsp;&nbsp;Dashboard</p>
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
                  <p>&nbsp;&nbsp;Trainor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="bi bi-envelope-check"></i>
                  <p>&nbsp;&nbsp;Verify Email</p>
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
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="container mt-5">
                <div class="row align-items-center">
                  <div class="col-md-4 text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         style="width: 250px; height: 250px; border-radius: 50%; object-fit: cover;"
                         src="<?php echo $Profile_pic; ?>" alt="User profile picture">
                  </div>
                  <div class="col-md-8 mt-3 d-flex flex-column">
                    <div class="card mb-3" style="position: relative;">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <h6><?php echo $_SESSION['s_ID'] ?></h6>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="fullname" class="form-label">Fullname</label>
                            <h6><?php echo $_SESSION['fname'] . ' ' . $_SESSION['mname'] . ' ' . $_SESSION['lname']; ?></h6>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="course" class="form-label">Course</label>
                            <h6><?php echo $_SESSION['course'] ?></h6>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="year_level" class="form-label">Year Level</label>
                            <h6><?php echo $_SESSION['year_level'] ?></h6>
                          </div>
                        </div>
                      </div>
                      <!-- Display QR Code -->
                      <div style="position: absolute; top: 10px; right: 10px;">
                        <?php
                        $qrCodeFilePath = 'qr_codes/' . $_SESSION['qrCodeFile'];
                        if (file_exists($qrCodeFilePath)) {
                          echo '<img src="' . $qrCodeFilePath . '" alt="QR Code" style="height: 100px; width: 100px;">';
                        } else {
                          echo 'QR Code image not found';
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="logout-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="logout-modal-label">Logout Confirmation</h5>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to logout?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <a href="Logout-students.php" class="btn btn-primary">Yes</a>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <!-- Additional content can go here -->
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <!-- <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer> -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="dist/js/adminlte.js"></script>
    <!-- OPTIONAL SCRIPTS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard3.js"></script>

    <script>
      document.getElementById('logout-link').addEventListener('click', function (event) {
        event.preventDefault();
        $('#logout-modal').modal('show');
      });

      document.addEventListener('DOMContentLoaded', function () {
        const navlinks = document.querySelectorAll('.nav-link');

        navlinks.forEach(link => {
          link.addEventListener('click', function () {
            navlinks.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
          });
        });
      });
    </script>
  </body>
  </html>

  <?php
} else {
  // If the user is not logged in, redirect to the login page
  header("Location: Login.php");
  exit();
}

