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
        $sql = "UPDATE cars  SET model= '". $_POST["model"] ."' , price= ". $_POST["price"] ."  , engine= '". $_POST["engine"] ."' , hp= ". $_POST["hp"] ." , description= '". $_POST["description"] ."' WHERE id ='" . $_SESSION["id"] . "'";
        $res = mysqli_query($connexion, $sql);
        if($res){
            header("location:../Edit.php");
        }
    }
    if (!$connexion) {
        die("Connexion échouée : " . mysqli_connect_error());
    }
    
    $sql = "SELECT  model , price  , engine , hp , description FROM cars  WHERE id ='" . $_SESSION["id"] . "'";
    $res = mysqli_query($connexion, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        echo '<form class="simple-form"  method="post">
                <label for="name">model:</label>
                <input type="text" id="model" name="model" value="'. $row["model"] .'">

                <label for="email">engine:</label>
                <input type="text" id="engine" name="engine" value="'. $row["engine"] .'">

                <label for="age">hp:</label>
                <input type="number" id="hp" name="hp" value="'. $row["hp"] .'">

                <label for="message">description:</label>
                <textarea id="message" name="description" rows="4">'. $row["description"] .'</textarea>

                <label for="quantity">price:</label>
                <input type="number" id="quantity" name="price" value="'. $row["price"] .'">

                <input type="submit" value="Edit" name="edit">
            </form>';
    }

 
?>

</body>
</html>

<!-- end -->