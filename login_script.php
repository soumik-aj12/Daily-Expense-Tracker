<?php
include 'connectDB.php';
if (isset($_POST['g-recaptcha-response'])) {
    // Your reCAPTCHA secret key
    include 'key.php';
    // Get the user's reCAPTCHA response from the form
    $captcha = $_POST['g-recaptcha-response'];

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha");
    $responseKeys = json_decode($response, true);
    // print_r($responseKeys);
    // Check if the response is valid
    if (intval($responseKeys["success"]) !== 1) {
        // reCAPTCHA verification failed, handle accordingly (e.g., show an error message).
         header("Location: form.php#login?captcha=false");
    }
    else{
        unset($_POST['g-recaptcha-response']);
        if (isset($_POST['log_sub'])) {
            $email = $_POST['log_email'];
            $password = $_POST['log_pass'];
            print_r($email);
            // print_r($password);
            $sql = "SELECT * FROM `users` where `email`='$email' and `password` ='$password';";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1) {
                $row = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['loggedin'] = true;
                echo "<script>window.location.href='dashboard/dashboard.php';</script>";
            } else {
                echo 'login failed';
            }
        }
    }
}
