<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
    $Student_ID = $_SESSION['Student_ID'];

    // Update the student's status to Offline
    $sql = "UPDATE users SET Status = 'Offline' WHERE Student_ID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $Student_ID); // Use 'i' for integer type
        if ($stmt->execute()) {
            // Successfully updated the status
            session_unset();
            session_destroy();
            // Redirect to the login page
            header("Location: Login.php");
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    // If session is not set, redirect to the login page
    header("Location: Login.php");
    exit();
}

