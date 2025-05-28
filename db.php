
<?php
$host = 'localhost';
$db   = 'portfolio_db';
$user = 'caiogoessens.nl';
$pass = '*JDneG221*@';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
    exit('Database connection failed: ' . $e->getMessage());
}
?>
