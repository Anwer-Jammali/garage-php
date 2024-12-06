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
    
    if (isset($_POST["buy"])) {
        if (isset($_SESSION["NAME"])) {
            $data_sell_contracts = "INSERT INTO sell_contracts (car_id, buyer_name, buyer_email, sale_date, sale_price) VALUES (" . $_POST["carID"] . ",'" . $_SESSION["NAME"] . "','" . $_SESSION["EMAIL"] . "','" . date("Y-m-d") . "'," . $_POST["carPRICE"] . ")";
            if (!mysqli_query($connexion, $data_sell_contracts)) {
                echo "Erreur d'insertion dans 'sell_contracts': " . mysqli_error($connexion) . "<br>";
            }
        } else {
            header('location:Log_in.php');
        }
    }


    $sql = "SELECT c.id ,name , model , price , image , engine , hp , description FROM cars as c JOIN brands as b ON(b.id=c.brand_id) WHERE c.id ='" . $_SESSION["carID"] . "'";
    $res = mysqli_query($connexion, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        echo "<div class='wrapper'>
	<div class='outer'>
    <form  method='post'>
		<div class='content animated fadeInLeft'>
			<span class='bg animated fadeInDown'>".$row["name"]."</span>
			<h1>".$row["model"]."</h1>
            <br>
            <div class='desc'>
            <h3> Engine : ". $row["engine"] ."</h3>
            <h3> Horse power : ". $row["hp"] ."</h3>
            </div>
			<p>". $row["description"] ."</p>
			<span> Price :".$row['price']." $</span>
            <input type='hidden' name='carPRICE' value='". $row["price"] ."'><input type='hidden' name='carID' value='". $row["id"] ."'>
			<input type='submit' name='buy' value='buy' class='buy'>
	</form>
			
		</div>
		<img src='".$row['image']."' width='300px' class='animated fadeInRight'>
	</div>
</div>";
    }

 
?>


</body>
</html>