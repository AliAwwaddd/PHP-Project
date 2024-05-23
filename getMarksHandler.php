
<link rel="stylesheet" href="./CSS Files/marksHandler.css">

<?php
// Include the necessary database connection or configuration file
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}

require_once('connect_database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['student_id'];
    $semester = $_POST['semester'];

    // Perform necessary database operations based on form data
    $query = "SELECT exam, mark FROM MarkRegister WHERE student = '$userId' AND semester = '$semester'";
    $result = $conn->query($query);

    if ($result === false) {
        die("Error in fetching marks: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Build HTML content for the marks
        echo "<h2>Student Marks:</h2><table><tr><th>Exam ID</th><th>Mark</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['exam'] . "</td><td>" . $row['mark'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        // No marks found
        echo "<p>No marks found for this student.</p>";
    }
    // $conn->close();
}
?>
