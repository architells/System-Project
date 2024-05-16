<?php

session_start();
include "db_conn.php";

if(isset($_POST['fname']) && isset($_POST['lname']) && 
isset($_POST['s_ID']) && isset($_POST['email']) && 
isset($_POST['password'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['s_ID']);
    $s_ID = validate($_POST['email']);
    $pass = validate($_POST['password']);

    if(empty($fname)){
        header("Location: Register.php?error=Firstname is empty");
        exit();
    }else if(empty($lname)){
        header("Location: Register.php?error=Lastname is empty");
        exit();
    }else if(empty($email)){
        header("Location: Register.php?error=Email is empty");
        exit();
    }else if(empty($s_ID)){
        header("Location: Register.php?error=Student ID is empty");
        exit();
    }else if(empty($pass)){
        header("Location: Register.php?error=Password is empty");
        exit();
    }else{

        $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO students(First_name, Last_name, Email, Student_ID, Password) VALUES('$fname','$lname','$s_ID','$email','$hashed_pass')";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("Location: Front-Page.php");
            exit();
        }else{
            header("Location: Register.php?error=Registration Failed");
            exit();
        }
    }
}