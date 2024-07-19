<?php include "dbcon-pdo.php" ?>

<?php 

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE prodid = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        header("location:../index.php?message=The product was not found.");
        exit;
    } else {
        $row = $stmt->fetch();
    }
}

?>

<?php include "../assets/header.php" ?>

<section class="container">

<?php if (isset($row)) { ?>
        <div class="mt-5 mb-3">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-4 pb-5 text-center text-md-start">
                    <img src="<?php echo htmlspecialchars($row['prodimage']); ?>" alt="<?php echo htmlspecialchars($row["prodname"]); ?>" style="width: 250px;" />
                </div>
                <div class="col-sm-12 col-md-6 col-xl-8">
                    <h1 class="fw-bold"><?php echo htmlspecialchars($row['prodname']); ?></h1>
                    <p><span class="fw-bold">Brand:</span> <?php echo htmlspecialchars($row['prodbrand']); ?></p>
                    <p><span class="fw-bold">Seller:</span> -- SELLER --</p>
                    <div class="d-flex justify-content-start">
                        <p>5 <span style="color:#ffa41c">&#9733;&#9733;&#9733;&#9733;&#9733;</span></p>
                        <p class="ms-3 fst-italic fw-medium"><?php echo htmlspecialchars($row['prodreviewcount']); ?> ratings</p>
                    </div>
                    <p class="fw-semibold fs-2">$<?php echo htmlspecialchars($row['prodprice']); ?></p>
                    <p>Stock: <?php echo htmlspecialchars($row['prodquantity']); ?></p>
                    <p>Category: <span class="bg-success-subtle px-2 rounded-pill"><a href="http://localhost/PHP-PRODUCT-UPLOAD-v2/products/<?php echo htmlspecialchars($row['prodtag']); ?>.php" class="text-reset text-decoration-none"><?php echo htmlspecialchars($row['prodtag']); ?></a></span></p>
                    <p class="fw-bold">Details about this item:</p>
                    <p><?php echo htmlspecialchars($row['prodshortdescription']); ?></p>
                </div>
            </div>
        </div>

        <div class="mt-5 mb-3">
            <div class="row">
                <div class="col-12">
                    <h2 class="fw-bold">Product Description</h2>
                    <p><?php echo htmlspecialchars($row['prodlongdescription']); ?></p>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="mt-5 mb-3">
        <div class="row mt-3 mb-4">
            <div class="col-12">
                <h4 class="fw-bold">What do customers buy after viewing this item?</h4>
            </div>
        </div>

        <div class="row">
        <?php 
        $query = "SELECT * FROM products";
        $stmt = $pdo->query($query);

        try{
            if ($stmt->rowCount() == 0) {
                echo("Error: Failed to load product recommendations.");
                exit;
            } else {
                for ($i = 1; $i <= 6; $i++) {
                    $row = $stmt->fetch();
                    if (!$row) {
                        break;
                    }
                    ?>

                    <div class='col-sm-12 col-md-4 col-xl-2 p-2'>
                        <div class="text-center py-4 p-2 border rounded-none border-8 border-solid border-gray-800">
                            <img src="<?php echo htmlspecialchars($row['prodimage']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['prodname']); ?>" style="height: 150px; width: auto;">
                            <h4 class="mb-1"><a href="product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="text-decoration-none text-reset fs-6"><?php echo htmlspecialchars($row['prodname'])?></a></h4>
                            <p class="fw-bold fs-5">$<?php echo htmlspecialchars($row['prodprice']); ?></p>
                        </div>
                    </div>

                    <?php
                }
            }
        ?>
        </div>

    <?php
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    ?>

    </div>


</section>

<?php include("../assets/footer.php"); ?>