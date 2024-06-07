<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location:login.php");
}
include('db.php');
if (isset($_POST['reset_bookings'])) {
    $delete_sql = "DELETE FROM roombook";
    if (mysqli_query($con, $delete_sql)) {
        foreach ($count as $type => $booking_count) {
            $update_room_count_sql = "UPDATE room SET count = $booking_count WHERE type = '$type'";
            if (!mysqli_query($con, $update_room_count_sql)) {
                echo '<script>alert("Failed to update room count for ' . $type . ': ' . mysqli_error($con) . '")</script>';
            }
        }
        echo '<script>alert("All bookings reset."); window.location.href = "home.php";</script>';
        exit();
    } else {
        echo '<script>alert("Failed to reset bookings: ' . mysqli_error($con) . '")</script>';
    }}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HYPNOS HOTEL</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["user"]; ?> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li><a class="active-menu" href="home.php"><i class="fa fa-dashboard"></i> Booking</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a></li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">Booking</h1>
                    </div>
                </div>
                <?php
                $sql = "SELECT * FROM roombook";
                $result = mysqli_query($con, $sql);
                $count = mysqli_num_rows($result);
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"></div>
                                <h4 class="panel-title">
                                <form method="post">
                                    <input type="submit" name="reset_bookings" value="Reset Bookings" class="btn btn-danger">
                                </form>
                                </h4>
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                    <button class="btn btn-default" type="button">
                                                        New Room Bookings <span class="badge"><?php echo $count; ?></span>
                                                    </button>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                            <div class="panel-body">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Number of Rooms</th>
                                                                        <th>Name</th>
                                                                        <th>Email</th>
                                                                        <th>Country</th>
                                                                        <th>Room</th>
                                                                        <th>Bedding</th>
                                                                        <th>Meal</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    while ($row = mysqli_fetch_array($result)) {
                                                                        echo "<tr>
                                                                                <th>{$row['NRoom']}</th>
                                                                                <th>{$row['FName']} {$row['LName']}</th>
                                                                                <th>{$row['Email']}</th>
                                                                                <th>{$row['Country']}</th>
                                                                                <th>{$row['TRoom']}</th>
                                                                                <th>{$row['Bed']}</th>
                                                                                <th>{$row['Meal']}</th>
                                                                                <th>{$row['cin']}</th>
                                                                                <th>{$row['cout']}</th>
                                                                            </tr>";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $rsql = "SELECT * FROM roombook";
                                    $rre = mysqli_query($con, $rsql);
                                    $r = mysqli_num_rows($rre);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom-scripts.js"></script>
</body>
</html>
