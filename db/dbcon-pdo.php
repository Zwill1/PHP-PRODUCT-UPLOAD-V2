<?php 

// Database connection details
$dsn = 'mysql:host=localhost;dbname=phpproductupload;';
$username = 'root';
$password = '';

// Create a PDO instance
$pdo = new PDO($dsn, $username, $password);

// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>