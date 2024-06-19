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

    // Validate and sanitize each input field
    $trainer = validate($_POST['trainer_name']);
    $workout = validate($_POST['body_workout']);
    $pnum = validate($_POST['phone_number']);
    $birthday = validate($_POST['birthday']);
    $gender = validate($_POST['gender']);
    $payment = validate($_POST['payment']);

    // Handle file upload
    $target_dir = "Trainor_pic/"; // Directory where you want to save the uploaded file
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $filename_only = basename($_FILES["file"]["name"]);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        header("Location: Add_trainor.php?error=File is not an image");
        exit();
    }

    // Check file size (limit to 5MB)
    if ($_FILES["file"]["size"] > 5000000) {
        $uploadOk = 0;
        header("Location: Add_trainor.php?error=Sorry, your file is too large");
        exit();
    }

    // Allow certain file formats
    $allowed_types = array("jpg", "png", "jpeg", "gif");
    if (!in_array($imageFileType, $allowed_types)) {
        $uploadOk = 0;
        header("Location: Add_trainor.php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed");
        exit();
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header("Location: Add_trainor.php?error=Sorry, your file was not uploaded");
        exit();
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // Retrieve the Student_ID from the session
            $student_id = $_SESSION['Student_ID'];

            // Prepared statement to insert data into database
            $sql = "INSERT INTO trainers (Student_ID, trainer_name, body_workout, phone_number, birthday, gender, Profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                // Check for errors in SQL preparation
                header("Location: Add_trainor.php?error=SQL prepare error: " . htmlspecialchars($conn->error));
                exit();
            }

            // Bind parameters including Student_ID
            $stmt->bind_param("issssss", $student_id, $trainer, $workout, $pnum, $birthday, $gender, $filename_only);

            // Execute the statement
            if ($stmt->execute()) {
                // Insertion successful
                header("Location: Add_trainor.php?success=New trainer added successfully");
                exit();
            } else {
                // Error handling
                header("Location: Add_trainor.php?error=New trainer failed to add: " . htmlspecialchars($stmt->error));
                exit();
            }
        } else {
            header("Location: Add_trainor.php?error=Sorry, there was an error uploading your file");
            exit();
        }
    }
} else {
    header("Location: Add_trainor.php");
    exit();
}
