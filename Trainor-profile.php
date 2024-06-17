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
        <title>GYM | Trainor Profile</title>

        <!-- Google Font: Source Sans Pro -->
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
                <a href="#" class="brand-link">
                    <img src="dumbbell.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
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

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
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
                                    <p>&nbsp;&nbsp;Add Trainor</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="Trainor-profile.php" class="nav-link">
                                    <i class="bi bi-person-badge"></i>
                                    <p>&nbsp;&nbsp;Trainor Profile</p>
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
                                <h1 style="color: white;">Trainor Profile</h1>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            #
                                        </th>
                                        <th style="width: 20%">
                                            Trainor's Name
                                        </th>
                                        <th style="width: 30%">
                                            Profile
                                        </th>
                                        <th>
                                            Project Progress
                                        </th>
                                        <th style="width: 8%" class="text-center">
                                            Status
                                        </th>
                                        <th style="width: 20%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <a>
                                                Gwen Apuli
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="dist/img/avatar2.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="dist/img/avatar3.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="dist/img/avatar4.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                                </div>
                                            </div>
                                            <small>
                                                57% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#" id="profile-1">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2
                                        </td>
                                        <td>
                                            <a>
                                                Mikha
                                            </a>
                                            <br />
                                            <small>
                                                Created 01.01.2019
                                            </small>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="dist/img/avatar.png">
                                                </li>
                                                <li class="list-inline-item">
                                                    <img alt="Avatar" class="table-avatar" src="dist/img/avatar2.png">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="47"
                                                    aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                </div>
                                            </div>
                                            <small>
                                                100% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td class="project-actions text-right">
                                            <a class="btn btn-primary btn-sm" href="#" id="profile-2">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                            <a class="btn btn-info btn-sm" href="#">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="#">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="modal fade" id="profile-modal-1" tabindex="-1" role="dialog"
                            aria-labelledby="profile-modal-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="logout-modal-label">Profile</h5>
                                    </div>
                                    <div class="modal-body">
                                        test-1
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <a href="#" class="btn btn-primary">Yes</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="profile-modal-2" tabindex="-1" role="dialog"
                            aria-labelledby="profile-modal-label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="logout-modal-label">Profile</h5>
                                    </div>
                                    <div class="modal-body">
                                        test-2
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <a href="#" class="btn btn-primary">Yes</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                    <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog"
                        aria-labelledby="logout-modal-label" aria-hidden="true">
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

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.2.0
                </div>
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
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

    <script>
        document.getElementById('logout-link').addEventListener('click', function (event) {
            event.preventDefault();
            $('#logout-modal').modal('show');
        });

        document.getElementById('profile-1').addEventListener('click', function (event) {
            event.preventDefault();
            $('#profile-modal-1').modal('show');
        });

        document.getElementById('profile-2').addEventListener('click', function (event) {
            event.preventDefault();
            $('#profile-modal-2').modal('show');
        })
    </script>

    </html>

    <?php
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: Login.php");
    exit();
}
?>