<?php include "dbcon.php" ?>
<?php include "../assets/header.php" ?>

<section class="container">
    <?php 

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $query = "SELECT * FROM products WHERE prodid = $id";

        $result = mysqli_query($connection, $query);
    
        if(!$result){
            die("Query failed" . mysqli_error($connection));
        } else {
            $row = mysqli_fetch_assoc($result);
        }

    }
    
    ?>

    <div class="mt-5 mb-3">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-xl-4 pb-5 text-center text-md-start">
                <img src="<?php echo $row['prodimage'];  ?>" alt="<?php echo $row["prodname"]; ?>" style="width: 250px;" />
            </div>
            <div class="col-sm-12 col-md-6 col-xl-8">
                <h1 class="fw-bold"><?php echo $row['prodname']; ?></h1>
                <p><span class="fw-bold">Brand:</span> <?php echo $row['prodbrand'] ?></p>
                <div class="d-flex justify-content-start">
                        <p>5 <span style="color:#ffa41c">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
                        <p class="ms-3 fst-italic fw-medium"><?php echo $row['prodreviewcount'] ?> ratings</p>
                </div>
                <p class="fw-semibold fs-2">$<?php echo $row['prodprice'] ?></p>
                <p>Stock left: <?php echo $row['prodquantity'] ?></p>
                <p class="fw-bold">Details about this item:</p>
                <p><?php echo $row['prodshortdescription'] ?></p>
            </div>
        </div>
    </div>

    <div class="mt-5 mb-3">
        <div class="row">
            <div class="col-12">
                <h2 class="fw-bold">Product Description</h2>
                <p><?php echo $row['prodlongdescription'] ?></p>
            </div>
        </div>
    </div>

    <div class="mt-5 mb-3">
        <div class="row mt-3 mb-4">
            <div class="col-12">
                <h4 class="fw-bold">What do customers buy after viewing this item?</h4>
            </div>
        </div>
        <div class="row">
            <?php 
            
            $query = "SELECT * FROM products";

            $result = mysqli_query($connection, $query);

            if(!$result){
                die("Query failed" . mysqli_error($connection));
            }
            else {
                for($i = 1; $i <= 6; $i++){
                    $row = mysqli_fetch_assoc($result);
                    ?>

                    <div class='col-sm-12 col-md-4 col-xl-2 p-2'>
                        <div class="bg-body-secondary text-center py-4 p-2">
                            <img src="<?php echo $row['prodimage']; ?>" class="card-img-top" alt="<?php echo $row['prodname']; ?>" style="width: 150px;">
                            <h4 class="mb-1"><a href="product.php?id=<?php echo $row['prodid']; ?>" class="text-decoration-none text-reset fs-6"><?php echo $row['prodname']?></a></h4>
                            <p class="">$<?php echo $row['prodprice']; ?></p>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
    </div>


</section>

<?php include("../assets/footer.php"); ?>