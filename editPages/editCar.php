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
    $serveur = "localhost"; 
    $utilisateur = "root"; 
    $motdepasse = ""; 
    $nom_base = "sayarat_3amek_faouzi";
    
    $connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $nom_base);
    
    if (!$connexion) {
        die("Connexion échouée : " . mysqli_connect_error());
    }
    session_start();
    $sql = "SELECT  model , price  , engine , hp , description FROM cars  WHERE id ='" . $_SESSION["id"] . "'";
    $res = mysqli_query($connexion, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        echo '<form class="simple-form"  method="post">
                <label for="name">model:</label>
                <input type="text" id="name" name="name" value="'. $row["model"] .'">

                <label for="email">engine:</label>
                <input type="text" id="email" name="email" value="'. $row["engine"] .'">

                <label for="age">hp:</label>
                <input type="number" id="age" name="age" value="'. $row["hp"] .'">

                <label for="message">description:</label>
                <textarea id="message" name="message" rows="4">'. $row["description"] .'</textarea>

                <label for="quantity">price:</label>
                <input type="number" id="quantity" name="quantity" value="'. $row["price"] .'">

                <button type="submit">Submit</button>
            </form>';
    }

 
?>
</body>
</html>