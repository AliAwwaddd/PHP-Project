<Style>
        #content-container {
            /* display:flex; */
            max-width: 800px;
            margin: 50px auto;

            background-color: #e0e0e0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
            height: 450px;
        }

        #content-container ul {
            list-style-type: none;
            padding: 0;
        }

        #content-container li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        #content-container li:last-child {
            border-bottom: none;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .content-container input[type="submit"] {
            font-size: 18px;
            padding: 5px 14px;
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

        .content-container h2{

            margin:auto;

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

    // Display form for updating phone number and address
    echo "<h3>Update Contact Information</h3>";
    echo "<form action='page5_process.php' method='post'>";
    echo "<label for='newPhone'>New Phone Number:</label>";
    echo "<input type='text' id='newPhone' name='newPhone' placeholder='Enter new phone number' required><br>";

    echo "<label for='newAddress'>New Address:</label>";
    echo "<input type='text' id='newAddress' name='newAddress' placeholder='Enter new address' required><br>";

    echo "<input type='submit' value='Update'>";
    echo "</form>";

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