<?php
include '../connectDB.php';

if (isset($_POST['delete-all-exp-btn'])) {
    $user_id = $_POST['delete-user-id'];
    // echo $expense_id;
    $sql_exp = "DELETE FROM expenses WHERE user_id = '$user_id'";
    $result = mysqli_query($con, $sql_exp);
    if ($result) {
        header("Location: expenses.php");
        exit;
    }
    else {
        header("Location: expenses.php?error=unknown_error");
    }
        
}