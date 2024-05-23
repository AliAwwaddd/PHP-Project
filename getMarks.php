<link rel="stylesheet" href="./CSS Files/getMarks.css">


<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // header("Location: LoginPage.php");
    exit();
}

echo "<form id='getMarksForm'>";
echo "<h3>Get Marks</h3>";
echo "<label for='student_id'>Student ID:</label>";
echo "<input type='text' id='student_id' name='student_id' placeholder='Enter student ID' required><br>";

echo "<label for='semester'>Semester:</label>";
echo "<input type='text' id='semester' name='semester' placeholder='Enter semester' required><br>";

echo "<input type='submit' value='Get Marks'>";
echo "</form>";
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Submit form using AJAX
            $("#getMarksForm").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission
                var formData = $(this).serialize(); // Serialize form data

                // Use AJAX to submit the form data
                $.ajax({
                    type: "POST",
                    url: "getMarksHandler.php", // Handler script to process the form data
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

