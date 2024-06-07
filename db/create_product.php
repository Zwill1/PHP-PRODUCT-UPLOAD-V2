<?php include "dbcon-pdo.php" ?>

<?php 

// Checks the POST method from INPUT button to pass info to SQL query.
if(isset($_POST["create_product"])){
    $pname = $_POST["pname"];
    $pbrand = $_POST["pbrand"];
    $pprice = $_POST["pprice"];
    $pquantity = $_POST["pquantity"];
    $pimage = $_POST["pimage"];
    $ptag = $_POST["ptags"];
    $pshortdescription = $_POST["pshortdescription"];
    $plongdescription = $_POST["plongdescription"];

    // Checks to see if name is empty as a STRING or NULL - NOT WORKING AS INTENDED JUST YET
    if($pname == "" || empty($pname)){
        header("location:../admin/account.php?message=You need fill in the product name");
    }
    if($pbrand == "" || empty($pname)){
        header("location:../admin/account.php?message=You need fill in the product brand");
    }
    if($pprice == "" || empty($pprice)){
        header("location:../admin/account.php?message=You need fill in the product price");
    }
    if($pquantity == "" || empty($pquantity)){
        header("location:../admin/account.php?message=You need fill in the product quantity");
    } 
    if($pimage == "" || empty($pimage)){
        header("location:../admin/account.php?message=You need fill in the product image link");
    } 
    if($ptag == "" || empty($ptag)){
        header("location:../admin/account.php?message=You need fill in the product tag");
    } 
    if($pshortdescription == "" || empty($pshortdescription)){
        header("location:../admin/account.php?message=You need fill in the product short description");
    } 
    if($plongdescription == "" || empty($plongdescription)){
        header("location:../admin/account.php?message=You need fill in the product long description");
    } 
    else {

        $query = "insert into `products` (`prodname`,`prodbrand`,`prodprice`,`prodquantity`, `prodimage`, `prodtag`, `prodshortdescription`, `prodlongdescription`) values (:pname, :pbrand, :pprice, :pquantity, :pimage, :ptag, :pshortdescription, :plongdescription)";

        $stmt = $pdo->prepare($query);
        // Using BindParam for more security
        $stmt->bindParam(':pname', $pname, PDO::PARAM_STR);
        $stmt->bindParam(':pbrand', $pbrand, PDO::PARAM_STR);
        $stmt->bindParam(':pprice', $pprice, PDO::PARAM_STR);
        $stmt->bindParam(':pquantity', $pquantity, PDO::PARAM_INT);
        $stmt->bindParam(':pimage', $pimage, PDO::PARAM_STR);
        $stmt->bindParam(':ptag', $ptag, PDO::PARAM_STR);
        $stmt->bindParam(':pshortdescription', $pshortdescription, PDO::PARAM_STR);
        $stmt->bindParam(':plongdescription', $plongdescription, PDO::PARAM_STR);

        if($stmt->execute()){

            // Redirects to index page with row data
            header("location:../index.php?insert_msg=The product has been added to the database.");

        }else {
            echo "Something went wrong. Please try again.";
        }
    }

}

?>