<?php
session_start();


if (isset($_SESSION['ID'])) {



    include "db_conn.php";

    if (isset($_POST['oldPass']) && isset($_POST['newPass'])) {

        function validate($data)
        {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $oldPass = validate($_POST['oldPass']);
        $newPass = validate($_POST['newPass']);
        $confirm = ($_POST['confirm']);


        if (empty($oldPass)) {
            header("Location: profile.php?error2=Old password is required");
            exit();
        } else if (empty($newPass)) {
            header("Location: profile.php?error2=New password is required");
            exit();
        } else if ($newpass !== $confirm) {
            header("Location: profile.php?error2=Confirmation password is not match");
            exit();
        } else {
            // Check old password
            $ID = $_SESSION['ID'];

            if ($oldPass == $newPass) {
                header("Location: profile.php?error2=Old and new passwords cannot be the same");
                exit();
            }
            // Retrieve the hashed password from the database
            $sql = "SELECT Password FROM users WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $ID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $hashed_password = $row['Password'];

                // Verify the old password
                if (password_verify($oldPass, $hashed_password)) {
                    // Update the password
                    $hashed_new = password_hash($newPass, PASSWORD_BCRYPT);
                    $update_sql = "UPDATE students SET Password = ? WHERE ID = ?";
                    $stmt = $conn->prepare($update_sql);
                    $stmt->bind_param("si", $hashed_new, $ID);
                    $stmt->execute();
                    header("Location: profile.php?success2=Password updated successfully");
                    exit();
                } else {
                    header("Location: profile.php?error2=Password failed to update");
                    exit();
                }
            } else {
                header("Location: profile.php?error2=User not found");
                exit();
            }
        }
    }
} else {
    header("Location: profile.php?");
    exit();
}