<?php
session_start();
include "db_conn.php";

if (isset($_POST['npass']) && isset($_POST['cpass'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $npass = validate($_POST['npass']);
    $cpass = validate($_POST['cpass']);

    if (empty($npass)) {
        header("Location: Reset_password.php?error=Please enter new password");
        exit();
    } else if (empty($cpass)) {
        header("Location: Reset_password.php?error=Please enter confirmation password");
        exit();
    } else if ($npass !== $cpass) {
        header("Location: Reset_password.php?error=Confirmation password does not match");
        exit();
    } else {
        // Validate and sanitize the OTP
        $otp = validate($_SESSION['OTP']);

        // Prepare and execute SQL query to get Email for the given OTP
        $stmt = $conn->prepare("SELECT Email FROM password_recovery WHERE OTP = ?");
        $stmt->bind_param("s", $otp);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // OTP found, retrieve the Email
            $row = $result->fetch_assoc();
            $email = $row['Email'];

            // Retrieve the student ID based on the Email
            $stmt = $conn->prepare("SELECT ID, Password FROM users WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Student ID found, update the password
                $row = $result->fetch_assoc();
                $student_id = $row['ID'];
                $current_password = $row['Password'];

                // Check if new password is the same as current password
                if (password_verify($npass, $current_password)) {
                    header("Location: Reset_password.php?error=New password cannot be the same as current password");
                    exit();
                }

                $hashed_new = password_hash($npass, PASSWORD_BCRYPT);
                $update_sql = "UPDATE students SET Password = ? WHERE ID = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $hashed_new, $student_id);
                $stmt->execute();

                header("Location: Login.php?success=Password updated successfully");
                exit();
            } else {
                header("Location: Reset_password.php?error=User not found");
                exit();
            }
        } else {
            // OTP not found for the user, redirect with error message
            header("Location: Reset_password.php?error=OTP not found");
            exit();
        }
    }
} else {
    header("Location: Reset_password.php");
    exit();
}

