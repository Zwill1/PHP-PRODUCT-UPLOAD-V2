<?php include "../db/session.php" ?>
<?php include "../db/dbcon-pdo.php" ?>
<?php include "../assets/header.php" ?>

<!-- display success when registering/logging in is done correctly -->
<?php        
    if(isset($_GET['acct_msg'])){
        echo 
        "<section class='container-fluid p-0'>
            <div class='bg-success p-2'>
                <div class='container text-white text-center fw-bold'>
                    <h6 class='text-center'>".$_GET['acct_msg']."</h6>
                </div>
            </div>
        </section>";
    }       
?>
<?php        
    if(isset($_GET['reg_msg'])){
        echo 
        "<section class='container-fluid p-0'>
            <div class='bg-success p-2'>
                <div class='container text-white text-center fw-bold'>
                    <h6 class='text-center'>".$_GET['reg_msg']."</h6>
                </div>
            </div>
        </section>";
    }       
?>

<!-- Set up local storage for session value and allow the nav to pick up if a session exists -->

<!-- Protected content here -->

<!-- Additional Security Measures

    Use HTTPS: Ensure your site is served over HTTPS to protect data in transit.
    Limit Login Attempts: Implement a mechanism to limit login attempts and prevent brute force attacks.
    Session Management: Regenerate session IDs on login and logout to prevent session fixation attacks.
    Password Policies: Enforce strong password policies to ensure users create strong passwords.
    Input Validation and Sanitization: Always validate and sanitize user input to prevent XSS and other injection attacks. -->

<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <nav class="nav flex-column">
                <a class="btn btn-secondary m-1" type="button" href="#">Add a Product</a>
                <a class="btn btn-secondary m-1" type="button" href="#">Edit a Product</a>
                <a class="btn btn-secondary m-1" type="button" href="#">Delete a Product</a>
            </nav>
        </div>
        <div class="col-9">
            <div class="row">
                <!-- Display all products here with pagination -->
                <?php 
                
                try {

                    // Prepare the SQL query
                    $stmt = $pdo->prepare("SELECT * FROM products");

                    // Execute the query
                    $stmt->execute();

                    // Fetch the results in a while loop
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Process each row
                        // echo "Product ID: " . $row['prodid'] . "<br>";
                        // echo "Product Product Name: " . $row['prodname'] . "<br>";
                        // echo "Product Price: " . $row['prodprice'] . "<br><br>";
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
                                    <div class="col-12 pt-2 pb-2">
                                        <a href="db/product.php?id=<?php echo $row['prodid']; ?>" class="btn btn-info w-100">Details</a>
                                    </div>
                                    <div class="col-12 d-flex justify-content-evenly">
                                        <a href="db/edit_product.php?id=<?php echo $row['prodid']; ?>" class="btn btn-warning w-100 mx-1">Edit</a>
                                        <a href="db/delete_product.php?id=<?php echo $row['prodid']; ?>" class="btn btn-danger w-100 mx-1">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                } catch(PDOException $e) {

                    // Handle the exception
                    echo "Connection failed: " . $e->getMessage();

                }


                ?>            
        </div>
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>