<?php
session_start();
include "db_conn.php";

if (isset($_POST['event_name'], $_POST['description'])) {

    function validate($data)
    {
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
    } elseif (empty($description)) {
        header("Location: Announcement.php?error=Description is empty");
        exit();
    } else {
        $Student_ID = $_SESSION['Student_ID'];

        // Check if the user is an admin
        $sql = "SELECT * FROM users WHERE Student_ID = ? AND Role = 'admin'";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $Student_ID); // 's' for string type
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Insert announcement
            $sql2 = "INSERT INTO announcement (student_id, event_name, description) VALUES (?, ?, ?)";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "iss", $Student_ID, $event, $description); // 's' for string type, 'i' for integer type
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
