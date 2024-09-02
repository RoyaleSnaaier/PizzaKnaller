<?php
// Include database connection script
include 'db_connection.php'; // Update this with your actual database connection script

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get updated pizza details from the form
    $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $description = implode(', ', $_POST['description']); // Combine selected toppings into a comma-separated string
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imageDir = 'images/'; // Ensure this directory exists and is writable
        $imagePath = $imageDir . $imageName;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            // Update pizza details in the database including image
            $sql = "UPDATE products SET name = :name, description = :description, price = :price, image = :image WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id, 'name' => $name, 'description' => $description, 'price' => $price, 'image' => $imageName]);
        } else {
            echo "Failed to upload the image.";
            exit();
        }
    } else {
        // Update pizza details in the database without changing the image
        $sql = "UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name, 'description' => $description, 'price' => $price]);
    }

    // Redirect back to the admin page
    header("Location: admin.php");
    exit();
} else {
    // Retrieve the pizza ID from the URL parameter
    $id = $_GET['id'] ?? null;

    if (!$id) {
        // Handle case where ID is not provided
        echo 'Pizza ID not provided.';
        exit();
    }

    // Fetch pizza details from the database
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $pizza = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pizza) {
        // Handle case where pizza with given ID is not found
        echo 'Pizza not found.';
        exit();
    }

    // Fetch toppings from the database
    $toppingsStmt = $pdo->query('SELECT * FROM toppings');
    $toppings = $toppingsStmt->fetchAll(PDO::FETCH_ASSOC);

    // Display a form to edit the pizza details
    echo '<h2>Edit Pizza</h2>';
    echo '<form action="edit_pizza.php" method="POST" enctype="multipart/form-data">';
    echo '<input type="hidden" name="id" value="' . $id . '">';
    echo 'Name: <input type="text" name="name" value="' . $pizza['name'] . '"><br>';
    echo 'Toppings: <select name="description[]" multiple>';
    foreach ($toppings as $topping) {
        $isSelected = in_array($topping['name'], explode(', ', $pizza['description'])) ? 'selected' : '';
        echo '<option value="' . $topping['name'] . '" ' . $isSelected . '>' . $topping['name'] . '</option>';
    }
    echo '</select><br>';
    echo 'Price: <input type="number" name="price" step="0.01" min="0" value="' . $pizza['price'] . '"><br>';
    echo 'Image: <input type="file" name="image" accept="image/*"><br>';
    echo '<input type="submit" value="Save">';
    echo '</form>';
}
?>
