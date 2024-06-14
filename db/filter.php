<?php include "dbcon-pdo.php" ?>
<?php include "../assets/header.php" ?>
<?php include "../assets/hero.php" ?>

<div class="container">
    <!-- <section class="row mt-5 mb-2">
        <h1 class="fw-bold text-center">Filtered Products for <?php echo $categories ?></h1>
    </section> -->

    <?php

        // Check if the form was submitted and categories were selected
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['prodtag'])) {
            // print_r($_GET['prodtag']);
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

            // print_r($categories);

            foreach ($categories as $category) {
                echo '<section class="row mt-5 mb-2">';
                    echo '<h1 class="fw-bold text-center">Filtered Products for ' . $category . '</h1>';
                echo '</section>';

            echo '<section class="row">';

            foreach ($products as $product) {
                if($product['prodtag'] === $category){
                echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-2">';
                    echo '<div class="card border-0 p-2 rounded-0 bg-body-secondary py-4" id="product-' . htmlspecialchars($product['prodid']) . '">';
                        echo '<div class="d-flex justify-content-center">';
                            echo '<img src="' . htmlspecialchars($product['prodimage']) . '" class="card-img-top" alt="' . htmlspecialchars($product['prodname']) . '" style="width: 150px;">';
                        echo '</div>';
                        echo '<div class="card-body">';
                            echo '<div class="text-center">';
                                echo '<h5 class="card-title mb-1">' . htmlspecialchars($product['prodname']) . '</h5>';
                                echo '<p class="card-text mb-1 fw-bold">$' . htmlspecialchars($product['prodprice']) . '</p>';
                            echo '</div>';
                            echo '<div class="d-flex justify-content-evenly">';
                                    echo '<p>5 <span style="color:#ffa41c">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>';
                                    echo '<p class="ms-3">' . htmlspecialchars($product['prodreviewcount']) .  ' ratings</p>';
                            echo '</div>';
                            echo '<div class="col-12 pt-2 pb-2">';
                                echo '<a href="product.php?id=' . htmlspecialchars($product['prodid']) . '" class="btn btn-info w-100">Details</a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

                // echo "ID: " . $product['prodid'] . "<br>";
                // echo "Name: " . $product['prodname'] . "<br>";
                // echo "Category: " . $product['prodtag'] . "<br>";
                // echo "Price: " . $product['prodprice'] . "<br><br>";
                // echo '</div>';
                }
            }
        }
        } else {
            echo '<section class="row mt-5 mb-2">';
            echo '<p class="text-center">No product categories selected.</p>';
            echo '</section>';
        }
    ?>

    </section>

</div>

<?php include "../assets/footer.php" ?>