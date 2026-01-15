<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="welcome">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</h2>
            <p>You have successfully logged in.</p>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </body>
</html>
