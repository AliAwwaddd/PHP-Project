<link rel="stylesheet" href="./CSS Files/addMarks2.css">


<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}

echo "<form action='addMarks2_process.php' method='post'>";
echo "<h3>Insert new Marks</h3>";
echo "<label for='student_id'>Student ID:</label>";
echo "<input type='text' id='student_id' name='student_id' placeholder='Enter student ID' required><br>";

echo "<label for='course'>Course:</label>";
echo "<input type='text' id='course' name='course' placeholder='Enter course' required><br>";

echo "<label for='exam'>Exam:</label>";
echo "<input type='text' id='exam' name='exam' placeholder='Enter exam name' required><br>";

echo "<label for='mark'>Mark:</label>";
echo "<input type='text' id='mark' name='mark' placeholder='Enter mark' required><br>";

echo "<label for='semester'>Semester:</label>";
echo "<input type='text' id='semester' name='semester' placeholder='Enter semester' required><br>";

echo "<input type='submit' value='update Mark'>";
echo "</form>";
?>

