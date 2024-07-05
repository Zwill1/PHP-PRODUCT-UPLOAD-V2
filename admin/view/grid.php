<?php include "../../db/session.php" ?>
<?php include "../../db/dbcon-pdo.php" ?>
<?php include "../../assets/header.php" ?>

<!-- Set up local storage for session value and allow the nav to pick up if a session exists -->

<!-- Protected content here -->

<!-- Additional Security Measures

    Use HTTPS: Ensure your site is served over HTTPS to protect data in transit.
    Limit Login Attempts: Implement a mechanism to limit login attempts and prevent brute force attacks.
    Session Management: Regenerate session IDs on login and logout to prevent session fixation attacks.
    Password Policies: Enforce strong password policies to ensure users create strong passwords.
    Input Validation and Sanitization: Always validate and sanitize user input to prevent XSS and other injection attacks. -->

<div class="container-fluid pt-5 px-0">
    <div class="row mx-0">
        <div class="col-lg-12 col-xl-3">
            <nav class="nav flex-column">
                <a class="btn btn-secondary m-0 rounded-0" type="button" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Add a Product</a>
            </nav>
            <div class="row mx-0 mt-2">
            <div class="col-lg-6 col-xl-6 p-0">
                <nav class="nav flex-column">
                    <a class="btn btn-warning m-0 rounded-0" type="button" href="http://localhost/PHP-PRODUCT-UPLOAD-v2/admin/view/list.php">List View</a>
                </nav>
            </div>
            <div class="col-lg-6 col-xl-6 p-0">
                <nav class="nav flex-column">
                    <a class="btn btn-info m-0 rounded-0" type="button" href="http://localhost/PHP-PRODUCT-UPLOAD-v2/admin/account.php">Regular View</a>
                </nav>
            </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-9">
            <div class="row">

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
                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 p-0">
                        <div class="border rounded-none border-8 border-solid border-gray-800 m-2 my-xl-0 mx-md-1">

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
                                    <div class="col-12 pt-2 pb-2">
                                        <a href="../../db/product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="btn btn-info w-100 rounded-0">Details</a>
                                    </div>
                                    <div class="col-12 d-flex justify-content-evenly">
                                        <a href="../../db/edit_product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="btn btn-warning w-100 rounded-0 px-0 me-1">Edit</a>
                                        <a href="../../db/delete_product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="btn btn-danger w-100 rounded-0 px-0 ms-1">Delete</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            <?php endforeach; ?>

        </div>
        <div class="row py-5">
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
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="../db/create_product.php" method="POST">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <!-- <form> -->
                    <div class="form-group">
                        <label for="exampleInputFistName">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputFistName" name="pname" aria-describedby="First Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFistName">Product Brand</label>
                        <input type="text" class="form-control" id="exampleInputFistName" name="pbrand" aria-describedby="First Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLastName">Product Price</label>
                        <input type="text" class="form-control" id="exampleInputLastName" name="pprice">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAge">Product Quantity</label>
                        <input type="text" class="form-control" id="exampleInputAge" name="pquantity">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAge">Product Image Link (Not File Upload)</label>
                        <input type="text" class="form-control" id="exampleInputAge" name="pimage">
                    </div>
                    <div class="form-group py-3">
                        <label for="exampleInputAge">Product Tag (Select one from dropdown)</label>
                        <select class="form-select" aria-label="Default select example" name="ptags">
                            <option selected value="arrivals">New Arrivals</option>
                            <option value="shirts">Shirts</option>
                            <option value="pants">Pants</option>
                            <option value="shorts">Shorts</option>
                            <option value="shoes">Shoes</option>
                            <option value="sales">Sales</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAge">Product About Description (Short)</label>
                        <input type="text" class="form-control" id="exampleInputAge" name="pshortdescription">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAge">Product Long Description</label>
                        <textarea type="text" class="form-control" id="exampleInputAge" name="plongdescription"></textarea> 
                    </div>
                <!-- </form> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="create_product" value="Add" />
                </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->

<?php include "../../assets/footer.php" ?>