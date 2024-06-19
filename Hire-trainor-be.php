<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
    if (isset($_POST['index'])) {
        $index = $_POST['index'];

        $sql = "UPDATE trainers SET Status = 'Hired' WHERE `index` = ?";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameter
            $stmt->bind_param("i", $index);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Status updated successfully.";
            } else {
                echo "Error executing query: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Index is not set in POST request.";
    }
} else {
    echo "Access denied. You are not a student.";
}

// Close the database connection
$conn->close();

