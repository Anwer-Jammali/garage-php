<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection Base Donnée</title>
</head>
<body>
    <center>
        <h1>Création du base de données</h1>
<?php
    $serveur = "localhost"; 
    $utilisateur = "root"; 
    $motdepasse = ""; 
    $nom_base = "sayarat_3amek_faouzi";

    $connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $nom_base);

    if (!$connexion) {
        die("Connexion échouée : " . mysqli_connect_error());
    }
    echo "<h1>Connexion réussie à la base de données.</h1><br>";
    
    // Create tables one by one
    $create_brands = "CREATE TABLE IF NOT EXISTS brands (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        country VARCHAR(100) NOT NULL
    )";

    $create_cars = "CREATE TABLE IF NOT EXISTS cars (
        id INT AUTO_INCREMENT PRIMARY KEY,
        model VARCHAR(100) NOT NULL,
        brand_id INT NOT NULL,
        year INT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        image VARCHAR(255),
        FOREIGN KEY (brand_id) REFERENCES brands(id)
    )";

    $create_sell_contracts = "CREATE TABLE IF NOT EXISTS sell_contracts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        car_id INT NOT NULL,
        buyer_name VARCHAR(100) NOT NULL,
        buyer_email VARCHAR(100),
        sale_date DATE NOT NULL,
        sale_price DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (car_id) REFERENCES cars(id)
    )";

    $create_Accounts = "CREATE TABLE IF NOT EXISTS Accounts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Account_name VARCHAR(25) NOT NULL,
        Email VARCHAR(50) NOT NULL,
        Account_Password VARCHAR(25) NOT NULL,
        Account_Role VARCHAR(10) NOT NULL
    )";

    if (mysqli_query($connexion, $create_brands) && 
        mysqli_query($connexion, $create_cars) && 
        mysqli_query($connexion, $create_sell_contracts) && 
        mysqli_query($connexion, $create_Accounts)) {
        echo "Les tables 'cars', 'brands', 'sell_contracts' , 'Accounts' ont été créées avec succès.<br>";
    } else {
        echo "<h2>Erreur de création:</h2> " . mysqli_error($connexion) . "<br>";
    }
    
    // Insert dummy data one by one
    $data_brands = "INSERT INTO brands (name, country) VALUES 
        ('Toyota', 'Japan'), 
        ('Ford', 'USA'), 
        ('BMW', 'Germany')";
    
    $data_cars = "INSERT INTO cars (model, brand_id, year, price, image) VALUES
        ('Camry', 1, 2022, 25000.00, 'images/camry.jpg'),
        ('Mustang', 2, 2021, 55000.00, 'images/mustang.jpg'),
        ('X5', 3, 2023, 70000.00, 'images/x5.jpg')";
    
    $data_sell_contracts = "INSERT INTO sell_contracts (car_id, buyer_name, buyer_email, sale_date, sale_price) VALUES
        (1, 'John Doe', 'john.doe@example.com', '2024-10-15', 24000.00),
        (2, 'Jane Smith', 'jane.smith@example.com', '2024-11-10', 54000.00)";

    if (mysqli_query($connexion, $data_brands)) {
        echo "Données insérées dans 'brands' avec succès.<br>";
    } else {
        echo "Erreur d'insertion dans 'brands': " . mysqli_error($connexion) . "<br>";
    }

    if (mysqli_query($connexion, $data_cars)) {
        echo "Données insérées dans 'cars' avec succès.<br>";
    } else {
        echo "Erreur d'insertion dans 'cars': " . mysqli_error($connexion) . "<br>";
    }

    if (mysqli_query($connexion, $data_sell_contracts)) {
        echo "Données insérées dans 'sell_contracts' avec succès.<br>";
    } else {
        echo "Erreur d'insertion dans 'sell_contracts': " . mysqli_error($connexion) . "<br>";
    }

    // Close the connection
    mysqli_close($connexion);
?>
</center>
</body>
</html>
