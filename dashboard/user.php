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
    echo "<script>window.location.href='../form.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../assets/js/popup.js"></script>

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/modal.css">


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
        }

        .edit-profile-btn {
            margin: 5px;
            font-size: 1rem;
            font-weight: 600;
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
                $phone = 0;
                if (!empty($row['phone']))
                    $phone = $row['phone'];
                $totalExpenses = 0;
                $sql = "SELECT SUM(expense_amount) AS total_expenses FROM expenses WHERE user_id = '$id'";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    $exp_row = mysqli_fetch_assoc($result);

                    // Store the total expenses in a PHP variable
                    $totalExpenses = $exp_row['total_expenses'];

                    // Output the total expenses
                }
                echo '
                <div class="modal" id="modal_del_user" data-animation="slideInOutLeft">
                                    <div class="modal-dialog">
                                        <header class="modal-header">
                                            <h3>Delete Expense</h3>
                                            <button class="close-modal" aria-label="close modal" data-close>
                                                ✕
                                            </button>
                                        </header>
                                        <section class="modal-content">
                                            <div style="margin-bottom: 20px;">Are you sure you want to delete this account?</div>
                                            <div class="form-div">
                                            <form action="delete_user.php" method="post">
                                                <input type="hidden" name="delete-user-id" value="' . $id . '">
                                                <button type="submit" class="btn" name="delete-user-btn">Yes</button>
                                                </form>
                                                <button class="close-modal" aria-label="close modal" data-close>
                                                No
                                            </button>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                ';
                echo '
                <div class="modal" id="modal_upd_user" data-animation="slideInOutLeft">
                            <div class="modal-dialog">
                                <header class="modal-header">
                                    <h3>Update User</h3>
                                    <button class="close-modal" aria-label="close modal" data-close>
                                        ✕
                                    </button>
                                </header>
                                <section class="modal-content">
                                <div class="form-div">
                                    <form action="update_user.php" method="post">
                                        <div class="input-group">
                                            <label for="expense-name">First Name</label>
                                            <input type="text" name="fname" value="' . $fname . '">
                                        </div>
                                        <div class="input-group">
                                            <label for="expense-name">Last Name</label>
                                            <input type="text" name="lname" value="' . $lname . '">
                                        </div>
                                        <div class="input-group">
                                            <label for="phone">Phone</label>';
                if ($phone != 0) {
                    echo '<input type="tel" id="phone" name="phone" pattern="[0-9]{10}"
                    title="Phone number must be 10 digits" value="' . $phone . '" required>';

                }
                echo '</div>
                                        
                                        <input type="hidden" name="update-user-id" value="' . $id . '">
                                        <button type="submit" class="btn" name="update-user-btn" id="update-user-btn">Update User</button>
                                        <span id="name_error"><span>
                                    </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                ';
                echo '<h2 id="profile-head">User Profile</h2>';
                echo '<div class="profile-info">';
                echo '<p><strong>Username:</strong> ' . $fname . ' ' . $lname . '</p>';
                echo '<p><strong>Email:</strong> ' . $email . '</p>';
                if ($phone != 0)
                    echo '<p><strong>Phone:</strong> ' . $phone . '</p>';
                if ($totalExpenses == 0)
                    echo '<p><strong>No Expenses yet.</strong></p>';
                else
                    echo '<p><strong>Total Expenses:</strong> ₹ ' . $totalExpenses . '</p>';
                echo '<button class="edit-profile-btn open-modal" data-open="modal_upd_user"">Edit Profile</button>';
                echo '
                <button type="submit" class="edit-profile-btn open-modal" data-open="modal_del_user">Delete Profile</button>';
                echo '</div>';
            } else {
                echo "User not found.";
            }

            ?>
        </div>
    </section>
    <?php if (isset($_GET['message']) && $_GET['message'] == 6006) { ?>
        <script>
            swal({
                title: "Details Updated!",
                icon: "success",
                button: "Okay!",
            });
        </script>
        <?php
        unset($_GET['message']);
    } ?>

    <script>
        var fname = document.querySelector('input[name="fname"]');
        var lname = document.querySelector('input[name="lname"]');
        var error = document.querySelector('#name_error');
        var numberRegex = /\d/;

        function validateName() {
            if (numberRegex.test(fname.value) || numberRegex.test(lname.value)) {
                error.style.color = 'red';
                error.textContent = 'Name cannot contain numbers!';
                document.querySelector('#update-user-btn').disabled = true;
            } else {
                error.textContent = '';
                document.querySelector('#update-user-btn').disabled = false;
            }
        }

        fname.addEventListener('input', validateName);
        lname.addEventListener('input', validateName);
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('message')) {
            setTimeout(() => {
                urlParams.delete('message');
                const newUrl = window.location.pathname + urlParams.toString();
                window.history.replaceState({}, document.title, newUrl);
            }, 5000);
        }
    </script>
    <script src="../assets/js/popup.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/modal.js"></script>

</body>

</html>