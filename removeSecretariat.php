<link rel="stylesheet" href="./CSS Files/removeSecretariat.css">
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}

echo "<form action='removeSecretariat_process.php' method='post'>";
echo "<h3>Remove Secretariat</h3>";
echo "<label for='student_name'>Secretariat ID:</label>";
echo "<input type='text' id='sid' name='sid' placeholder='Enter Secretariat ID' required><br>";

echo "<label for='student_name'>Secretariat Name:</label>";
echo "<input type='text' id='student_name' name='secretariat_name' placeholder='Enter Secretariat name' required><br>";

echo "<label for='date_of_birth'>Date of Birth:</label>";
echo "<input type='date' id='date_of_birth' name='date_of_birth' required><br>";

echo "<input type='submit' value='Remove Secretariat'>";
echo "</form>";



?>

<script src="darkModeToggle.js"></script>