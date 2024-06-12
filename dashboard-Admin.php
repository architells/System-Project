<?php
// Start the PHP session
session_start();

// Check if the user is logged in
if (isset($_SESSION['ID'])) {

  include "db_conn.php"; // Include database connection here

  // Fetch course data for the donut chart for the last day
  $courses = [];
  $count_data = [];
  $one_day_ago = date('Y-m-d H:i:s', strtotime('-1 day'));
  $course_sql = "SELECT Course, COUNT(*) as course_count 
               FROM students 
               WHERE Role = 'student' AND Login_Time >= '$one_day_ago' 
               GROUP BY Course";
  $course_result = $conn->query($course_sql);

  if ($course_result->num_rows > 0) {
    while ($row = $course_result->fetch_assoc()) {
      $courses[] = $row['Course'];
      $count_data[] = $row['course_count'];
    }
  }
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
      </nav>


      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <img src="dumbbell.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
              <a href="profile-admin.php"
                class="d-block"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['mname'] . ' ' . $_SESSION['lname']; ?></a>
            </div>
          </div>


          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              <li class="nav-item">
                <a href="dashboard-Admin.php" class="nav-link">
                  <i class="bi bi-speedometer2"></i>
                  <p>&nbsp;&nbsp;Dashboard</p>
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
      <div class="content-wrapper" style="background: url('GYM-IMG-4.jpg') no-repeat center center fixed; background-size: cover;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <!-- /.col -->
            </div><!-- /.row -->

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Courses</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <div class="col-md-4">
                    <ul id="course-counts">
                      <!-- Course counts will be populated here -->
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Student Logged In</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" id="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                          <button type="button" id="search_button" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                      <thead>
                        <tr>
                          <th style="text-align: center;">#</th>
                          <th style="text-align: center;">Student ID</th>
                          <th style="text-align: center;">Fullname</th>
                          <th style="text-align: center;">Course</th>
                          <th style="text-align: center;">Year Level</th>
                          <th style="text-align: center;">Login Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include "db_conn.php";
                        $one_day_ago = date('Y-m-d H:i:s', strtotime('-1 day'));
                        $sql = "SELECT Student_ID, First_name, Middle_name, Last_name, Email, Login_Time, Course, Year_level 
                                FROM students 
                                WHERE Role = 'student' AND Login_Time >= '$one_day_ago'
                                ORDER BY Last_name ASC";
                        $result = $conn->query($sql);
                        $id = 1; 
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            $loginTime = new DateTime($row['Login_Time']);
                            $formattedDate = $loginTime->format('Y-m-d h:i A');
                            ?>
                            <tr>
                              <td style="text-align: center;"><?php echo $id; ?></td>
                              <td style="text-align: center;"><?php echo htmlspecialchars($row['Student_ID']); ?></td>
                              <td style="text-align: center;">
                                <?php echo htmlspecialchars($row['Last_name']) . ', ' . htmlspecialchars($row['First_name']) . ' ' . htmlspecialchars($row['Middle_name']) . '.'; ?>
                              </td>
                              <td style="text-align: center;"><?php echo htmlspecialchars($row['Course']); ?></td>
                              <td style="text-align: center;"><?php echo htmlspecialchars($row['Year_level']); ?></td>
                              <td style="text-align: center;"><?php echo htmlspecialchars($formattedDate); ?></td>
                            </tr>
                            <?php
                            $id++; 
                          }
                        } else {
                          echo "<tr><td colspan='6' style='text-align: center;'> No Students found. </td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
          </div><!-- /.container-fluid -->

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
                  <a href="Logout-admin.php" class="btn btn-primary">Yes</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
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
  <script>
    $(function () {
      var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      var donutData = {
        labels: <?php echo json_encode($courses); ?>,
        datasets: [{
          data: <?php echo json_encode($count_data); ?>,
          backgroundColor: ['#FFFF00', '#FF7D33', '#FF0000', '#008000', '#3c8dbc', '#d2d6de'],
        }]
      };
      var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }

      new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })

      // Populate course counts
      var courseCounts = <?php echo json_encode(array_combine($courses, $count_data)); ?>;
      var courseCountsList = $('#course-counts');
      for (var course in courseCounts) {
        courseCountsList.append('<li>' + course + ' - ' + courseCounts[course] + '</li>');
      }
    })
    document.getElementById('logout-link').addEventListener('click', function (event) {
      event.preventDefault();
      $('#logout-modal').modal('show');
    });
  </script>

  <script>
    document.getElementById('table_search').addEventListener('input', function () {
      var searchText = this.value.toLowerCase();
      var tableRows = document.querySelectorAll('.table tbody tr');

      tableRows.forEach(function (row) {
        var rowData = row.textContent.toLowerCase();
        if (rowData.indexOf(searchText) === -1) {
          row.style.display = 'none';
        } else {
          row.style.display = '';
        }
      });
    });

    document.getElementById('search_button').addEventListener('click', function () {
      var searchText = document.getElementById('table_search').value.toLowerCase();
      var tableRows = document.querySelectorAll('.table tbody tr');

      tableRows.forEach(function (row) {
        var rowData = row.textContent.toLowerCase();
        if (rowData.indexOf(searchText) === -1) {
          row.style.display = 'none';
        } else {
          row.style.display = '';
        }
      });
    });
  </script>

  </html>

  <?php
} else {
  // If the user is not logged in, redirect to the login page
  header("Location: Login.php");
  exit();
}

