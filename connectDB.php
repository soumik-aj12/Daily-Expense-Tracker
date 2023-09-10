<?php
$hostname = "localhost";
$username = "soumik";
$password = "1234";
$db = "det";
$con = mysqli_connect($hostname, $username, $password,$db);
if (!$con) {
    die('Could not connect');
}
?>