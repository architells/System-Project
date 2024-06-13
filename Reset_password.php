<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="dumbbell.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM | Reset Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page"
    style="background: url('GYM-IMG.jpg') no-repeat center center fixed; background-size: cover;">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1 style="font-weight: bold;">GYM</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Create your new password.</p>
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
                <form action="Reset_password-be.php" method="post">
                    <label for="newpass">New Password</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="New password" name="npass">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <label for="confirmpass">Confirm Password</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm password" name="cpass">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>