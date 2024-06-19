<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GYM | Add Trainor</title>
        <link rel="shortcut icon" href="dumbbell.png">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">

        <style>
            .card-custom {
                max-width: 70%;
                margin: 50px auto;
            }

            .profile-picture {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
            }
        </style>
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

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="dashboard-Admin.php" class="brand-link">
                    <img src="dumbbell.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">Admin</span>
                </a>

                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <?php
                        $Profile_pic = isset($_SESSION['Profile_picture']) && !empty($_SESSION['Profile_picture']) ? "upload/" . $_SESSION['Profile_picture'] : "default.jpg";
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

                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
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
                </div>
            </aside>

            <!-- Content Wrapper -->
            <div class="content-wrapper"
                style="background: url('GYM-IMG-4.jpg') no-repeat center center fixed; background-size: cover;">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 style="color: white;">Add Trainer</h1>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="content">
                    <div class="card card-primary card-outline card-custom">
                        <div class="card-body box-profile">
                            <div class="col-md-12">
                                <form action="Add_trainor_be.php" method="POST" enctype="multipart/form-data">
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

                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="trainerName">Trainer's Name</label>
                                                <input type="text" class="form-control" id="trainerName" name="trainer_name"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="bodyWorkout">Body Workout</label>
                                                <input type="text" class="form-control" id="bodyWorkout" name="body_workout"
                                                    required>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                                    <input type="text" class="form-control" id="phoneNumber"
                                                        name="phone_number" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label" for="birthday">Birthday</label>
                                                    <input type="date" class="form-control" id="birthday" name="birthday"
                                                        required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label" for="gender">Gender</label>
                                                    <select class="form-select form-control" id="gender" name="gender"
                                                        required>
                                                        <option value="">Select your gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                                            <label class="form-label">Profile Picture</label>
                                            <div class="text-center">
                                                <img id="profilePicturePreview"
                                                    class="profile-user-img img-fluid profile-picture"
                                                    src="<?php echo $Profile_pic; ?>" alt="User profile picture">
                                            </div>
                                            <div class="custom-file mt-3">
                                                <input type="file" class="custom-file-input" id="exampleInputFile"
                                                    name="file" required>
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="mb-3">
                                        <button type="submit" name="submit"
                                            class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                <a href="Logout-admin.php" class="btn btn-primary">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-wrapper -->

            <!-- Footer -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.2.0
                </div>
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io </a>.</strong> All rights
                reserved.
            </footer>
            <!-- /.footer -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- /.wrapper -->

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Custom script -->
        <script>
            // Logout modal display
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

            // Display selected file name and preview profile picture
            document.querySelector('.custom-file-input').addEventListener('change', function (e) {
                var fileInput = document.getElementById("exampleInputFile");
                var fileName = fileInput.files[0].name;
                var nextSibling = e.target.nextElementSibling;
                nextSibling.innerText = fileName;

                // Display the selected picture
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profilePicturePreview').src = e.target.result;
                }
                reader.readAsDataURL(fileInput.files[0]);
            });
        </script>
    </body>

    </html>

    <?php
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: Login.php");
    exit();
}
?>