<?php include "dbcon-pdo.php" ?>

<?php

// Check if the form was submitted and categories were selected
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['prodtag'])) {
    print_r($_GET['prodtag']);
    $categories = $_GET['prodtag'];

    // If only one category is selected, convert it into an array
    // $categories = is_array($_GET['prodtag']) ? $_GET['prodtag'] : [$_GET['prodtag']];

    // Create a SQL query with placeholders for each category
    $placeholders = str_repeat('?,', count($categories) - 1) . '?';
    $sql = "SELECT * FROM products WHERE prodtag IN ($placeholders)";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute($categories);

    // Fetch and display the results
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        echo "ID: " . $product['prodid'] . "<br>";
        echo "Name: " . $product['prodname'] . "<br>";
        echo "Category: " . $product['prodtag'] . "<br>";
        echo "Price: " . $product['prodprice'] . "<br><br>";
    }
} else {
    echo "No categories selected.";
}
?>
