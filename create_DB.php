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
            
    $sql = "CREATE table brands (
        id int auto increment primary key,
        name varchar(100) not null,
        country varchar(100) not null
    );
    create table cars (
        id int auto_increment primary key,
        model varchar(100) not null,
        brand_id int not null,
        year int not null,
        price number(10,2) not null,
        image varchar(255),
        foreign key (brand_id) references brands(id)
);
    create table sell_contracts (
    id int auto_increment primary key,
    car_id int not null,
    buyer_name varchar(100) not null,
    buyer_email varchar(100),
    sale_date date not null,
    sale_price number(10,2) not null,
    foreign key (car_id) references cars(id)
);";
    if (mysqli_query($connexion, $sql)) {
        echo "les tables 'cars' , 'brands' , 'sell_contracts' a créée avec succès.<br>";
    } else {
        echo "Erreur de creation: " . mysqli_error($connexion);
    }
    // dummy data
    $sql = "INSERT INTO brands (name, country) VALUES
                ('Toyota', 'Japan'),
                ('Ford', 'USA'),
                ('BMW', 'Germany');

            INSERT INTO cars (model, brand_id, year, price, image) VALUES
                ('Camry', 1, 2022, 25000.00, 'images/camry.jpg'),
                ('Mustang', 2, 2021, 55000.00, 'images/mustang.jpg'),
                ('X5', 3, 2023, 70000.00, 'images/x5.jpg');

            INSERT INTO sell_contracts (car_id, buyer_name, buyer_email, sale_date, sale_price) VALUES
                (1, 'John Doe', 'john.doe@example.com', '2024-10-15', 24000.00),
                (2, 'Jane Smith', 'jane.smith@example.com', '2024-11-10', 54000.00);";

    if (mysqli_query($connexion, $sql)) {
        echo "donnée basic ajouté !<br>";
    } else {
        echo "Erreur d'ajoutage : " . mysqli_error($connexion);
    }

?>
</center>
</body>
</html>