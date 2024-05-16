<?php
session_start();
include "db_conn.php";

if(isset($_POST['s_ID']) && isset($_POST['password'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $s_ID = validate($_POST['s_ID']);
    $pass = validate($_POST['password']);

    if(empty($s_ID)){
        header("Location: Front-Page.php?error=Please enter your Student ID");
        exit();
    }else if(empty($pass)){
        header("Location: Front-Page.php?error=Please enter your password");
        exit();
    }else{

        $sql = "SELECT * FROM students WHERE Student_ID = '$s_ID'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($pass, $row['Password'])){
                
                $_SESSION['ID'] = $row['ID'];
                $_SESSION['fname'] = $row['First_name'];
                $_SESSION['lname'] = $row['Last_name'];
                $_SESSION['s_ID'] = $row['Student_ID'];
                $_SESSION['email'] = $row['Email'];
                
                header("Location: dashboard.php");
                exit();
            } else {
                header("Location: Front-Page.php?error=Incorrect Password!");
                exit();
            }
        } else {
            header("Location: Front-Page.php?error=Student ID not found");
            exit();
        }
    }
}else{
    header("Location: Front-Page.php");
    exit();
}
