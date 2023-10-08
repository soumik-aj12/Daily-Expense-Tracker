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
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://www.google.com/jsapi"></script>
    <script src="chart.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">


    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background-color: #2ecc71;
            color: white;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        thead:hover {
            background-color: #27ae60;
        }

        .dash-content .chart {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .dash-content .title {
            margin: 10px;
        }


        /* #daily_expenses_chart_div,
        #monthly_expenses_chart_div {
            border: 2px solid #27ae60;
            padding: 20px;
            border-radius: 5px;
            width: 100%;
        } */

        .chart-container {
            display: flex;
            gap: 20px;
            /* Adjust the gap size as needed */
        }

        .chart {
            flex: 1;
        }

        @media screen and (max-width: 768px) {
            .chart-container {
                flex-direction: column;
            }

            .chart {
                margin-bottom: 20px;
            }
        }

        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {

            /* Force table to not be like tables anymore */
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
            }

            /*
	Label the data
	*/
            td:nth-of-type(1):before {
                content: "Product Name";
            }

            td:nth-of-type(2):before {
                content: "Product Type";
            }

            td:nth-of-type(3):before {
                content: "Price";
            }

            .modal {
                z-index: 9999;
            }
        }
    </style>
    <title>Admin Dashboard Panel</title>
</head>

<body class="bg-gray">
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
        <?php
        $sql = "SELECT expense_amount, date_added FROM expenses WHERE user_id = '$id'";
        $result = mysqli_query($con, $sql);

        // Initialize an associative array to store monthly totals
        $dailyExpenses = array();
        $monthlyExpensesData = array();

        // Process the data
        while ($row = mysqli_fetch_assoc($result)) {
            $expenseAmount = $row['expense_amount'];
            $expenseDate = strtotime($row['date_added']);
            $dayMonthYear = date('d M Y', $expenseDate);
            $monthYear = date('M Y', $expenseDate);
            if (isset($monthlyExpensesData[$monthYear])) {
                $monthlyExpensesData[$monthYear] += $expenseAmount;
            } else {
                $monthlyExpensesData[$monthYear] = $expenseAmount;
            }
            // Add the expense amount to the corresponding day
            if (isset($dailyExpenses[$dayMonthYear])) {
                $dailyExpenses[$dayMonthYear] += $expenseAmount;
            } else {
                $dailyExpenses[$dayMonthYear] = $expenseAmount;
            }
        }

        // Create an array to store all days
        $allDays = array();
        $allMonths = array();

        // Get the current day
        $currentDay = date('d M Y');
        $currentMonth = date('M Y');

        // Create data for all available days
        foreach ($dailyExpenses as $day => $expense) {
            $allDays[] = $day;
        }
        foreach ($monthlyExpensesData as $month => $expense) {
            $allMonths[] = $month;
        }
        $allMonths = array_unique($allMonths);
        sort($allMonths);
        // Fill in zero expenses for days with no data
        $allDays = array_unique($allDays);
        sort($allDays);

        // Create a data array with all days and their respective expenses
        foreach ($allDays as $day) {
            $expense = isset($dailyExpenses[$day]) ? $dailyExpenses[$day] : 0;
            $dataArray_day[] = [$day, $expense];
        }

        $dataArray_month = [];
        foreach ($allMonths as $month) {
            $expense = isset($monthlyExpensesData[$month]) ? $monthlyExpensesData[$month] : 0;
            $dataArray_month[] = [$month, $expense];
        }

        // Convert the data to JSON format
        $dataJson_day = json_encode($dataArray_day);
        $dataJson_month = json_encode($dataArray_month);
        ?>
        <div class="dash-content">

            <div class="title" style="margin-top: 60px;">
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Dashboard</span>
            </div>

            <div class="chart-container">
                <div class="chart">
                    <canvas id="dailyExpenseBarChart" width="400" height="200"></canvas>
                </div>
                <div class="chart">
                    <canvas id="monthlyExpenseLineChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="title">
                <i class="uil uil-clock-three"></i>
                <span class="text">Last Three Expenses</span>
            </div>
            <div class="table-container">
                <?php
                $sql = "SELECT * FROM expenses WHERE user_id = '$id' ORDER BY expense_id DESC LIMIT 3";

                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Price</th>
                    <th>Date of Expense</th>
                </tr>
            </thead>
            <tbody>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        $expenseName = $row['expense_name'];
                        $expenseType = $row['expense_type'];
                        $expenseAmount = $row['expense_amount'];
                        $date_added = $row['date_added'];
                        echo '<tr>
                <td>' . $expenseName . '</td>
                <td>' . $expenseType . '</td>
                <td>₹ ' . $expenseAmount . '</td>
                <td>' . $date_added . '</td>
              </tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo "No expenses found.";
                }

                ?>
            </div>

        </div>
    </section>
    <script type="text/javascript">
        var dataJsonDay = <?php echo $dataJson_day; ?>;
        var labelsDay = dataJsonDay.map(function(item) {
            return item[0];
        });
        var valuesDay = dataJsonDay.map(function(item) {
            return item[1];
        });

        var dataDay = {
            labels: labelsDay,
            datasets: [{
                label: 'Daily Expenses',
                data: valuesDay,
                backgroundColor: 'rgba(46, 204, 113, 0.5)', // Bar color
                borderColor: 'rgba(46, 204, 113, 1)', // Border color
                borderWidth: 1 // Border width
            }]
        };

        var optionsDay = {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Expense Amount'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Day'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    enabled: true, // Enable tooltips to show data point values on hover
                    mode: 'index',
                    bodyFontSize: 12, // Increase the font size of the tooltip text
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': $' + context.parsed.y;
                        }
                    }
                }
            }
        };

        var ctxDay = document.getElementById('dailyExpenseBarChart').getContext('2d');
        var dailyExpenseBarChart = new Chart(ctxDay, {
            type: 'bar',
            data: dataDay,
            options: optionsDay
        });

        var dataJsonMonth = <?php echo $dataJson_month; ?>;
        dataJsonMonth.sort(function(a, b) {
            return new Date(a[0]) - new Date(b[0]);
        });
        var labelsMonth = dataJsonMonth.map(function(item) {
            return item[0];
        });
        var valuesMonth = dataJsonMonth.map(function(item) {
            return item[1];
        });

        var dataMonth = {
            labels: labelsMonth,
            datasets: [{
                label: 'Monthly Expenses',
                data: valuesMonth,
                borderColor: 'rgba(46, 204, 113, 1)', // Line color
                borderWidth: 2, // Line width
                pointBackgroundColor: 'rgba(46, 204, 113, 1)', // Data point color
                pointRadius: 5, // Data point radius
                fill: false // Disable filling area under the line
            }]
        };

        var optionsMonth = {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Expense Amount'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    enabled: true, // Enable tooltips to show data point values on hover
                    mode: 'index',
                    bodyFontSize: 12, // Increase the font size of the tooltip text
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': $' + context.parsed.y;
                        }
                    }
                }
            }
        };

        var ctxMonth = document.getElementById('monthlyExpenseLineChart').getContext('2d');
        var monthlyExpenseLineChart = new Chart(ctxMonth, {
            type: 'line',
            data: dataMonth,
            options: optionsMonth
        });
        window.addEventListener('resize', function() {
            monthlyExpenseLineChart.resize();
            console.log('Window resized');
            dailyExpenseBarChart.resize();

        });
    </script>
    <script src="script.js"></script>

</body>

</html>