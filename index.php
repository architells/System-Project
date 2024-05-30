<?php
session_start();
include "db_conn.php";

// Check if the form is submitted with required fields
if(isset($_POST['s_ID']) && isset($_POST['password']) && isset($_POST['role'])){

    /**
     * Function to validate input data.
     * 
     * Description: Cleans input data to prevent security issues.
     * Parameters: 
     *   - $data (string): The input data to be validated.
     * Behavior: Trims whitespace, strips slashes, and converts special characters to HTML entities.
     * Return Values: Returns the cleaned data.
     */
    function validate($data){
        $data = trim($data);            // Remove whitespace from both sides of a string
        $data = stripslashes($data);    // Un-quotes a quoted string
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;                   // Return the cleaned data
    }

    // Validate and sanitize input
    $s_ID = validate($_POST['s_ID']);
    $pass = validate($_POST['password']);
    $role = validate($_POST['role']);

    // Check if the student ID is empty
    if(empty($s_ID)){
        header("Location: Login-form.php?error=Please enter your Student ID"); // Redirect with an error message
        exit();
    }
    // Check if the password is empty
    else if(empty($pass)){
        header("Location: Login-form.php?error=Please enter your password"); // Redirect with an error message
        exit();
    }
    else{
        // SQL query to fetch user details by Student ID
        $sql = "SELECT * FROM students WHERE Student_ID = '$s_ID' AND Role = '$role'";
        $result = mysqli_query($conn, $sql);

        // Check if the student ID exists in the database
        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);

            // Verify the input password with the hashed password in the database
            if(password_verify($pass, $row['Password'])){
                // Set session variables on successful login
                $_SESSION['ID'] = $row['ID'];
                $_SESSION['fname'] = $row['First_name'];
                $_SESSION['lname'] = $row['Last_name'];
                $_SESSION['s_ID'] = $row['Student_ID'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['role'] = $row['Role'];
                
                if ($role == 'admin') {
                    header("Location: dashboard-Admin.php"); // Redirect to admin dashboard
                } else {
                    header("Location: dashboard-Student.php"); // Redirect to student dashboard
                }
                exit();
            } else {
                header("Location: Login-form.php?error=Incorrect Password!"); // Redirect with an error message
                exit();
            }
        } else {
            header("Location: Login-form.php?error=Student ID or Role not found"); // Redirect with an error message
            exit();
        }
    }
}else{
    header("Location: Login-form.php"); // Redirect if the form is not submitted properly
    exit();
}
?>
