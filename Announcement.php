<?php
// Start the PHP session
session_start();

// Check if the user is logged in
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="dumbbell.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM | Announcement</title>

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
          <span class="brand-text font-weight-light">Admin</span>
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
                <a href="dashboard-Admin.php" class="nav-link">
                  <i class="bi bi-speedometer2"></i>
                  <p>&nbsp;&nbsp;Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Add_trainor.php" class="nav-link">
                  <i class="bi bi-person-raised-hand"></i>
                  <p>&nbsp;&nbsp;Add Trainer</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Trainor-profile.php" class="nav-link">
                  <i class="bi bi-person-badge"></i>
                  <p>&nbsp;&nbsp;Trainer Profile</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Announcement.php" class="nav-link">
                  <i class="bi bi-megaphone-fill"></i>
                  <p>&nbsp;&nbsp;Announcement</p>
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
                <h1 style="color: white;">Announcement</h1>
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
        <div class="card card-primary card-outline w-50 mx-auto mt-5">
          <div class="card-body box-profile">
            <div class="col-md-12">
              <form action="Announcement-be.php" method="POST">
                <!-- Display error messages -->
                <?php if (isset($_GET['error'])) { ?>
                  <div class="alert alert-danger text-center">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                  </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                  <div class="alert alert-success text-center">
                    <?php echo htmlspecialchars($_GET['success']); ?>
                  </div>
                <?php } ?>
                <div class="mb-3">
                  <label class="form-label">Event Name</label>
                  <input type="text" class="form-control" id="eventInput" aria-describedby="emailHelp" name="event_name">
                  <div id="emailHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea class="form-control" id="exampleInputPassword1" name="description" rows="4"></textarea>
                </div>
                <div class="mb-3 d-grid">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
          window.location.href = 'logout-admin.php';
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