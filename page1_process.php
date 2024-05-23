<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPhone = $_POST['newPhone'];
    $newAddress = $_POST['newAddress'];
    $user_id = $_SESSION['user_id'];

    // Update the database with the new phone number and address
    $updateQuery = "UPDATE Student SET phone='$newPhone', address='$newAddress' WHERE sid='$user_id'";

    // Execute the update query
    $updateResult = $conn->query($updateQuery);

    if ($updateResult === false) {
        // Handle query error
        die("Error in update query: " . $conn->error);
    }

    // Redirect back to the user profile page after updating
    $conn->close();
    header("Location: student_interface.php?success=personal info updated successfully for student=$user_id with address: $newAddress and phone: $newPhone");
    exit();
} else {
    // Redirect to the user profile page if the form is not submitted
    $conn->close();
    header("Location: student_interface.php?error=an error occured while updating personal info");
    exit();
}

?>
