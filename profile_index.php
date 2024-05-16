<?php
// Start the PHP session and include the database connection file
session_start();
include "db_conn.php";


// Check if form data is submitted
if (isset($_POST['Pnum']) && isset($_POST['month']) && 
    isset($_POST['day']) && isset($_POST['year']) && 
    isset($_POST['gender'])  &&  isset($_POST['province']) && 
    isset($_POST['city']) && isset($_POST['barangay']) && isset($_POST['zip_code']) && 
    isset($_POST['education']) && isset($_POST['experience']) && isset($_POST['skills'])){

    // Function to validate input data
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Retrieve and validate form data
    $Pnum = validate($_POST['Pnum']);
    $month = validate($_POST['month']);
    $day = validate($_POST['day']);
    $year = validate($_POST['year']);
    $gender = validate($_POST['gender']);
    $province = validate($_POST['province']);
    $city = validate($_POST['city']);
    $barangay = validate($_POST['barangay']);
    $zip_code = validate($_POST['zip_code']);
    $education = validate($_POST['education']);
    $experience = validate($_POST['experience']);
    $skills = validate($_POST['skills']);
    $terms = ($_POST['terms']);
    

    $user_ifo = "Pnum=" . $Pnum . "&month=" . $month . "&day=" . $day . "&year=" . $year . "&gender=" . $gender. 
                "&province=" . $province. "&city=" . $city. "&barangay=" . $barangay. "&zip_code=" . $zip_code . 
                "&education=" . $education . "&experience=" . $experience .  "&skills=" . $skills;

    if (empty($Pnum)) {
        header("Location: profile.php?error=Phone number is required&$user_info");
        exit();
    }else if (empty($month)){
        header("Location:  profile.php?error=month is required&$user_info");
        exit();
    }else if (empty($day)){
        header("Location:  profile.php?error=day is required&$user_info");
        exit();
    }else if (empty($year)) {  
        header("Location:  profile.php?error=year is required&$user_info");
        exit();
    }else if (empty($gender)){
        header("Location:  profile.php?error=Gender is required&$user_info");
        exit();
    }else if (empty($province)){
        header("Location:  profile.php?error=province is required&$user_info");
        exit();
    }else if (empty($city)){
        header("Location:  profile.php?error=city is required&$user_info");
        exit();
    }else if (empty($barangay)) {  
        header("Location:  profile.php?error=barangay is required&$user_info");
        exit();
    }else if (empty($zip_code)) {  
        header("Location:  profile.php?error=zip_code is required&$user_info");
        exit();
    }else if (empty($education)) {  
        header("Location:  profile.php?error=education is required&$user_info");
        exit();
    }else if (empty($experience)) {  
        header("Location:  profile.php?error=experience is required&$user_info");
        exit();
    }else if (empty($skills)) {  
        header("Location:  profile.php?error=skills is required&$user_info");
        exit();
    }else if (empty($terms)) {  
        header("Location:  profile.php?error=Please check the terms and conditions&$user_info");
        exit();
    }

        $ID = $_SESSION['ID'];

        // Fetch user information
        $sql = "SELECT * FROM user WHERE ID='$ID'";
        $result = mysqli_query($conn, $sql);

        // Fetch user profile information
        $sql3 = "SELECT * FROM user_profile WHERE user_id='$user_id'";
        $result3 = mysqli_query($conn, $sql3);

        // Check if user profile exists, if not, insert a new record
        if(mysqli_num_rows($result3) == 0) {
            $sql4 = "INSERT INTO user_profile (user_id) VALUES ('$user_id')";
            mysqli_query($conn, $sql4);
        }

        if(mysqli_num_rows($result) > 0) {
    // Fetch user information if the user exists
            $row = mysqli_fetch_assoc($result);

            // Update user profile information
            $sql2 = "UPDATE `user_profile` SET 
            `user_id`='$user_id',
            `Phone_number`='$Pnum',
            `Month`='$month',
            `Day`='$day',
            `Year`='$year',
            `gender`='$gender',
            `province`='$province',
            `city`='$city',
            `barangay`='$barangay',
            `zip_code`='$zip_code',
            `Education`='$education',
            `Experience`='$experience',
            `Skills`='$skills' 
            WHERE user_id='$user_id'";

            $result2 = mysqli_query($conn, $sql2);
            
    if($result2) {
        echo "<script> alert('Information update successful'); window.location.href='profile.php' </script>";
        exit();
    } else {
        echo "<script> alert('Information failed to update'); window.location.href='profile.php' </script>";
        exit();
    }
}
}
else {
    // Redirect to the registration page if no form data is submitted
    header("Location:  profile.php");
    exit();
}