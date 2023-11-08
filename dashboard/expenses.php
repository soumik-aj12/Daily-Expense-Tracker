<?php
include '../connectDB.php';
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * from `users` where id = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $expenseLimit = $row['expense_limit'];
    // print_r($row);
} else {
    echo "<script>window.location.href='../form.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/modal.css">


    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Daily Expense Tracker</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">
                <?php echo $row['fname']; ?>
            </span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="dashboard.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="expenses.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Expenses</span>
                    </a></li>
                <li><a href="user.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">User Profile</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <img src="images/profile.jpg" alt="">
        </div>

        <div class="dash-content" id="add-expense">
            <div class="overview">
                <div class="activity add_expenses">
                    <?php include 'add_expenses.php' ?>

                    <button type="button" class="edit-profile-btn open-modal" data-open="modal_exp_limit">Set Expense
                        Limit</button>

                    <?php
                    if ($expenseLimit != NULL)
                        echo '<div style="color:#2ecc71;font-weight:bold;padding-left:5px;">Current Expense limit:- ₹' . $expenseLimit . '</div>';
                    else
                        echo '<div style="color:red;font-weight:bold;padding-left:5px;">No limit set yet!</div>';
                    echo '
           <div class="modal" id="modal_exp_limit" data-animation="slideInOutLeft">
               <div class="modal-dialog">
                   <header class="modal-header">
                       Update Expense
                       <button class="close-modal" aria-label="close modal" data-close>
                           ✕
                       </button>
                   </header>
                   <section class="modal-content">
                       <form action="set_exp_limit.php" method="post">
                           <div class="input-group">
                               <label for="expense-name">Expense Limit</label>
                               
                               <input type="number" id="expense-name" name="expense_limit" min="100" max="100000" required>
                           </div>
                           <input type="hidden" name="id" value="' . $id . '">
                           <button type="submit" name="expense_lim_btn">Update Expense</button>
                       </form>
                   </section>
               </div>
           </div>
   ';
                    ?>
                </div>

                <div class=" activity">
                    <?php
                    $sql = "SELECT * FROM expenses WHERE user_id = '$id'";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="title">
                            <span class="text">Expenses</span>
                        </div>
    
                        <div class="table-container">
                            <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Type</th>
                                <th>Price</th>
                                <th>Date of Expense</th>
                                <th><th>
                            </tr>
                        </thead>
                        <tbody>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            $expense_Id = $row['expense_id'];
                            $expenseName = $row['expense_name'];
                            $expenseType = $row['expense_type'];
                            $expenseAmount = $row['expense_amount'];
                            $date_added = $row['date_added'];
                            // Delete expense Modal(Also getting the expense id to delete that expense)
                            echo '
                                <div class="modal" id="modal_' . $expense_Id . '"data-animation="slideInOutLeft">
                                    <div class="modal-dialog">
                                        <header class="modal-header">
                                            Delete Expense
                                            <button class="close-modal" aria-label="close modal" data-close>
                                                ✕
                                            </button>
                                        </header>
                                        <section class="modal-content">
                                            <div style="margin-bottom: 20px;">Are you sure you want to delete this expense?</div>
                                            <form action="delete_exp.php" method="post">
                                                <input type="hidden" name="expense_id" value="' . $row['expense_id'] . '">
                                                <button type="submit" name="delete_button" class="del">Yes</button>
                                            </form>
                                            <button class="close-modal" aria-label="close modal" data-close>
                                                No
                                            </button>
                                        </section>
                                    </div>
                                </div>
                        ';

                            // Update expense Modal(Also getting the expense id to delete that expense)
                            echo '
                        <div class="modal" id="modal3_' . $expense_Id . '" data-animation="slideInOutLeft">
                            <div class="modal-dialog">
                                <header class="modal-header">
                                    Update Expense
                                    <button class="close-modal" aria-label="close modal" data-close>
                                        ✕
                                    </button>
                                </header>
                                <section class="modal-content">
                                    <form action="update_exp.php" method="post">
                                        <div class="input-group">
                                            <label for="expense-name">Expense Name</label>
                                            <input type="text" id="expense-name" name="expense_name" value="' . $expenseName . '"required>
                                        </div>
                                        <div class="input-group">
                                            <label for="expense-name">Expense Type</label>
                                            <input type="text" id="expense-name" name="expense_type" value="' . $expenseType . '"required>
                                        </div>
                                        <div class="input-group">
                                            <label for="expense-amount">Expense Amount ($)</label>
                                            <input type="number" id="expense-amount" name="expense_amount" value="' . $expenseAmount . '" min="1" max="100000" required>
                                        </div>
                                        <input type="hidden" name="expense_id" value="' . $row['expense_id'] . '">
                                        <button type="submit" class="btn">Update Expense</button>
                                    </form>
                                </section>
                            </div>
                        </div>
                ';

                            echo '<tr>
                        <td>' . $expenseName . '</td>
                        <td>' . $expenseType . '</td>
                        <td>₹ ' . $expenseAmount . '</td>
                        <td>' . $date_added . '</td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="open-modal" data-open="modal_' . $expense_Id . '">Delete</button>
                      </div>
                        </td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="open-modal" data-open="modal3_' . $expense_Id . '">Update</button>
                      </div>
                        </td>
                     </tr>';
                        }

                        echo '</tbody></table>';
                    } else {

                        echo '<div class="if-no-exp ">
                        <div class="text"><strong>No Expenses yet :(</strong></div>
                    </div>';
                    }

                    ?>
                </div>
            </div>

        </div>
        </div>

    </section>
    <script>
        

    </script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/modal.js"></script>

</body>

</html>