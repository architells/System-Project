<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="dumbbell.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GYM | Register</title>

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

  <style>
    .wider-form {
      max-width: 700px;
    }
  </style>
</head>

<body class="hold-transition login-page"
  style="background: url('GYM-IMG.jpg') no-repeat center center fixed; background-size: cover;">

  <div class="container">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
      <div class="col-md-8 wider-form">
        <div class="card card-outline card-primary" style="opacity: 0.9;">
          <div class="card-header text-center">
            <h1 style="font-size: 50px;">Register</h1>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Fill the form to create your account</p>
            <?php if (isset($_GET['error'])) { ?>
              <div class="alert alert-danger text-center">
                <?php echo $_GET['error']; ?>
              </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
              <div class="alert alert-success text-center">
                <?php echo $_GET['success']; ?>
              </div>
            <?php } ?>

            <form action="Register-index.php" method="post">
              <div class="row mb-3">
                <div class="col-md-4">
                  <div class="input-group">
                    <input type="text" name="fname" class="form-control" placeholder="First name"
                      value="<?php echo $_GET['fname'] ?? ''; ?>" pattern="[A-Za-z ]+" title="numbers are not allowed!">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <input type="text" name="mname" class="form-control" placeholder="Middle name"
                      value="<?php echo $_GET['mname'] ?? ''; ?>" pattern="[A-Za-z .]+"
                      title="numbers are not allowed!">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <input type="text" name="lname" class="form-control" placeholder="Last name"
                      value="<?php echo $_GET['lname'] ?? ''; ?>" pattern="[A-Za-z]+" title="numbers are not allowed!">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="input-group mb-3">
                <input type="text" name="s_ID" class="form-control" placeholder="ID number"
                  value="<?php echo $_GET['uname'] ?? ''; ?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="bi bi-person-vcard-fill"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" name="course" class="form-control" placeholder="Course"
                  value="<?php echo $_GET['uname'] ?? ''; ?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="bi bi-book"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <select name="year_level" class="form-control">
                  <option value="" selected>Select Year Level</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="bi bi-calendar"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email"
                  value="<?php echo $_GET['email'] ?? ''; ?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
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
              <div class="input-group mb-3">
                <input type="password" name="retypepassword" class="form-control" placeholder="Retype password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                      I agree to the <a href="#">terms</a>
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
            <div class="social-auth-links text-center">
              <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i>
                Sign up using Facebook
              </a>
              <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i>
                Sign up using Google+
              </a>
            </div>

            <a href="Login.php" class="text-center">I already have a membership</a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
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