<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
    <!-- Link to external stylesheet -->
    <link rel="shortcut icon" href="dumbbell.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <form action="verify.php" method="post" class="border shadow p-3 rounded login-container">
            <h1 class="text-center p-3">Email Verification</h1>
            <div class="container">
                <!-- Display error or success message -->
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success">
                        <?php echo $_GET['success']; ?>
                    </div>
                <?php } ?>

                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-shield-lock-fill"></i>
                        <label for="Verification_code" class="form-label ms-2">Verification Code</label>
                    </div>
                    <input type="text" class="form-control" name="v_code" style="width: calc(100%);"
                        placeholder="Enter verification code...">
                </div>

                <!-- Submit button -->
                <div class="text-center mt-3">
                    <button class="btn btn-primary same-length" type="submit">Submit</button>
                </div>
            </div> <!-- end of container div -->
            <hr>
            <h6>Something Wrong? <a href="login-form.php">Back to login</a>.</h6>
        </form>
    </div> <!-- end of container div -->
</body>

</html>