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
    <link rel="shortcut icon" href="dumbbell.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM | Qr Code</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="shortcut icon" href="dumbbell.png">
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Theme style -->
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
        <a href="dashboard-Admin.php" class="brand-link">
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
              <a href="profile-admin.php"
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
                <a href="#" class="nav-link">
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
                  <p>&nbsp;&nbsp;Trainor</p>
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
                <h1 style="color: white;">Qr Code</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->

          <!-- /.card -->

        </section>
        <div class="card card-primary card-outline w-50 mx-auto mt-5"
          style="background-image: linear-gradient(90deg, rgba(165, 165, 165, 0.03) 0%, rgba(165, 165, 165, 0.03) 8%,rgba(235, 235, 235, 0.03) 8%, rgba(235, 235, 235, 0.03) 9%,rgba(7, 7, 7, 0.03) 9%, rgba(7, 7, 7, 0.03) 14%,rgba(212, 212, 212, 0.03) 14%, rgba(212, 212, 212, 0.03) 17%,rgba(219, 219, 219, 0.03) 17%, rgba(219, 219, 219, 0.03) 95%,rgba(86, 86, 86, 0.03) 95%, rgba(86, 86, 86, 0.03) 100%),linear-gradient(67.5deg, rgba(80, 80, 80, 0.03) 0%, rgba(80, 80, 80, 0.03) 11%,rgba(138, 138, 138, 0.03) 11%, rgba(138, 138, 138, 0.03) 17%,rgba(122, 122, 122, 0.03) 17%, rgba(122, 122, 122, 0.03) 24%,rgba(166, 166, 166, 0.03) 24%, rgba(166, 166, 166, 0.03) 27%,rgba(245, 245, 245, 0.03) 27%, rgba(245, 245, 245, 0.03) 89%,rgba(88, 88, 88, 0.03) 89%, rgba(88, 88, 88, 0.03) 100%),linear-gradient(67.5deg, rgba(244, 244, 244, 0.03) 0%, rgba(244, 244, 244, 0.03) 4%,rgba(16, 16, 16, 0.03) 4%, rgba(16, 16, 16, 0.03) 10%,rgba(157, 157, 157, 0.03) 10%, rgba(157, 157, 157, 0.03) 20%,rgba(212, 212, 212, 0.03) 20%, rgba(212, 212, 212, 0.03) 83%,rgba(5, 5, 5, 0.03) 83%, rgba(5, 5, 5, 0.03) 84%,rgba(237, 237, 237, 0.03) 84%, rgba(237, 237, 237, 0.03) 100%),linear-gradient(90deg, #ffffff,#ffffff);">
          <div class="card-body box-profile">
            <div class="col-md-12 text-center">
              <?php
              $qrCodeFilePath = 'qr_codes/' . $_SESSION['qrCodeFile'];
              if (file_exists($qrCodeFilePath)) {
                echo '<img src="' . $qrCodeFilePath . '" alt="QR Code" class="img-fluid" style="max-width: 100%; height: auto;">';
              } else {
                echo 'QR Code image not found';
              }
              ?>
            </div>
            <p class="text-center mt-3">Note: Please don't share this QR code</p>
          </div>
        </div>



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

        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
          <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io </a>.</strong> All rights reserved.
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
    // Event listener for logout confirmation
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
          window.location.href = 'logout-student.php';
        }
      });
    });
  </script>

  <?php
} else {
  // If the user is not logged in, redirect to the login page
  header("Location: Login.php");
  exit();
}
?>