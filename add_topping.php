<?php
// Include database connection script
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $topping_name = $_POST['topping_name'];

    try {
        // Prepare SQL statement to insert topping into the database
        $stmt = $pdo->prepare("INSERT INTO toppings (name) VALUES (:name)");
        $stmt->bindParam(':name', $topping_name);
        $stmt->execute();

        echo "Topping added successfully.";
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
<li><a href="admin.php">Admin</a></li>