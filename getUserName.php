<?php
// session_start();

function getUserName()
{
    require_once('connect_database.php');

    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['user_type'];

    // Define the table and column names based on the user type
    $table_name = "";
    $id_column = "";
    $name_column = "";

    // Set the table and column names based on the user type
    switch ($user_type) {
        case 'student':
            $table_name = "Student";
            $id_column = "sid";
            $name_column = "sname";
            break;

        case 'teacher':
            $table_name = "Teacher";
            $id_column = "tid";
            $name_column = "tname";
            break;

        case 'secretariat':
            $table_name = "Secretariat";
            $id_column = "sid";
            $name_column = "sname";
            break;

        case 'manager':
            $table_name = "Manager";
            $id_column = "mid";
            $name_column = "mname";
            break;

        default:
            return "Invalid user type";
    }

    // Retrieve the user's name from the database
    $query = "SELECT $name_column FROM $table_name WHERE `$id_column` = '$user_id'";
    $result = $conn->query($query);

    if ($result === false) {
        // Handle query error
        $conn->close();
        return "Error in query: unable to get user name" ;
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_name = $row[$name_column];

        // Close the result set
        $result->close();
        // Close the database connection
        $conn->close();

        return $user_name;
    } else {
        // Close the result set
        $result->close();
        // Close the database connection
        $conn->close();

        return "User not found";
    }
}
?>
