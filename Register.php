<?php
session_start();
include "db_conn.php";

// Check if the form is submitted with required fields
if(isset($_POST['fname']) && isset($_POST['lname']) && 
   isset($_POST['s_ID']) && isset($_POST['email']) && 
   isset($_POST['password'])){

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
    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $s_ID = validate($_POST['s_ID']);
    $pass = validate($_POST['password']);

    // Check if any required field is empty
    if(empty($fname)){
        header("Location: Front-Page.php?error=Firstname is empty"); // Redirect with an error message
        exit();
    } else if(empty($lname)){
        header("Location: Front-Page.php?error=Lastname is empty"); // Redirect with an error message
        exit();
    } else if(empty($email)){
        header("Location: Front-Page.php?error=Email is empty"); // Redirect with an error message
        exit();
    } else if(empty($s_ID)){
        header("Location: Front-Page.php?error=Student ID is empty"); // Redirect with an error message
        exit();
    } else if(empty($pass)){
        header("Location: Front-Page.php?error=Password is empty"); // Redirect with an error message
        exit();
    } else {
        // Hash the password using bcrypt
        $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
        
        // Insert user data into the database
        $sql = "INSERT INTO students(First_name, Last_name, Email, Student_ID, Password) 
                VALUES('$fname','$lname','$email','$s_ID','$hashed_pass')";
        $result = mysqli_query($conn, $sql);

        // Check if the insertion was successful
        if($result){
            header("Location: Front-Page.php"); // Redirect to the front page on successful registration
            exit();
        } else {
            header("Location: Front-Page.php?error=Registration Failed"); // Redirect with an error message
            exit();
        }
    }
}
?>
