<link rel="stylesheet" href="./CSS Files/page1.css">

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');

$user_id = $_SESSION['user_id'];
// Retrieve the user's name from the database
$query = "SELECT * FROM Student WHERE `sid` = '$user_id'";
$result = $conn->query($query);

if ($result === false) {
    // Handle query error
    $conn->close();
    return "Error in query: " . $conn->error;
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['sname'];
    $bdate = $row['bdate'];
    $address = $row['address'];
    $phone = $row['phone'];
    $acquiredCredits = $row['acquiredCredits'];
    $obtainedCourses = $row['obtainedCourses'];

    echo "<ul>";
    echo "<h2>Personal info</h2>";
    echo "<li><strong>Name:</strong> $name</li>";
    echo "<li><strong>Birthdate:</strong> $bdate</li>";
    echo "<li><strong>Address:</strong> $address</li>";
    echo "<li><strong>Phone:</strong> $phone</li>";
    echo "<li><strong>Acquired Credits:</strong> $acquiredCredits</li>";
    echo "<li><strong>Obtained Courses:</strong> $obtainedCourses</li>";
    echo "</ul>";
    // Close the result set
    $result->close();
    // Close the database connection
} else {
    // Close the result set
    $result->close();
    // Close the database connection
    $conn->close();
    // header("Location: student_Interface.php?error=Could not retreive student Info");
}
?>




