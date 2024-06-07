<?php  
 session_start();  
 if(isset($_SESSION["user"]))  
 {  
      header("location:home.php");  
 } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HYPNOS ADMIN</title>
  <link rel="stylesheet" href="css\styles.css">
</head>
<body>
  <a href="../index.php" class="back"><span> Home </span></a>
  <div class="container">
    <div class="logo">
        <img src="images/hypnos.jpg" alt="logo">
    </div>
    <div id="login">
      <form method="post">
        <fieldset class="clearfix">
          <p><span class="fontawesome-user"></span><input type="text" name="user" placeholder="Username" required></p>
          <p><span class="fontawesome-lock"></span><input type="password" name="pass" placeholder="Password" required></p>
          <p><input type="submit" name="sub" value="Login"></p>
        </fieldset>
      </form>
    </div>
  </div>
  <footer>
    <div class="copy">
      <p>© 2024 HYPNOS. All Rights Reserved</p>
    </div>
  </footer>
</body>
</html>

<?php
   include('db.php');
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusername = mysqli_real_escape_string($con,$_POST['user']);
      $mypassword = mysqli_real_escape_string($con,$_POST['pass']); 
      $sql = "SELECT id FROM login WHERE usname = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count == 1) {
         $_SESSION['user'] = $myusername;
         header("location: home.php");
      }else {
         echo '<script>alert("Your Login Name or Password is invalid") </script>' ;
      }
   }
?>