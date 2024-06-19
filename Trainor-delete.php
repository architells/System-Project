<?php
session_start();
include "db_conn.php"; // Make sure db_conn.php includes your database connection details and establishes $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize input data
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $trainer_index = validate($_POST['trainer_index']);

    // Prepare a statement to delete the trainer from the database
    $stmt = $conn->prepare("DELETE FROM trainers WHERE `index` = ?");
    $stmt->bind_param("i", $trainer_index);

    // Execute the statement
    if ($stmt->execute()) {
        // Deletion successful
        header("Location: Trainor-profile.php?success=Trainer deleted successfully");
        exit();
    } else {
        // Error handling
        header("Location: Trainor-profile.php?error=Failed to delete trainer");
        exit();
    }
}
