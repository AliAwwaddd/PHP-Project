<link rel="stylesheet" href="./CSS Files/page6.css">

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');

$uid = $_SESSION['user_id'];

$query = "SELECT * FROM Messages WHERE mid = '$uid'";
$result = $conn->query($query);
if($result->num_rows > 0){

    echo "<div>your Message is the wait list, we will get back to you soon.</div>";
    $conn->close();
    exit();
}

    echo "<h3>Reach out to Managers</h3>";

    echo "<form action='page6.2_process.php' method='post'>";

    echo '<label for="title">Title:</label>';
    echo '<input type="text" name="title" id="title" maxlength="30" placeholder="Enter your Title (30 characters max)">';
    
    echo '<label for="description">Description:</label>';
    echo '<textarea name="description" id="description" rows="4" maxlength="240" placeholder="Enter your message (240 characters max)"></textarea>';

echo "<input type='submit' value='Send Message'>";
echo "</form>";
?>