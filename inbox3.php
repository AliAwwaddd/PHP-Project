<link rel="stylesheet" href="./CSS Files/inbox3.css">

<?php

session_start();
require_once('connect_database.php');

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}

// Fetch messages from the Messages table
$query = "SELECT * FROM Messages WHERE is_read = '0' AND type = '1'";
$result = $conn->query($query);

// Check for errors
if (!$result) {
    echo "Error: " . $conn->error;
}

if($result->num_rows == 0){

    echo "<H1> Inbox Empty <H1>";
}

$numMessages = $result->num_rows;

// Display messages
while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<table>";
    echo "<tr><td><strong>Title:</strong> " . $row['title'] . "</td></tr>";
    echo "<tr><td><strong>Type:</strong> " . $row['type'] . "</td></tr>";
    echo "<tr><td><strong>ID:</strong> " . $row['mid'] . "</td></tr>";
    // echo "<BR>";
    echo "<tr><td><strong>Description:</strong> " . $row['description'] . "</td></tr>";
    // echo "<BR>";
    // echo "<strong>Read:</strong> " . ($row['is_read'] ? 'Yes' : 'No') . "<br>";

    // Display existing reply
    if ($row['reply_text']) {
        echo "<tr><td><strong>Replied:</strong> " . $row['reply_text'] . "</td></tr>";
        echo "<tr><td><strong>Reply Date:</strong> " . $row['reply_date'] . "</td></tr>";
    }
    echo "</table>";

    // Reply form
    echo "<form action='inbox3_reply_process.php' method='post'>";
    echo "<input type='hidden' name='mid' value='" . $row['mid'] . "'>";
    echo "<input type='hidden' name='type' value='" . $row['type'] . "'>";
    echo "Reply: <textarea name='reply_text' rows='4' cols='50' maxlength='250'></textarea><br>";
    echo "<input type='submit' value='Reply'>";
    echo "</form>";

    echo "</div>";
    echo "<hr>";
}
$minHeight = max(($numMessages * 60) + 100, 450);
?>

<style>
    #content-container {
        max-width: 800px;
        margin: 50px auto;
        min-height: <?php echo $minHeight; ?>px;
        background-color: #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        box-sizing: border-box;
    }