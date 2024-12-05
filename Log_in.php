<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <link rel="stylesheet" href="log_in_style.css">
<div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="#" method="post">
        <input type="text" placeholder="Enter your email" name="l_email">
        <input type="password" placeholder="Enter your password" name="l_pw">
        <input type="submit" class="button" value="Login" name="l_btn">
        <input type="submit" class="cbutton" value="Cancel" name="cancel">
      </form>
      <div class="signup">
        <span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
      </div>
    </div>
    <div class="registration form">
      <header>Signup</header>
      <form action="#" method="post">
        <input type="text" name="s_name" placeholder="Enter your name">
        <input type="text" placeholder="Enter your email" name="s_email">
        <input type="password" placeholder="Create a password" name="s_pw">
        <input type="submit" class="button" value="Signup" name="s_btn">
        <input type="submit" class="button" value="Cancel" name="cancel">
      </form>
      <div class="signup">
        <span class="signup">Already have an account?
         <label for="check">Login</label>
        </span>
      </div>
    </div>
  </div>
  <?php
  //connection a la base 
  $serveur = "localhost"; 
  $utilisateur = "root"; 
  $motdepasse = ""; 
  $nom_base = "sayarat_3amek_faouzi";

  $connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $nom_base);

  if (!$connexion) {
      die("Connexion échouée : " . mysqli_connect_error());
  }
    // traitment for signup
    $Sname=$_POST['s_name']??'';
    $Semail=$_POST['s_email']??'';
    $Spw=$_POST['s_pw']??'';
    if(isset($_POST['s_btn'])){
        $role="User";
        $sql="insert into Accounts (Account_name,Email,Account_Password,Account_Role) values ('$Sname','$Semail','$Spw','$role')";
        if(mysqli_query($connexion,$sql)){
            echo "signup successfull !";
            $sql="SELECT id from Accounts where Email='$Semail' and Account_Password='$Spw' and Account_Role='$role'";
            $res = mysqli_query($connexion, $sql);    
            $row = mysqli_fetch_assoc($res);
            if(mysqli_num_rows($res) == 1) {
            session_start();
            $_SESSION['ID']=$row['id'];
            $_SESSION['ROLE'] = $role;
            $_SESSION['EMAIL'] = $Semail;
            $_SESSION['NAME'] = $Sname;
            }
            header('location:index.php');
        }else {
            echo "<h3 style='color:red;'>error".mysqli_error($connexion)."</h3>";
        }
    }
    // traitment for login
    $lemail=$_POST['l_email']??'';
    $lpw=$_POST['l_pw']??'';
    if(isset($_POST['l_btn'])){
        $sql="SELECT id , account_name , account_role from Accounts where Email='$lemail' and Account_Password='$lpw'";
        $res = mysqli_query($connexion, $sql);
        if(mysqli_num_rows($res) == 1) {
            // 3adih lel dashboard or something
            //session_start();
            //header("");
            session_start();
            $row = mysqli_fetch_assoc($res);
            $_SESSION['ID']=$row['id'];
            $_SESSION["NAME"] = $row['account_name']; // Retrieve account_name
            $_SESSION["ROLE"] = $row['account_role']; // Retrieve account_role
            $_SESSION["EMAIL"] = $lemail;
            header("location:index.php");
            
        }else{
            echo "<h3 style='color:red;'>Il n a pas un(e) utilisateur enregistrer avec ces cordonnée !</h3>";
        }
        
    }

    if(isset($_POST["cancel"])){
        header("location:index.php");
    }
  ?>
</body>
</html>