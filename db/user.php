<?php include "dbcon-pdo.php" ?>

<?php 

if(isset($_GET['userId'])){

    $userId = $_GET['userId'];

    // echo $userId;

    $sql = "SELECT username, email, created_at from users where userId = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        header("location:../index.php?message=The user was not found.");
        exit;
    } else {
        $row = $stmt->fetch();
    }
}

?>

<?php include "../assets/header.php" ?>

<?php if (isset($row)) { 
    
    // Original date string
    $dateString = htmlspecialchars($row['created_at']);

    // Create a DateTime object from the string
    $date = new DateTime($dateString);

    // Format the date to a readable month and year format
    $readableDate = $date->format('F Y');

    // echo $readableDate;
    
    ?>

<section class="container">
    <div class="mt-5 mb-3 row">
        <div>
            <h1 class="fw-bold">Seller's Profile:</h1>
        </div>
    </div>
    <div class="mb-3 row">
        <div>
            <?php 
                try {
                    ?>
                        <p>User: <?php echo htmlspecialchars($row['username']); ?></p>
                        <p>Contact Seller: <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>"><?php echo htmlspecialchars($row['email']); ?></a></p>
                        <p>User Joined: <?php echo $readableDate; ?></p>
                        <?php
                }catch(PDOException $e){
                    // Handle the exception
                    echo 'Caught exception: ',  $e->getMessage();
                }
            ?>

            <!-- <p>User: <?php echo htmlspecialchars($row['username']); ?></p>
            <p>Contact Seller: <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>"><?php echo htmlspecialchars($row['email']); ?></a></p>
            <p>User Joined: <?php echo $readableDate; ?></p> -->
            
        </div>
    </div>
<?php } ?>
    <div class="mb-3 row">
        <div>
            <h2 class="fw-bold">Products by Seller:</h2>
        </div>
    </div>
    <div class="mb-3 row">
            <?php 
            
            $query = "SELECT * FROM products WHERE userId = :pid";
            
            $qstmt = $pdo->prepare($query);
            $qstmt->bindParam(':pid', $userId, PDO::PARAM_INT);
            $qstmt->execute();

            $results = $qstmt->fetchAll(PDO::FETCH_ASSOC);

            // var_dump($results);

            ?>

        <?php 
            
        try {
                
            foreach ($results as $row): ?>
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
                                    <a href="product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="btn btn-info w-100 rounded-0">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; 
        }catch(PDOException $e){
            // Handle the exception
            echo 'Caught exception: ',  $e->getMessage();
        }

        ?>

    </div>
</section>








<?php include("../assets/footer.php"); ?>