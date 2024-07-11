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

    <!-- display message when validating new product is done incorrectly -->
    <?php        
        if(isset($_GET['message'])){
            echo 
            "<section class='container-fluid p-0'>
                <div class='bg-danger p-2'>
                    <div class='container text-white text-center fw-bold'>
                        <h6 class='text-center'>".$_GET['message']."</h6>
                    </div>
                </div>
            </section>";
        }       
    ?>

<?php include "assets/hero.php" ?>

<?php include 'assets/components/iconbar.php' ?>

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

    <section class="pt-4">
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
                <img class="img-fluid" src="assets/images/image-1.jpg" alt="woman carrying her bags from a day of shopping" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="assets/images/image-2.jpg" alt="woman looking at shoes in a shopping mall" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="assets/images/image-3.jpg" alt="rack of suits in a store" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="assets/images/image-4.jpg" alt="clothes and shoes on a wall rack display" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="assets/images/image-5.jpg" alt="open store with clothes on hangers for customers" />
            </div>
            <div class="col-6 col-md-4 col-xl-2 px-0 img-container">
                <img class="img-fluid" src="assets/images/image-6.jpg" alt="2 customers looking at clothes and checking the price tag" />
            </div>
        </div>
    </section>

</div>

<div class="container-fluid text-bg-primary p-0">
    <section class="container g-0 py-3">
        <div class="row w-full mx-0 d-flex align-items-center py-2 py-lg-0">
            <div class="w-full col-lg-4 px-0 text-center text-lg-start">
                <p class="mb-0">
                    <a href="#" class="text-black text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor" class="rounded-circle bg-white p-1"><path d="M14 13.5H16.5L17.5 9.5H14V7.5C14 6.47062 14 5.5 16 5.5H17.5V2.1401C17.1743 2.09685 15.943 2 14.6429 2C11.9284 2 10 3.65686 10 6.69971V9.5H7V13.5H10V22H14V13.5Z"></path></svg>
                    </a>
                    <a href="#" class="text-black text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor" class="rounded-circle bg-white p-1"><path d="M22.2125 5.65605C21.4491 5.99375 20.6395 6.21555 19.8106 6.31411C20.6839 5.79132 21.3374 4.9689 21.6493 4.00005C20.8287 4.48761 19.9305 4.83077 18.9938 5.01461C18.2031 4.17106 17.098 3.69303 15.9418 3.69434C13.6326 3.69434 11.7597 5.56661 11.7597 7.87683C11.7597 8.20458 11.7973 8.52242 11.8676 8.82909C8.39047 8.65404 5.31007 6.99005 3.24678 4.45941C2.87529 5.09767 2.68005 5.82318 2.68104 6.56167C2.68104 8.01259 3.4196 9.29324 4.54149 10.043C3.87737 10.022 3.22788 9.84264 2.64718 9.51973C2.64654 9.5373 2.64654 9.55487 2.64654 9.57148C2.64654 11.5984 4.08819 13.2892 6.00199 13.6731C5.6428 13.7703 5.27232 13.8194 4.90022 13.8191C4.62997 13.8191 4.36771 13.7942 4.11279 13.7453C4.64531 15.4065 6.18886 16.6159 8.0196 16.6491C6.53813 17.8118 4.70869 18.4426 2.82543 18.4399C2.49212 18.4402 2.15909 18.4205 1.82812 18.3811C3.74004 19.6102 5.96552 20.2625 8.23842 20.2601C15.9316 20.2601 20.138 13.8875 20.138 8.36111C20.138 8.1803 20.1336 7.99886 20.1256 7.81997C20.9443 7.22845 21.651 6.49567 22.2125 5.65605Z"></path></svg>
                    </a>
                    <a href="#" class="text-black text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor" class="rounded-circle bg-white p-1"><path d="M13.3717 2.09442C8.42512 1.41268 3.73383 4.48505 2.38064 9.29256C1.02745 14.1001 3.42711 19.1692 8.00271 21.1689C7.94264 20.4008 7.99735 19.628 8.16502 18.8761C8.34964 18.0374 9.46121 13.4132 9.46121 13.4132C9.23971 12.9173 9.12893 12.379 9.13659 11.8359C9.13659 10.3509 9.99353 9.24295 11.0597 9.24295C11.4472 9.23718 11.8181 9.40028 12.0758 9.68981C12.3335 9.97934 12.4526 10.3667 12.402 10.751C12.402 11.6512 11.8236 13.0131 11.5228 14.2903C11.4014 14.7656 11.5131 15.2703 11.8237 15.65C12.1343 16.0296 12.6069 16.2389 13.0967 16.2139C14.9944 16.2139 16.2675 13.7825 16.2675 10.9126C16.2675 8.71205 14.8098 7.0655 12.1243 7.0655C10.826 7.01531 9.56388 7.4996 8.63223 8.40543C7.70057 9.31126 7.18084 10.5595 7.19423 11.859C7.16563 12.5722 7.39566 13.2717 7.84194 13.8287C8.01361 13.9564 8.07985 14.1825 8.00425 14.3827C7.9581 14.5673 7.84194 15.0059 7.79578 15.1675C7.77632 15.278 7.70559 15.3728 7.60516 15.4228C7.50473 15.4729 7.38651 15.4724 7.28654 15.4214C5.9019 14.8674 5.24957 13.3439 5.24957 11.6051C5.24957 8.75822 7.63424 5.3497 12.4036 5.3497C16.1998 5.3497 18.723 8.1273 18.723 11.0972C18.723 15.0059 16.5468 17.9451 13.3298 17.9451C12.3526 17.9761 11.4273 17.5061 10.8759 16.6986C10.8759 16.6986 10.2974 19.0146 10.1835 19.4531C9.95101 20.2099 9.60779 20.9281 9.16505 21.5844C10.0877 21.8643 11.0471 22.0044 12.0113 22C14.6636 22.0017 17.2078 20.9484 19.0829 19.072C20.958 17.1957 22.0099 14.6504 22.0069 11.9975C22.004 7.00306 18.3183 2.77616 13.3717 2.09442Z"></path></svg>
                    </a>
                    <a href="#" class="text-black text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor" class="rounded-circle bg-white p-1"><path d="M12.2439 4C12.778 4.00294 14.1143 4.01586 15.5341 4.07273L16.0375 4.09468C17.467 4.16236 18.8953 4.27798 19.6037 4.4755C20.5486 4.74095 21.2913 5.5155 21.5423 6.49732C21.942 8.05641 21.992 11.0994 21.9982 11.8358L21.9991 11.9884L21.9991 11.9991C21.9991 11.9991 21.9991 12.0028 21.9991 12.0099L21.9982 12.1625C21.992 12.8989 21.942 15.9419 21.5423 17.501C21.2878 18.4864 20.5451 19.261 19.6037 19.5228C18.8953 19.7203 17.467 19.8359 16.0375 19.9036L15.5341 19.9255C14.1143 19.9824 12.778 19.9953 12.2439 19.9983L12.0095 19.9991L11.9991 19.9991C11.9991 19.9991 11.9956 19.9991 11.9887 19.9991L11.7545 19.9983C10.6241 19.9921 5.89772 19.941 4.39451 19.5228C3.4496 19.2573 2.70692 18.4828 2.45587 17.501C2.0562 15.9419 2.00624 12.8989 2 12.1625V11.8358C2.00624 11.0994 2.0562 8.05641 2.45587 6.49732C2.7104 5.51186 3.45308 4.73732 4.39451 4.4755C5.89772 4.05723 10.6241 4.00622 11.7545 4H12.2439ZM9.99911 8.49914V15.4991L15.9991 11.9991L9.99911 8.49914Z"></path></svg>
                    </a>
                    <a href="#" class="text-black text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor" class="rounded-circle bg-white p-1"><path d="M6.94048 4.99993C6.94011 5.81424 6.44608 6.54702 5.69134 6.85273C4.9366 7.15845 4.07187 6.97605 3.5049 6.39155C2.93793 5.80704 2.78195 4.93715 3.1105 4.19207C3.43906 3.44699 4.18654 2.9755 5.00048 2.99993C6.08155 3.03238 6.94097 3.91837 6.94048 4.99993ZM7.00048 8.47993H3.00048V20.9999H7.00048V8.47993ZM13.3205 8.47993H9.34048V20.9999H13.2805V14.4299C13.2805 10.7699 18.0505 10.4299 18.0505 14.4299V20.9999H22.0005V13.0699C22.0005 6.89993 14.9405 7.12993 13.2805 10.1599L13.3205 8.47993Z"></path></svg>
                    </a>
                    <a href="#" class="text-black text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor" class="rounded-circle bg-white p-1"><path d="M13.3109 20.3997C12.8839 20.4657 12.4464 20.5 12.001 20.5C7.30656 20.5 3.50098 16.6944 3.50098 12C3.50098 11.5545 3.53524 11.1171 3.60129 10.6901C3.21792 9.96108 3.00098 9.13087 3.00098 8.25C3.00098 5.35051 5.35148 3 8.25098 3C9.13185 3 9.96205 3.21694 10.6911 3.60031C11.118 3.53427 11.5555 3.5 12.001 3.5C16.6954 3.5 20.501 7.30558 20.501 12C20.501 12.4455 20.4667 12.8829 20.4007 13.3099C20.784 14.0389 21.001 14.8691 21.001 15.75C21.001 18.6495 18.6505 21 15.751 21C14.8701 21 14.0399 20.7831 13.3109 20.3997ZM12.0532 17.1555L12.0126 17.1562C14.8854 17.1562 16.3158 15.7703 16.3158 13.9132C16.3158 12.7148 15.7645 11.442 13.5904 10.9552L11.6073 10.515C10.8522 10.3433 9.98514 10.1145 9.98514 9.39975C9.98514 8.685 10.6041 8.187 11.7088 8.187C13.9394 8.187 13.7355 9.71475 14.8403 9.71475C15.4156 9.71475 15.933 9.37275 15.933 8.78475C15.933 7.41525 13.7355 6.3855 11.8773 6.3855C9.85579 6.3855 7.70421 7.2435 7.70421 9.52875C7.70421 10.6275 8.09753 11.799 10.2634 12.342L12.9527 13.0133C13.7686 13.215 13.9709 13.6718 13.9709 14.085C13.9709 14.772 13.2873 15.4432 12.0532 15.4432C9.6362 15.4432 9.97461 13.5855 8.67885 13.5855C8.09828 13.5855 7.67639 13.9837 7.67639 14.5575C7.67639 15.6712 9.0278 17.1555 12.0532 17.1555Z"></path></svg>
                    </a>
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