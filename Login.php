<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="dumbbell.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gym Login</title>

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
  style="background: url('PIC_SET.jpg') no-repeat center center fixed; background-size: cover;">

  <div class="container">
    <div class="d-flex justify-content-start">
      <h3 style="font-weight: bold;">GYM.</h3>
    </div>
  </div>

  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-box" style="opacity: 0.9;">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <h1 style="font-size: 50px; font-weight: bold;">Login</h1>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Welcome to the GYM</p>

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

          <form action="Login-index.php" method="post">
            <div class="mb-3">
              <div class="input-group">
                <input type="text" name="s_ID" class="form-control" placeholder="ID number">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="bi bi-person-vcard-fill"></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <select id="role" name="role" class="form-control">
                <option value="" selected>Select Role</option>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="bi bi-people"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <hr>

          <div class="social-auth-links text-center mt-2 mb-3">
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div>
          <!-- /.social-auth-links -->

          <p class="mb-0">
            <a href="Register.php" class="text-center">Register a new membership</a>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->
  </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>