<?php
session_start();
include "db_conn.php";

if (isset($_POST['event_name']) && isset($_POST['description'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $event = validate($_POST['event_name']);
    $description = validate($_POST['description']);

    if (empty($event)) {
        header("Location: Announcement.php?error=Event name is empty");
        exit();
    } else if (empty($description)) {
        header("Location: Announcement.php?error=Please put description");
        exit();
    } else {
        $ID = $_SESSION['ID'];

        // Check if the user is an admin
        $sql = "SELECT * FROM students WHERE ID = ? AND Role = 'admin'";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $ID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Insert or update announcement
            $sql2 = "INSERT INTO announcement (ID, event_name, description) VALUES (?, ?, ?)
                     ON DUPLICATE KEY UPDATE event_name = VALUES(event_name), description = VALUES(description)";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "iss", $ID, $event, $description);
            $result2 = mysqli_stmt_execute($stmt2);

            if ($result2) {
                header("Location: Announcement.php?success=Event successfully published");
                exit();
            } else {
                header("Location: Announcement.php?error=Event failed to publish");
                exit();
            }
        } else {
            header("Location: Announcement.php?error=You do not have permission to perform this action");
            exit();
        }
    }
} else {
    header("Location: Announcement.php");
    exit();
}

