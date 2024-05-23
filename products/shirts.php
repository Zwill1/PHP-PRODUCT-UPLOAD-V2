<?php include "../db/dbcon.php" ?>
<?php include "../assets/header.php" ?>
<?php include "../assets/hero.php" ?>

<div class="container">
    <section class="row mt-5 mb-2">
        <h1 class="fw-bold text-center">Shop Shirts</h1>
    </section>
    <section class="row">
        <?php 
        $query = "SELECT * FROM `products` WHERE prodtag = 'shirts'";

        $result = mysqli_query($connection, $query);

        // if not greater than 0 result
        if (!mysqli_num_rows($result) > 0) {
            echo "There were no results for this product tag";
        }
        if(!$result){
            die("Query failed" . mysqli_error($connection));
        }else{
            while($row = mysqli_fetch_assoc($result)){
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
                // echo "There were results found for this tag ";
            }
        }

        ?>
    </section>

<?php include "../assets/footer.php" ?>