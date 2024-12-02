<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard_style.css">
    <title>Admin dashboard</title>
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
    ?>
        <form class="fixed-list" method="post">
            <input type="submit" name="home" value="Home">
        </form>
        <?php
            if(isset($_POST['home'])){
                header('location:index.php');
            }
        ?>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Admin Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <?php
                            $sql = "SELECT COUNT(Account_name) AS total_users FROM Accounts WHERE account_role='User'";
                            $res = mysqli_query($connexion, $sql);
                            if ($res) {
                                $row = mysqli_fetch_assoc($res);
                                $total_users = $row['total_users']; 
                                if($total_users==0){
                                    echo "<span class='text'>No users for now</span><br>";    
                                }else{
                                    echo "<span class='text'>Total Users: </span><br><span class='text'>$total_users </span>" ;
                                }
                            } else {
                                echo "Error in query: " . mysqli_error($connexion);
                            }
                        ?>

                    </div>
                    <div class="box box1">
                        <i class="uil uil-comments"></i>
                        <?php
                            $sql = "SELECT COUNT(id) AS total_cars FROM cars";
                            $res = mysqli_query($connexion, $sql);
                            if ($res) {
                                $row = mysqli_fetch_assoc($res);
                                $total_cars = $row['total_cars']; 
                                if($total_cars==0){
                                    echo "<span class='text'>No cars available</span><br>";    
                                }else{
                                    echo "<span class='text'>Total cars available: </span><br><span class='text'>$total_cars </span>" ;
                                }
                            } else {
                                echo "Error in query: " . mysqli_error($connexion);
                            }
                        ?>
                    </div>
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <?php
                            $sql = "SELECT COUNT(id) AS total_sells FROM sell_contracts";
                            $res = mysqli_query($connexion, $sql);
                            if ($res) {
                                $row = mysqli_fetch_assoc($res);
                                $total_sells = $row['total_sells']; 
                                if($total_sells==0){
                                    echo "<span class='text'>No sells have been made</span><br>";    
                                }else{
                                    echo "<span class='text'>Total sells made: </span><br><span class='text'>$total_sells </span>" ;
                                }
                            } else {
                                echo "Error in query: " . mysqli_error($connexion);
                            }
                        ?>
                    </div>
            </div>

            <div class="activity">
                <center>
    <div class="title">
        <i class="uil uil-clock-three"></i>
        <span class="text">All Users</span>
    </div>
    <?php
    // Query to fetch non-admin users
    $sql = "SELECT id, Account_name, Email FROM Accounts WHERE Account_Role != 'Admin'";
    $result = mysqli_query($connexion, $sql);

    if (!$result) {
        // Display an error message if the query fails
        echo "<p>Error executing query: " . mysqli_error($connexion) . "</p>";
    } else {
        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Account ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>";
            // Loop through and display each user
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['Account_name']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            // Display a friendly message if no users are found
            echo "<p>No users found.</p>";
        }
    }
    ?>
    <div class="title">
        <i class="uil uil-clock-three"></i>
        <span class="text">All Registered Brands</span>
    </div>
    <?php
    // Query to fetch all brands
    $sql = "SELECT id, name, country FROM brands";
    $result = mysqli_query($connexion, $sql);

    if (!$result) {
        echo "<p>Error executing query: " . mysqli_error($connexion) . "</p>";
    } else {
        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Brand ID</th>
                        <th>Name</th>
                        <th>Country</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['country']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No brands found.</p>";
        }
    }
    ?>
    <div class="title">
        <i class="uil uil-clock-three"></i>
        <span class="text">All Available Cars</span>
    </div>
    <?php
    // Query to fetch all cars
    $sql = "SELECT id, model, year, price FROM cars";
    $result = mysqli_query($connexion, $sql);

    if (!$result) {
        echo "<p>Error executing query: " . mysqli_error($connexion) . "</p>";
    } else {
        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Car ID</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Price</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['model']) . "</td>
                        <td>" . htmlspecialchars($row['year']) . "</td>
                        <td>$" . htmlspecialchars(number_format($row['price'], 2)) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No cars found.</p>";
        }
    }
    ?>
    <div class="title">
        <i class="uil uil-clock-three"></i>
        <span class="text">All Sell Contracts</span>
    </div>
    <?php
    // Query to fetch all sell contracts
    $sql = "SELECT id, car_id, buyer_name, sale_date, sale_price FROM sell_contracts";
    $result = mysqli_query($connexion, $sql);

    if (!$result) {
        echo "<p>Error executing query: " . mysqli_error($connexion) . "</p>";
    } else {
        if (mysqli_num_rows($result) > 0) {
            echo "<table>
                    <tr>
                        <th>Contract ID</th>
                        <th>Car ID</th>
                        <th>Buyer Name</th>
                        <th>Sale Date</th>
                        <th>Sale Price</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['car_id']) . "</td>
                        <td>" . htmlspecialchars($row['buyer_name']) . "</td>
                        <td>" . htmlspecialchars($row['sale_date']) . "</td>
                        <td>$" . htmlspecialchars(number_format($row['sale_price'], 2)) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No sell contracts found.</p>";
        }
    }
    
    ?>
</div>
</center>
</div>

</body>
</html>