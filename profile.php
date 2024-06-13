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
    <title>GYM | PROFILE</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        </ul>
        <div class="col-sm-0">
          <h2>Profile</h2>
        </div>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
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
                <a href="Student-updates.php" class="nav-link">
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
            <div class="row mb-1">
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                        style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;"
                        src="<?php echo $Profile_pic; ?>" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">
                      <?php echo $_SESSION['fname'] . ' ' . $_SESSION['mname'] . ' ' . $_SESSION['lname']; ?>
                    </h3>

                    <!-- <p class="text-muted text-center"><?php echo $_SESSION['Education']; ?></p> -->

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Firstname</b> <a class="float-right"><?php echo $_SESSION['fname']; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Middle_name</b> <a class="float-right"><?php echo $_SESSION['mname']; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Lastname</b> <a class="float-right"><?php echo $_SESSION['lname']; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Email</b> <a class="float-right"><?php echo $_SESSION['email']; ?></a>
                      </li>
                    </ul>

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Phone Number</strong>

                    <p class="text-muted">
                      <?php echo $_SESSION['Pnum']; ?>
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                    <p class="text-muted">
                      <?php echo $_SESSION['province'] . ' ' . $_SESSION['city'] . ' ' . $_SESSION['barangay'] . ' ' . $_SESSION['zip_code']; ?>
                    </p>

                    <hr>

                    <strong><i class="fas fa-mars mr-1"></i> Gender</strong>

                    <p class="text-muted"> <?php echo $_SESSION['gender']; ?>

                    </p>

                    <hr>

                    <strong><i class="bi bi-balloon-heart"></i> Birthday</strong>

                    <p class="text-muted">
                      <?php echo ($_SESSION['birthday'] == '0000-00-00') ? '' : date('F d, Y', strtotime($_SESSION['birthday'])); ?>
                    </p>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="card">


                  <!-- /.tab-content -->
                </div>
                <div class="card card-primary card-outline mx-auto">
                  <div class="card-body box-profile">
                    <div class="col-md-12 mx-auto">
                      <div class="personal-information-section">
                        <form action="profile_index.php" method="post" class="form-horizontal">
                          <h2 class="text-center">PERSONAL INFORMATION</h2>
                          <?php if (isset($_GET['error1'])) { ?>
                            <div class="alert alert-danger">
                              <?php echo $_GET['error1']; ?>
                            </div>
                          <?php } ?>
                          <?php if (isset($_GET['success1'])) { ?>
                            <div class="alert alert-success">
                              <?php echo $_GET['success1']; ?>
                            </div>
                          <?php } ?>
                          <!-- Phone Number -->
                          <div class="form-group row">
                            <label for="inputphonenumber" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="Pnum" id="inputphonenumber"
                                placeholder="Phone number" value="<?php echo $_GET['Pnum'] ?? ''; ?>">
                            </div>
                          </div>
                          <!-- Birthday -->
                          <div class="form-group row">
                            <label for="inputBirthday" class="col-sm-2 col-form-label">Birthday</label>
                            <div class="col-sm-10">
                              <input type="date" class="form-control" name="birthday" id="inputBirthday"
                                placeholder="Birthday" value="<?php echo $_GET['birthday'] ?? ''; ?>">
                            </div>
                          </div>
                          <!-- Gender -->
                          <div class="form-group row">
                            <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10" style="display: flex; gap: 10px;">
                              <select class="form-select" id="inputGender" name="gender"
                                aria-label="Default select example" value="<?php echo $_GET['gender'] ?? ''; ?>">
                                <option value="" selected>Select your gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                          <!-- Address -->
                          <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-3 mb-2">
                              <input type="text" class="form-control" name="province" id="inputProvince"
                                placeholder="Province" value="<?php echo $_GET['province'] ?? ''; ?>">
                            </div>
                            <div class="col-sm-3 mb-2">
                              <input type="text" class="form-control" name="city" id="inputCity" placeholder="City"
                                value="<?php echo $_GET['city'] ?? ''; ?>">
                            </div>
                            <div class="col-sm-2 mb-2">
                              <input type="text" class="form-control" name="barangay" id="inputBarangay"
                                placeholder="Barangay" value="<?php echo $_GET['barangay'] ?? ''; ?>">
                            </div>
                            <div class="col-sm-2 mb-2">
                              <input type="text" class="form-control" name="zip_code" id="inputZipCode"
                                placeholder="Zip Code" value="<?php echo $_GET['zip_code'] ?? ''; ?>">
                            </div>
                          </div>
                          <!-- Update Button -->
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10 text-right">
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- Change Password Section -->
                <div class="card card-primary card-outline mx-auto">
                  <div class="card-body box-profile">
                    <div class="col-md-12 mx-auto">
                      <div class="change-password-section">
                        <form action="Change_pass.php" method="post" class="form-horizontal">
                          <h2 class="text-center">CHANGE PASSWORD</h2>
                          <?php if (isset($_GET['error2'])) { ?>
                            <div class="alert alert-danger">
                              <?php echo $_GET['error2']; ?>
                            </div>
                          <?php } ?>
                          <?php if (isset($_GET['success2'])) { ?>
                            <div class="alert alert-success">
                              <?php echo $_GET['success2']; ?>
                            </div>
                          <?php } ?>

                          <!-- Old Password -->
                          <div class="form-group row">
                            <label for="inputChangePassword" class="col-sm-2 col-form-label">Change Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="oldPass" id="inputChangePassword"
                                placeholder="Old password">
                            </div>
                          </div>
                          <!-- New Password -->
                          <div class="form-group row">
                            <label for="inputNewPassword" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" name="newPass" id="inputNewPassword"
                                placeholder="New password">
                            </div>
                          </div>
                          <!-- Update Password Button -->
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10 text-right">
                              <button type="submit" class="btn btn-primary">Update password</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- Change Profile Section -->
                <div class="card card-primary card-outline mx-auto">
                  <div class="card-body box-profile">
                    <div class="col-md-12 mx-auto">
                      <div class="change-profile-section">
                        <form action="Change_profile.php" method="post" enctype="multipart/form-data"
                          class="form-horizontal">
                          <h2 class="text-center">CHANGE PROFILE</h2>
                          <?php if (isset($_GET['error3'])) { ?>
                            <div class="alert alert-danger">
                              <?php echo $_GET['error3']; ?>
                            </div>
                          <?php } ?>
                          <?php if (isset($_GET['success3'])) { ?>
                            <div class="alert alert-success">
                              <?php echo $_GET['success3']; ?>
                            </div>
                          <?php } ?>
                          <!-- Update Profile Button and Upload Picture -->
                          <div class="form-group">
                            <label for="exampleInputFile">Upload Picture</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <button class="input-group-text" type="submit" name="upload">Upload</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
      </div><!-- /.container-fluid -->
      </section>

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

    document.querySelector('.custom-file-input').addEventListener('change', function (e) {
      var fileName = document.getElementById("exampleInputFile").files[0].name;
      var nextSibling = e.target.nextElementSibling
      nextSibling.innerText = fileName
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

  <?php
} else {
  // If the user is not logged in, redirect to the login page
  header("Location: Front-Page.php");
  exit();
}
?>