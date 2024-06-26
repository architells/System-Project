<?php
// Start the PHP session and include the database connection file
session_start();
include "db_conn.php";


// Check if form data is submitted
if (
    isset($_POST['uname']) && isset($_POST['Pnum']) && isset($_POST['birthday']) && isset($_POST['gender']) &&
    isset($_POST['province']) && isset($_POST['city']) && isset($_POST['barangay']) &&
    isset($_POST['zip_code'])
) {

    // Function to validate input data
    function validate($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Retrieve and validate form data
    $uname = validate($_POST['uname']);
    $Pnum = validate($_POST['Pnum']);
    $birthday = validate($_POST['birthday']);
    $gender = validate($_POST['gender']);
    $province = validate($_POST['province']);
    $city = validate($_POST['city']);
    $barangay = validate($_POST['barangay']);
    $zip_code = validate($_POST['zip_code']);



    $user_info = "&uname=" . urlencode($uname) . "&Pnum=" . urlencode($Pnum) . "&birthday=" . urlencode($birthday) . "&gender=" . urlencode($gender) .
        "&province=" . urlencode($province) . "&city=" . urlencode($city) . "&barangay=" . urlencode($barangay) . "&zip_code=" . urlencode($zip_code) .
        "&education=" . urlencode($education);

    if (empty($Pnum)) {
        header("Location: profile.php?error1=Username is required&$user_info");
        exit();
    } else if (empty($Pnum)) {
        header("Location: profile.php?error1=Phone number is required&$user_info");
        exit();
    } else if (!preg_match('/^\+?[0-9\s-]{10,15}$/', $Pnum)) {
        header("Location: profile.php?error1=Invalid phone number format&$user_info");
        exit();
    } else if (empty($birthday)) {
        header("Location: profile.php?error1=Birthday is required&$user_info");
        exit();
    } else if (strtotime($birthday) > time()) {
        header("Location: profile.php?error1=Future birthday is not allowed&$user_info");
        exit();
    } else if (empty($gender)) {
        header("Location:  profile.php?error1=Gender is required&$user_info");
        exit();
    } else if (empty($province)) {
        header("Location:  profile.php?error1=province is required&$user_info");
        exit();
    } else if (empty($city)) {
        header("Location:  profile.php?error1=city is required&$user_info");
        exit();
    } else if (empty($barangay)) {
        header("Location:  profile.php?error1=barangay is required&$user_info");
        exit();
    } else if (empty($zip_code)) {
        header("Location:  profile.php?error1=zip_code is required&$user_info");
        exit();
    } else {


        $Student_ID = $_SESSION['Student_ID'];

        // Fetch user information
        $sql = "SELECT * FROM users WHERE Student_ID=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $Student_ID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Fetch user profile information
        $sql3 = "SELECT * FROM student_profile WHERE Student_ID=?";
        $stmt3 = mysqli_prepare($conn, $sql3);
        mysqli_stmt_bind_param($stmt3, "s", $Student_ID);
        mysqli_stmt_execute($stmt3);
        $result3 = mysqli_stmt_get_result($stmt3);

        // Check if user profile exists, if not, insert a new record
        if (mysqli_num_rows($result3) == 0) {
            $sql4 = "INSERT INTO student_profile (Student_ID) VALUES (?)";
            $stmt4 = mysqli_prepare($conn, $sql4);
            mysqli_stmt_bind_param($stmt4, "s", $Student_ID);
            mysqli_stmt_execute($stmt4);
            if (mysqli_stmt_affected_rows($stmt4) < 1) {
                // Handle insertion failure
                // Log error or provide error message
            }
        }


        if (mysqli_num_rows($result) > 0) {
            // Fetch user information if the user exists
            $row = mysqli_fetch_assoc($result);

            // Update user profile information
            $sql2 = "UPDATE `student_profile` SET
                `username` = ?,
                `Phone_number` = ?,
                `birthday` = ?,
                `gender` = ?,
                `province` = ?,
                `city` = ?,
                `barangay` = ?,
                `zip_code` = ? 
                WHERE Student_ID = ?";

            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "sssssssss", $uname, $Pnum, $birthday, $gender, $province, $city, $barangay, $zip_code, $Student_ID);
            $result2 = mysqli_stmt_execute($stmt2);


            if ($result2) {
                $_SESSION['uname'] = $uname;
                $_SESSION['Pnum'] = $Pnum;
                $_SESSION['birthday'] = $birthday;
                $_SESSION['gender'] = $gender;
                $_SESSION['province'] = $province;
                $_SESSION['city'] = $city;
                $_SESSION['barangay'] = $barangay;
                $_SESSION['zip_code'] = $zip_code;
                header("Location: profile.php?success1=Information updated successfully&$user_info");
                exit();
            } else {
                header("Location: profile.php?error1=Information failed to update&$user_info");
                exit();
            }
        }
    }
} else {
    // Redirect to the registration page if no form data is submitted
    header("Location:  profile.php");
    exit();
}