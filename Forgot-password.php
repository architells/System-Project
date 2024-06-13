<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="dumbbell.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GYM | Forgot Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
        .digit-input {
            width: 40px;
            height: 40px;
            font-size: 24px;
            text-align: center;
            margin: 0 5px;
        }

        #sixDigitForm {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .otp-input-group {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="hold-transition login-page"
    style="background: url('GYM-IMG.jpg') no-repeat center center fixed; background-size: cover;">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1 style="font-weight: bold;">GYM</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
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
                <form action="recover-password.php" method="post" id="otpForm">
                    <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="requestOtpBtn" class="btn btn-primary btn-block">Request
                                OTP</button>
                            <span id="countdown" style="display: none;">Please wait <span id="countdownTimer">30</span>
                                seconds</span>
                        </div>
                    </div>
                </form>

                <div class="card-body text-center">
                    <?php if (isset($_GET['error1'])) { ?>
                        <div class="alert alert-danger text-center">
                            <?php echo htmlspecialchars($_GET['error1']); ?>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['success1'])) { ?>
                        <div class="alert alert-success text-center">
                            <?php echo htmlspecialchars($_GET['success1']); ?>
                        </div>
                    <?php } ?>
                    <form action="OTP-verify.php" method="POST" id="sixDigitForm">
                        <label for="otp">Enter OTP</label>
                        <div class="otp-input-group">
                            <input type="text" class="form-control digit-input" id="digit1" maxlength="1"
                                pattern="[0-9]">
                            <input type="text" class="form-control digit-input" id="digit2" maxlength="1"
                                pattern="[0-9]">
                            <input type="text" class="form-control digit-input" id="digit3" maxlength="1"
                                pattern="[0-9]">
                            <input type="text" class="form-control digit-input" id="digit4" maxlength="1"
                                pattern="[0-9]">
                            <input type="text" class="form-control digit-input" id="digit5" maxlength="1"
                                pattern="[0-9]">
                            <input type="text" class="form-control digit-input" id="digit6" maxlength="1"
                                pattern="[0-9]">
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block" name="OTP">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <p class="mt-3 mb-0 text-end">
                    <a href="Login.php" style="font-size: 15px;">&nbsp;Back to Login</a>
                </p>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('sixDigitForm');
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Collect the digit inputs
                let otp = '';
                for (let i = 1; i <= 6; i++) {
                    otp += document.getElementById('digit' + i).value;
                }

                // Set the OTP value to a hidden input field
                const otpInput = document.createElement('input');
                otpInput.type = 'hidden';
                otpInput.name = 'otp';
                otpInput.value = otp;
                form.appendChild(otpInput);

                // Submit the form
                form.submit();
            });
        });
    </script>
</body>

</html>