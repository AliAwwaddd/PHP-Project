<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./CSS Files/RegisterStyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script>
    function validatePasswords() {
        var password1 = document.getElementsByName("password1")[0].value;
        var password2 = document.getElementsByName("password2")[0].value;

        if (password1 !== password2) {
            alert("Passwords do not match. Please try again.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
    </script>
</head>

<body>
    <div class="container">
        <div class="title">Registration</div>
        <div class="content">
            <form action="registration_process.php" method="post" onsubmit="return validatePasswords()">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="uname" placeholder="Enter your name" required>
                    </div>
                    <div class=" input-box">
                        <span class="details">User ID</span>
                        <input type="text" name="user_id" placeholder="Enter your LibanPost ID" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Adress</span>
                        <input type="text" name="address" placeholder="Enter your Adress" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" name="phone" placeholder="Enter your number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password1" placeholder="Enter your password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" name="password2" placeholder="Confirm your password" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Birthdate</span>
                        <input type="date" name="bdate" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Role</span>
                        <select name='role' required>
                            <option value="" disabled selected>Select your role</option>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <option value="secretariat">Secretariat</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
</body>

</html>