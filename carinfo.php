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
        echo "<div class='wrapper'>
	<div class='outer'>
		<div class='content animated fadeInLeft'>
			<span class='bg animated fadeInDown'>".$row["name"]."</span>
			<h1>".$row["model"]."</h1>
			<p>yap yap yapuchinou about the car above , this will be filled by the database's 'description' column in the table 'cars'</p>
			
			<div class='button'>
				<a href='#'>".$row['price']."</a><a class='cart-btn' href='#'><i class='cart-icon ion-bag'></i>ADD TO CART</a>
			</div>
			
		</div>
		<img src='".$row['image']."' width='300px' class='animated fadeInRight'>
	</div>
	<p class='footer'>".$row['image']."</p>
</div>";
    }

 
?>

</body>
</html>