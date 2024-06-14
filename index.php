<?php include "db/dbcon-pdo.php" ?>
<?php include "assets/header.php" ?>

    <!-- display success when inserting is done correctly -->
    <?php        
        if(isset($_GET['insert_msg'])){
            echo 
            "<section class='container-fluid p-0'>
                <div class='bg-success p-2'>
                    <div class='container text-white text-center fw-bold'>
                        <h6 class='text-center'>".$_GET['insert_msg']."</h6>
                    </div>
                </div>
            </section>";
        }       
    ?>

    <!-- display success when editing is done correctly -->
    <?php        
        if(isset($_GET['update_msg'])){
            echo 
            "<section class='container-fluid p-0'>
                <div class='bg-success p-2'>
                    <div class='container text-white text-center fw-bold'>
                        <h6 class='text-center'>".$_GET['update_msg']."</h6>
                    </div>
                </div>
            </section>";
        }       
    ?>

    <!-- display success when deleting a product is done correctly -->
    <?php        
        if(isset($_GET['delete_msg'])){
            echo 
            "<section class='container-fluid p-0'>
                <div class='bg-success p-2'>
                    <div class='container text-white text-center fw-bold'>
                        <h6 class='text-center'>".$_GET['delete_msg']."</h6>
                    </div>
                </div>
            </section>";
        }       
    ?>

<?php include "assets/hero.php" ?>
<div class="container">
    <section class="row mt-5 mb-2">
        <h1 class="fw-bold text-center">Shop Your Favorite Products</h1>
    </section>

    <section class="row mt-3 mb-3">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 w-100 text-center">
            <div>
                <h4>Select Product Tags:</h4>
                <form method="GET" action="db/filter.php">
                    <input type="checkbox" name="prodtag[]" value="arrivals"> <label for="newArrivals">New Arrivals</label>
                    <input type="checkbox" name="prodtag[]" value="shirts"> <label for="shirts">Shirts</label>
                    <input type="checkbox" name="prodtag[]" value="pants"> <label for="pants">Pants</label>
                    <input type="checkbox" name="prodtag[]" value="shorts"> <label for="shorts">Shorts</label>
                    <input type="checkbox" name="prodtag[]" value="shoes"> <label for="shoes">Shoes</label>
                    <input type="checkbox" name="prodtag[]" value="sales"> <label for="sales">Sales</label>
                    <input type="submit" value="Filter">
                </form>
            </div>
        </div>
    </section>

    <!-- <section class="row">

    <?php 
            //try {
                //$sql = 'SELECT * FROM products';
                //$stmt = $pdo->prepare($sql);
                //$stmt->execute();
                //$result = $stmt->fetch(PDO::FETCH_ASSOC);

                //while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    ?>  
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 p-2">
                            <div class="card border-0 p-2 rounded-0 bg-body-secondary py-4" id="product-<?php echo htmlspecialchars($row['prodid']); ?>">
                                <div class="d-flex justify-content-center">
                                    <img src="<?php echo htmlspecialchars($row['prodimage']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['prodname']); ?>" style="width: 150px;">
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5 class="card-title mb-1"><?php echo htmlspecialchars($row['prodname']); ?></h5>
                                        <p class="card-text mb-1 fw-bold">$<?php echo htmlspecialchars($row['prodprice']); ?></p>
                                    </div>
                                    <div class="d-flex justify-content-evenly">
                                            <p>5 <span style="color:#ffa41c">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
                                            <p class="ms-3"><?php echo htmlspecialchars($row['prodreviewcount']); ?> ratings</p>
                                    </div>
                                    <div class="col-12 pt-2 pb-2">
                                        <a href="db/product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="btn btn-info w-100">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                //}
            //}catch (PDOException $e) {
                // Handle the exception
                //echo "Connection failed: " . $e->getMessage();
            //}           
   ?>

    </section> -->

    <section class="row">

        <?php 
                
                $resultsPerPage = 8;
                $sql = 'SELECT COUNT(*) FROM products';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $totalResults = $stmt->fetchColumn();
                $totalPages = ceil($totalResults / $resultsPerPage);
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                $startingLimit = ($page - 1) * $resultsPerPage;

                $sql = "SELECT * FROM products LIMIT :startingLimit, :resultsPerPage";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':startingLimit', $startingLimit, PDO::PARAM_INT);
                $stmt->bindParam(':resultsPerPage', $resultsPerPage, PDO::PARAM_INT);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>

            <?php foreach ($results as $row): ?>
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
                                    <div class="text-center"">
                                        <p class="card-text mb-3 fw-bold fs-5">$<?php echo htmlspecialchars($row['prodprice']); ?></p>
                                    </div>
                                    <div class="col-12">
                                        <a href="db/product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="btn btn-info w-100">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>

    </section>

    <section class="row">
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </section>

</div>
        
<?php include "assets/footer.php" ?>