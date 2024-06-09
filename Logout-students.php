<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['s_ID'])) {
    $s_ID = $_SESSION['s_ID'];

    // Update the student's status to Offline
    $sql = "UPDATE students SET Status = 'Offline' WHERE Student_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $s_ID);
    if ($stmt->execute()) {
        // Successfully updated the status
        session_unset();
        session_destroy();
        // Redirect to the login page
        header("Location: Login.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // If session is not set, redirect to the login page
    header("Location: Login.php");
    exit();
}

