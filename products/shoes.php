<?php include "../db/dbcon-pdo.php" ?>
<?php include "../assets/header.php" ?>
<?php include "../assets/hero.php" ?>

<div class="container">
    <section class="row mt-5 mb-2">
        <h1 class="fw-bold text-center">Shop Shoes</h1>
    </section>
    <section class="row">

        <?php 

        $shoes = 'shoes';
        
        $sql = "SELECT * FROM `products` WHERE prodtag = :shoes";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':shoes', $shoes, PDO::PARAM_STR);
        $stmt->execute();

        // Counter to track number of rows fetched to display that none were found
        $rowCount = 0;

        try{
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>  
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-0">
                        <div class="border rounded-none border-8 border-solid border-gray-800 m-2">
                            <div class="card px-2 rounded-0 py-3 border-transparent" id="product-<?php echo htmlspecialchars($row['prodid']); ?>">
                                <div class="d-flex justify-content-center">
                                    <img src="<?php echo htmlspecialchars($row['prodimage']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['prodname']); ?>" style="height: 150px; width: auto;">
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5 class="card-title mb-1 fw-bold"><?php echo htmlspecialchars($row['prodname']); ?></h5>
                                    </div>
                                    <div class="d-flex justify-content-evenly mt-3">
                                        <p>5 <span style="color:#ffa41c">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
                                        <p class="ms-3"><?php echo htmlspecialchars($row['prodreviewcount']); ?> ratings</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="card-text mb-3 fw-bold fs-5">$<?php echo htmlspecialchars($row['prodprice']); ?></p>
                                    </div>
                                    <div class="col-12">
                                        <a href="../db/product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="btn btn-info w-100 rounded-0">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                $rowCount++;
            }

            // Check if items with product tag were found
            if ($rowCount === 0) {
                echo "There were no results for this product tag.";
            }

        }catch(PDOException $e){
            // Handle the exception
            echo "Connection failed: " . $e->getMessage();
        }
        
        ?>
    </section>
</div>

<?php include "../assets/footer.php" ?>