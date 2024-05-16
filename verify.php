<?php
// Include the database connection file
include "db_conn.php";

// Start the session
session_start();

// If the verification code is present in the POST request
if (isset($_POST['v_code'])) {
    // Prepare the SQL query to select the user with the given verification code
    $query = "SELECT * FROM user WHERE Verification_code = ?";
    
    // Function to sanitize and validate input data
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Retrieve and validate the submitted verification code
    $v_code = validate($_POST['v_code']);

    if (empty($v_code)) {
        header("Location: success.php?error=Verification code is required");
        exit();
    } elseif (!ctype_digit($v_code)) {
        header("Location: success.php?error=Verification code must contain numbers only");
        exit();
    } elseif (strlen($v_code) != 6) {
        header("Location: success.php?error=Verification code must be exactly 6 digits long");
        exit();
    }

    // Prepare and execute the statement
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $v_code);
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {  // If the query was successful
        if (mysqli_num_rows($result) == 1) {  // If a single row is returned
            $row = mysqli_fetch_assoc($result);  // Fetch the user data as an associative array

            if ($row['Is_verified'] == 0) {    // If the user is not already verified
                // Get the email of the user
                $email = $row['Email'];
                // Prepare the SQL query to update the user's verification status
                $update = "UPDATE user SET Is_verified='1' WHERE Email = ?";
                
                // Prepare and execute the update statement
                $stmt = mysqli_prepare($conn, $update);
                mysqli_stmt_bind_param($stmt, "s", $email);
                if (mysqli_stmt_execute($stmt)) {
                    header("Location: Login-v2.php?success=Email validated successfully");
                    exit();
                }
            } else {
                header("Location: success.php?success=Email is already registered");
                exit();
            }
        } else {
            header("Location: success.php?error=Verification code does not match");
            exit();
        }
    }
}
?>
