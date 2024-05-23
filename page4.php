<link rel="stylesheet" href="./CSS Files/enrollCourse.css">

<?php session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');
require('page4.5.php');
?>



<script src="./JS Files/enrollPage.js"></script>