<nav class="navbar">
        <div class="logo">
            <a href="#">Daily Expense Tracker</a>
        </div>
        <ul class="nav-items">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="login.php">Login/Signup</a></li>
            <li><a href="#">About</a></li>
        </ul>
    </nav>
<style>
    @import url('https://fonts.googleapis.com/css2?family=REM:wght@700&display=swap');
*{
    font-family: 'REM',sans-serif;
}
    .navbar {
    background-color: #2ecc71;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    color: white;
}

.logo a {
    font-size: 1.5rem;
    font-weight: bold;
    text-decoration: none;
    color: white;
}

.nav-items {
    list-style: none;
    display: flex;
}

.nav-items li {
    margin-left: 15px;
}

.nav-items a {
    text-decoration: none;
    color: white;
}

/* .navbar:hover {
    background-color: #27ae60;
} */

.nav-items li {
    margin-left: 15px;
    transition: transform 0.2s;
}

.nav-items a {
    text-decoration: none;
    color: white;
    transition: color 0.2s;
}

.nav-items li:hover {
    transform: translateY(-3px);
}

.nav-items a:hover {
    color: #ecf0f1;
}

.nav-items .active {
    background-color: #27ae60;
    border-radius: 5px;
    padding: 5px 10px;
}
@media screen and (max-width: 768px) {
    .navbar {
        flex-direction: column;
        align-items: center;
        padding: 10px;
    }

    .nav-items {
        margin-top: 10px;
        flex-direction: column;
        align-items: center;
    }

    .nav-items li {
        margin: 10px 0;
    }

    .content {
        padding: 30px;
    }
}


</style>