<?php
include 'connectDB.php';
if(isset($_POST['sign_sub'])){
    $pass = $_POST['sign_pass'];
    $cpass = $_POST['cpass'];
if($pass != $cpass)
{
    header("Location: form.php?error=error2");
}
    else
    {
        $email = $_POST['sign_email'];
        $sql = "SELECT * FROM users where email='$email';";
        $num = mysqli_num_rows(mysqli_query($con, $sql));
        if($num==1){
        header("Location: form.php?error=error1");
        }
        else{
            $id = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            if(isset($_POST['phone'])){
                $phone = $_POST['phone'];
                $sql = "insert into users (fname,lname,email,phone,password) values ('$fname','$lname','$email','$phone','$password');";
            }
            else 
            $sql = "insert into users (fname,lname,email,password) values ('$fname','$lname','$email','$password');";
           
            // echo $name;
            // echo $email;
            // echo $pass;
            $result = mysqli_query($con,$sql);
            session_start();
            $_SESSION['id'] = $id;
            echo "<script>window.location.href='dashboard/dashboard.php';</script>";

        }

    }
}
?>
