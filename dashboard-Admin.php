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
    <title>Admin's Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="admin-style.css">
  </head>
  <!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

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
          <form action="logout.php" method="post" style="display: inline;">
            <button class="btn btn-primary" type="submit">Logout</button>
          </form>



      </nav>


      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
          <span class="brand-text font-weight-light">Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <?php
            if (isset($_SESSION['Profile_picture']) && !empty($_SESSION['Profile_picture'])) {
              $Profile_pic = "pages/examples/upload/" . $_SESSION['Profile_picture'];
            } else {
              $Profile_pic = "default.jpg";
            }
            ?>
            <div class="image">
              <img src="<?php echo $Profile_pic; ?>" class="img-circle elevation-3" alt="User Image"
                style="height: 2.3rem; width: 2.3rem; border-radius: 50%; object-fit: cover;">
            </div>
            <div class="info">
              <a href="#"
                class="d-block"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['mname'] . ' ' . $_SESSION['lname']; ?></a>
            </div>
          </div>

          <!-- SidebarSearch Form -->
          <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="bi bi-person-lines-fill"></i>
                  <p>&nbsp;&nbsp;Profile</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Announcement.php" class="nav-link">
                  <i class="bi bi-megaphone-fill"></i>
                  <p>&nbsp;&nbsp;Announcement</p>
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
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <!-- /.col -->




            </div><!-- /.row -->
            <div class="container">
              <div class="section-2">
                <div class="counter">
                  <h2>Number of Students Logged In</h2>
                  <?php
                  include "db_conn.php";
                  $count_sql = "SELECT COUNT(*) AS student_count FROM students WHERE Role = 'student' AND Status = 'Online'";
                  $count_result = $conn->query($count_sql);
                  $student_count = 0;

                  if ($count_result->num_rows > 0) {
                    $count_row = $count_result->fetch_assoc();
                    $student_count = $count_row["student_count"];
                  }
                  ?>
                  <p><?php echo $student_count; ?></p>
                </div>
              </div>
              <div class="section-3">
                <!-- <h2>Logged In Students Details</h2> -->
                <table>
                  <thead>

                    <tr>
                      <th>Student ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Login Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "db_conn.php";
                    $sql = "SELECT Student_ID, Last_name, Email, Login_Time FROM students WHERE Role = 'student' AND Status = 'Online'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        $LoginTime = date('Y-m-d H:i:s', strtotime($row['Login_Time']))
                          ?>
                        <tr>
                          <td><?php echo htmlspecialchars($row['Student_ID']); ?></td>
                          <td><?php echo htmlspecialchars($row['Last_name']); ?></td>
                          <td><?php echo htmlspecialchars($row['Email']); ?></td>
                          <td><?php echo htmlspecialchars($LoginTime); ?></td>
                        </tr>
                        <?php
                      }
                    } else {
                      echo "<tr><td colspan='6'> No Students found. </td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </div>
        <!-- <div class="section-2">
          <div class="row">
            <div class="column">
              <div class="card">
                <p><i class="fa fa-user"></i></p>
                <h3 class="counter">12</h3>
                <h5>student</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="section-3">
          <div class="row">
            <div class="column">
              <div class="card">
                <p><i class="fa fa-user"></i></p>
                <h3 class="counter-2">12</h3>
                <h5>admin</h5>
              </div>
            </div>
          </div>
        </div> -->

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <!-- <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
              
                  
              </table>
            </div> -->
                </div>


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
  </body>

  </html>

  <?php
} else {
  // If the user is not logged in, redirect to the login page
  header("Location: Login-form.php");
  exit();
}
?>