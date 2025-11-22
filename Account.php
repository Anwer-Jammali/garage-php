<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="parts/navbarcss.css">
    <link rel="stylesheet" href="AccountStyle.css">
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
//echo $_SESSION['ID'];
if (!isset($_SESSION['ID'])) {
    echo "<h2>u aint logged it ! (or session aint working)</h2>";  
    header('Location:Log_in.php'); // Redirect to login if not logged in
    exit();
}else{
    echo "<div class='account-container'>
        <h1> Welcome ".htmlspecialchars($_SESSION['NAME'])." ! </h1>";
$user_id = $_SESSION['ID'];
$sql_user = "SELECT * FROM Accounts WHERE id = '$user_id'";
$result_user = mysqli_query($connexion, $sql_user);
$user = mysqli_fetch_assoc($result_user);

if (!$user) {
    echo "User not found!";
    exit();
}
}

if (isset($_POST['delete_account'])) {
    $sql_delete = "DELETE FROM Accounts WHERE id = '$user_id'";
    if (mysqli_query($connexion, $sql_delete)) {
        session_destroy(); // Log out user after deletion
        header('Location: login.php');
        exit();
    } else {
        echo "Error deleting account: " . mysqli_error($connexion);
    }
}

?>
        <h2>Your Purchases :</h2>
                    <?php
                    $sql = "SELECT c.model, s.sale_date, s.sale_price 
                    FROM cars c 
                    JOIN sell_contracts s ON c.id = s.car_id 
                    WHERE s.buyer_name = '" .$_SESSION['NAME'] ."'AND s.buyer_email = '" .$_SESSION['EMAIL'] . "'";
                    $res= mysqli_query($connexion, $sql);
                    if (!$res) {
                        echo "<p>Error executing query: " . mysqli_error($connexion) . "</p>";
                    }
                    if (mysqli_num_rows($res) > 0) {
                        echo "<table>
                                <thead>
                                    <tr>
                                        <th>Car Model</th>
                                        <th>Sale Date</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['model']) . "</td>
                                    <td>" . htmlspecialchars($row['sale_date']) . "</td>
                                    <td>" . htmlspecialchars($row['sale_price']) . "</td>
                                  </tr>";
                        }
                    
                        echo "</tbody>
                              </table>";
                    } else {
                        echo "<p>You have not made any purchases yet.</p>";
                    }
            
            ?>
        <h2>Edit Your Account</h2>
        <form method="POST">   
            Name:<input type="text" name="name" class="form_input" value="<?php echo htmlspecialchars($user['Account_name']); ?>"><br><br>
            Email:<input type="email"name="email" class="form_input" value="<?php echo htmlspecialchars($user['Email']); ?>"><br><br>
            New Password:<input type="password" id="password" name="password" class="form_input"><br><br>
            <button type="submit" name="update" class="update_button">Update Account</button>
        </form>
        <?php
        
            if(isset($_POST["update"])){
                if(isset($_POST['password'])){
                    $sql = "UPDATE accounts  SET Account_name= '". $_POST["name"] ."' , Email= '". $_POST["email"] ."', Account_Password= '". $_POST["password"]."' WHERE id =" . $_SESSION["ID"] . "";
                    $res = mysqli_query($connexion, $sql);
                    if($res){
                        echo "<h3>Your changes have been made successfully !</h3>";
                        header("location:Account.php");
                }
                }else if(!isset($_POST['password'])){
                    $sql = "UPDATE accounts  SET Account_name= '". $_POST["name"] ."' , Email= '". $_POST["email"] ."' WHERE id =" . $_SESSION["ID"] . "";
                    $res = mysqli_query($connexion, $sql);
                    if($res){
                        echo "<h3>Your changes have been made successfully !</h3>";
                        header("location:Account.php");
                    }
            }
            if (!$connexion) {
                die("Connexion échouée : " . mysqli_connect_error());
            }
        }
        ?>

    
        <h2>Delete Your Account</h2>
        <form method="POST">
            <button type="submit" name="delete" class="delete_button" onclick="return confirm('Are you sure you want to delete your account?');">Delete Account</button>
        </form>
        <?php
            if(isset($_POST["delete"])){
                $sql = "DELETE from accounts WHERE id =" . $_SESSION["ID"] . "";
                $res = mysqli_query($connexion, $sql);
                if($res){
                    header("location:index.php");
                    session_destroy();
                    exit();
                }
            }
            if (!$connexion) {
                die("Connexion échouée : " . mysqli_connect_error());
            }
        ?>
    </div>
</body>
</html>

<!-- end -->