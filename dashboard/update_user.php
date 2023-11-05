<?php
include '../connectDB.php';

// Retrieve the form inputs
if (isset($_POST['update-user-btn'])) {
    $id = $_POST['update-user-id'];
    $email = $_POST['email'];
    $sql_exists = "SELECT * FROM users WHERE id = '$id';";
    $result_exists = mysqli_query($con, $sql_exists);
    if (mysqli_num_rows($result_exists) != 0) {
        header("Location: user.php?message=exists");
    } else {
        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
            $sql_phone = "UPDATE users SET email = '$email', phone = '$phone' where id = '$id'";
            $result = mysqli_query($con, $sql_phone);
            if ($result) {
                header("Location: user.php");
            } else
                echo 'error';

        } else {
            $sql = "UPDATE users SET email = '$email' where id = '$id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
                header("Location: user.php");
            } else
                echo 'error';
        }
    }
}
?>