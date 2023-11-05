<?php
include '../connectDB.php';

if (isset($_POST['delete-user-btn'])) {
    $user_id = $_POST['delete-user-id'];
    // echo $expense_id;
    $sql_exp = "DELETE FROM expenses WHERE user_id = '$user_id'";
    $result_exp = mysqli_query($con, $sql_exp);
    if ($result_exp) {
        $sql_user = "DELETE FROM users WHERE id = '$user_id'";
        $result_user = mysqli_query($con, $sql_user);
        if ($result_user) {
            header('Location: ../form.php');
            exit;
        }
    } else {
        echo "Error deleting expense: " . mysqli_error($con);
    }
}