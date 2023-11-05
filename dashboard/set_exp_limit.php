<?php
include '../connectDB.php';
session_start();
  // Check if the user has set an expense limit
  if (isset($_POST['expense_lim_btn']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $expenseLimit = $_POST['expense_limit'];    
    // Update expense_limit in the expenses table
    $sql = "UPDATE users SET expense_limit = '$expenseLimit' WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    if($result){
      header("Location: expenses.php");
    }
    

    
  }

?>