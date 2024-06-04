<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="dumbbell.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="nav">
        <div class="nav-logo">
            <p>GYM .</p>
        </div>
    </nav>

    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger">
                <?php echo $_GET['error']; ?>
            </div>
        <?php } ?>
        <form action="index.php" method="post">
            <label for="student-id">ID NUMBER:</label>
            <input type="text" id="student-id" name="s_ID">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Login</button>
        </form>
        <h5>Don't have an account? <a href="register-form.php">Register here</a>.</h5>
    </div>
</body>

</html>