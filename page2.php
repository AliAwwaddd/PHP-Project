<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');


if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: FinalLoginPage.php");
    exit();
}
require_once('connect_database.php');

$studentID = $_SESSION['user_id'];
// Fetch enrolled courses for the student
$enrolledCoursesQuery = "SELECT course
             FROM StudentCourses
             WHERE student = '$studentID'";

$enrolledCoursesResult = $conn->query($enrolledCoursesQuery);
// echo "TEST444";

if ($enrolledCoursesResult === false) {
    // Handle the query error
    die("Error in fetching enrolled courses: " . $conn->error);
}
if ($enrolledCoursesResult->num_rows > 0) {

    echo "<h2>Student Courses:</h2>";
    echo "<table>";
    echo "<tr><th>Course ID</th><th>Course name</th><th>semester</th><th>Passed</th></tr>";
    while ($course = $enrolledCoursesResult->fetch_assoc()) {

        $cid = $course["course"];
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $passed = $_POST['passed'];
            if($passed == "1"){
                
                // echo $passed;
                $passedQuery = "SELECT mark,course FROM MarkRegister WHERE course = '$cid' AND student ='$studentID'";
                $passedCourseResult = $conn->query($passedQuery);
                if ($passedCourseResult === false) {
                    die("Error in passed courses query: " . $conn->error);
                }
                $passedCourse = $passedCourseResult->fetch_assoc();

                if ($passedCourse['mark'] < 50) continue; 

            }else if($passed == "0"){
                
                // echo $passed;
                $passedQuery = "SELECT mark, course FROM MarkRegister WHERE course = '$cid' AND student ='$studentID'";
                $passedCourseResult = $conn->query($passedQuery);
                if ($passedCourseResult === false) {
                    die("Error in passed courses query: " . $conn->error);
                }
                $passedCourse = $passedCourseResult->fetch_assoc();

                if ($passedCourse['mark'] >= 50) continue;
                
            }
            
        }else{
                $passedQuery = "SELECT mark, course FROM MarkRegister WHERE course = '$cid' AND student ='$studentID'";
                $passedCourseResult = $conn->query($passedQuery);
                if ($passedCourseResult === false) {
                    die("Error in passed courses query: " . $conn->error);
                }
                $passedCourse = $passedCourseResult->fetch_assoc();
                $cid2 = $passedCourse['course'];
    
            }


        //  echo $cid2."<BR>";

        $semesterQuery = "SELECT semester FROM Course WHERE cid = '$cid'";
        $semesterQueryResult = $conn->query($semesterQuery);
       
        $semester = $semesterQueryResult->fetch_assoc();
        $semester1 = $semester['semester'];

        $CourseNameQuery = "SELECT cname FROM Course WHERE cid = '$cid'";
        $CourseNameResult = $conn->query($CourseNameQuery);

        $CourseName = $CourseNameResult->fetch_assoc();
        $cname = $CourseName['cname'];

        echo "<tr>";
        echo "<td>" . $cid . "</td>";
        echo "<td>" . $cname . "</td>";
        echo "<td>" . $semester1 . "</td>";
        if ($passedCourse['mark'] >= 50) {
            echo "<td> passed </td>";
        } else {
            echo "<td> No yet</td>";
        }
        echo "</tr>";

    }
    echo "</table>";

    echo "<div id='formContainer'>";

    echo "<form class='getCourses'>";
    echo "<input type='hidden' name='passed' value='1'>";
    echo "<input type='submit' value='passed Courses'>";
    echo "</form>";
    echo "<form class='getCourses'>";
    echo "<input type='hidden' name='passed' value='0'>";
    echo "<input type='submit' value='not passed Courses'>";
    echo "</form>";

    echo "</div>";
} else {
        echo "<p>No Courses found for this student.</p>";
}
$conn->close();

?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Submit form using AJAX
            $(".getCourses").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission
                var formData = $(this).serialize(); // Serialize form data

                // Use AJAX to submit the form data
                $.ajax({
                    type: "POST",
                    url: "page2.php", // Handler script to process the form data
                    data: formData,
                    success: function (response) {
                        // Load the updated content into the container
                        loadContent(response);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error submitting form:", status, error);
                    }
                });
            });
            function loadContent(content) {
                console.log("Loading content...");

                $("#content-container").html(content);
            }

        });


    </script>

<link rel="stylesheet" href="./CSS Files/page2.css">
