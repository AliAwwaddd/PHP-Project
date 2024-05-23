<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $secretariatName = $_POST['secretariat_name'];
    $dateOfBirth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $sid = $_POST['sid'];


    if (secretariatExists($sid)) {
        // Secretariat already exists, handle accordingly (e.g., show an error message)
        header("Location: manager_dashboard.php?error=Secretariat with ID: $sid already exists");
        exit();
    } else {
        // Secretariat doesn't exist, proceed with insertion
        if (insertSecretariat($sid, $secretariatName, $dateOfBirth, $address, $phone)) {
            // Redirect to a success page or handle success accordingly
            header("Location: manager_dashboard.php?success=Secretariat_inserted");
            exit();
        } else {
            // Redirect to an error page or handle the error accordingly
            header("Location: manager_dashboard.php?error=Secretariat_insert_failed");
            exit();
        }
    }
} else {
    // Handle invalid requests
    header("Location: manager_dashboard.php?error=400 Bad Request");
    exit("Invalid request");
}

function secretariatExists($sid)
{
    global $conn;

    $checkQuery = "SELECT * FROM Secretariat WHERE `sid` = '$sid'";
    
    $result = $conn->query($checkQuery);
    
    if ($result->num_rows > 0) {
        // Secretariat exists
        return true;
    } else {
        // Secretariat not found
        return false;
    }
}

function insertSecretariat($sid, $secretariatName, $dateOfBirth, $address, $phone)
{
    global $conn;

    $insertQuery = "INSERT INTO Secretariat (`sid`, sname, `bdate`, `address`, phone)
                    VALUES ('$sid','$secretariatName', '$dateOfBirth', '$address', '$phone')";

    if ($conn->query($insertQuery) === TRUE) {
        // Insertion successful
        return true;
    } else {
        // Insertion failed
        return false;
    }
}
?>