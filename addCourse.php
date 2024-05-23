<link rel="stylesheet" href="./CSS Files/addCourse.css">

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}

// echo "<div class='content-container'>"; removed because it affected dark mode
echo "<form action='addCourse_process.php' method='post'>";
echo "<h3>Add Course</h3>";

echo "<label for='teacher'>Teacher:</label>";
echo "<input type='text' id='teacher' name='teacher' placeholder='Enter teacher ID' required>";

echo "<label for='ccode'>Course ID:</label>";
echo "<input type='text' id='ccode' name='cid' placeholder='Enter course id' required>";
echo "<label for='ccode'>Course Code:</label>";
echo "<input type='text' id='ccode' name='ccode' placeholder='Enter course code' required>";

echo "<label for='cname'>Course Name:</label>";
echo "<input type='text' id='cname' name='cname' placeholder='Enter course name' required>";

echo "<label for='hours'>Hours:</label>";
echo "<input type='text' id='hours' name='hours' placeholder='Enter hours' required>";

echo "<label for='credits'>Credits:</label>";
echo "<input type='text' id='credits' name='credits' placeholder='Enter credits' required>";

echo "<label for='semester'>Semester:</label>";
echo "<input type='text' id='semester' name='semester' placeholder='Enter semester' required>";

echo "<input type='submit' value='Add Course'>";
echo "</form>";
// echo "</div>";
?>
