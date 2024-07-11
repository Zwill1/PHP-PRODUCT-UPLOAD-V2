<?php include "dbcon-pdo.php" ?>

<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "SELECT * FROM `products` where `prodid` = :id";
        $stmt = $pdo->prepare($query);
        
        if($stmt->execute(['id' => $id])){
            $row = $stmt->fetch();
            if(!$row){
                header("location:../admin/account.php?message=The product was not found.");
                exit;
            }
        }else{
            header("location:../admin/account.php?message=Query failed: No results found");
            exit;
        }
            
}
?>

<?php
    if(isset($_POST['update_product'])){

        $pname = $_POST["pname"];
        $pbrand = $_POST["pbrand"];
        $pprice = $_POST["pprice"];
        $pquantity = $_POST["pquantity"];
        $pimage = $_POST["pimage"];
        $ptag = $_POST["ptags"];
        $pshortdescription = $_POST["pshortdescription"];
        $plongdescription = $_POST["plongdescription"];

        $query = "update `products` set `prodname` = :pname, `prodbrand` = :pbrand, `prodprice` = :pprice, `prodquantity` = :pquantity, `prodimage` = :pimage, `prodtag` = :ptag, `prodshortdescription` = :pshortdescription, `prodlongdescription` = :plongdescription where `prodid` = :id";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':pname', $pname, PDO::PARAM_STR);
        $stmt->bindParam(':pbrand', $pbrand, PDO::PARAM_STR);
        $stmt->bindParam(':pprice', $pprice, PDO::PARAM_STR);
        $stmt->bindParam(':pquantity', $pquantity, PDO::PARAM_INT);
        $stmt->bindParam(':pimage', $pimage, PDO::PARAM_STR);
        $stmt->bindParam(':ptag', $ptag, PDO::PARAM_STR);
        $stmt->bindParam(':pshortdescription', $pshortdescription, PDO::PARAM_STR);
        $stmt->bindParam(':plongdescription', $plongdescription, PDO::PARAM_STR);

        if($stmt->execute(['id' => $id,'pname' => $pname, 'pbrand' => $pbrand, 'pprice' => $pprice, 'pquantity' => $pquantity, 'pimage' => $pimage, 'ptag' => $ptag, 'pshortdescription' => $pshortdescription, 'plongdescription' => $plongdescription])){
            header("location:../admin/account.php?update_msg=The product has been updated.");
            exit;
        }else {
            header("location:../admin/account.php?message=The product was not updated.");
            exit;
        }
    }


?>

<?php include "../assets/header.php" ?>



<div class="container mt-3 mb-3">
<form action="edit_product.php?id=<?php echo $id; ?>" method="POST">
    <div class="form-group">
        <label for="exampleInputFistName">Product Name</label>
        <input type="text" class="form-control" id="exampleInputFistName" name="pname" value="<?php echo htmlspecialchars($row['prodname']); ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputFistName">Product Brand</label>
        <input type="text" class="form-control" id="exampleInputFistName" name="pbrand" value="<?php echo htmlspecialchars($row['prodbrand']); ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputLastName">Product Price</label>
        <input type="text" class="form-control" id="exampleInputLastName" name="pprice" value="<?php echo htmlspecialchars($row['prodprice']); ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputAge">Product Quantity</label>
        <input type="text" class="form-control" id="exampleInputAge" name="pquantity" value="<?php echo htmlspecialchars($row['prodquantity']); ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputAge">Product Image Link</label>
        <input type="text" class="form-control" id="exampleInputAge" name="pimage" value="<?php echo htmlspecialchars($row['prodimage']); ?>">
    </div>
    <div class="form-group py-3">
        <label for="exampleInputAge">Product Tag (Select one from dropdown)</label>
        <select class="form-select" aria-label="Default select example" name="ptags">\
            <option selected value="<?php echo htmlspecialchars($row['prodtag']); ?>"><?php echo htmlspecialchars($row['prodtag']); ?></option>
            <option value="arrivals">New Arrivals</option>
            <option value="shirts">Shirts</option>
            <option value="pants">Pants</option>
            <option value="shorts">Shorts</option>
            <option value="shoes">Shoes</option>
            <option value="sales">Sales</option>
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputAge">Product Short Description</label>
        <input type="text" class="form-control" id="exampleInputAge" name="pshortdescription" value="<?php echo htmlspecialchars($row['prodshortdescription']); ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputAge">Product Long Description</label>
        <textarea type="text" class="form-control" id="exampleInputAge" name="plongdescription"><?php echo htmlspecialchars($row['prodlongdescription']); ?></textarea> 
    </div>
    <div class="form-group mt-3">
        <input type="submit" class="btn btn-success" name="update_product" value="Update" />
    </div>
</form>

</div>

<?php include "../assets/footer.php" ?>