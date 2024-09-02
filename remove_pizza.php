<?php
// Include database connection script
include 'db_connection.php'; // Update this with your actual database connection script

// Retrieve the pizza ID from the URL parameter
$id = $_GET['id'] ?? null;

if (!$id) {
    // Handle case where ID is not provided
    echo 'Pizza ID not provided.';
    exit();
}

// Delete the pizza from the database
$sql = "DELETE FROM products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// Redirect back to the admin page
header("Location: admin.php");
exit();