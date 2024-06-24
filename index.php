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
    <section class="row lg:flex mt-3">
        <div class="w-full col-lg-3">
            <div class="row align-items-center">
                <div class="col-4 text-center">
                    <p>ICON</p>
                </div>
                <div class="col-8">
                    <p class="fw-bold">Free Shipping</p>
                    <p>On all orders above $150.</p>
                </div>
            </div>
        </div>
        <div class="w-full col-lg-3">
            <div class="row align-items-center">
                <div class="col-4 text-center">
                    <p>ICON</p>
                </div>
                <div class="col-8">
                    <p class="fw-bold">Free Return</p>
                    <p>Within 30 days for an echange</p>
                </div>
            </div>
        </div>
        <div class="w-full col-lg-3">
            <div class="row align-items-center">
                <div class="col-4 text-center">
                    <p>ICON</p>
                </div>
                <div class="col-8">
                    <p class="fw-bold">Secured Payment</p>
                    <p>We ensure secure payments and checkout.</p>
                </div>
            </div>
        </div>
        <div class="w-full col-lg-3">
            <div class="row align-items-center">
                <div class="col-4 text-center">
                    <p>ICON</p>
                </div>
                <div class="col-8">
                    <p class="fw-bold">Support 24/7</p>
                    <p>Contact us 24 hours a day</p>
                </div>
            </div>
        </div>
    </section>
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
                                        <a href="db/product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="btn btn-info w-100 rounded-0">Details</a>
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

<div class="container-fluid p-0">

    <section class="mt-5">
        <div class="row mx-0">
            <h2 class="text-center fw-bold text-3xl px-0">Gallery</h2>
        </div>
        <div class="row mt-3 mx-0">
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="https://placehold.co/300x250" alt="" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="https://placehold.co/300x250" alt="" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="https://placehold.co/300x250" alt="" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="https://placehold.co/300x250" alt="" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="https://placehold.co/300x250" alt="" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="https://placehold.co/300x250" alt="" />
            </div>
        </div>
    </section>

</div>

<div class="container-fluid text-bg-primary p-0">
    <section class="container g-0 py-3">
        <div class="row w-full mx-0 d-flex align-items-center py-2 py-lg-0">
            <div class="w-full col-lg-4 px-0 text-center text-lg-start">
                <p class="mb-0">
                    <img src="https://placehold.co/15x15" alt="" />
                    <img src="https://placehold.co/15x15" alt="" />
                    <img src="https://placehold.co/15x15" alt="" />
                    <img src="https://placehold.co/15x15" alt="" />
                    <img src="https://placehold.co/15x15" alt="" />
                    <img src="https://placehold.co/15x15" alt="" />
                </p>
            </div>
            <div class="w-full col-lg-4 px-0 text-center text-lg-start py-4 py-lg-0">Sign Up For Newsletters & Get 20% off</div>
            <div class="w-full col-lg-4 px-5">
            <div class="input-group">
                <input type="text" class="form-control rounded-0" placeholder="Your Email Address" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn bg-black text-white rounded" type="button" id="button-addon2">Subscribe</button>
            </div>

            </div>
        </div>
    </section>
</div>
<!-- <style>

    .img-container img {
        width: 100%;
        height: auto;
    }
</style> -->
        
<?php include "assets/footer.php" ?>