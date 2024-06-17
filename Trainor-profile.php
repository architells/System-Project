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
                                        <th style="width: 1%">#</th>
                                        <th style="width: 20%">Trainor's Name</th>
                                        <th style="width: 30%">Profile</th>
                                        <th>Workout</th>
                                        <th style="width: 8%" class="text-center">Status</th>
                                        <th style="width: 20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Include database connection
                                    include "db_conn.php";

                                    // SQL query to fetch trainers data
                                    $sql = "SELECT * FROM trainers";
                                    $result = $conn->query($sql);

                                    // Check if there are rows returned from query
                                    if ($result->num_rows > 0) {
                                        // Loop through each row of data
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['ID']; ?></td>
                                                <td>
                                                    <a><?php echo $row['Trainer_name']; ?></a><br>
                                                </td>
                                                <td>
                                                </td>
                                                <td class="workout">


                                                </td>
                                                <td class="project-state"><span
                                                        class="badge badge-success"><?php echo $row['Status']; ?></span></td>
                                                <td class="project-actions text-right">
                                                    <a class="btn btn-primary btn-sm btn-view-profile" href="#" data-toggle="modal"
                                                        data-target="#profile-modal-<?php echo $row['ID']; ?>">
                                                        <i class="fas fa-folder"></i> View
                                                    </a>
                                                    <a class="btn btn-info btn-sm btn-edit-trainer" href="#" data-toggle="modal"
                                                        data-target="#edit-modal-<?php echo $row['ID']; ?>">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete-trainer" href="#" data-toggle="modal"
                                                        data-target="#delete-modal-<?php echo $row['ID']; ?>">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        } // End of while loop
                                    } else {
                                        // No trainers found
                                        echo '<tr><td colspan="6">No trainers found</td></tr>';
                                    }

                                    // Close database connection
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <?php
                        // Render modals for each trainer profile
                        if ($result->num_rows > 0) {
                            $result->data_seek(0); // Reset result pointer
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <!-- View Modal -->
                                <div class="modal fade" id="profile-modal-<?php echo htmlspecialchars($row['ID']); ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="profile-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="profile-modal-label">Profile</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Profile modal content -->
                                                <p>Profile content for <?php echo htmlspecialchars($row['Trainer_name']); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <!-- Example action button -->
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit-modal-<?php echo htmlspecialchars($row['ID']); ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit-modal-label">Edit Trainer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Edit form content -->
                                                <p>Edit form for <?php echo htmlspecialchars($row['Trainer_name']); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete-modal-<?php echo htmlspecialchars($row['ID']); ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete-modal-label">Delete Trainer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Delete confirmation content -->
                                                <p>Are you sure you want to delete
                                                    <?php echo htmlspecialchars($row['Trainer_name']); ?>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>


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
        document.addEventListener('DOMContentLoaded', function () {
            // Check if #logout-link exists before adding event listener
            if (document.getElementById('logout-link')) {
                document.getElementById('logout-link').addEventListener('click', function (event) {
                    event.preventDefault();
                    $('#logout-modal').modal('show');
                });
            }

            // Add event listeners for profile view buttons
            var profileButtons = document.querySelectorAll('.btn-view-profile');
            profileButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var targetModalId = this.getAttribute('data-target');
                    $(targetModalId).modal('show');
                });
            });

            // Add event listeners for edit trainer buttons
            var editButtons = document.querySelectorAll('.btn-edit-trainer');
            editButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var targetModalId = this.getAttribute('data-target');
                    // Perform edit action or show edit modal
                    // Example: $(targetModalId).modal('show');
                    console.log('Edit button clicked');
                });
            });

            // Add event listeners for delete trainer buttons
            var deleteButtons = document.querySelectorAll('.btn-delete-trainer');
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var targetModalId = this.getAttribute('data-target');
                    // Perform delete action or show delete confirmation modal
                    // Example: $(targetModalId).modal('show');
                    console.log('Delete button clicked');
                });
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
?>