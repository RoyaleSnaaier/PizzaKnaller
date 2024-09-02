<?php
// Database connection
$host = 'localhost'; // Database host
$dbname = 'pizzawebshop'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection errors
    echo 'Database connection failed: ' . $e->getMessage();
}