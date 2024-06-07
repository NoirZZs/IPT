<?php
include('../database/database.php');
$con = new mysqli("localhost", "root", "", "hotel",);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?> 