<?php
include '../connectDB.php';

if(isset($_POST['delete_button'])){
    $expense_id = $_POST['expense_id'];
    // echo $expense_id;
    $sql = "DELETE FROM expenses WHERE expense_id = '$expense_id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('Location: expenses.php');
        exit;
    } else {
        echo "Error deleting expense: " . mysqli_error($con);
    }
}
?>
