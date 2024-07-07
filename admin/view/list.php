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
                    <a class="btn btn-warning m-0 rounded-0" type="button" href="http://localhost/PHP-PRODUCT-UPLOAD-v2/admin/account.php">Regular View</a>
                </nav>
            </div>
            <div class="col-lg-6 col-xl-6 p-0">
                <nav class="nav flex-column">
                    <a class="btn btn-info m-0 rounded-0" type="button" href="http://localhost/PHP-PRODUCT-UPLOAD-v2/admin/view/grid.php">Grid View</a>
                </nav>
            </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-9">
            <div class="row">

            <?php 
            
                $sql = 'SELECT COUNT(*) FROM products';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $sql = "SELECT * FROM products";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ?>

        <table class="table table-dark table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Category</th>
                    <th scope="col">Product Details</th>
                </tr>
            </thead>
            <?php foreach ($results as $row): ?>
                <tr>
                <th scope="row"><?php echo htmlspecialchars($row['prodid']); ?></th>
                <td><?php echo htmlspecialchars($row['prodname']); ?></td>
                <td><?php echo htmlspecialchars($row['prodbrand']); ?></td>
                <td>$<?php echo htmlspecialchars($row['prodprice']); ?></td>
                <td><?php echo htmlspecialchars($row['prodquantity']); ?></td>
                <td><?php echo htmlspecialchars($row['prodtag']); ?></td>
                <td>
                    <a href="../../db/product.php?id=<?php echo htmlspecialchars($row['prodid']); ?>" class="btn btn-info w-100 rounded-0">Details</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="../../db/create_product.php" method="POST">
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