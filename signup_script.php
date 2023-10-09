<?php
include 'connectDB.php';
if(isset($_POST['sign_sub'])){
    $pass = $_POST['sign_pass'];
    $cpass = $_POST['cpass'];
if($pass != $cpass)
{
    header("Location: form.php#signup?error=error2");
}
    else
    {
        $email = $_POST['sign_email'];
        $sql = "SELECT * FROM users where email='$email';";
        $num = mysqli_num_rows(mysqli_query($con, $sql));
        if($num==1){
        header("Location: form.php#signup?error=error1");
        }
        else{
            $id = $_POST['id'];
            $fname = mysqli_real_escape_string($con, $_POST['fname']);
            $lname = mysqli_real_escape_string($con, $_POST['lname']);
            
            // Hash the password securely
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
            if(isset($_POST['phone'])){
                $phone = $_POST['phone'];
                $sql_ins = "insert into users (fname,lname,email,phone,password) values ('$fname','$lname','$email','$phone','$hashedPassword');";
            }
            else 
            $sql_ins = "insert into users (fname,lname,email,password) values ('$fname','$lname','$email','$hashedPassword');";
           
            // echo $name;
            // echo $email;
            // echo $pass;
            $result_ins = mysqli_query($con,$sql_ins);
            session_start();
            $_SESSION['id'] = $id;
            echo "<script>window.location.href='dashboard/dashboard.php';</script>";

        }

    }
}
?>
