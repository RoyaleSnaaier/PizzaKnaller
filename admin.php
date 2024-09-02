<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Pizza</title>
    <!-- Add your CSS and JavaScript files here -->
</head>
<body>
    <h1>Add New Pizza</h1>
    <form action="add_pizza.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <p>houd de ctrl key ingedrukt om meerdere toppings te kiezen</p>

        <label for="toppings">Toppings:</label>
        <select id="toppings" name="toppings[]" multiple>
            <?php
            try {
                // Include database connection script
                include 'db_connection.php'; // Update this with your actual database connection script

                // Fetch toppings from the database
                $stmt = $pdo->query('SELECT * FROM toppings');

                // Check if there are toppings available
                if ($stmt->rowCount() === 0) {
                    echo '<option value="">No toppings available</option>';
                } else {
                    // Start generating HTML for toppings dropdown
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    }
                }
            } catch (PDOException $e) {
                // Handle database connection errors
                echo '<option value="">Database connection failed: ' . $e->getMessage() . '</option>';
            }
            ?>
        </select><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" required><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>

        <input type="submit" value="Add Pizza">
    </form>
     <hr>
    <!-- Form for adding toppings -->
    <form action="add_topping.php" method="POST">
        <label for="topping_name">Topping Name:</label>
        <input type="text" id="topping_name" name="topping_name" required><br><br>

        <input type="submit" value="Add Topping">
    </form>
    <!-- Display existing toppings with delete buttons -->
    <ul>
    
    

        <?php
            echo "<h2>Existing Toppings</h2>";
            echo "<hr>";

        try {
            // Include database connection script
            include 'db_connection.php'; // Update this with your actual database connection script

            // Fetch toppings from the database
            $stmt = $pdo->query('SELECT * FROM toppings');

            // Check if there are toppings available
            if ($stmt->rowCount() === 0) {
                echo '<li>No toppings available</li>';
            } else {
                // Start generating HTML for existing toppings
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div style="display: inline-block; margin-bottom: 10px;">';
                    echo '<span style="display: inline-block; width: 150px;">' . $row['name'] . '</span>';
                    echo '<form action="remove_topping.php" method="POST" style="display: inline;"><input type="hidden" name="topping_id" value="' . $row['id'] . '"><input type="submit" value="Delete" style="margin-left: -50px; margin-right: 100px;"></form>';
                    echo '</div>';
                                    }
            }
        } catch (PDOException $e) {
            // Handle database connection errors
            echo '<li>Database connection failed: ' . $e->getMessage() . '</li>';
        }
        ?>

<?php
    echo "<hr>";
    // Include database connection script
    include 'db_connection.php'; // Update this with your actual database connection script
    include 'model/product.php';

    try {
        // Fetch pizza data from the database
        $stmt = $pdo->prepare('SELECT * FROM products');
        $stmt->execute();

        $products = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product($row['id'], $row['name'], $row['price'], $row['description'], $row['image']);
        }

        // Check if there are pizzas available
        if ($stmt->rowCount() === 0) {
            echo 'No pizzas available';
            exit;
        }
        
        // Start generating HTML for displaying pizzas
        echo '<h2>Existing Pizzas</h2>';
        echo '<table>';
        echo '<tr><th>Name</th><th>Toppings</th><th>Price</th><th>Image</th><th>Actions</th></tr>';
        foreach($products as $product){
            echo '<tr>';
            echo '<td>' . $product->getName() . '</td>';
            echo '<td>' . $product->getDescription() . '</td>'; // Assuming toppings are stored in the 'description' column
            echo '<td>€' . $product->getPrice() . '</td>';
            echo '<td>';
            // Display the image name or a tiny preview
            $imagePath = 'images/' . $product->getImage();
            if (file_exists($imagePath)) {
                echo '<img src="' . $imagePath . '" alt="' . $product->getName() . '" style="width:50px;height:50px;">';
            } else {
                echo $product->getImage();
            }
            echo '</td>';
            echo '<td><a href="edit_pizza.php?id=' . $product->getId() . '">Edit</a> | <a href="remove_pizza.php?id=' . $product->getId() . '">Remove</a></td>';
            echo '</tr>';
        }
        echo '</table>';

    } catch (PDOException $e) {
        // Handle database connection errors
        echo 'Database connection failed: ' . $e->getMessage();
    }
?>


</body>
</html>
