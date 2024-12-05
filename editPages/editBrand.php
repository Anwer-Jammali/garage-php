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
        $sql = "UPDATE brands  SET name= '". $_POST["name"] ."', country= '". $_POST["country"] ."'  WHERE id ='" . $_SESSION["id"] . "'";
        $res = mysqli_query($connexion, $sql);
        if($res){
            header("location:../Edit.php");
        }
    }
    if (!$connexion) {
        die("Connexion échouée : " . mysqli_connect_error());
    }
    
    $sql = "SELECT  name , country  FROM brands  WHERE id ='" . $_SESSION["id"] . "'";
    $res = mysqli_query($connexion, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        echo '<form class="simple-form"  method="post">
                <label for="name">name:</label>
                <input type="text" id="name" name="name" value="'. $row["name"] .'">

                <label for="email">country:</label>
                <input type="text" id="country" name="country" value="'. $row["country"] .'">

                <input type="submit" value="Edit" name="edit">
            </form>';
    }

 
?>

</body>
</html>