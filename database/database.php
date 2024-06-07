<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel";
$con = new mysqli("localhost", "root", "", "hotel",);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?> 