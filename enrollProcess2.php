<?php
session_start();
require_once('connect_database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_SESSION['user_id'];
    $selectedCourses = $_POST["courses"];
    // $counter = $_SESSION['counter'];

   

    // print_r($selectedCourses);

    // Check if the student is already enrolled in any of the selected courses
    foreach ($selectedCourses as $courseName) {
        
        $checkEnrollmentQuery = "SELECT * FROM StudentCourses 
                                 WHERE student = '$studentID' 
                                 AND course = (SELECT cid FROM Course WHERE cname = '$courseName')";
        $existingEnrollment = $conn->query($checkEnrollmentQuery);
        
        if ($existingEnrollment->num_rows > 0) {
            // Redirect back to the enroll page with an error message or handle it as needed
            header("Location: student_Interface.php?error=already_enrolled&course=$courseName");
            exit();
            // echo "##3######";
        }
    }

    // If not already enrolled, insert selected courses into studentCourses table
    foreach ($selectedCourses as $courseName) {
        $insertQuery = "INSERT INTO studentCourses (student, course)
                        VALUES ('$studentID', (SELECT cid FROM Course WHERE cname = '$courseName'))";
        $conn->query($insertQuery);
    }

    // Redirect back to the enroll page or another destination
    header("Location: student_Interface.php?success= Courses enrolled successfully");

    exit();
} else {
    // Handle invalid requests
    header("Location: student_Interface.php?error=400 Bad Request");
    exit("Invalid request");
}

?>