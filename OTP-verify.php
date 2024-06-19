<?php
session_start();
include "db_conn.php"; // Make sure db_conn.php contains the database connection logic

if (isset($_POST['otp'])) {
    // Function to validate input data
    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Validate and sanitize OTP
    $otp = validate($_POST['otp']);

    

    // Prepare and execute SQL query to get Email for the given OTP
    $stmt = $conn->prepare("SELECT Email FROM password_recovery WHERE OTP = ?");
    $stmt->bind_param("i", $otp); // Assuming OTP is a string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // OTP found
        $row = $result->fetch_assoc();
        $email = $row['Email'];

        // Prepare and execute SQL query to get ID from the students table using the retrieved Email
        $stmt = $conn->prepare("SELECT ID FROM students WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email found in students table
            $row = $result->fetch_assoc();
            $student_id = $row['ID'];

            $_SESSION['student_id'] = $student_id;
            // Proceed to the next step (e.g., password reset form) and pass the student ID if needed
            header("Location: Reset_password.php?");
            exit();
        } else {
            // Email not found in students table, redirect with error message
            header("Location: Forgot-password.php?error1=Email not found in students table");
            exit();
        }
    } else {
        // OTP not found for the user, redirect with error message
        header("Location: Forgot-password.php?error1=OTP not found");
        exit();
    }
} else {
    // Redirect if OTP is not set
    header("Location: Forgot-password.php");
    exit();
}

