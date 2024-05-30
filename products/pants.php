<?php include "../db/dbcon-pdo.php" ?>
<?php include "../assets/header.php" ?>
<?php include "../assets/hero.php" ?>

<div class="container">
    <section class="row mt-5 mb-2">
        <h1 class="fw-bold text-center">Shop Pants</h1>
    </section>
    <section class="row">

        <?php 
        
        $sql = "SELECT * FROM `products` WHERE prodtag = 'pants'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Counter to track number of rows fetched to display that none were found
        $rowCount = 0;

        try {

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-2">
                        <div class="card border-0 p-2 rounded-0 bg-body-secondary py-4" id="product-<?php echo $row['prodid']; ?>">
                            <div class="d-flex justify-content-center">
                                <img src="<?php echo $row['prodimage']; ?>" class="card-img-top" alt="<?php echo $row['prodname']; ?>" style="width: 150px;">
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="card-title mb-1"><?php echo $row['prodname']; ?></h5>
                                    <p class="card-text mb-1 fw-bold">$<?php echo $row['prodprice']; ?></p>
                                </div>
                                <div class="d-flex justify-content-evenly">
                                    <p>5 <span style="color:#ffa41c">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
                                    <p class="ms-3"><?php echo $row['prodreviewcount'] ?> ratings</p>
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