<?php
include 'connectDB.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
// if(isset($_POST['submit_otp'])){
//     if($_POST['otp_no']==$_SESSION['otp']){
//         echo "HI i am in";
//         }
//     else{
        
//     }
// }

if (isset($_POST['confirm_email'])) {
    $email = $_POST['otp_email'];
    // echo $email;
    $sql = "SELECT * FROM users where email='$email'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row == 0) {
        header("Location: form.php?email=nein");
    } else {
        $pass = $row['password'];
        include 'password.php';
        $otp_generated = rand(99999, 100000);
        $mail = new PHPMailer();

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'noreply2601@gmail.com';                     //SMTP username
    $mail->Password   = $password;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noreply2601@gmail.com', 'Daily Expense Tracker');
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Daily Expense Tracker : Forgot Password';
    $mail->Body    = 'Your Password is:- <b>'.$pass.'!</b>';

    $mail->send();
    header("Location: form.php?message=6006");   
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    }
}
?>