<?php
include 'connectDB.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Daily Expense Tracker</title>
</head>

<body style="margin:0;">
    <?php include "navbar.php"; ?>

    <div class="form">

        <ul class="tab-group">
            <li class="tab active"><a href="#login">Log In</a></li>
            <li class="tab"><a href="#signup">Sign Up</a></li>
        </ul>

        <div class="tab-content">

            <div id="login">
                <h1>Welcome Back!</h1>

                <form action="login_script.php" method="POST">
                    <div class="field-wrap">
                        <label>
                            Email Address<span class="req">*</span>
                        </label>
                        <input type="email" required name='log_email' autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label>
                            Password<span class="req">*</span>
                        </label>
                        <input type="password" required name='log_pass' autocomplete="off" />
                    </div>
                    <div class="field-wrap" id='captcha'>
                        <div class="g-recaptcha" data-sitekey="6Ld6qPYnAAAAAIfs-CyStFk-fDF0l5q_NTml0TuD"></div>
                        <?php
                        if (isset($_GET['captcha'])) {
                            echo "<p style='color:red;'>Please verify the captcha!</p>";
                            unset($_GET['captcha']);
                        }
                        ?>
                    </div>
                    <br>
                    <!-- <p class="forgot"><a href="#">Forgot Password?</a></p> -->

                    <button class="button button-block" name='log_sub'>Log In</button>

                </form>

            </div>

            <div id="signup">
                <h1>Sign Up</h1>
                <form action="signup_script.php" method="POST">

                    <div class="top-row">
                        <div class="field-wrap">
                            <label>
                                First Name<span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" name='fname' />
                        </div>

                        <div class="field-wrap">
                            <label>
                                Last Name<span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" name='lname' />
                        </div>
                    </div>

                    <div class="field-wrap">
                        <label>
                            Email Address<span class="req">*</span>
                        </label>
                        <input type="email" required name='sign_email' />
                        <?php
                        if (isset($_GET['error']) && $_GET['error'] == "error1")
                            echo " <p style='color:red;'>Email already exists! Try logging in!</p>";
                        ?>
                    </div>
                    <div class="field-wrap">
                        <label>
                            Phone
                        </label>
                        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" title="Phone number must be 10 digits">

                    </div>

                    <div class="field-wrap">
                        <label>
                            Password<span class="req">*</span>
                        </label>
                        <input type="password" required name='sign_pass' autocomplete="off" />
                    </div>
                    <div class="field-wrap">
                        <label>
                            Confirm Password<span class="req">*</span>
                        </label>
                        <input type="password" required autocomplete="off" name='cpass' />
                        <?php
                        if (isset($_GET['error']) && $_GET['error'] == "error2")
                            echo "<p style='color:red;'>Your passwords do not match!</p>";
                        ?>
                    </div>

                    <button type="submit" class="button button-block" name='sign_sub'>Signup</button>

                </form>

            </div>
        </div><!-- tab-content -->

    </div> <!-- /form -->
    <script>
        // Check if the URL contains the 'captcha' parameter
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('captcha')) {
            // Remove the 'captcha' parameter after a delay (e.g., 5 seconds)
            setTimeout(() => {
                urlParams.delete('captcha');
                const newUrl = window.location.pathname + urlParams.toString();
                window.history.replaceState({}, document.title, newUrl);
            }, 5000);
        }
        if (urlParams.has('error')) {
            // Remove the 'captcha' parameter after a delay (e.g., 5 seconds)
            setTimeout(() => {
                urlParams.delete('error');
                const newUrl = window.location.pathname + urlParams.toString();
                window.history.replaceState({}, document.title, newUrl);
            }, 5000);
        }
    </script>
    <script src="form.js"></script>
</body>

</html>