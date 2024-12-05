<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit mod</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    session_start();
    $serveur = "localhost"; 
    $utilisateur = "root"; 
    $motdepasse = ""; 
    $nom_base = "sayarat_3amek_faouzi";
    
    $connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $nom_base);
    if(isset($_POST["edit"])){
        $sql = "UPDATE accounts  SET Account_name= '". $_POST["Account_name"] ."' , Email= '". $_POST["Email"] ."' WHERE id ='" . $_SESSION["id"] . "'";
        $res = mysqli_query($connexion, $sql);
        if($res){
            header("location:../Edit.php");
        }
    }
    if (!$connexion) {
        die("Connexion échouée : " . mysqli_connect_error());
    }
    
    $sql = "SELECT  Account_name , Email FROM accounts  WHERE id ='" . $_SESSION["id"] . "'";
    $res = mysqli_query($connexion, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        echo '<form class="simple-form"  method="post">
                <label for="name">Account_name:</label>
                <input type="text" id="Account_name" name="Account_name" value="'. $row["Account_name"] .'">

                <label for="email">Email:</label>
                <input type="text" id="Email" name="Email" value="'. $row["Email"] .'">

                <input type="submit" value="Edit" name="edit">
            </form>';
    }

 
?>

</body>
</html>