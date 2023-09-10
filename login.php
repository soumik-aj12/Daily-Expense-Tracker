<?php
include 'connectDB.php';
if(isset($_GET['captcha'])) $captcha = $_GET['captcha'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-styles.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Daily Expense Tracker</title>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="content">
        <div class="login-container">
            <h1>Login</h1>
            <form action="login_script.php" method="POST">
                <input type="email" placeholder="E-mail" name='email' required>
                <input type="password" placeholder="Password" name='password' required>
                <div class="g-recaptcha" data-sitekey="6Ld6qPYnAAAAAIfs-CyStFk-fDF0l5q_NTml0TuD"></div> 
                <?php
                if(isset($_GET['captcha'])){
                    echo "<p style='color:red;'>Please verify the captcha!</p>";
                    unset($_GET['captcha']);
                }
                ?>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account?</p>
            <a href="signup.php">Signup here</a>
        </div>
    </div>


</body>
</html>