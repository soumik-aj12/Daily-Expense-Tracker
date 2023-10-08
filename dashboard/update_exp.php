<?php
include '../connectDB.php';

// Retrieve the form inputs
$expenseId = $_POST['expense_id'];
$expenseName = $_POST['expense_name'];
$expenseType = $_POST['expense_type'];
$expenseAmount = $_POST['expense_amount'];

// Perform the update operation
// Assuming you have a database connection established
$sql = "UPDATE expenses SET expense_name = '$expenseName', expense_type = '$expenseType', expense_amount = '$expenseAmount' WHERE expense_id = '$expenseId'";
$result = mysqli_query($con, $sql);

// Check if the update was successful
if ($result) {
    // Redirect the user to the expenses page or display a success message
    header("Location: expenses.php");
    exit();
} else {
    // Handle the case where the update failed
    echo "Failed to update expense. Please try again.";
}
?>