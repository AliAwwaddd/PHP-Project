<?php
session_start();
require_once('connect_database.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have sanitized user inputs for security
    $uid = $_SESSION['user_id'];
    $title = $conn->real_escape_string($_POST['title']); // Escape user input to prevent SQL injection
    $description = $conn->real_escape_string($_POST['description']);
    $type = 1;

    // Insert data into the Messages table
    $query = "INSERT INTO Messages (mid, title, `description`, `type`) VALUES ('$uid','$title', '$description',$type)"; // type 1 mean this message is received from a secretariat
    // Assuming $conn is your mysqli connection
    if ($conn->query($query) === FALSE) {
        // Handle query error
        echo "Error in inserting query: " . $conn->error;
        exit(); // Exit the script to avoid further execution
    } else {
        // Close the connection
        $conn->close();

        // Redirect with success message
        header("Location: secretariat_dashboard.php?success=Message sent successfully.");
        exit();
    }
} else {
    // Redirect to the user profile page if the form is not submitted
    $conn->close();
    header("Location: secretariat_dashboard.php?error=An error occurred while sending the message");
    exit();
}


?>
