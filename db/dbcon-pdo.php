<?php 

// Database connection details
$dsn = 'mysql:host=localhost;dbname=phpproductuploadv2;';
$username = 'root';
$password = '';

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}catch(PDOException $e){
    die("Connection failed: " . $e->getMessage());
}
// // Create a PDO instance
// $pdo = new PDO($dsn, $username, $password);

// // Set the PDO error mode to exception
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>