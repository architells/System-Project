<?php
// Start the PHP session
session_start();

// Unset all session variables and destroy the session
session_unset();
session_destroy();

// Redirect the user to the login form page
header("Location: Front-Page.php");