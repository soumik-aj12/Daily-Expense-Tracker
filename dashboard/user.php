<?php
include '../connectDB.php';
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * from `users` where id = '$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    // print_r($row);
} else {
    echo "<script>window.location.href='../login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* align-items: center; */
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .profile-info {
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .profile-info {
            margin-top: 20px;
        }

        .profile-info p {
            margin: 10px 0;
        }

        .profile-info strong {
            font-weight: bold;
        }

        .profile-info .edit-profile-btn {
            display: inline-block;
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }

        .profile-info .edit-profile-btn:hover {
            background-color: #27ae60;
        }

        /* Add more styles as needed for additional elements or customization */
    </style>
    <title>Daily Expense Tracker</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name"><?php echo $row['fname']; ?></span>
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

        <div class="dash-content profile-info">
        <?php
            $id = $_SESSION['id'];

            $sql = "SELECT * FROM users WHERE id = '$id'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                $totalExpenses = 0;
                $sql = "SELECT SUM(expense_amount) AS total_expenses FROM expenses WHERE user_id = '$id'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $exp_row = mysqli_fetch_assoc($result);

                    // Store the total expenses in a PHP variable
                    $totalExpenses = $exp_row['total_expenses'];

                    // Output the total expenses
                }

                echo '<h2>User Profile</h2>';
                echo '<div class="profile-info">';
                echo '<p><strong>Username:</strong> ' . $fname . ' ' . $lname . '</p>';
                echo '<p><strong>Email:</strong> ' . $email . '</p>';
                if ($totalExpenses == 0) echo '<p><strong>No Expenses yet.</strong></p>';
                else echo '<p><strong>Total Expenses:</strong> ₹ ' . $totalExpenses . '</p>';

                echo '<a class="edit-profile-btn" href="#">Edit Profile</a>';
                echo '</div>';
            } else {
                echo "User not found.";
            }

            ?>            

        </div>
    </section>

    <script src="script.js"></script>
</body>

</html>