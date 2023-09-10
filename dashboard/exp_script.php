<?php
include '../connectDB.php';
session_start();
$id = $_SESSION['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expenseName = $_POST['expense_name'];
    $expenseType = $_POST['expense_type'];
    $expenseAmount = $_POST['expense_amount'];
    $date_added = $_POST['date_added'];

    $sql = "INSERT INTO expenses (user_id, expense_name, expense_type, expense_amount) 
            VALUES ('$id', '$expenseName', '$expenseType', '$expenseAmount');";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>window.location.href='expenses.php';</script>";
     } 
    //else {
    //     echo "Error: " . mysqli_error($con);
    // }
}
?>
