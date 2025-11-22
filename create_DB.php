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
            id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(100) NULL,
            country VARCHAR(100) NULL,
            PRIMARY KEY (id)
        );
    ";

    $create_cars = "CREATE TABLE IF NOT EXISTS cars (
            id INT(11) NOT NULL AUTO_INCREMENT,
            model VARCHAR(100) NULL,
            brand_id INT(11) NULL,
            Engine VARCHAR(25) NULL,
            hp INT(4) NULL,
            Description TEXT NULL,
            year INT(11) NULL,
            price DECIMAL(10,2) NULL,
            image VARCHAR(255) NULL,
            PRIMARY KEY (id),
            INDEX (brand_id),
            CONSTRAINT fk_cars_brands
                FOREIGN KEY (brand_id)
                REFERENCES brands (id)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
        );
    ";

    $create_sell_contracts = "CREATE TABLE IF NOT EXISTS sell_contracts (
            id INT(11) NOT NULL AUTO_INCREMENT,
            car_id INT(11) NULL,
            buyer_name VARCHAR(100) NULL,
            buyer_email VARCHAR(100) NULL,
            sale_date DATE NULL,
            sale_price DECIMAL(10,2) NULL,
            PRIMARY KEY (id),
            INDEX (car_id),
            CONSTRAINT fk_contracts_cars
                FOREIGN KEY (car_id)
                REFERENCES cars (id)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
        );
    ";

    $create_Accounts = "CREATE TABLE IF NOT EXISTS accounts (
            id INT(11) NOT NULL AUTO_INCREMENT,
            Account_name VARCHAR(25) NULL,
            Email VARCHAR(50) NULL,
            Account_Password VARCHAR(25) NULL,
            Account_Role VARCHAR(10) NULL,
            PRIMARY KEY (id)
        );
    ";

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
        ('BMW', 'Germany'),
        ('Mercedes-Benz', 'Germany'),
        ('Honda', 'Japan'),
        ('Hyundai', 'South Korea'),
        ('Chevrolet', 'USA'),
        ('Kia', 'South Korea'),
        ('Audi', 'Germany');";
    
    $data_cars = "INSERT INTO cars (model, brand_id, Engine, hp, Description, year, price, image) VALUES
        ('Camry', 1, 'V6', 300, 'A reliable sedan', 2022, 30000.00, 'images/camry.png'),
        ('Mustang', 2, 'V8', 450, 'A powerful sports car', 2023, 50000.00, 'images/mustang.jpg'),
        ('X5', 3, 'Turbo', 400, 'Luxury SUV', 2023, 60000.00, 'images/x5.jpg'),
        ('Corolla', 1, 'I4', 140, 'A compact sedan known for its excellent fuel economy, reliability, and affordability. A perfect car for daily commuting.', 2022, 20000.00, 'images/corolla.jpg'),
        ('Supra', 1, 'Turbo I6', 382, 'A high-performance sports car with a sleek design, powerful engine, and exceptional handling. Ideal for enthusiasts.', 2023, 50000.00, 'images/supra.jpg'),
        ('F-150', 2, 'V6', 290, 'A versatile and powerful pickup truck, perfect for work, towing, and off-road adventures. Known for durability.', 2023, 40000.00, 'images/f150.jpg'),
        ('Escape', 2, 'I4', 181, 'A compact SUV offering a smooth ride, modern technology, and ample space for families and adventurers alike.', 2022, 25000.00, 'images/escape.jpg'),
        ('3 Series', 3, 'Turbo I4', 255, 'A luxury sedan with cutting-edge technology, dynamic performance, and premium comfort for discerning drivers.', 2023, 45000.00, 'images/3series.jpg'),
        ('X7', 3, 'Turbo V8', 523, 'A full-size luxury SUV that combines opulent design, advanced tech, and powerful performance for a premium experience.', 2023, 75000.00, 'images/x7.jpg'),
        ('Land Cruiser', 1, 'V8', 381, 'A rugged and reliable SUV designed for off-road excellence and luxury on-road comfort. A legendary name in 4x4 vehicles.', 2021, 85000.00, 'images/landcruiser.jpg'),
        ('Ranger', 2, 'I4', 270, 'A mid-size truck that offers great off-road capability, strong towing performance, and a comfortable cabin.', 2023, 32000.00, 'images/ranger.jpg'),
        ('i8', 3, 'Hybrid I3', 369, 'A futuristic hybrid sports car combining cutting-edge electric technology with high-end performance and style.', 2022, 140000.00, 'images/i8.jpg'),
        ('Yaris', 1, 'I4', 106, 'A subcompact car that is fuel-efficient, affordable, and easy to drive. Perfect for city dwellers and budget-conscious buyers.', 2022, 15000.00, 'images/yaris.jpg'),
        ('C-Class', 4, 'Turbo I4', 255, 'A compact luxury sedan offering refined interiors, advanced technology, and impressive driving dynamics.', 2023, 42000.00, 'images/cclass.jpg'),
        ('E-Class', 4, 'Turbo I6', 362, 'A mid-size luxury sedan designed for comfort and performance, featuring a sleek design and advanced safety features.', 2023, 54000.00, 'images/eclass.jpg'),
        ('Civic', 5, 'I4', 158, 'A popular compact sedan known for its reliability, fuel efficiency, and modern design, perfect for urban driving.', 2022, 21000.00, 'images/civic.jpg'),
        ('CR-V', 5, 'I4', 190, 'A versatile and spacious SUV with advanced safety features, excellent fuel efficiency, and great resale value.', 2023, 28000.00, 'images/crv.jpg'),
        ('Sonata', 6, 'I4', 180, 'A stylish and feature-packed sedan offering excellent value, advanced technology, and a comfortable interior.', 2023, 24000.00, 'images/sonata.jpg'),
        ('Elantra', 6, 'I4', 147, 'A compact sedan offering modern styling, excellent fuel efficiency, and a surprisingly roomy interior.', 2022, 20000.00, 'images/elantra.jpg'),
        ('Impala', 7, 'V6', 305, 'A full-size sedan with a powerful engine, spacious cabin, and smooth ride, ideal for long-distance driving.', 2023, 32000.00, 'images/impala.jpg'),
        ('Tahoe', 7, 'V8', 355, 'A large SUV with exceptional towing capacity, advanced features, and plenty of room for passengers and cargo.', 2023, 52000.00, 'images/tahoe.jpg'),
        ('Sportage', 8, 'I4', 181, 'A compact SUV offering modern features, a bold design, and great value for both city and highway driving.', 2023, 27000.00, 'images/sportage.jpg'),
        ('Q5', 9, 'Turbo I4', 261, 'A luxury SUV offering a smooth ride, premium interior materials, and cutting-edge technology.', 2023, 43000.00, 'images/q5.jpg'),
        ('A4', 9, 'Turbo I4', 201, 'A premium sedan with exceptional build quality, advanced tech features, and a comfortable yet sporty ride.', 2023, 41000.00, 'images/a4.jpg');

    ";
    
    $data_sell_contracts = "INSERT INTO sell_contracts (car_id, buyer_name, buyer_email, sale_date, sale_price) VALUES
        (1, 'John Doe', 'johndoe@example.com', '2024-01-15', 29000.00),
        (2, 'Jane Smith', 'janesmith@example.com', '2024-02-20', 48000.00),
        (3, 'Mike Johnson', 'mikejohnson@example.com', '2024-03-10', 58000.00);";

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
    $Add_Admins = "INSERT INTO accounts (Account_name, Email, Account_Password, Account_Role) VALUES
        ('admin', 'admin@example.com', 'password123', 'admin'),
        ('user1', 'user1@example.com', 'password456', 'user'),
        ('user2', 'user2@example.com', 'password789', 'user');";

    if (mysqli_query($connexion, $Add_Admins)) {
        echo "les admin sont inserer avec success.<br>";
    } else {
        echo "Erreur d'insertion des admins : " . mysqli_error($connexion) . "<br>";
    }


    // Close the connection
    mysqli_close($connexion);
?>
</center>
</body>
</html>


<!-- end -->