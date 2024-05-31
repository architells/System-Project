<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="dumbbell.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="nav">
        <div class="nav-logo">
            <p>GYM .</p>
        </div>
    </nav>

    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-danger">
                    <?php echo $_GET['success']; ?>
                </div>
            <?php } ?>
        <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>
        <form action="register.php" method="post">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="fname">

            <label for="middle-name">Middle Name:</label>
            <input type="text" id="middle-name" name="mname">

            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="lname">

            <label for="student-id">Student ID:</label>
            <input type="text" id="student-id" name="s_ID">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <button type="submit">Register</button>
        </form>
        <h5>Already have an account? <a href="login-form.php">Login here</a>.</h5>
    </div>
</body>
</html>
