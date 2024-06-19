<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];

    // Update the student's status to Offline
    $sql = "UPDATE students SET Status = 'Offline' WHERE ID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $ID); // Use 'i' for integer type
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

