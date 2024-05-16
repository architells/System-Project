<?php
session_start();
include "db_conn.php";  // Include database connection file

if(isset($_POST['upload'])){
    $user_id = $_SESSION['user_id'];


    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');

    if(empty($_FILES["file"]["type"])){
        header("Location:  profile.php?error=File is required");
        exit();
    }elseif(!in_array($_FILES["file"]["type"], $allowed_types)){
        header("Location:  profile.php?error=Only image files are allowed");
        exit();
    }

    $file = rand(1000, 100000)."-".$_FILES["file"]["name"];   // Generate random number and add original filename to it
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder = "upload/";

    $new_size = $file_size/1024;

    $new_file_name = strtolower($file);

    $final_file = str_replace(' ', '-', $new_file_name);

    // Fetch user information
    $sql = "SELECT * FROM user WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        // Fetch user information if the user exists
        $row = mysqli_fetch_assoc($result);

        // Check if user profile exists, if not, insert a new record
        $sql3 = "SELECT * FROM user_profile WHERE user_id='$user_id'";
        $result3 = mysqli_query($conn, $sql3);

        if(mysqli_num_rows($result3) == 0) {
            $sql4 = "INSERT INTO user_profile (user_id) VALUES ('$user_id')";
            mysqli_query($conn, $sql4);
        }

        // Combine filename and file type
        $file_name_and_type = $final_file . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        // Move the uploaded file to user's profile
        if(move_uploaded_file($file_loc, $folder.$file_name_and_type)){
            $sql = "UPDATE user_profile SET Profile_picture='$file_name_and_type' WHERE user_id='$user_id'";
            mysqli_query($conn, $sql);

            $_SESSION['Profile_picture'] = $file_name_and_type;
            header("Location:  profile.php?success=Picture successfully uploaded");
            exit();
        } else {
            header("Location:  profile.php?error=Picture not uploaded");
            exit();
        }
    } else {
        header("Location:  profile.php?error=User not found");
        exit();
    }
} else {
    header("Location:  profile.php?error=Please try again");
    exit();
}
?>
