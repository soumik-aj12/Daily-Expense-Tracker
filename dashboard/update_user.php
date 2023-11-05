<?php
include '../connectDB.php';

// Retrieve the form inputs
if (isset($_POST['update-user-btn'])) {
    $id = $_POST['update-user-id'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
            function sanitize_uname($data) {
                $data = filter_var($data, FILTER_SANITIZE_STRING);
                return $data;
            }
            $sql_phone = "UPDATE users SET fname='$fname', lname='$lname', phone = '$phone' where id = '$id'";
            $result = mysqli_query($con, $sql_phone);
            if ($result) {
                header("Location: user.php?message=6006");
            } else
                echo 'error';

        } else {
            $sql = "UPDATE users SET fname='$fname', lname='$lname' where id = '$id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                header("Location: user.php?message=6006");
            } else
                echo 'error';
        }
}
?>