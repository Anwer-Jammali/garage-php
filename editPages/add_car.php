
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
// Database connection
$serveur = "localhost"; 
$utilisateur = "root"; 
$motdepasse = ""; 
$nom_base = "sayarat_3amek_faouzi";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $nom_base);
    
if (!$connexion) {
    die("Connexion échouée : " . mysqli_connect_error());
}

// Handle car addition when form is submitted
if (isset($_POST['add_car'])) {
    $model = mysqli_real_escape_string($connexion, $_POST['model']);
    $brand_id = mysqli_real_escape_string($connexion, $_POST['brand_id']);
    $year = mysqli_real_escape_string($connexion, $_POST['year']);
    $price = mysqli_real_escape_string($connexion, $_POST['price']);
    
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $allowed_ext = ['jpg', 'jpeg', 'png'];

        if (in_array(strtolower($image_ext), $allowed_ext)) {
            $new_image_name = uniqid() . '.' . $image_ext;
            $image_path = 'images/' . $new_image_name;

            // Move the uploaded image to the 'images/' directory
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                // Insert the car data into the database
                $sql = "INSERT INTO cars (model, brand_id, year, price, image) 
                        VALUES ('$model', '$brand_id', '$year', '$price', '$image_path')";
                if (mysqli_query($connexion, $sql)) {
                    echo "Car added successfully!";
                } else {
                    echo "Error: " . mysqli_error($connexion);
                }
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Invalid image format. Only JPG, JPEG, and PNG are allowed.";
        }
    } else {
        echo "Please upload an image.";
    }
}
?>

<body>
    <form class="simple-form" method="POST" enctype="multipart/form-data">
        <label for="model">Car Model:</label>
        <input type="text" id="model" name="model" required><br><br>

        <label for="brand_id">Brand ID:</label>
        <input type="number" id="brand_id" name="brand_id" required><br><br>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br><br>

        <label for="image">Car Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <button type="submit" name="add_car">Add Car</button>
    </form>
</body>
</html>
