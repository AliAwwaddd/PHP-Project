
<html>

<head> </head>

<body>
<?php

$studentID = $_SESSION["user_id"];

$failedCourseNameToCredit = [];
$totalFailedCredits = 0;
$failedCourses = [];


function checkEligibility($conn, $student_id)
{
    global $failedCourseNameToCredit, $totalFailedCredits, $failedCourses;

    $eligibilityQuery = "SELECT MarkRegister.course, Course.credits, Course.semester, Course.cname
        FROM MarkRegister, Course
        WHERE MarkRegister.student = '$student_id' AND MarkRegister.mark < 50 AND MarkRegister.course = Course.cid";

    $eligibilityResult = $conn->query($eligibilityQuery);

    if ($eligibilityResult === false) {
        // Handle the query error, for example:
        die("Error in eligibility query: " . $conn->error);
    }

    while ($eligibility = $eligibilityResult->fetch_assoc()) {
        $failedCourses[$eligibility['course']] = $eligibility['semester'];
        $totalFailedCredits += $eligibility['credits'];
        $failedCourseNameToCredit[$eligibility['cname']] = $eligibility['credits'];
    }

    if (empty($failedCourses)) {
        return 1; // Student passed all courses
    }

    if ($totalFailedCredits >= 30) {
        return 0; // Student failed the year
    }

    return $failedCourses;
}


// Rest of your code remains the same

function getNextSemesterCourses($conn, $failedCourses)
{

    // a method to get the next semester

    $maxSemester = "S1"; // Assuming the lowest possible semester is "S1"

    foreach ($failedCourses as $courseName => $semester) {
        $number = (int) substr($semester, 1);

        if ($number > (int) substr($maxSemester, 1)) {
            $maxSemester = $semester;
        }
    }

    $number = (int) substr($maxSemester, 1);
    $incrementedNumber = $number + 1;
    if(($incrementedNumber%2 )== 0) $incrementedNumber++; // this mean we are in semester 2 of the year
    $nextSemester = "S" . $incrementedNumber;
    // echo $nextSemester;

    // Get courses linked to the failed courses for the next semester
    $nextSemesterCoursesQuery = "SELECT cid, cname, credits
                 FROM Course
                 WHERE semester = '" . $nextSemester . "'";
    $nextSemesterCoursesResult = $conn->query($nextSemesterCoursesQuery);


    $nextSemesterCourses = [];
    while ($row = $nextSemesterCoursesResult->fetch_assoc()) {
        $nextSemesterCourses[] = $row;
    }
    return $nextSemesterCourses;
}

$eligibilityResult = checkEligibility($conn, $studentID);

if ($eligibilityResult == 1) {


    echo "Congratulations! You have passed all your courses. All your next semester courses will be enrolled.";
    $user_id = $_SESSION['user_id'];
    $query = "SELECT semester FROM MarkRegister WHERE student='$user_id' LIMIT 1";
    
   

    $result = $conn->query($query);
    $semester = $result->fetch_assoc();
    $semester = $semester['semester'];
    $number = (int) substr($semester, 1);
    $incrementedNumber = $number + 1;
    if(!($incrementedNumber % 2)) $incrementedNumber++;
    $nextSemester = "S" . $incrementedNumber;


    $query = "SELECT ccode FROM Course WHERE semester = '$nextSemester'";
    $result = $conn->query($query);

    if ($result === false) {
        // Handle the error as needed
        die("Error executing query");
    }

    // Fetch all courses for the specified semester
    while ($row = $result->fetch_assoc()) {
        $ccode = $row['ccode'];
        // Use the same loop variable as in the first loop
        $query2 = "INSERT INTO StudentCourses VALUES ('$user_id','$ccode')";
        $conn->query($query2);
    }
    $conn->close();
    // header("Location: student_Interface.php?success=All courses for semester $nextSemester enrolled successfully");


} elseif ($eligibilityResult == 0) {
    echo "Sorry, you have failed your semester. You cannot choose any courses. you'll have to take all your current semester failed courses.";
} else {
    // Student is eligible, show the courses for the next semester
    $nextSemesterCourses = getNextSemesterCourses($conn, $eligibilityResult);

    if (!empty($nextSemesterCourses)) {
        echo "<h2>Available Courses for Next Semester</h2>";
        echo "<form action='enrollProcess.php' onsubmit='return enableDisabledCheckboxes()' method='post' style='max-width: 600px; margin: 0 auto;'>";
        echo "<div class='container'>";

        $counter1 = 0;
        foreach ($failedCourseNameToCredit as $failedCourse => $credit) {
            $counter1++;
            echo '<div class="box">';
            echo "<input type='checkbox' class='course-checkbox' name='failedCourses[]' value='" . $failedCourse . "' checked disabled data-credits='$credit' failedCNames='" . implode(",", array_keys($failedCourseNameToCredit)) . "' failedCredits ='" . $totalFailedCredits . "'>";
            echo "<div class='boxContent'>";
            echo "<i class='fas fa-music'></i>";
            echo '<p>' . $failedCourse . "</p><p>" . $credit . " credits </p>";
            echo "</div>";
            echo "</div>";
        }

        $_SESSION['counter'] = $counter1;

        foreach ($nextSemesterCourses as $course) {
            echo '<div class="box">';
            echo "<input type='checkbox' class='course-checkbox nerdstuff' name='courses[]' value='" . $course['cname'] . "' data-credits='" . $course['credits'] . "'>";
            echo "<div class='boxContent'>";
            echo "<i class='fas fa-music'></i>";
            echo '<p>' . $course['cname'] . "</p><p> " . $course['credits'] . " credits</p>";
            echo "</div>";
            echo "</div>";
        }

        echo "<div class='tc'>Total Credits: <span id='totalCredits'>$totalFailedCredits</span></div>"; // Display total credits
        // echo "<input type='hidden' name='student_id' value='$studentID'>";

        ?>


<?php
        echo "<div><input type='submit' value='Enroll'></div>";
        echo "</div>";

        echo "</form>";
    } else {
        echo "No courses available for the next semester.";
    }
}
?>

<script>

// Function to enable disabled checkboxes before form submission
function enableDisabledCheckboxes() {
    console.log("FRee PAlestine");
    var checkboxes = document.querySelectorAll('.nerdstuff[disabled]:checked');
    checkboxes.forEach(function (checkbox) {
        checkbox.disabled = false;
    });

    return true;
}



</script>

</body>

</html>
<!-- <script src="./JS Files/enrollPage.js"></script> -->