<?php
session_start();

require_once('connect_database.php');

// Validate and sanitize user inputs
$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
$passwordEntered = $_POST['password'];

// Query the database for the user
$sql = "SELECT * FROM User WHERE user_id = '$user_id'";
$result = $conn->query($sql);

//close conn after getting the data btch
$conn->close();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];

    // Verify the entered password
    if (password_verify($passwordEntered, $hashedPassword)) {
        // Password is correct, create a session for the user
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_type'] = $row['user_type'];

        // Redirect to the appropriate page based on user type
        switch ($_SESSION['user_type']) {
            case 'student':
                header("Location: student_Interface.php");
                break;
            case 'secretariat':
                header("Location: secretariat_dashboard.php");
                break;
            case 'manager':
                header("Location: manager_dashboard.php");
                break;
            default:
                // Redirect to a default page or handle accordingly
                header("Location: default_dashboard.php");
                break;
        }
        exit();
    } else {
        // Incorrect password
        header("Location: LoginPage.php?error=Incorrect password");
        exit();
    }
} else {
    // User not found
    header("Location: LoginPage.php?error=User not found");
    exit();
}



?>