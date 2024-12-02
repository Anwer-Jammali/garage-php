<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Navbar with Submit Buttons</title>
  <link rel="stylesheet" href="navbarcss.css">
</head>
<body>
  <nav class="navbar">
    <div class="container">
      <form class="nav-links" action="" method="post">
        <input type="submit" name="home" value="Home">
        <input type="submit" name="services" value="Services">
        <input type="submit" name="contact" value="Contact">
        <?php
          session_start();
          if (isset($_SESSION['ROLE'])) {
            echo "<input type='submit' name='log_out' value='Log out'>";
            if($_SESSION['ROLE']=='Admin'){
              echo "<input type='submit' name='dashboard' value='dashboard'>";
              if(isset($_POST['dashboard'])){
                header('location:dashboard.php');
              }
            }else{
              echo "<input type='submit' name='Acc_info' value='My Account'>";
            }
          } else {
              echo "<input type='submit' name='log_in' value='Log in'>";
          }
          if(isset($_POST["home"])){
            header("location:index.php");
          }
        ?>
      </form>
      <?php
        if(isset($_POST['log_in'])){
          header('location:Log_in.php');
        }
        if(isset($_POST["log_out"])){
          session_destroy();
          header("location:index.php");
        }
      ?>
    </div>
  </nav>
</body>
</html>
