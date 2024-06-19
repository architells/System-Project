<?php
session_start();
include "db_conn.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $v_code)
{
    require ("PHPMailer/PHPMailer.php");
    require ("PHPMailer/SMTP.php");
    require ("PHPMailer/Exception.php");

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                             //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                     //Enable SMTP authentication
        $mail->Username = 'mangaronarch@gmail.com';                 //SMTP username
        $mail->Password = 'atdw cugc zqnz iadm';                    //SMTP password (Note: Keep this secure)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                          //TCP port to connect to

        //Recipients
        $mail->setFrom('mangaronarch@gmail.com', 'Password Recovery');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = 'Email request to OTP';
        $mail->Body = 'Here is the OTP that you have requested
        <h1 class="text-center mt-5">' . $v_code . '</h1>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['email'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);

    // Generate a random 6-digit OTP
    $otp = rand(100000, 999999);

    // Check if email exists in the students table and get the ID
    $stmt = $conn->prepare("SELECT ID, Email FROM users WHERE Email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ID = $row['ID'];
        $email = $row['Email'];

        // Check if the email already exists in the password_recovery table
        $stmt = $conn->prepare("SELECT ID FROM password_recovery WHERE Email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update existing OTP record
            $stmt = $conn->prepare("UPDATE password_recovery SET OTP=? WHERE Email=?");
            $stmt->bind_param("is", $otp, $email);
        } else {
            // Insert new OTP record
            $stmt = $conn->prepare("INSERT INTO password_recovery (ID, Email, OTP) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $ID, $email, $otp);
        }

        if ($stmt->execute()) {
            // Send OTP via email
            if (sendMail($email, $otp)) {
                header("Location: Forgot-password.php?success=OTP sent&email=" . urlencode($email));
                exit();
            } else {
                header("Location: Forgot-password.php?error=Failed to send OTP");
                exit();
            }
        } else {
            header("Location: Forgot-password.php?error=Failed to save OTP");
            exit();
        }
    } else {
        header("Location: Forgot-password.php?error=Email not found");
        exit();
    }
} else {
    header("Location: Forgot-password.php");
    exit();
}


