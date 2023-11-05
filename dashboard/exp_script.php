<?php
include '../connectDB.php';
session_start();
$id = $_SESSION['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expenseName = $_POST['expense_name'];
    $expenseType = $_POST['expense_type'];
    $expenseAmount = $_POST['expense_amount'];
    $date_added = date("Y-m-d");
    $sql = "INSERT INTO expenses (user_id, expense_name, expense_type, expense_amount, date_added) 
            VALUES ('$id', '$expenseName', '$expenseType', '$expenseAmount','$date_added');";
    echo $sql;
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>window.location.href='expenses.php';</script>";
     } 
    //else {
    //     echo "Error: " . mysqli_error($con);
    // }
}
?>
