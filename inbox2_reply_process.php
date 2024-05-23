<?php
session_start();
require_once('connect_database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have sanitized user inputs for security
    $mid = $_POST['mid'];
    $reply_text = $_POST['reply_text'];
    $type = $_POST['type'];

    if($reply_text == "end" && $type == 0){

        $query = "DELETE FROM Messages WHERE mid = '$mid'";
        $conn->query($query);
        $conn->close();
        header("Location: secretariat_dashboard.php?success=Conversion ended");
        exit();
    }

    // Update the Messages table with the reply
    if($type == '1'){
    $query = "UPDATE Messages SET reply_text = '$reply_text', is_read = '0', reply_date = NOW() WHERE mid = '$mid'";
    } else
        $query = "UPDATE Messages SET reply_text = '$reply_text', is_read = '1', reply_date = NOW() WHERE mid = '$mid'";

    if ($conn->query($query) === FALSE) {
        // Handle query error
        echo "Error in inserting query: " . $conn->error;
        exit(); // Exit the script to avoid further execution
    } else {
        // Close the connection
        $conn->close();

        // Redirect with success message
        header("Location: secretariat_dashboard.php?success=Reply message sent successfully.");
        exit();
    }
} else {
    // Redirect to the user profile page if the form is not submitted
    $conn->close();
    header("Location: secretariat_dashboard.php?error=An error occurred while sending the reply message");
    exit();
}
?>
