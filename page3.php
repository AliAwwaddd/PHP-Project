<style>

    .content-container {
        flex: 1;
        padding: 20px 0 0 0;
        background-color: #e0e0e0;
        margin: 0px auto;
        display: flex;
        flex-direction: column;
        justify-content: center;

        align-items: center;

    }


    table {

        border-collapse: collapse;
        margin: 0 auto;
        /* This will horizontally center the table within the div */
        width: 70%;
        margin-bottom: 30px;
        /* Adjust the width as needed */
    }
    
    th,
    td {
        border: 1px solid #FFFFFF;
        padding: 8px;
        text-align: left;
    }
    
    th {
        background-color: #f2f2f2;
    }
    
    
    .content-container input[type="submit"] {
            /* margin-right: 700px; */
            font-size: 18px;
            padding: 3px 7px;
            /* Add padding for a larger button */
            margin-left: 12px;
            margin-top: 10px;
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
        
        #formContainer {
            margin-bottom: 100px;
            display: flex;
        }

        /* Add some spacing between the forms */
        .getMarksForm {
            margin-right: 10px;
        }


</style>



<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}
require_once('connect_database.php');



$studentID = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $semester = $_POST['semester'];
        // $sql = "SELECT `sid`, sname, `address`, phone, DATE(bdate) as bdate FROM Student WHERE sid = '$studentID'";
        $markRegisterQuery = "SELECT * FROM MarkRegister WHERE student = '$studentID'  AND semester='$semester'";

    }else{
        $markRegisterQuery = "SELECT * FROM MarkRegister WHERE student = '$studentID'";
        // $sql = "SELECT `sid`, sname, `address`, phone, DATE(bdate) as bdate FROM Student WHERE sid = '$studentID'";
    }
    $markRegisterResult = $conn->query($markRegisterQuery);

if ($markRegisterResult->num_rows > 0) {
    // Display the MarkRegister table in a table format
    echo "<h2>Mark Register:</h2>";
    echo "<table>";
    echo "<tr><th>Course ID</th><th>Course name</th><th>Mark</th><th>Semester</th><th>Date</th><th>Credits</th></tr>";

    while ($markRow = $markRegisterResult->fetch_assoc()) {
        $courseID = $markRow['course'];
        $courseQuery = "SELECT cname, credits, semester FROM Course WHERE ccode = '$courseID'";
        $courseResult = $conn->query($courseQuery);
        $course = $courseResult->fetch_assoc();

        $examID = $markRow['exam'];
        $dateQuery = "SELECT DATE(fromdate) as fromdate FROM Exam WHERE xid = '$examID'";
        $dateResult = $conn->query($dateQuery);
        $date = $dateResult->fetch_assoc();

        echo "<tr>";
        echo "<td>" . $markRow['course'] . "</td>";
        echo "<td>" . $course['cname'] . "</td>";
        echo "<td>" . $markRow['mark'] . "</td>";
        echo "<td>" . $course['semester'] . "</td>";
        echo "<td>" . $date['fromdate'] . "</td>";
        echo "<td>" . $course['credits'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<div id='formContainer'>";
    
    echo "<form class='getMarksForm'>";
    echo "<input type='hidden' name='semester' value='S1'>";
    echo "<input type='submit' value='S1 Marks'>";
    echo "</form>";

    echo "<form class='getMarksForm'>";
    echo "<input type='hidden' name='semester' value='S2'>";
    echo "<input type='submit' value='S2 Marks'>";
    echo "</form>";

    echo "<form class='getMarksForm'>";
    echo "<input type='hidden' name='semester' value='S3'>";
    echo "<input type='submit' value='S3 Marks'>";
    echo "</form>";

    echo "<form class='getMarksForm'>";
    echo "<input type='hidden' name='semester' value='S4'>";
    echo "<input type='submit' value='S4 Marks'>";
    echo "</form>";

    echo "</div>";
} else {
    echo "<p>No marks found for this student.</p>";
}

$conn->close();
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Submit form using AJAX
            $(".getMarksForm").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission
                var formData = $(this).serialize(); // Serialize form data

                // Use AJAX to submit the form data
                $.ajax({
                    type: "POST",
                    url: "page3.php", // Handler script to process the form data
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

