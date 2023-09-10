<?php
include '../connectDB.php';
session_start();
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
        $sql = "SELECT * from `users` where id = '$id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        // print_r($row);
}
else{
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
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://www.google.com/jsapi"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=REM:wght@700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'REM', sans-serif;
}

:root{
    /* ===== Colors ===== */
    --primary-color: #27ae60;
    --panel-color: #FFF;
    --text-color: #000;
    --black-light-color: #707070;
    --border-color: #e6e5e5;
    --toggle-color: #DDD;
    --box1-color: #90e0b2;
    --box2-color: #beefd3;
    --box3-color: #dfe8e2;
    --title-icon-color: #fff;
    
    /* ====== Transition ====== */
    --tran-05: all 0.5s ease;
    --tran-03: all 0.3s ease;
    --tran-03: all 0.2s ease;
}

body.dark {
    --primary-color: #27ae60;
    --panel-color: #242526;
    --text-color: #27ae60;
    --black-light-color: #27ae60;
    --border-color: #27ae60;
    --toggle-color: #FFF;
    --box1-color: #3A3B3C;
    --box2-color: #3A3B3C;
    --box3-color: #3A3B3C;
    --title-icon-color: #CCC;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

thead {
    background-color: #2ecc71;
    color: white;
}

th, td {
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
.dash-content .chart{
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}
.dash-content .title{
    margin:10px;
}
#chart_div{
    border: 10px solid #27ae60;
    padding: 20px;
    border-radius: 5px;
}
.chart {
    width: 100%; /* Make the chart container 100% of its parent element */
    margin: 0 auto; 
    overflow:hidden;
    padding:10px;
}
@media screen and (max-width: 768px) {
    .chart {
        max-width: 100%; /* Allow the chart to take up the full width */

    }
}

    </style>
    <title>Admin Dashboard Panel</title> 
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
                <li><a href="add_expenses.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Add Expenses</span>
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
$monthlyExpenses = array();

// Process the data
while ($row = mysqli_fetch_assoc($result)) {
    $expenseAmount = $row['expense_amount'];
    $expenseDate = strtotime($row['date_added']);
    $monthYear = date('M Y', $expenseDate);

    // Add the expense amount to the corresponding month
    if (isset($monthlyExpenses[$monthYear])) {
        $monthlyExpenses[$monthYear] += $expenseAmount;
    } else {
        $monthlyExpenses[$monthYear] = $expenseAmount;
    }
}

// Create an array to store all months
$allMonths = array();

// Get the current month
$currentMonth = date('M Y');

// Create data for all available months
foreach ($monthlyExpenses as $month => $expense) {
    $allMonths[] = $month;
}

// Fill in zero expenses for months with no data
$allMonths = array_unique($allMonths);
sort($allMonths);

// Create a data array with all months and their respective expenses
$dataArray = [['Month', 'Expense Amount']];
foreach ($allMonths as $month) {
    $expense = isset($monthlyExpenses[$month]) ? $monthlyExpenses[$month] : 0;
    $dataArray[] = [$month, $expense];
}

// Convert the data to JSON format
$dataJson = json_encode($dataArray);

?>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
        <script type="text/javascript">
google.charts.load('current', { 'packages': ['bar'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $dataJson; ?>);

            var options = {
                title: 'Monthly Expenses',
                hAxis: { title: 'Month' },
                vAxis: { title: 'Expense Amount' },
                chartArea: { width: '80%', height: '70%' },
                colors: ['#2ecc71'],
                bars: 'vertical',
                bar: { groupWidth: '50%' }
            };

            var chart = new google.charts.Bar(document.getElementById('chart_div'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
            
$(window).resize(function(){
  drawChart();
});

}
$(window).resize(function(){
  drawChart();
});

            
    </script>
</head>
<body>
    <div class="chart">
        <!-- <div class="box box1" style="background-color: #2ecc71; text-align: center; width: 100%;">
        </div> -->
        <div id="chart_div" style="width: 100%; height: 400px;"></div>

    </div>

            </div>
            <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Last Three Expenses</span>
                </div>

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
}
else {
    echo "No expenses found.";
}

?>
        </div>
    </section>

    <script src="script.js"></script>

</body>
</html>