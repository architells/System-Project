<?php
session_start();
include "db_conn.php";

// Check if the form is submitted with required fields
if (isset($_POST['s_ID']) && isset($_POST['password']) && isset($_POST['role'])) {

    // Function to validate input data
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize input
    $s_ID = validate($_POST['s_ID']);
    $pass = validate($_POST['password']);
    $role = validate($_POST['role']);

    // Check if the student ID is empty
    if (empty($s_ID)) {
        header("Location: Login.php?error=Please enter your Student ID");
        exit();
    }
    // Check if the role is empty
    else if (empty($role)) {
        header("Location: Login.php?error=Please select your role");
        exit();
    }
    // Check if the password is empty
    else if (empty($pass)) {
        header("Location: Login.php?error=Please enter your password");
        exit();
    } else {
        // SQL query to fetch user details by Student ID
        $sql = "SELECT * FROM students WHERE Student_ID = ? AND Role = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $s_ID, $role);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if the student ID exists in the database
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Verify the input password with the hashed password in the database
            if (password_verify($pass, $row['Password'])) {

                // Update the login time
                $updateSql = "UPDATE students SET Login_Time = CURRENT_TIMESTAMP, Status = 'Online' WHERE Student_ID = ?";
                $updateStmt = mysqli_prepare($conn, $updateSql);
                mysqli_stmt_bind_param($updateStmt, "s", $s_ID);
                mysqli_stmt_execute($updateStmt);

                // Set session variables on successful login
                $_SESSION['ID'] = $row['ID'];
                $_SESSION['fname'] = $row['First_name'];
                $_SESSION['mname'] = $row['Middle_name'];
                $_SESSION['lname'] = $row['Last_name'];
                $_SESSION['s_ID'] = $row['Student_ID'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['course'] = $row['Course'];
                $_SESSION['year_level'] = $row['Year_level'];


                $_SESSION['role'] = $row['Role'];
                $_SESSION['Pnum'] = $row['Phone_Number'];
                $_SESSION['birthday'] = $row['Birthday'];
                $_SESSION['gender'] = $row['Gender'];
                $_SESSION['province'] = $row['Province'];
                $_SESSION['city'] = $row['City'];
                $_SESSION['barangay'] = $row['Barangay'];
                $_SESSION['zip_code'] = $row['Zip_code'];
                $_SESSION['Profile_picture'] = $row['Profile_picture'];


                // Redirect based on role
                if ($role == 'admin') {
                    header("Location: dashboard-Admin.php");
                } else {
                    header("Location: dashboard-Student.php");
                }
                exit();
            } else {
                header("Location: Login.php?error=Incorrect Password!");
                exit();
            }
        } else {
            header("Location: Login.php?error=Student ID or Role not found");
            exit();
        }
    }
} else {
    header("Location: Login.php");
    exit();
}
