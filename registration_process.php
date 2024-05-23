<?php

session_start();

require_once('connect_database.php');

$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
$password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
$role = $_POST['role'];


// transaction kermel fi 7al sar creation lal user bas sar fi meshkle bl creation lal student ywa2f l 3amalie kela. la2no aw2at 3m yn3aml ceation lal user w ma ykon asesan fi Student la ya3ml reference 3 hal User.
$conn->begin_transaction();

try {
    // Insert into User table with user_id set to student_id
    $sql_user = "INSERT INTO User (`user_id`, `password`, `user_type`) VALUES ('$user_id', '$password', '$role')";
    $conn->query($sql_user);

    // Continue with the insertion based on the selected role
    if ($role === 'student') {
        $sname = mysqli_real_escape_string($conn, $_POST['uname']);
        $bdate = $_POST['bdate'];
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        
        // Check if the provided student information matches a record in the Student table
        $check_student_info = "SELECT * FROM Student WHERE sid = '$user_id' AND sname = '$sname' AND phone = '$phone' AND bdate='$bdate'";
        $result_student_info = $conn->query($check_student_info);
        
        if ($result_student_info->num_rows === 1) {
            // Student information matches, proceed with user creation
            $student_data = $result_student_info->fetch_assoc();

             // Check if the student is already associated with a user // mesh darorie bs DOUBLE PROTECTION
            if ($student_data['user_id'] !== null) {
            throw new Exception("Student is already associated with a user");
        }

            // Update the Student table to link the user_id
            $update_student = "UPDATE Student SET user_id = '$user_id' WHERE sid = '$user_id'";
            $conn->query($update_student);
        } else {
            // Student information does not match or student not found
            throw new Exception("Invalid or mismatched Student information");
        }
    } elseif ($role === 'secretariat') {
        $secretariat_id = $_POST['user_id'];
        $secretariat_name = $_POST['uname'];
        $bdate = $_POST['bdate'];
        $phone = $_POST['phone'];

        // Check if the provided secretariat information matches a record in the Secretariat table
        $check_secretariat_info = "SELECT * FROM Secretariat WHERE sid = '$secretariat_id' AND bdate= '$bdate' AND sname = '$secretariat_name' AND phone = '$phone'";
        $result_secretariat_info = $conn->query($check_secretariat_info);

        if ($result_secretariat_info->num_rows === 1) {
            // Secretariat information matches, proceed with user creation
            $secretariat_data = $result_secretariat_info->fetch_assoc();

            // Check if the secretariat is already associated with a user // mesh darorie bs DOUBLE PROTECTION
            if ($secretariat_data['user_id'] !== null) {
                throw new Exception("secretariat is already associated with a user");
            }

            // Update the Secretariat table to link the user_id
            $update_secretariat = "UPDATE Secretariat SET user_id = '$user_id' WHERE sid = '$secretariat_id'";
            $conn->query($update_secretariat);
        } else {
            // Secretariat information does not match or secretariat not found
            throw new Exception("Invalid or mismatched Secretariat information");
        }
    } elseif ($role === 'manager') {
        $manager_id = $_POST['user_id'];
        $manager_name = $_POST['uname'];
        $bdate = $_POST['bdate'];
        $phone = $_POST['phone'];

        // echo ''. $manager_id .' - '. $manager_name . ' - ' . ''. $bdate .' - '. $phone;

        // Check if the provided manager information matches a record in the Manager table
        $check_manager_info = "SELECT * FROM Manager WHERE mid = '$manager_id' AND mname = '$manager_name' AND bdate = '$bdate' AND phone = '$phone'";
        $result_manager_info = $conn->query($check_manager_info);

        if ($result_manager_info->num_rows === 1) {
            // Manager information matches, proceed with user creation
            $manager_data = $result_manager_info->fetch_assoc();

            // Check if the maanger is already associated with a user // mesh darorie bs DOUBLE PROTECTION
            if ($manager_data['user_id'] !== null) {
                throw new Exception("Manager is already associated with a user");
            }

            // Update the Manager table to link the user_id
            $update_manager = "UPDATE Manager SET user_id = '$user_id' WHERE mid = '$manager_id'";
            $conn->query($update_manager);
        } else {
            // Manager information does not match or manager not found
            throw new Exception("Invalid or mismatched Manager information");
        }
    }

    // Commit the transaction
    $conn->commit();
    header("Location: LoginPage.php");
    exit();
} catch (Exception $e) {
    // An error occurred, rollback the transaction
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>