<?php
// Check if the topping ID is provided
if (isset($_POST['topping_id'])) {
    try {
        // Include database connection script
        include 'db_connection.php'; // Update this with your actual database connection script

        // Prepare a SQL statement to delete the topping
        $stmt = $pdo->prepare('DELETE FROM toppings WHERE id = :topping_id');

        // Bind the topping ID parameter
        $stmt->bindParam(':topping_id', $_POST['topping_id'], PDO::PARAM_INT);

        // Execute the SQL statement
        $stmt->execute();

        // Redirect back to the admin page after successful deletion
        header('Location: admin.php');
        exit;
    } catch (PDOException $e) {
        // Handle database connection errors
        echo 'Database connection failed: ' . $e->getMessage();
    }
} else {
    // Redirect back to the admin page if topping ID is not provided
    header('Location: admin.php');
    exit;
}