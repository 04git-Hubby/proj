<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = $_POST['password'];
    $conpass = $_POST['conpass'];

    if ($password !== $conpass) {
        echo "<script>alert('Passwords do not match'); window.location='register.php';</script>";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $check = mysqli_query($connect, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already exists!'); window.location='register.php';</script>";
        exit;
    }

    $query = "INSERT INTO users (fullname, email, password)
              VALUES ('$fullname', '$email', '$hashedPassword')";

    if (mysqli_query($connect, $query)) {
        echo "<script>alert('Registration successful! Please login.'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($connect);
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
    <title>Register</title>
</head>
<body>
    <div class="wrapper">

        <div class="welcome">
            <h1>Welcome!</h1>
        </div>

        <form class="signup-form" method="POST" action="">
            <h2>Register</h2>

            <div class="signup-box">
                <input type="text" class="input-field" id="fullname" name="fullname" placeholder=" " required autocomplete="off">
                <label for="fullname">Fullname</label>
                <ion-icon name="person-circle-outline"></ion-icon>
            </div>

            <div class="signup-box">
                <input type="email" class="input-field" id="email" name="email" placeholder=" " required autocomplete="off">
                <label for="name">Email</label>
                <span class="icon"><ion-icon name="mail"></ion-icon>
                    </span>
            </div>

            <div class="signup-box">
                <input type="password" name="password" required>
                <label for="password">Password</label>
                <ion-icon id="togglePassword" name="eye-off-outline"></ion-icon>
            </div>
            
            <div class="signup-box">
                <input type="password" name="conpass" required>
                <label for="password">Confirm Password</label>
                <ion-icon id="togglePassword" name="eye-off-outline"></ion-icon>
            </div>

            <div class="signup-box">
                <button type="submit" class="btn">Submit</button>
                <p>Already have an account?<a href="index.php" class="register-link"> Login</a></p>
            </div>
        <form>
        
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