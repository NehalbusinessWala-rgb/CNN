<?php
// Database configuration
$host = 'localhost';
$db_name = 'rsoa_rsoa324_03';
$username = 'rsoa_rsoa324_03';
$password = '123456';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // In a production environment, don't show the full error
    die("Connection failed: " . $e->getMessage());
}

// Function to get categories for navigation
function getCategories($conn) {
    $stmt = $conn->query("SELECT * FROM categories ORDER BY name ASC");
    return $stmt->fetchAll();
}

// Function to format dates
function formatDate($date) {
    return date('F j, Y, g:i a', strtotime($date));
}
?>
