<?php
session_start();


if (isset($_SESSION['user_id']) && isset($_SESSION['Email'])) {



include "db_conn.php";

if (isset($_POST['oldPass']) && isset($_POST['newPass'])){
    
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $oldPass = validate($_POST['oldPass']);
    $newPass = validate($_POST['newPass']);


    if (empty($oldPass)) {
        header("Location: profile.php?error=old password is required");
        exit();
    } else if (empty($newPass)) {
        header("Location: profile.php?error=New password is required");
        exit();
    } else {
        // Check old password
        $user_id = $_SESSION['user_id'];

        if ($oldPass == $newPass) {
            header("Location: profile.php?error=Old and new passwords cannot be the same");
            exit();
        }
        // Retrieve the hashed password from the database
        $sql = "SELECT password FROM user WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify the old password
            if (password_verify($oldPass, $hashed_password)) {
                // Update the password
                $hashed_new = password_hash($newPass, PASSWORD_BCRYPT);
                $update_sql = "UPDATE user SET password = ? WHERE user_id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $hashed_new, $user_id);
                $stmt->execute();
                echo "<script> alert('Password updated successful'); window.location.href='profile.php' </script>";
                exit();
            } else {
                echo "<script> alert('Password failed to update'); window.location.href='profile.php' </script>";
                exit();
            }
        } else {
            header("Location: profile.php?error=User not found");
            exit();
        }
    }
}
}
else{
    header("Location: profile.php?");
    exit();
}