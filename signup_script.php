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
            function sanitize_uname($data) {
                $data = filter_var($data, FILTER_SANITIZE_STRING);
                return $data;
            }
            $fname = mysqli_real_escape_string($con, sanitize_uname($_POST['fname']));
            $lname = mysqli_real_escape_string($con, sanitize_uname($_POST['lname']));
            
            if(isset($_POST['phone'])){
                $phone = $_POST['phone'];
                $sql_ins = "insert into users (fname,lname,email,phone,password) values ('$fname','$lname','$email','$phone','$pass');";
            }
            else 
            $sql_ins = "insert into users (fname,lname,email,password) values ('$fname','$lname','$email','$pass');";   
            // echo $name;
            // echo $email;
            // echo $pass;
            $result_ins = mysqli_query($con,$sql_ins);
            $sql_sess = "SELECT * FROM users where email='$email';";
            $num = mysqli_fetch_assoc(mysqli_query($con, $sql_sess));
            session_start();
            $_SESSION['id'] = $num['id'];
            echo "<script>window.location.href='dashboard/dashboard.php';</script>";

        }

    }
}
?>
