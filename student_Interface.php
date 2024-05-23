<?php session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: LoginPage.php");
    exit();
}
include_once 'getUserName.php';
$sname = getUserName();
$_SESSION['uname'] = $sname;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sidebar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./CSS Files/studentInterface.css">
    <link rel="stylesheet" href="./CSS Files/darkMode.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <Style>

        /* Style for the container div */
        #content-container .welcome {
            background-color: #3498db;
            /* Set background color */
            color: #fff;
            /* Set text color */
            padding: 10px;
            /* Add some padding for better readability */
            font-family: Arial, sans-serif;
            /* Set font family */
            font-size: 16px;
            /* Set font size */
            text-align: center;
            /* Center-align text */
            border-radius: 5px;
            /* Add rounded corners */
        }

        #content-container {

            /* max-width: 600px; */
            /* margin: 50px auto; */
            /* background-color: #e0e0e0; */
            border-radius: 10px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            padding-top: 70px;
            padding-left: 20px;
            padding-right: 20px;
            box-sizing: border-box;
            /* height: 70px; */
            /* justify-content: center; */
            /*Center the content horizontally */
            /* align-items: center; */
        }
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
                        <a href="#Personalinfo" onclick="loadContent('page1.php')" title="Dashboard" class="tooltip"
                            id="dashboard-link">
                            <img src="assets/user.png" alt="Dashboard">
                            <span class="link hide">Personal info</span>
                            <span class="tooltip__content">Personal info</span>
                        </a>
                    </li>
                    <li>
                        <a href="#Courses" onclick="loadContent('page2.php')" title="Courses" class="tooltip">
                            <img src="assets/book.png" alt="Analytics">
                            <span class="link hide">Courses</span>
                            <span class="tooltip__content">Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="#Marks" onclick="loadContent('page3.php')" title="marks" class="tooltip">
                            <img src="assets/marks.png" alt="marks">
                            <span class="link hide">Marks</span>
                            <span class="tooltip__content">Marks</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="loadContent('page4.php')" title="Enroll Courses" class="tooltip">
                            <img src="assets/learning.png" alt="Funds">
                            <span class="link hide">Enroll Courses</span>
                            <span class="tooltip__content">EnrollCourses</span>
                        </a>
                    </li>
                    <li>
                        <a href="#Inobx" onclick="loadContent('inbox1.php')" title="Inbox" class="tooltip">
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
                            <a href="#help" onclick="loadContent('page6.php')" title="Help" class="tooltip">
                                <img src="assets/help.svg" alt="Help">
                                <span class="link hide">Help</span>
                                <span class="tooltip__content">Help</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings" onclick="loadContent('page5.php')" title="Settings" class="tooltip">
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
            <div class="welcome">
                <?php echo "Welcome " . $_SESSION['uname'] ?>
            </div>

            <fieldset style="margin-top:30px">
                <legend>Log Table</legend>
                <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    ?>
                    <table>
                        <tr>
                            <th> message: </th>
                        </tr>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($_GET['error']); ?>
                            </td>


                        </tr>
                    </table>
                    <?php
                } else {
                    echo htmlspecialchars($_GET['success']);
                }
                ?>
            </fieldset>
        </div>
    </div>
    </div>
    <!-- <input type="checkbox" id="dark-mode-toggle"> enable it to remove console error -->

    <script src="./JS Files/script.js"></script>
    <!-- <script src="./JS Files/darkMode.js"></script> -->
    <script src="darkMode.js"></script>
    <script>
    function loadContent(page) {
        // Use jQuery to load content dynamically
        console.log("Loading content from:", page);
        $("#content-container").load(page, function (response, status, xhr) {
            console.log("Load Status:", status);
            if (status === "error") {
                console.error("Error loading content:", xhr.status, xhr.statusText);
            } else {
                // Call a function to initialize JavaScript for the loaded content
                // initializePageJavaScript();
                // console.log("Error occured 102030");
            }
        });
    }

</script>
</body>
</html>

