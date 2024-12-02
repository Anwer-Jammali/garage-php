<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="carinfo.css">
    <link rel="stylesheet" href="parts/navbarcss.css">
</head>
<body>
<?php include 'parts/navbar.php'; ?>
<?php
    $serveur = "localhost"; 
    $utilisateur = "root"; 
    $motdepasse = ""; 
    $nom_base = "sayarat_3amek_faouzi";
    
    $connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $nom_base);
    
    if (!$connexion) {
        die("Connexion échouée : " . mysqli_connect_error());
    }
    
    $sql = "SELECT c.id ,name , model , price , image FROM cars as c JOIN brands as b ON(b.id=c.brand_id) WHERE c.id ='" . $_SESSION["carID"] . "'";
    $res = mysqli_query($connexion, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        echo $row["name"] . " " . $row["model"];
    }

?>

</body>
</html>