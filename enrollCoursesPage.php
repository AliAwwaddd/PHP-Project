<?php session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sidebar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="studentInterface.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        
        nav {
            z-index: 1;
        }

        .content-container {
            z-index: 0;
            flex: 1;
            padding: 20px 0 0 0;
            /* Adjust padding as needed */
            background-color: #e0e0e0;
            /* Set background color for the right half */
            display: flex;
            flex-direction: column;
            justify-content: center;
            /*Center the content horizontally */
            align-items: center;
            /*Center the content vertically */
            height: 100vh;
        }

        .boxContent p {
            text-align: center;
            font-size: small;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .heading {
            margin-bottom: 15px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
        }

        .box {
            width: 80px;
            height: 80px;
            position: relative;
            margin: 20px;
        }

        .box input {
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            z-index: 20;
        }

        .boxContent {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            height: 100%;
            margin-bottom: 5px;
            position: relative;
        }

        .boxContent::before,
        .boxContent::after {
            content: '';
            position: absolute;
            border-radius: 10px;
        }

        .boxContent::before {
            width: 100%;
            height: 100%;
            background: rgb(255, 255, 255);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.075);
            z-index: -1;
        }

        .boxContent::after {
            width: 115%;
            height: 115%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.050);
            z-index: -2;
        }

        .box input:checked~.boxContent::after {
            background: linear-gradient(to right, #78051c, #78051c);
        }

        .box input:checked:disabled~.boxContent::after {
            background: linear-gradient(to right, #000000, #000100);

        }

        /* Style for unchecked and disabled checkboxes */
        .box input[type="checkbox"]:not(:checked):disabled {
            /* Your styling goes here */
            background: linear-gradient(to right, #FFfFFF, #FFFFFF);
            opacity: 0.7;
            /* Example: reduce opacity for disabled and unchecked checkboxes */
        }


        .box input:checked~.boxContent i,
        .box input:checked~.boxContent p {
            background: linear-gradient(to right, #78051c, #78051c);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }



        /* Increase the font size for better readability */
        .content-container label {

            font-size: 18px;
        }

        /* Add more space between elements */
        .content-container label {

            margin-bottom: 10px;
        }

        /* Increase the font size of the header */
        .content-container h2 {

            font-size: 24px;
        }

        /* Adjust the spacing for the total credits */
        #totalCredits {
            font-size: 24px;
            font-weight: bold;
            /* Add bold for emphasis */
            /* Adjust spacing as needed */
        }

        .tc {
            margin-top: 40px;

        }

        .content-container input[type="submit"] {
            font-size: 18px;
            padding: 5px 14px;
            /* Add padding for a larger button */
            margin-left: 12px;
            margin-top: 40px;
            background-color: #4CAF50;
            /* Green background color */
            color: white;
            /* White text color */
            border: none;
            /* Remove border */
            border-radius: 5px;
            /* Add border-radius for rounded corners */
            cursor: pointer;
            transition: background-color 0.3s;
            /* Add transition for a smooth hover effect */
        }

        .content-container input[type="submit"]:hover {
            background-color: #78051c;
            /* Darker green color on hover */
        }


        /* Additional styles for other elements inside content-container */
    </style>
</head>

<body>
    <div class="wrapper">
        <nav>
            <div class="sidebar-top">
                <a href="#" class="logo__wrapper">
                    <img src="assets/lu.png" alt="Logo" class="logo">
                    <h1 class="hide">Lebanese University</h1>
                </a>
                <div class="expand-btn">
                    <img src="assets/chevron.svg" alt="Chevron">
                </div>
            </div>
            <div class="sidebar-links">
                <ul>
                    <li>
                        <a href="student_interface.php#Personalinfo" title="Dashboard" class="tooltip"
                            id="dashboard-link">
                            <img src="assets/user.png" alt="Dashboard">
                            <span class="link hide">Personal info</span>
                            <span class="tooltip__content">Personal info</span>
                        </a>
                    </li>
                    <li>
                        <a href="student_interface.php#Courses" title="Courses" class="tooltip">
                        <img src="assets/book.png" alt="Analytics">
                            <span class="link hide">Courses</span>
                            <span class="tooltip__content">Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="student_interface.php#Marks" title="marks" class="tooltip">
                        <img src="assets/marks.png" alt="marks">
                            <span class="link hide">Marks</span>
                            <span class="tooltip__content">Marks</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Enroll Courses" class="tooltip">
                        <img src="assets/learning.png" alt="Funds">
                            <span class="link hide">Enroll Courses</span>
                            <span class="tooltip__content">EnrollCourses</span>
                        </a>
                    </li>
                    <li>
                        <a href="student_interface.php#Inbox" title="Inbox" class="tooltip">
                        <img src="assets/inbox.png" alt="Inbox">
                            <span class="link hide">Inbox</span>
                            <span class="tooltip__content">Inbox</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-bottom">
                <div class="sidebar-links">
                    <ul>
                        <li>
                            <a href="#student_interface.php#Help" title="Help" class="tooltip">
                                <img src="assets/help.svg" alt="Help">
                                <span class="link hide">Help</span>
                                <span class="tooltip__content">Help</span>
                            </a>
                        </li>
                        <li>
                            <a href="student_interface.php#Settings" title="Settings" class="tooltip">
                                <img src="assets/settings.svg" alt="Settings">
                                <span class="link hide">Settings</span>
                                <span class="tooltip__content">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="signout.php" title="Sign out" class="tooltip">
                                <img src="assets/signout.png" alt="logout">
                                <span class="link hide">Sign out</span>
                                <span class="tooltip__content">Sign out</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar__profile">
                    <div class="avatar__wrapper">
                        <img class="avatar" src="assets/profile.jpg" alt="Profile">
                        <div class="online__status"></div>
                    </div>
                    <div class="avatar__name hide">

                        <div class="user-name">
                            <?php echo $_SESSION['uname'] ?>
                        </div>
                        <div class="email">
                            <?php echo $_SESSION['user_id'] ?>
                        </div>

                    </div>
                </div>
            </div>
        </nav>


        <div class="content-container" id="content-container">

            <!-- Add more content as needed -->
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
            
                $maxSemester = "S1"; // Assuming the lowest possible semester is "S0"
            
                foreach ($failedCourses as $courseName => $semester) {
                    $number = (int) substr($semester, 1);

                    if ($number > (int) substr($maxSemester, 1)) {
                        $maxSemester = $semester;
                    }
                }

                $number = (int) substr($maxSemester, 1);
                $incrementedNumber = $number + 1;
                if($incrementedNumber == 4) $incrementedNumber++;
                $nextSemester = "S" . $incrementedNumber;

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
                header("Location: student_Interface.php?success=All courses for semester: $nextSemester enrolled successfully");


            } elseif ($eligibilityResult == 0) {
                echo "Sorry, you have failed your second year. You cannot choose any 3rd-year courses.";
            } else {
                // Student is eligible, show the courses for the next semester
                $nextSemesterCourses = getNextSemesterCourses($conn, $eligibilityResult);

                if (!empty($nextSemesterCourses)) {
                    echo "<h2>Available Courses for Next Semester</h2>";
                    echo "<form action='enrollProcess2.php' method='post' style='max-width: 600px; margin: 0 auto;'>";
                    echo "<div class='container'>";
                    
                    // $counter1 = 0;
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

                    // $_SESSION['counter'] = $counter1;


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
                    echo "<div><input type='submit' value='Enroll'></div>";
                    echo "</div>";

                    echo "</form>";
                } else {
                    echo "No courses available for the next semester.";
                }
            }



            $conn->close();


            ?>

            <!-- <div class="div1">TEST</div>
                    <div class="div2">TEST</div>
                    <div class="div3">TEST</div> -->



        </div>




    </div>
    <script>

        // Function to enable disabled checkboxes before form submission
        function enableDisabledCheckboxes() {
            console.log("FRee PAlestine");
            var checkboxes = document.querySelectorAll('.nerdstuff[disabled]:checked');
            checkboxes.forEach(function (checkbox) {
                checkbox.disabled = false;
            });
        }

        // Add an event listener to the form to call the enableDisabledCheckboxes function before submission
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.querySelector('form');
            form.addEventListener('submit', enableDisabledCheckboxes);
        });

    </script>

    <script src="enrollPage.js"></script>
    <script src="script.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> I couldnt have time to do it -->
</body>

</html>