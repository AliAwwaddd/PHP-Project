

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST['student_name'];
    $dateOfBirth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $sid = $_POST['sid'];
    
   
    if (insertStudent($sid, $studentName, $dateOfBirth, $address, $phone)) {
        // Redirect to a success page or handle success accordingly
        header("Location: secretariat_dashboard.php?success=student_inserted");
        exit();
    } else {
        // Redirect to an error page or handle the error accordingly
        header("Location: secretariat_dashboard.php?error=student_insert_failed");
        exit();
    }
} else {

    // Handle invalid requests
    header("Location: secretariat_dashboard.php?error=400 Bad Request");
    exit("Invalid request");
}
function insertStudent($sid, $studentName, $dateOfBirth, $address, $phone)
{
    global $conn;

    $insertQuery = "INSERT INTO Student (`sid`, sname, `bdate`, `address`, phone)
                    VALUES ('$sid','$studentName', '$dateOfBirth', '$address', '$phone')";

    if ($conn->query($insertQuery) === TRUE) {
        // Insertion successful
        return true;
    } else {
        // Insertion failed
        return false;
    }
}
?>