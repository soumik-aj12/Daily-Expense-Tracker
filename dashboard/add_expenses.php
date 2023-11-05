<div class="btn-group">
    <button type="button" class="open-modal" data-open="modal2">
    <i class="uil uil-rupee-sign"></i>
        Add Expenses </button>
    <div class="modal" id="modal2" data-animation="slideInOutLeft">
        <div class="modal-dialog">
            <header class="modal-header">
                <h1>Add Expense </h1>
                <button class="close-modal" aria-label="close modal" data-close>
                    ✕
                </button>
            </header>
            <section class="modal-content">
                <form action="exp_script.php" method="POST">
                    <div class="input-group">
                        <label for="expense-name">Expense Name</label>
                        <input type="text" id="expense-name" name='expense_name' required>
                    </div>
                    <div class="input-group">
                        <label for="expense-name">Expense Type</label>
                        <input type="text" id="expense-name" name='expense_type' required>
                    </div>
                    <div class="input-group">
                        <label for="expense-amount">Expense Amount ($)</label>
                        <input type="number" id="expense-amount" name='expense_amount' required>
                    </div>
                    <?php
                    $today = date("Y-m-d");
                    $sql_warning = "SELECT SUM(expense_amount) AS total_expense FROM expenses WHERE user_id = '$id' AND date_added = '$today'";
                    $result_warning = mysqli_query($con, $sql_warning);
                    $row_warning = mysqli_fetch_assoc($result_warning);
                    $todayExpense = $row_warning['total_expense'];
                    $remainingLimit = $expenseLimit - $todayExpense;
                    if($remainingLimit < 0){
                        echo '<div style="color:red;font-weight:bold;">You have crossed your expense limit!</div>';
                    }
                    else if ($remainingLimit < 100) {
                        echo '<div style="color:red;font-weight:bold">You are close to your expense limit!</div>';
                    }

                    ?>
                    <button type="submit" class="btn">Add Expense</button>
                </form>
            </section>
        </div>
    </div>