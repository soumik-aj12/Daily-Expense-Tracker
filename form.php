<?php
include 'connectDB.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/modal.css">
    <script src="assets/js/popup.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Daily Expense Tracker</title>

</head>

<body style="margin:0;">
    <nav class="navbar">
        <div class="logo">
            <a href="#">Daily Expense Tracker</a>
        </div>
        <ul class="nav-items">
            <li><a href="index.php">Home</a></li>
            <li><a href="form.php" class="active">Login/Signup</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
    </nav>

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
                        <input type="email" name='log_email' autocomplete="off" required />
                    </div>

                    <div class="field-wrap">
                        <label>
                            Password<span class="req">*</span>
                        </label>
                        <input type="password" name='log_pass' autocomplete="off" required />
                    </div>
                    <div class="field-wrap" id='captcha'>
                        <div class="g-recaptcha" data-sitekey="6LdJChcoAAAAAKoLQFs5IkQ6sH3wWMr6OhU7le4-"></div>
                    </div>

                    <button class="button button-block" name='log_sub'>Log In</button>

                </form>
                <?php if (isset($_GET['message']) && $_GET['message'] == "incorrect") {
                    echo "<p style='color:red;margin-bottom:-2px;text-align: center;'>Incorrect Email/Password</p>";
                    unset($_GET['message']);
                } else if (isset($_GET['message']) && $_GET['message'] == "captcha_error") {
                    echo "<p style='color:red;margin-bottom:-2px;text-align: center;'>Please verify the captcha!</p>";
                    unset($_GET['message']);
                }

                ?>
                <div class="modal" id="modal_del_user" data-animation="slideInOutLeft">
                    <div class="modal-dialog">
                        <header class="modal-header">
                            <h3>Forgot Password</h3>
                            <button class="close-modal" aria-label="close modal" data-close>
                                ✕
                            </button>
                        </header>
                        <section class="modal-content">
                            <div class="form-div">
                                <form action="otp.php" method="post" autocomplete="off">
                                    <input type="email" id="email" name="otp_email" placeholder="Enter your email:-">
                                    <button type="submit" class="btn" name="confirm_email">Confirm</button>
                                </form>
                                <button class="close-modal" aria-label="close modal" data-close>
                                    Cancel
                                </button>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="forgot_div">
                    <button type="submit" id="forgot-btn" data-open="modal_del_user">Forgot Password</button>
                </div>



            </div>

            <div id="signup">
                <h1>Sign Up</h1>
                <form action="signup_script.php" method="POST">

                    <div class="top-row">
                        <div class="field-wrap">
                            <label id="flabel">
                                First Name<span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" name='fname' readonly
                                onfocus="this.removeAttribute('readonly');" />
                        </div>

                        <div class="field-wrap">
                            <label id="llabel">
                                Last Name<span class="req">*</span>
                            </label>
                            <input type="text" required autocomplete="off" name='lname' readonly
                                onfocus="this.removeAttribute('readonly');" />
                        </div>
                    </div>
                    <span id="name_error"></span>


                    <div class="field-wrap">
                        <label>
                            Email Address<span class="req">*</span>
                        </label>
                        <input type="email" required name='sign_email' readonly
                            onfocus="this.removeAttribute('readonly');" />
                        <?php
                        if (isset($_GET['error']) && $_GET['error'] == "error1") {
                            echo '<script>
                            document.getElementById("login").style.display = "none";
                            document.getElementById("signup").style.display = "block";
                            </script>';
                            echo " <p id='error_p' style='color:red;margin-bottom:-2px;'>Email already exists! Try logging in!</p>";

                        }
                        ?>
                        <span id="email_error"></span>
                    </div>
                    <div class="field-wrap">
                        <label>
                            Phone
                        </label>
                        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}"
                            title="Phone number must be 10 digits" readonly onfocus="this.removeAttribute('readonly');">

                    </div>

                    <div class="field-wrap">
                        <label id="pwd">
                            Password<span class="req">*</span>
                        </label>
                        <input type="password" required name='sign_pass' autocomplete="off" readonly
                            onfocus="this.removeAttribute('readonly');" />
                        <span id="pass_error"></span>

                    </div>
                    <div class="field-wrap">
                        <label id="cpwd">
                            Confirm Password<span class="req">*</span>
                        </label>
                        <input type="password" required autocomplete="off" name='cpass' />
                        <?php
                        if (isset($_GET['error']) && $_GET['error'] == "error2") {
                            echo '<script>
                            document.getElementById("login").style.display = "none";
                            document.getElementById("signup").style.display = "block";
                            </script>';
                            echo "<p id='error_p' style='color:red;margin-bottom:-2px;'>Your passwords do not match!</p>";
                        }
                        ?>
                        <span id="cpass_error"></span>

                    </div>

                    <button type="submit" class="button button-block" id="sign_sub" name='sign_sub'>Signup</button>

                </form>

            </div>
        </div><!-- tab-content -->

    </div> <!-- /form -->

    <?php if (isset($_GET['message']) && $_GET['message'] == 6006) { ?>
        <script>
            swal({
                title: "An email has been sent!",
                icon: "success",
                button: "Okay!",
            });
        </script>
        <?php unset($_GET['message']);
    } ?>


    <?php if (isset($_GET['message']) && $_GET['message'] == 4004) { ?>
        <script>
            swal({
                title: "Email doesn't exist!",
                icon: "error",
                button: "Okay!",
            });
        </script>
        <?php unset($_GET['message']);
    } ?>
    <script>
        var fname = document.querySelector('input[name="fname"]');
        var lname = document.querySelector('input[name="lname"]');
        var email = document.querySelector('input[name="sign_email"]');
        var password = document.querySelector('input[name="sign_pass"]');
        var cpassword = document.querySelector('input[name="cpass"]');


        // Regular expression for email validation
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        function validateEmail() {
            // Validate email
            var error = document.querySelector('#email_error');
            if (!emailRegex.test(email.value)) {
                error.style.color = 'red';
                error.textContent = 'Invalid email format!';
            } else {
                error.textContent = '';
            }
        }

        function validatePassword() {
            // Validate password
            var error = document.querySelector('#pass_error');
            if (password.value.length < 8) {
                error.style.color = 'red';
                error.textContent = 'Password must be at least 8 characters long!';
                document.getElementById('pwd').textContent = "";
                document.querySelector('#sign_sub').disabled = true;

            } else {
                error.textContent = '';
                document.getElementById('pwd').textContent = "Password";
                document.querySelector('#sign_sub').disabled = false;


            }
        }
        function noMatchPassword() {
            // Validate password
            var error = document.querySelector('#cpass_error');
            if (password.value != cpassword.value && password.value != "" && cpassword.value != "") {
                error.style.color = 'red';
                error.textContent = 'Passwords do not match!';
                document.getElementById('cpwd').textContent = "";
                document.querySelector('#sign_sub').disabled = true;

            } else {
                error.textContent = '';
                document.getElementById('cpwd').textContent = "Confirm Password";
                document.querySelector('#sign_sub').disabled = false;


            }
        }
        var error = document.querySelector('#name_error');
        var numberRegex = /\d/;

        function validateName() {
            if (numberRegex.test(fname.value) || numberRegex.test(lname.value)) {
                error.style.color = 'red';
                error.textContent = 'Name cannot contain numbers!';
                document.getElementById('flabel').textContent = "";
                document.getElementById('llabel').textContent = "";
                document.querySelector('#sign_sub').disabled = true;
            } else {
                error.textContent = '';
                document.getElementById('flabel').textContent = "First Name";
                document.getElementById('llabel').textContent = "Last Name";
                document.querySelector('#sign_sub').disabled = false;
            }
        }

        

        // Attach the validation function to the input event
        fname.addEventListener('input', validateName);
        lname.addEventListener('input', validateName);
        email.addEventListener('input', validateEmail);
        password.addEventListener('input', validatePassword);
        cpassword.addEventListener('input', noMatchPassword);

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
        if (urlParams.has('message')) {
            // Remove the 'captcha' parameter after a delay (e.g., 5 seconds)
            setTimeout(() => {
                urlParams.delete('message');
                const newUrl = window.location.pathname + urlParams.toString();
                window.history.replaceState({}, document.title, newUrl);
            }, 5000);
        }
    </script>
    <script src="assets/js/form.js"></script>
    <script src="assets/js/modal.js"></script>


</body>

</html>