<?php
$dsn = 'mysql:host=localhost;dbname=contact_manager;charset=utf8mb4';
$db_username = 'root';
$db_password = '';

try {
    $db = new PDO($dsn, $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $exception) {
    $error_message = 'Database connection failed.';
    include __DIR__ . '/../views/errors/database_error.php';
    exit();
}
?>