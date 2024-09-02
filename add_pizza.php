<?php
// Include database connection script
include 'db_connection.php'; // Update this with your actual database connection script

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get pizza details from the form
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name']; // Get the name of the uploaded image file
    $image_tmp = $_FILES['image']['tmp_name']; // Get the temporary name/location of the uploaded image file

    // Move the uploaded image to a permanent location
    move_uploaded_file($image_tmp, "images/$image");

    // Initialize an empty array to store toppings
    $toppings = [];

    // Check if toppings were selected
    if (isset($_POST['toppings'])) {
        // Loop through each selected topping
        foreach ($_POST['toppings'] as $topping) {
            // Sanitize and add the topping to the array
            $toppings[] = $topping;
        }
    }

    // Convert the array of toppings into a comma-separated string
    $toppingsString = implode(', ', $toppings);

    // Insert pizza details into the database
    $sql = "INSERT INTO products (name, description, price, image) VALUES (:name, :description, :price, :image)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'description' => $toppingsString, 'price' => $price, 'image' => $image]);

    // Redirect back to the admin page
    header("Location: admin.php");
    exit();
} else {
    // Redirect back to the admin page if the form is not submitted
    header("Location: admin.php");
    exit();
}