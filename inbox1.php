<link rel="stylesheet" href="./CSS Files/inbox1.css">

<?php

session_start();
require_once('connect_database.php');

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}

$uid = $_SESSION['user_id'];

// Fetch messages from the Messages table
$query = "SELECT * FROM Messages WHERE mid = '$uid'";
$result = $conn->query($query);

// Check for errors
if (!$result) {

    $conn->close();
    header("Location: student_interface.php?error=$conn->error");
    exit();
}
if($result->num_rows == 0){

    $conn->close();
    echo "<H1> Inbox Empty <H1>";
    exit();
}

// Display messages
while ($row = $result->fetch_assoc()) {


    echo "<div>";
    echo "<table>";
    echo "<tr><td><strong>Title:</strong> " . $row['title'] . "</td></tr>";
    echo "<tr><td><strong>Description:</strong> " . $row['description'] . "</td></tr>";

    // echo "<strong>Type:</strong> " . $row['type'] . "<br>";
    // echo "<strong>ID:</strong> " . $row['mid'] . "<br>";
    // echo "<strong>Read:</strong> " . ($row['is_read'] ? 'Yes' : 'No') . "<br>";

    // Display existing reply
    if ($row['is_read']) {
        // echo "<BR>";
        echo "<tr><td><strong>Replied:</strong> " . $row['reply_text'] . "</td></tr>";
        // echo "<BR>";
        echo "<tr><td><strong>Reply Date:</strong> " . $row['reply_date'] . "</td></tr>";
    }else{
        // echo "<BR>";
        echo "<tr><td><strong>Reply: Pending</strong> </td></tr>";
        
    }
    
    echo "</table>";

    if($row['is_read']){
    // Reply form
   echo "<form action='inbox1_reply_process.php' method='post'>";
   echo "<input type='hidden' name='mid' value='" . $row['mid'] . "'>";
   echo "<input type='hidden' name='type' value='" . $row['type'] . "'>";
   echo "Reply: <textarea name='reply_text' rows='4' cols='50' maxlength='250'></textarea><br>";
   echo "<input type='submit' value='Reply'>";
   echo "</form>";
    }
    echo "</div>";
    echo "<hr>";
}

?>