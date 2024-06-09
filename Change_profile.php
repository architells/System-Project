<?php
session_start();
include "db_conn.php";  // Include database connection file

if(isset($_POST['upload'])){
    $ID = $_SESSION['ID'];

    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');

    if(empty($_FILES["file"]["type"])){
        header("Location: profile.php?error3=File is required");
        exit();
    } elseif(!in_array($_FILES["file"]["type"], $allowed_types)){
        header("Location: profile.php?error3=Only image files are allowed");
        exit();
    }

    $file = rand(1000, 100000) . "-" . $_FILES["file"]["name"];   // Generate random number and add original filename to it
    $file_loc = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $folder = "upload/";

    // Fetch user information
    $sql = "SELECT * FROM students WHERE ID=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        // Fetch user information if the user exists
        $row = mysqli_fetch_assoc($result);

        // Check if user profile exists, if not, insert a new record
        $sql3 = "SELECT * FROM student_profile WHERE ID=?";
        $stmt3 = mysqli_prepare($conn, $sql3);
        mysqli_stmt_bind_param($stmt3, "s", $ID);
        mysqli_stmt_execute($stmt3);
        $result3 = mysqli_stmt_get_result($stmt3);

        if(mysqli_num_rows($result3) == 0) {
            $sql4 = "INSERT INTO student_profile (ID) VALUES (?)";
            $stmt4 = mysqli_prepare($conn, $sql4);
            mysqli_stmt_bind_param($stmt4, "s", $ID);
            mysqli_stmt_execute($stmt4);
            mysqli_stmt_close($stmt4); // Close the statement
        }

        // Combine filename and file type
        $file_name_and_type = $file . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // Move the uploaded file to user's profile
        if(move_uploaded_file($file_loc, $folder.$file_name_and_type)){
            $sql5 = "UPDATE student_profile SET Profile_picture=? WHERE ID=?";
            $stmt5 = mysqli_prepare($conn, $sql5);
            mysqli_stmt_bind_param($stmt5, "ss", $file_name_and_type, $ID);
            mysqli_stmt_execute($stmt5);

            $_SESSION['Profile_picture'] = $file_name_and_type;
            header("Location: profile.php?success3=Picture successfully uploaded");
            exit();
        } else {
            header("Location: profile.php?error3=Picture not uploaded");
            exit();
        }
    } else {
        header("Location: profile.php?error3=User not found");
        exit();
    }
} else {
    header("Location: profile.php?error3=Please try again");
    exit();
}

