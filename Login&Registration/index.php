<?php
    session_start();
    include("database.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = mysqli_real_escape_string(
            $connect, $_POST['email']
        );

        $password = $_POST['password'];

        $result = mysqli_query(
            $connect, "SELECT * FROM users WHERE email='$email'"
        );

        $user = mysqli_fetch_assoc(
            $result
        );

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header("Location: welcome.php");
            exit;
        } else {
            echo "<script>alert('Invalid email or password!'); window.location='index.php';</script>";
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Sign up</title>
</head>
<body>
    <div class="wrapper">

        <div class="welcome">
            <h1>Welcome!</h1>
        </div>
        
        <form class="signup-form" method="POST" action="">
            <h1>Login</h1>

            <div class="signup-box">
                <input type="text" class="input-field" id="fullname" name="fullname" placeholder=" " required>
                <label for="fullname">Username</label>
                <ion-icon name="person-circle-outline"></ion-icon>
            </div>

            <div class="signup-box">
                <input type="password" class="input-field" id="password" name="password" placeholder=" " required>
                <label for="password">Password</label>
                <ion-icon id="togglePassword" name="eye-off-outline"></ion-icon>
            </div>

            <div class="remember-forgotpass">
                <label><input type="checkbox"> Remember Me</label>
                <a href="#">Forgot Password?</a>
            </div>

            <div class="signup-box">
                <button type="submit" class="btn">Login</button>
            </div>

            <div class="signup-box">
                <div class="login-register">
                    <p>Don't have an account?<a href="register.php" class="register-link"> Register</a></p>
                </div>
            </div>

        </form>
        
    </div>

    <script>
    const passwordField = document.getElementById("password");
    const togglePassword = document.getElementById("togglePassword");

    togglePassword.addEventListener("mouseenter", () => {
        passwordField.type = "text";
        togglePassword.setAttribute("name", "eye-outline");
    });

    togglePassword.addEventListener("mouseleave", () => {
        passwordField.type = "password";
        togglePassword.setAttribute("name", "eye-off-outline");
    });
    </script>
</body>
</html>