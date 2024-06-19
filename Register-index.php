<?php
session_start();
include "db_conn.php";

require 'vendor/autoload.php';

use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;


// Check if the form is submitted with required fields
if (
    isset($_POST['fname']) && isset($_POST['mname']) && isset($_POST['lname']) &&
    isset($_POST['s_ID']) && isset($_POST['course']) && isset($_POST['year_level']) &&
    isset($_POST['email']) && isset($_POST['role']) && isset($_POST['password']) &&
    isset($_POST['retypepassword'])
) {

    // Function to validate input data
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize input
    $fname = validate($_POST['fname']);
    $mname = validate($_POST['mname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $s_ID = validate($_POST['s_ID']);
    $course = validate($_POST['course']);
    $year_level = validate($_POST['year_level']);
    $role = validate($_POST['role']);
    $pass = validate($_POST['password']);
    $retype = validate($_POST['retypepassword']);
    $terms = $_POST['terms']; // No need to validate as it's a checkbox

    $user_info = "fname=" . $fname . "&mname=" . $mname . "&lname=" . $lname . "&uname=" . $uname . "&email=" . $email . "&s_ID=" . $s_ID . "&course=" . $course . "&year_level=" . $year_level
        . "&role=" . $role . "&role=" . $role;

    // Check if any required field is empty
    if (empty($fname)) {
        header("Location: Register.php?error=Firstname is empty&$user_info");
        exit();
    } else if (empty($lname)) {
        header("Location: Register.php?error=Lastname is empty&$user_info");
        exit();
    } else if (empty($email)) {
        header("Location: Register.php?error=Email is empty&$user_info");
        exit();
    } else if (empty($s_ID)) {
        header("Location: Register.php?error=Student ID is empty&$user_info");
        exit();
    } else if (empty($course)) {
        header("Location: Register.php?error=Course is empty&$user_info");
        exit();
    } else if (empty($year_level)) {
        header("Location: Register.php?error=Year level is empty&$user_info");
        exit();
    } else if (empty($role)) {
        header("Location: Register.php?error=Role is empty&$user_info");
        exit();
    } else if (empty($pass)) {
        header("Location: Register.php?error=Password is empty&$user_info");
        exit();
    } else if ($pass !== $retype) {
        header("Location: Register.php?error=Passwords do not match&$user_info");
        exit();
    } else if (empty($terms)) {
        header("Location: Register.php?error=Please accept the terms and conditions&$user_info");
        exit();
    } else {
        // Hash the password using bcrypt
        $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
        $sqlCheckID = "SELECT * FROM users WHERE Student_ID='$s_ID' OR Email='$email'";
        $check = mysqli_query($conn, $sqlCheckID);
        if (mysqli_num_rows($check) > 0) {
            header("Location: Register.php?error=Student ID or Email is already taken&$user_info");
            exit();
        } else {
            // Insert user data into the database
            $sql = "INSERT INTO users (First_name, Middle_name, Last_name, Student_ID, Course, Year_level, Email, Role, Password) 
                    VALUES ('$fname', '$mname', '$lname', '$s_ID', '$course', '$year_level', '$email', '$role', '$hashed_pass')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Define the data to be encoded in the QR code
                $data = "$lname, $fname $mname. $course - $year_level $s_ID";

                // Set up the QR code renderer
                $renderer = new ImageRenderer(
                    new RendererStyle(400),
                    new ImagickImageBackEnd()
                );

                // Create the QR code writer
                $writer = new Writer($renderer);

                // Define the file path where the QR code will be saved
                $qrCodeFile = 'qr_codes/' . $s_ID . '.png';

                // Write the QR code to a file
                $writer->writeFile($data, $qrCodeFile);

                // Verify the QR code file was created
                if (file_exists($qrCodeFile)) {
                    // Store the file name in the database
                    $qrCodeFileName = $s_ID . '.png';
                    $sqlUpdateQR = "UPDATE users SET Qr_Code='$qrCodeFileName' WHERE Student_ID='$s_ID'";
                    $updateResult = mysqli_query($conn, $sqlUpdateQR);

                    if ($updateResult) {
                        // Check if user profile exists, if not, insert a new record
                        $sqlCheckStudentProfile = "SELECT * FROM student_profile WHERE Student_ID='$s_ID'";
                        $resultStudentProfile = mysqli_query($conn, $sqlCheckStudentProfile);
                        if (mysqli_num_rows($resultStudentProfile) == 0) {
                            $sqlInsertStudentProfile = "INSERT INTO student_profile (Student_ID) VALUES (?)";
                            $stmtStudentProfile = mysqli_prepare($conn, $sqlInsertStudentProfile);
                            mysqli_stmt_bind_param($stmtStudentProfile, "s", $s_ID);
                            mysqli_stmt_execute($stmtStudentProfile);
                            if (mysqli_stmt_affected_rows($stmtStudentProfile) < 1) {
                                // Handle insertion failure
                                header("Location: Register.php?error=Error inserting student profile&$user_info");
                                exit();
                            }
                        }

                        // Check if admin profile exists, if not, insert a new record
                        if ($role == 'admin') {
                            $sqlAdminProfile = "SELECT * FROM admin_profile WHERE Student_ID='$s_ID'";
                            $resultAdminProfile = mysqli_query($conn, $sqlAdminProfile);
                            if (mysqli_num_rows($resultAdminProfile) == 0) {
                                $sqlInsertAdminProfile = "INSERT INTO admin_profile (Student_ID) VALUES (?)";
                                $stmtAdminProfile = mysqli_prepare($conn, $sqlInsertAdminProfile);
                                mysqli_stmt_bind_param($stmtAdminProfile, "s", $s_ID);
                                mysqli_stmt_execute($stmtAdminProfile);
                                if (mysqli_stmt_affected_rows($stmtAdminProfile) < 1) {
                                    // Handle insertion failure
                                    header("Location: Register.php?error=Error inserting admin profile&$user_info");
                                    exit();
                                }
                            }
                        }

                        header("Location: Register.php?success=Your account has been created successfully");
                        exit();
                    } else {
                        header("Location: Register.php?error=Error updating QR code in the database&$user_info");
                        exit();
                    }
                } else {
                    header("Location: Register.php?error=An error occurred while creating your account&$user_info");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: Register.php");
    exit();
}

