<link rel="stylesheet" href="./CSS Files/addStudent.css">

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}

echo "<form action='addStudent_process.php' method='post'>";
echo "<h3>Insert Student</h3>";
echo "<label for='student_name'>Student ID:</label>";
echo "<input type='text' id='sid' name='sid' placeholder='Enter student ID' required><br>";

echo "<label for='student_name'>Student Name:</label>";
echo "<input type='text' id='student_name' name='student_name' placeholder='Enter student name' required><br>";

echo "<label for='date_of_birth'>Date of Birth:</label>";
echo "<input type='date' id='date_of_birth' name='date_of_birth' required><br>";

echo "<label for='address'>Address:</label>";
echo "<input type='text' id='address' name='address' placeholder='Enter address' required><br>";

echo "<label for='phone'>Phone:</label>";
echo "<input type='tel' id='phone' name='phone' placeholder='Enter phone number' required><br>";

echo "<input type='submit' value='Insert Student'>";
echo "</form>";



?>

