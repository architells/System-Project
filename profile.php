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
  <title>User Profile</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <div>
    <h3>Profile</h3>
    </div>

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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

      <form action="logout.php" method="post" style="display: inline;">
              <button class="btn btn-primary" type="submit">Logout</button>
      </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <?php 
        if(isset($_SESSION['Profile_picture']) && !empty($_SESSION['Profile_picture'])){
          $Profile_pic = "upload/" . $_SESSION['Profile_picture'];
        }else{
          $Profile_pic =  "default.jpg";
        }
      ?>

      <div class="image">
          <img src="<?php echo $Profile_pic; ?>" class="img-circle elevation-3" alt="User Image">
      </div>


        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['fname']. ' ' . ' ' . $_SESSION['lname'];?></a>
        </div>
      </div>

     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
              <li class="nav-item">
                <a href="profile.php" class="nav-link">
                  <p>Profile</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <p>Updates</p>
                </a>
              </li>
              
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
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
                       src="<?php echo $Profile_pic; ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $_SESSION['fname']. ' ' . $_SESSION['mname']. ' ' . $_SESSION['lname'];?></h3>

                <p class="text-muted text-center"><?php echo $_SESSION['Education']; ?></p>

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
                    <b>Gender</b> <a class="float-right"><?php echo $_SESSION['gender']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?php echo $_SESSION['Email']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone number</b> <a class="float-right"><?php echo $_SESSION['Pnum']; ?></a>
                  </li>
                </ul>

                <a href="#settings" class="btn btn-primary btn-block"><b>EDIT</b></a>
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
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                <?php echo $_SESSION['Education']; ?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted"><?php echo $_SESSION['province']. ' ' . $_SESSION['city']. ' ' . $_SESSION['barangay']. ' ' . $_SESSION['zip_code'];?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted"> <?php echo $_SESSION['Skills']; ?>
                
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Experience</strong>

                <p class="text-muted"><?php echo $_SESSION['Experience'] ?></p>
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Information</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="tab-pane" id="settings">
                      <!-- Personal Information Section -->
                        <div class="personal-information-section">
                            <form action="profile_index.php" method="post" class="form-horizontal">
                                <h2 class="text-center">PERSONAL INFORMATION</h2>
                                <?php if (isset($_GET['error'])) { ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_GET['error']; ?>
                                    </div>
                                    <?php } ?>
                                    <?php if (isset($_GET['success'])) { ?>
                                    <div class="alert alert-success">
                                        <?php echo $_GET['success']; ?>
                                    </div>
                                    <?php } ?>
                                <!-- Phone Number -->
                                <div class="form-group row">
                                    <label for="inputphonenumber" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Pnum" id="inputphonenumber" placeholder="Phone number" value="<?php echo $_GET['Pnum'] ?? ''; ?>">
                                    </div>
                                </div>
                                <!-- Birthday -->
                                <div class="form-group row">
                                    <label for="inputBirthday" class="col-sm-2 col-form-label">Birthday</label>
                                    <div class="col-sm-3 mb-2">
                                        <input type="text" class="form-control" name="month" id="inputBirthday" placeholder="Month" value="<?php echo $_GET['month'] ?? ''; ?>">
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <input type="text" class="form-control" name="day" id="inputBirthday" placeholder="Day" value="<?php echo $_GET['day'] ?? ''; ?>">
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <input type="text" class="form-control" name="year" id="inputBirthday" placeholder="Year" value="<?php echo $_GET['year'] ?? ''; ?>">
                                    </div>
                                </div>
                                <!-- Gender -->
                                <div class="form-group row">
                                    <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="inputGender" name="gender" aria-label="Default select example" value="<?php echo $_GET['gender'] ?? ''; ?>">
                                            <option selected>Select your gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-3 mb-2">
                                        <input type="text" class="form-control" name="province" id="inputProvince" placeholder="Province" value="<?php echo $_GET['province'] ?? ''; ?>">
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <input type="text" class="form-control" name="city" id="inputCity" placeholder="City" value="<?php echo $_GET['city'] ?? ''; ?>">
                                    </div>
                                    <div class="col-sm-2 mb-2">
                                        <input type="text" class="form-control" name="barangay" id="inputBarangay" placeholder="Barangay" value="<?php echo $_GET['barangay'] ?? ''; ?>">
                                    </div>
                                    <div class="col-sm-2 mb-2">
                                        <input type="text" class="form-control" name="zip_code" id="inputZipCode" placeholder="Zip Code" value="<?php echo $_GET['zip_code'] ?? ''; ?>">
                                    </div>
                                </div>
                                <!-- Education -->
                                <div class="form-group row">
                                    <label for="inputEducation" class="col-sm-2 col-form-label">Education</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="education" id="inputEducation" placeholder="Education" value="<?php echo $_GET['education'] ?? ''; ?>">
                                    </div>
                                </div>
                                <!-- Experience -->
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="experience" id="inputExperience" placeholder="Experience"><?php echo $_GET['experience'] ?? ''; ?></textarea>
                                    </div>
                                </div>
                                <!-- Skills -->
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="skills" id="inputSkills" placeholder="Skills" value="<?php echo $_GET['skills'] ?? ''; ?>">
                                    </div>
                                </div>
                                <!-- Terms and Conditions Checkbox -->
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name='terms'> I agree to the <a href="#">terms and conditions</a>
                                            </label>
                                        </div>
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
                        <hr> <!-- Horizontal line -->
                        <div style="margin-top: 20px;"> <!-- Add a margin-top to move the form down -->
                            <!-- Change Password Section -->
                            <div class="change-password-section">
                                <form action="Change_pass.php" method="post" class="form-horizontal">
                                    <h2 class="text-center">CHANGE PASSWORD</h2>
                                    
                                    
                                    <!-- Old Password -->
                                    <div class="form-group row">
                                        <label for="inputChangePassword" class="col-sm-2 col-form-label">Change Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="oldPass" id="inputChangePassword" placeholder="Old password">
                                        </div>
                                    </div>
                                    <!-- New Password -->
                                    <div class="form-group row">
                                        <label for="inputNewPassword" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="newPass" id="inputNewPassword" placeholder="New password">
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
                            <hr>
                            <!-- Change Profile Section -->
                            <div class="change-profile-section">
                                <form action="Change_profile.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <h2 class="text-center">CHANGE PROFILE</h2>
                                    
                                    <!-- Upload Picture -->
                                    <div class="form-group row">
                                        <label for="inputChangePicture" class="col-sm-2 col-form-label">Upload picture</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="file">
                                        </div>
                                    </div>
                                    <!-- Update Profile Button -->
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10 text-right">
                                            <button type="submit" class="btn btn-primary" name="upload">Update profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
<?php
}else {
    // If the user is not logged in, redirect to the login page
    header("Location: Front-Page.php");
    exit();
}
?>