


<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}

// Display form for updating phone number and address

echo "<h3>Update Personal Information</h3>";
echo "<form action='page1_process.php' method='post'>";
echo "<label for='newPhone'>New Phone Number:</label>";
echo "<input type='text' id='newPhone' name='newPhone' placeholder='Enter new phone number' required><br>";

echo "<label for='newAddress'>New Address:</label>";
echo "<input type='text' id='newAddress' name='newAddress' placeholder='Enter new address' required><br>";

echo "<input type='submit' value='Update'>";
echo "</form>";

echo "<div class='dark-mode-toggle-container'>";
echo "<input type='checkbox' id='dark-mode-toggle'>";
echo "<label for='dark-mode-toggle'>Dark Mode</label>";
echo "</div>";
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="./CSS Files/page5.css">
<script src="darkMode.js"></script>
