<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['student_id'];
    $course = $_POST['course'];
    $exam = $_POST['exam'];
    $mark = $_POST['mark'];
    $semester = $_POST['semester'];

    // Check if the student exists
    if (!studentExists($studentId)) {
        header("Location: secretariat_dashboard.php?error=student_not_found");
        exit();
    }

    // Check if the course exists
    if (!courseExists($course)) {
        header("Location: secretariat_dashboard.php?error=course_not_found");
        exit();
    }

    // Check if the exam exists
    if (!examExists($exam)) {
        header("Location: secretariat_dashboard.php?error=exam_not_found");
        exit();
    }

    // Check if the mark already exists for the given student, course, and exam
    if (markExists($studentId, $course, $exam)) {
        header("Location: secretariat_dashboard.php?error=mark_already_exists");
        exit();
    }

    // Insert marks if all checks pass
    if (insertMarks($studentId, $course, $exam, $mark, $semester)) {
        header("Location: secretariat_dashboard.php?success=marks_inserted");
        exit();
    } else {
        header("Location: secretariat_dashboard.php?error=marks_insert_failed");
        exit();
    }

} else {
    header("Location: secretariat_dashboard.php?error=400 Bad Request");
    exit("Invalid request");
}

function studentExists($studentId)
{
    global $conn;
    $query = "SELECT * FROM Student WHERE sid = '$studentId'";
    $result = $conn->query($query);
    return $result->num_rows > 0;
}

function courseExists($course)
{
    global $conn;
    $query = "SELECT * FROM Course WHERE cid = '$course'";
    $result = $conn->query($query);
    return $result->num_rows > 0;
}

function examExists($exam)
{
    global $conn;
    $query = "SELECT * FROM Exam WHERE xid = '$exam'";
    $result = $conn->query($query);
    return $result->num_rows > 0;
}

function markExists($studentId, $course, $exam)
{
    global $conn;
    $query = "SELECT * FROM MarkRegister WHERE student = '$studentId' AND course = '$course' AND exam = '$exam'";
    $result = $conn->query($query);
    return $result->num_rows > 0;
}

function insertMarks($studentId, $course, $exam, $mark, $semester)
{
    global $conn;

    $insertQuery = "INSERT INTO MarkRegister (student, course, exam, mark, semester) 
    VALUES ('$studentId', '$course', '$exam', '$mark', '$semester')";

    // Marks inserted successfully, now log the action
    $logTimestamp = date('Y-m-d H:i:s');
    $logAction = 'InsertMarks';
    $user_id = $_SESSION['user_id'];
    $logDetails = "Marks inserted by secretariat $user_id for student with ID $studentId Exam: $exam, Mark: $mark, Semester: $semester";

    // Insert into the log table
    $logQuery = "INSERT INTO LogTable (`message`, `timestamp`) 
                         VALUES ('$logDetails', '$logTimestamp')";
    if ($conn->query($logQuery) === TRUE) {
        echo'true';
    } else {

        echo "Error inserting log entry: ";
    }


    if ($conn->query($insertQuery) === TRUE) {

        return true;
    } else {
        return false;
    }
}
?>