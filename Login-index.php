<?php
session_start();
include "db_conn.php";

// Check if the form is submitted with required fields
if (isset($_POST['s_ID']) && isset($_POST['password']) && isset($_POST['role'])) {

    // Function to validate input data
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize input
    $s_ID = validate($_POST['s_ID']);
    $pass = validate($_POST['password']);
    $role = validate($_POST['role']);

    // Check if the student ID is empty
    if (empty($s_ID)) {
        header("Location: Login.php?error=Please enter your Student ID");
        exit();
    }
    // Check if the role is empty
    else if (empty($role)) {
        header("Location: Login.php?error=Please select your role");
        exit();
    }
    // Check if the password is empty
    else if (empty($pass)) {
        header("Location: Login.php?error=Please enter your password");
        exit();
    } else {
        // SQL query to fetch user details by Student ID
        $sql = "SELECT * FROM students WHERE Student_ID = ? AND Role = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $s_ID, $role);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if the student ID exists in the database
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Verify the input password with the hashed password in the database
            if (password_verify($pass, $row['Password'])) {

                // Update the login time
                $updateSql = "UPDATE students SET Login_Time = CURRENT_TIMESTAMP, Status = 'Online' WHERE Student_ID = ?";
                $updateStmt = mysqli_prepare($conn, $updateSql);
                mysqli_stmt_bind_param($updateStmt, "s", $s_ID);
                mysqli_stmt_execute($updateStmt);

                // Retrieve additional user profile data from student_profile
                $sql2 = "SELECT * FROM student_profile WHERE ID=?";
                $stmt2 = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                    header("Location: Login.php?error=SQL Error");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt2, "s", $row['ID']);
                    mysqli_stmt_execute($stmt2);
                    $result_profile = mysqli_stmt_get_result($stmt2);
                    $Student_profile = mysqli_fetch_assoc($result_profile);

                    // Set session variables for the user and user profile
                    $_SESSION['ID'] = $row['ID'];
                    $_SESSION['fname'] = $row['First_name'];
                    $_SESSION['mname'] = $row['Middle_name'];
                    $_SESSION['lname'] = $row['Last_name'];
                    $_SESSION['s_ID'] = $row['Student_ID'];
                    $_SESSION['email'] = $row['Email'];
                    $_SESSION['course'] = $row['Course'];
                    $_SESSION['year_level'] = $row['Year_level'];
                    $_SESSION['role'] = $row['Role'];
                    $_SESSION['qrCodeFile'] = $row['Qr_Code'];

                    if ($Student_profile) {
                        // If user profile exists, set session variables for user profile
                        $_SESSION['Pnum'] = $Student_profile['Phone_Number'];
                        $_SESSION['birthday'] = $Student_profile['Birthday'];
                        $_SESSION['gender'] = $Student_profile['Gender'];
                        $_SESSION['province'] = $Student_profile['Province'];
                        $_SESSION['city'] = $Student_profile['City'];
                        $_SESSION['barangay'] = $Student_profile['Barangay'];
                        $_SESSION['zip_code'] = $Student_profile['Zip_code'];
                        $_SESSION['Profile_picture'] = $Student_profile['Profile_picture'];
                    }

                    // Retrieve additional admin profile data if role is admin
                    if ($row['Role'] == 'admin') {
                        $sql3 = "SELECT * FROM admin_profile WHERE ID=?";
                        $stmt3 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt3, $sql3)) {
                            header("Location: Login.php?error=SQL Error");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt3, "s", $row['ID']);
                            mysqli_stmt_execute($stmt3);
                            $result_admin_profile = mysqli_stmt_get_result($stmt3);
                            $Admin_profile = mysqli_fetch_assoc($result_admin_profile);

                            if ($Admin_profile) {
                                // If admin profile exists, set session variables for admin profile
                                $_SESSION['Pnum'] = $Admin_profile['Phone_number'];
                                $_SESSION['birthday'] = $Admin_profile['Birthday'];
                                $_SESSION['gender'] = $Admin_profile['Gender'];
                                $_SESSION['province'] = $Admin_profile['Province'];
                                $_SESSION['city'] = $Admin_profile['City'];
                                $_SESSION['barangay'] = $Admin_profile['Barangay'];
                                $_SESSION['zip_code'] = $Admin_profile['Zip_code'];
                            }
                        }
                    }

                    // Redirect based on role
                    if ($role == 'admin') {
                        header("Location: dashboard-Admin.php");
                    } else {
                        header("Location: dashboard-Student.php");
                    }
                    exit();
                }
            } else {
                header("Location: Login.php?error=Incorrect Password!");
                exit();
            }
        } else {
            header("Location: Login.php?error=Student ID or Role not found");
            exit();
        }
    }
} else {
    header("Location: Login.php");
    exit();
}
