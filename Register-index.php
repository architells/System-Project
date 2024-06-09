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
    isset($_POST['email']) && isset($_POST['role']) && isset($_POST['password'])
) {

    /**
     * Function to validate input data.
     * 
     * Description: Cleans input data to prevent security issues.
     * Parameters: 
     *   - $data (string): The input data to be validated.
     * Behavior: Trims whitespace, strips slashes, and converts special characters to HTML entities.
     * Return Values: Returns the cleaned data.
     */
    function validate($data)
    {
        $data = trim($data);            // Remove whitespace from both sides of a string
        $data = stripslashes($data);    // Un-quotes a quoted string
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;                   // Return the cleaned data
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
    $retype = ($_POST['retypepassword']);
    $terms = ($_POST['terms']);

    // Check if any required field is empty
    if (empty($fname)) {
        header("Location: Register.php?error=Firstname is empty"); // Redirect with an error message
        exit();
    } else if (empty($lname)) {
        header("Location: Register.php?error=Lastname is empty"); // Redirect with an error message
        exit();
    } else if (empty($email)) {
        header("Location: Register.php?error=Email is empty"); // Redirect with an error message
        exit();
    } else if (empty($s_ID)) {
        header("Location: Register.php?error=Student ID is empty"); // Redirect with an error message
        exit();
    } else if (empty($course)) {
        header("Location: Register.php?error=Course is empty"); // Redirect with an error message
        exit();
    } else if (empty($year_level)) {
        header("Location: Register.php?error=Year level is empty"); // Redirect with an error message
        exit();
    } else if (empty($role)) {
        header("Location: Register.php?error=Role is empty"); // Redirect with an error message
        exit();
    } else if (empty($pass)) {
        header("Location: Register.php?error=Password is empty"); // Redirect with an error message
        exit();
    } else if (empty($retype)) {
        header("Location: Register.php?error=Password does not match"); // Redirect with an error message
        exit();
    } else if (empty($terms)) {
        header("Location: Register.php?error=Please check the terms and conditions"); // Redirect with an error message
        exit();
    } else {
        // Hash the password using bcrypt
        $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
        $sqlCheckID = "SELECT * FROM students WHERE Student_ID='$s_ID' OR Email='$email'";
        $check = mysqli_query($conn, $sqlCheckID);
        if (mysqli_num_rows($check) > 0) {
            header("Location: Register.php?error=Student ID or Email is already taken");
            exit();
        } else {

            // Insert user data into the database
            $sql = "INSERT INTO students (First_name, Middle_name, Last_name, Student_ID, Course, Year_level, Email, Role, Password) 
                VALUES ('$fname', '$mname', '$lname', '$s_ID', '$course', '$year_level', '$email', '$role', '$hashed_pass')";
            $result = mysqli_query($conn, $sql);

            // Check if the insertion was successful
            if ($result) {
                // Define the data you want to encode in the QR code (e.g., user's details)
                $data = "$lname, $fname $mname. $course - $year_level $s_ID";

                // Set up the QR code renderer
                $renderer = new ImageRenderer(
                    new RendererStyle(400), // Width and height of the QR code
                    new ImagickImageBackEnd() // Use SvgImageBackEnd as the image backend
                );

                // Create the QR code writer
                $writer = new Writer($renderer);

                // Define the file path where the QR code will be saved
                $qrCodeFile = 'qr_codes/' . $s_ID . '.png'; // File path to save the QR code

                // Write the QR code to a file
                $writer->writeFile($data, $qrCodeFile);

                // Save the QR code file path in the session
                $_SESSION['qrCodeFile'] = $qrCodeFile;

                // Check if QR code generation was successful
                if (file_exists($qrCodeFile)) {
                    header("Location: Register.php?success=Your account has been created successfully"); // Redirect with success message
                    exit();
                } else {
                    header("Location: Register.php?error=Error generating QR code"); // Redirect with error message
                    exit();
                }
            } else {
                header("Location: Register.php?error=An error occurred while creating your account"); // Redirect with error message
                exit();
            }
        }
    }
} else {
    header("Location: Register.php");
    exit();
}
