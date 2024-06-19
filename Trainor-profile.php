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
                                        <th style="width: 20%">Trainer's Name</th>
                                        <th style="width: 8%" class="text-center">Status</th>
                                        <th style="width: 20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Include database connection
                                    include "db_conn.php";

                                    // SQL query to fetch trainers data
                                    $sql = "SELECT `index`, Trainer_name, Status FROM trainers";
                                    $result = $conn->query($sql);
                                    $id = 1;

                                    // Check if there are rows returned from query
                                    if ($result->num_rows > 0) {
                                        // Loop through each row of data
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $id . '.' ?></td>
                                                <td>
                                                    <a><?php echo $row['Trainer_name']; ?></a><br>
                                                </td>
                                                <td class="project-state">
                                                    <span><?php echo $row['Status']; ?></span>
                                                </td>
                                                <td class="project-actions text-right">
                                                    <a class="btn btn-primary btn-sm btn-view-profile" href="#" data-toggle="modal"
                                                        data-target="#profile-modal-<?php echo $row['index']; ?>">
                                                        <i class="fas fa-folder"></i> View
                                                    </a>
                                                    <a class="btn btn-info btn-sm btn-edit-trainer" href="#" data-toggle="modal"
                                                        data-target="#edit-modal-<?php echo $row['index']; ?>">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete-trainer" href="#" data-toggle="modal"
                                                        data-target="#delete-modal-<?php echo $row['index']; ?>">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $id++;
                                        } // End of while loop
                                    } else {
                                        // No trainers found
                                        echo '<tr><td colspan="4">No trainers found</td></tr>';
                                    }

                                    // Close database connection
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->

                        <?php
                        include "db_conn.php"; // Make sure db_conn.php includes your database connection details and establishes $conn
                    
                        // Example SQL query to retrieve trainer details including profile picture
                        $sql = "SELECT * FROM trainers";
                        $result = $conn->query($sql);

                        // Render modals for each trainer profile
                        if ($result->num_rows > 0) {
                            $result->data_seek(0); // Reset result pointer
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <!-- View Modal -->
                                <div class="modal fade" id="profile-modal-<?php echo htmlspecialchars($row['index']); ?>"
                                    tabindex="-1" role="dialog" aria-labelledby="profile-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="profile-modal-label">
                                                    <?php echo htmlspecialchars($row['Trainer_name']); ?>'s Profile
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body d-flex justify-content-center">
                                                <img src="Trainor_pic/<?php echo htmlspecialchars($row['Profile_picture']); ?>"
                                                    alt="Trainer Profile Picture" class="img-fluid"
                                                    style="width: 250px; height: 250px; border-radius: 50%; object-fit: cover;">

                                            </div>

                                            <!-- Trainer's Birthday -->
                                            <div class="p-3">
                                                <strong>Birthday: </strong>
                                                <p>
                                                    <?php echo ($row['Birthday'] == '0000-00-00') ? '' : date('F d, Y', strtotime($row['Birthday'])); ?>
                                                </p>
                                            </div>
                                            <div class="p-3">
                                                <strong>Phone Number: </strong>
                                                <p>
                                                    <?php echo ($row['Phone_number']) ?>
                                                </p>
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit-modal-<?php echo htmlspecialchars($row['index']); ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit-modal-label">
                                                    Edit Profile - <?php echo htmlspecialchars($row['Trainer_name']); ?>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="update_trainer.php" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="trainer-name">Trainer Name</label>
                                                        <input type="text" class="form-control" id="trainer-name"
                                                            name="trainer_name"
                                                            value="<?php echo htmlspecialchars($row['Trainer_name']); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="profile-picture">Profile Picture</label>
                                                        <input type="file" class="form-control-file" id="profile-picture"
                                                            name="profile_picture">
                                                        <small class="form-text text-muted">Current Picture:
                                                            <?php echo htmlspecialchars($row['Profile_picture']); ?></small>
                                                    </div>
                                                    <input type="hidden" name="trainer_index"
                                                        value="<?php echo htmlspecialchars($row['index']); ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete-modal-<?php echo htmlspecialchars($row['index']); ?>"
                                    tabindex="-1" role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete-modal-label">Delete Trainer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete
                                                <?php echo htmlspecialchars($row['Trainer_name']); ?>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form method="POST" action="Trainor-delete.php">
                                                    <input type="hidden" name="trainer_index"
                                                        value="<?php echo htmlspecialchars($row['index']); ?>">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            } // End of while loop
                        }

                        // Close database connection
                        $conn->close();
                        ?>

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
                <strong>Copyright &copy; 2023 <a href="#">Fitness Gym System</a>.</strong> All rights reserved.
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
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        window.location.href = 'logout-admin.php';
                    }
                });
            });

            // Event listener for delete confirmation
            document.querySelectorAll('.btn-delete-trainer').forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent the default action
                    var form = event.target.closest('form');
                    var trainerName = form.querySelector('.trainer-name').textContent.trim(); // Assuming there's a class for the trainer name
                    Swal.fire({
                        title: 'Are you sure you want to delete ' + trainerName + '?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit the form
                            form.submit();
                        }
                    });
                });
            });

        </script>
    </body>

    </html>

    <?php
} else {
    // Redirect to login page if user is not logged in or not an admin
    header("Location: index.php");
    exit();
}
?>