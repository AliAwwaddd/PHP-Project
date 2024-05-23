<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher = $_POST['teacher'];
    $ccode = $_POST['ccode'];
    $cname = $_POST['cname'];
    $hours = $_POST['hours'];
    $credits = $_POST['credits'];
    $semester = $_POST['semester']; // Assuming you have a form field for semester
    $cid = $_POST['cid'];

    echo $teacher . $ccode . $cname . $hours . $credits . $semester . $cid;

    // Check if the teacher exists
    if (!teacherExists($teacher)) {
        header("Location: secretariat_dashboard.php?error=teacher_not_found");
        exit();
    }
    
    // Check if the course already exists
    if (courseExists($ccode)) {
        header("Location: secretariat_dashboard.php?error=course_already_exists");
        exit();
    }
    
    // Insert course if the check passes
    if (insertCourse($cid, $teacher, $ccode, $cname, $hours, $credits, $semester)) {
        
        header("Location: secretariat_dashboard.php?success=course_added");
        exit();
    } else {
        header("Location: secretariat_dashboard.php?error=course_add_failed");
        exit();
    }
} else {
    header("Location: secretariat_dashboard.php?error=400 Bad Request");
    exit("Invalid request");
}
function teacherExists($teacher)
{
    global $conn;
    $query = "SELECT * FROM Teacher WHERE tid = '$teacher'";
    $result = $conn->query($query);
    return $result->num_rows > 0;
}
function courseExists($ccode)
{
    global $conn;
    $query = "SELECT * FROM Course WHERE ccode = '$ccode'";
    $result = $conn->query($query);
    return $result->num_rows > 0;
}

function insertCourse($cid, $teacher, $ccode, $cname, $hours, $credits, $semester)
{
    global $conn;

    
    
    $insertQuery = "INSERT INTO Course (cid, teacher, ccode, cname, `hours`, credits, semester) 
                    VALUES ($cid, '$teacher', '$ccode', '$cname', '$hours', '$credits', '$semester')";

if ($conn->query($insertQuery) === TRUE) {
    return true;
} else {
    return false;
}
}
?>
