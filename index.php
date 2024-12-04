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
   // session_start(); // Ensure the session is started for the page

    $serveur = "localhost"; 
    $utilisateur = "root"; 
    $motdepasse = ""; 
    $nom_base = "sayarat_3amek_faouzi";
    
    $connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $nom_base);
    
    if (!$connexion) {
        die("Connexion échouée : " . mysqli_connect_error());
    }

    if (isset($_POST['info'])) {
        $_SESSION['carID'] = $_POST["carID"];
        header("location:carinfo.php");
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

    
    $results_per_page = 1; 
    $sql_total = "SELECT COUNT(*) AS total FROM cars"; 
    $result_total = mysqli_query($connexion, $sql_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_rows = $row_total['total'];
    $total_pages = ceil($total_rows / $results_per_page); 

    
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page < 1) $current_page = 1;
    if ($current_page > $total_pages) $current_page = $total_pages;

    $offset = ($current_page - 1) * $results_per_page; 

    
    $sql = "SELECT c.id, name, model, price, image, engine, hp, description FROM cars AS c 
            JOIN brands AS b ON b.id = c.brand_id 
            LIMIT $offset, $results_per_page";
    $result = mysqli_query($connexion, $sql);

    echo '<center><h1>Welcome to the Home Page!</h1></center>';
    if (!$result) {
        echo "<p>Error executing query: " . mysqli_error($connexion) . "</p>";
    } else {
        echo '<div class="card-container">';
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card">
                        <img src="' . $row['image'] . '" alt="Car Image" class="card-image">
                        <div class="card-content">
                            <form method="post">
                                <h2 class="card-title">' . htmlspecialchars($row['name']) . ' ' . htmlspecialchars($row['model']) . '</h2>
                                <p class="card-price">$' . htmlspecialchars($row['price']) . '</p>
                                <div class="flexi">
                                    <p class="atr">Horse Power: ' . htmlspecialchars($row['hp']) . '</p>
                                    <p class="atr">Engine: ' . htmlspecialchars($row['engine']) . '</p>
                                    <input type="hidden" name="carID" value="' . $row["id"] . '">
                                    <input type="hidden" name="carPRICE" value="' . $row["price"] . '">
                                    <input type="submit" value="More" name="info" class="sub">
                                    <input type="submit" value="BUY!!" name="buy" class="sub">
                                </div>
                            </form>
                        </div>
                    </div>';
            }
        } else {
            echo "<h1>No cars available at the moment.</h1>";
        }
        echo '</div>';
    }

    // Pagination links
    echo '<div class="pagination">';
    if ($current_page > 1) {
        echo '<a href="index.php?page=' . ($current_page - 1) . '">Previous</a>';
    }
    echo ' | ';
    if ($current_page < $total_pages) {
        echo '<a href="index.php?page=' . ($current_page + 1) . '">Next</a>';
    }
    echo '</div>';
?>
</body>
</html>
