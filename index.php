<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="parts/navbarcss.css">
    <link rel="stylesheet" href="style.css">
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
    if(isset($_POST['info'])){
        $_SESSION['carID']=$_POST["carID"];
        header("location:carinfo.php");
    }
    if(isset($_POST["buy"])){
        $data_sell_contracts = "INSERT INTO sell_contracts (car_id, buyer_name, buyer_email, sale_date, sale_price) VALUES (". $_POST["carID"] .",'". $_SESSION["NAME"] ."', '". $_SESSION["EMAIL"] ."','". date("Y-m-d")."', ". $_POST["carPRICE"] .")";
        if (!mysqli_query($connexion, $data_sell_contracts)) {
            echo "Erreur d'insertion dans 'sell_contracts': " . mysqli_error($connexion) . "<br>";
        }
    }
?>
<center>
<h1> Welcome to the Home Page!</h1>
</center>
<?php
    $sql = "SELECT c.id ,name , model , price , image FROM cars as c JOIN brands as b ON(b.id=c.brand_id)";
    $result = mysqli_query($connexion, $sql);

    if (!$result) {
        // Display an error message if the query fails
        echo "<p>Error executing query: " . mysqli_error($connexion) . "</p>";
    }else {
        echo '<div class="card-container">';
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo'<div class="card">
                        <img src="' .$row['image'] . '" alt="Car Image" class="card-image">
                        <div class="card-content">
                        <form method="post">
                            <h2 class="card-title">' . htmlspecialchars($row['name']) . ' ' . htmlspecialchars($row['model']) . '</h2>
                            <p class="card-price">' . htmlspecialchars($row['price']) . '</p>
                            <p class="card-description">This is a brief description of the card. It provides details about the content shown above.</p>
                            <input type="hidden" name="carID" value="'.$row["id"].'">
                            <input type="hidden" name="carPRICE" value="'.$row["price"].'">
                            <input type="submit" value="More" name="info">
                            <input type="submit" value="BUY!!" name="buy">
                        </form>
                        </div>
                    </div>';
            }
        } else {
            // Display a friendly message if no users are found
            echo "<h1>Where is the car ??.</h1>";
        }
        echo '</div>';
    }
    
?>
</body>
</html>