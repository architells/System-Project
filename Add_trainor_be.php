<?php
session_start();
include "db_conn.php"; // Make sure db_conn.php includes your database connection details and establishes $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize input data
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize each input field
    $trainer = validate($_POST['trainer_name']);
    $workout = validate($_POST['body_workout']);
    $pnum = validate($_POST['phone_number']);
    $birthday = validate($_POST['birthday']);
    $gender = validate($_POST['gender']);
    $payment = validate($_POST['payment']);
    $payment_methods = isset($_POST['payment_methods']) ? $_POST['payment_methods'] : [];


    // Prepared statement to insert data into database
    $stmt = $conn->prepare("INSERT INTO trainers (trainer_name, body_workout, phone_number, birthday, gender, payment, payment_methods)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $payment_methods_str = implode(", ", $payment_methods); // Convert array to comma-separated string
    $stmt->bind_param("sssssss", $trainer, $workout, $pnum, $birthday, $gender, $payment, $payment_methods_str);

    // Execute the statement
    if ($stmt->execute()) {
        // Insertion successful
        header("Location: Add_trainor.php?success=New trainor added successfully");
        exit();
    } else {
        // Error handling
        header("Location: Add_trainor.php?error=New trainor failed to add");
        exit();
    }
}

