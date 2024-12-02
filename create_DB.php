<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connection base donnee</title>
</head>
<body>
    <center>
        <h1>creation du base donnee </h1>
<?php
    
    $serveur = "localhost"; 
    $utilisateur = "root"; 
    $motdepasse = ""; 
    $nom_base = "sayarat_3amek_faouzi";
    
    $connexion = mysqli_connect($serveur, $utilisateur, $motdepasse,$nom_base);

    if (!$connexion) {
        die("Connexion échouée : " . mysqli_connect_error());
    }
    echo "<h1>Connexion réussie à la base de données.</h1><br>";
            
    $data = [
        "INSERT INTO brands (name, country) VALUES 
            ('Toyota', 'Japan'), 
            ('Ford', 'USA'), 
            ('BMW', 'Germany')",
        "INSERT INTO cars (model, brand_id, year, price, image) VALUES
            ('Camry', 1, 2022, 25000.00, 'images/camry.jpg'),
            ('Mustang', 2, 2021, 55000.00, 'images/mustang.jpg'),
            ('X5', 3, 2023, 70000.00, 'images/x5.jpg')",
        "INSERT INTO sell_contracts (car_id, buyer_name, buyer_email, sale_date, sale_price) VALUES
            (1, 'John Doe', 'john.doe@example.com', '2024-10-15', 24000.00),
            (2, 'Jane Smith', 'jane.smith@example.com', '2024-11-10', 54000.00)"
    ];
    
    foreach ($data as $query) {
        if (mysqli_query($connexion, $query)) {
            echo "Data inserted successfully.<br>";
        } else {
            echo "Error inserting data: " . mysqli_error($connexion) . "<br>";
        }
    }
?>
</center>
</body>
</html>