<?PHP

// Redirect to login page if not logged in
session_start();
if (isset($_SESSION['user_type'])) {

    switch ($_SESSION['user_type']) {
        case 'student':{
            header("Location: student_interface.php");
            exit();}
        case 'secretariat':{
            header("Location: secretariat_dashboard.php");
            exit();}
        case 'manager':{
            header("Location: manager_dashboard.php");
            exit();}
}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS Files/Loginstyle.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <!-- Login Form -->
        <div class="title">Login</div>
        <div class="content">
            <form action="login_process.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">User ID</span>
                        <input type="text" name="user_id" placeholder="Enter your User ID" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>
                <div class="button">
                    <input name="submit" type="submit" value="Login">
                </div>

                <div class="register-link">
                    Don't have an account? <a href="RegistrationPage.php">Register here</a>
                </div>
            </form>
        </div>

    </div>
</body>

</html>