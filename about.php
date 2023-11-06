<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Daily Expense Tracker - About Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            align-items: center;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: center;
            padding: 10px 0;
            justify-content: space-around;
            align-items: center;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <a href="#">Daily Expense Tracker</a>
        </div>
        <ul class="nav-items">
            <li><a href="index.php">Home</a></li>
            <li><a href="form.php">Login/Signup</a></li>
            <li><a href="about.php" class="active">About</a></li>
        </ul>
    </nav>

    <div class="container">
        <div id="about-us">
            <h1>About Daily Expense Tracker</h1>
            <p>Daily Expense Tracker is a web application designed to help users manage their daily expenses. It
                provides a simple and intuitive interface for users to record their expenses and view detailed reports.
                With Daily Expense Tracker, you can keep track of your spending habits and make informed decisions about
                your finances.
            </p>
        </div>
    </div>

    </div>

    <footer>
        <span>Made by Soumik Sil with ❤️!</span>
        <span>&copy; <span id="year-span"></span> Silco. All rights reserved.</span>
        <span>
            Reach Me:
            <a href="mailto:soumiksilco@gmail.com"><i class="uil uil-envelope-upload"></i></a>
            <a href="https://www.linkedin.com/in/soumiksil/"><i class="uil uil-linkedin"></i></a>
            <a href="https://github.com/soumik-aj12"><i class="uil uil-github"></i></a>
        </span>
    </footer>
    <script>
        var today = new Date();
        var year = today.getFullYear();
        document.getElementById("year-span").textContent = year;


    </script>
</body>

</html>