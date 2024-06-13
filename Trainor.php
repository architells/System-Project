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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM | Trainor</title>

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
          <li class="nav-item d-none d-sm-inline-block">
            <a href="dashboard-Student.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
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
                class="d-block"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['mname'] . ' ' . $_SESSION['lname']; ?></a>
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
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 style="color: white;">Trainor</h1>
              </div>
              <div class="col-sm-6">
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Full Body Workout
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Gwen Apuli</b></h2>
                      <p class="text-muted text-sm"><b>About: </b> Main dancer / Lead Vocal / Model</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Sa
                          Puso mo</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: 143</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="BINI GWEN.jpg" alt="user-avatar" class="img-circle img-fluid"
                        style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary" id="profile-link">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Biceps
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Mikha</b></h2>
                      <p class="text-muted text-sm"><b>About: </b> Main dancer / Lead Vocal / Model</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Sa
                          Puso mo</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: 143</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="BINI GWEN.jpg" alt="user-avatar" class="img-circle img-fluid"
                        style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Leg
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Aiah</b></h2>
                      <p class="text-muted text-sm"><b>About: </b> Main dancer / Lead Vocal / Model</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Sa
                          Puso mo</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: 143</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="BINI GWEN.jpg" alt="user-avatar" class="img-circle img-fluid"
                        style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>




      <div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="logout-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="logout-modal-label">Profile</h5>
            </div>
            <div class="modal-body text-center">
              <H1>Gwen Apuli</H1>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              <a href="#" class="btn btn-primary">Yes</a>
            </div>
          </div>
        </div>
      </div>



      <!-- /.card-body -->
      <div class="card-footer">
        .

        <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="logout-modal-label"
          aria-hidden="true">
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
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

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
  </body>

  </html>

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

    document.getElementById('profile-link').addEventListener('click', function (event) {
      event.preventDefault();
      $('#profile-modal').modal('show');
    });
  </script>

  <?php
} else {
  // If the user is not logged in, redirect to the login page
  header("Location: Login-form.php");
  exit();
}
?>