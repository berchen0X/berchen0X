<?php
// Database configuration
$config = [
    'host' => '127.0.0.1',
    'db' => 'forsat_db',
    'user' => 'root', // default user for XAMPP
    'pass' => '',     // default password for XAMPP
    'charset' => 'utf8mb4',
];

// DSN (Data Source Name) construction
$dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Database connection
try {
    $pdo = new PDO($dsn, $config['user'], $config['pass'], $options);
} catch (PDOException $e) {
    // Log the error and display a user-friendly message
    error_log("Database Connection Error: " . $e->getMessage());
    die("Sorry, there was a problem connecting to the database. Please try again later.");
}

// Function to get database connection
function getDB() {
    global $pdo;
    return $pdo;
}
?>
