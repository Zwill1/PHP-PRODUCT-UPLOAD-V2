    </div>
    <footer class="bg-body-tertiary pb-3 pt-3 mt-5">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12 col-md-4 text-center text-sm-center text-md-start">
                    <a class="fw-bold" href="http://localhost/PHP-PRODUCT-UPLOAD/">
                        <img src="http://localhost/PHP-PRODUCT-UPLOAD/assets/product-upload-logo.png" width="200px" alt="Product Upload logo" />
                    </a>
                </div>
                <div class="col-sm-12 col-md-4 text-center text-sm-center text-md-start">
                    <h6 class="fw-bold">Address</h6>
                    <p class="mb-0">Product Upload Ltd.</p>
                    <p class="mb-0">111 Calgary Ave.</p>
                    <p>Calgary, AB A1A A1A</p>
                    <p class="fw-bold">Phone <a href="#" class="text-decoration-none">(587) 111-2222</a></p>
                    <p class="fw-bold">Email <a href="#" class="text-decoration-none">info@productupload.ca</a></p>
                </div>
                <div class="col-sm-12 col-md-4 text-center text-sm-center text-md-start">
                    <h6 class="fw-bold">Hours:</h6>
                    <p class="mb-0">Monday - Saturday</p>
                    <p>11 am to 5:30 pm</p>
                </div>
            </div>
        </div>
    </footer>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>