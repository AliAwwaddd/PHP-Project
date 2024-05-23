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
    $sid = $_POST['sid'];
    
    
   
    if (secretariatExists($sid, $secretariatName, $dateOfBirth)) {
        if (deleteSecretariat($sid)) {
            // Redirect to a success page or handle success accordingly
            header("Location: manager_dashboard.php?success=Secretariat with id: $sid has been removed successfully");
            // exit();
        } else {
            // Redirect to an error page or handle the error accordingly
            header("Location: manager_dashboard.php?error=Secretariat_deletion_failed");
            exit();
        }
    } else {
        // Redirect to an error page or handle the error accordingly
        header("Location: manager_dashboard.php?error=Secretariat_not_found");
        exit();
    }
} else {
    // Handle invalid requests
    header("Location: manager_dashboard.php?error=400 Bad Request");
    exit("Invalid request");
}

function secretariatExists($sid, $secretariatName, $dateOfBirth)
{
    global $conn;

    $checkQuery = "SELECT * FROM Secretariat WHERE `sid` = '$sid' AND sname = '$secretariatName' AND bdate = '$dateOfBirth' ";
    
    $result = $conn->query($checkQuery);
    
    if ($result->num_rows > 0) {
        // Secretariat exists
        return true;
    } else {
        // Secretariat not found
        return false;
    }
}

function deleteSecretariat($sid)
{
    global $conn;

    // Assuming DeleteSecretariatAndUser is your stored procedure
    $deleteQuery = "CALL DeleteSecretariatAndUser($sid)";

    if ($conn->query($deleteQuery) === TRUE) {
        // Deletion successful
        return true;
    } else {
        // Deletion failed
        return false;
    }
}

?>