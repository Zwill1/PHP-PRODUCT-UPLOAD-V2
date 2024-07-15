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
    $userId = $_POST["usrId"];

    // Checks to see if name is empty as a STRING or NULL - NOT WORKING AS INTENDED JUST YET
    if($pname == "" || empty($pname)){
        header("location:../admin/account.php?message=You need fill in the product name");
        exit;
    }
    if($pbrand == "" || empty($pname)){
        header("location:../admin/account.php?message=You need fill in the product brand");
        exit;
    }
    if($pprice == "" || empty($pprice)){
        header("location:../admin/account.php?message=You need fill in the product price");
        exit;
    }
    if($pquantity == "" || empty($pquantity)){
        header("location:../admin/account.php?message=You need fill in the product quantity");
        exit;
    } 
    if($pimage == "" || empty($pimage)){
        header("location:../admin/account.php?message=You need fill in the product image link");
        exit;
    } 
    if($ptag == "" || empty($ptag)){
        header("location:../admin/account.php?message=You need fill in the product tag");
        exit;
    } 
    if($pshortdescription == "" || empty($pshortdescription)){
        header("location:../admin/account.php?message=You need fill in the product short description");
        exit;
    } 
    if($plongdescription == "" || empty($plongdescription)){
        header("location:../admin/account.php?message=You need fill in the product long description");
        exit;
    } 
    if($userId == "" || empty($userId)){
        header("location:../admin/account.php?message=Error in submitting the form.");
        exit;
    } 
    else {

        $query = "insert into `products` (`prodname`,`prodbrand`,`prodprice`,`prodquantity`, `prodimage`, `prodtag`, `prodshortdescription`, `prodlongdescription`, `userId`) values (:pname, :pbrand, :pprice, :pquantity, :pimage, :ptag, :pshortdescription, :plongdescription, :usrId)";

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
        $stmt->bindParam(':usrId', $userId, PDO::PARAM_INT);

        if($stmt->execute()){
            // Redirects to index page with row data
            header("location:../admin/account.php?insert_msg=The product has been added to the database.");
            exit;
        }else {
            // Redirects to account admin page with row data
            header("location:../admin/account.php?message=Their was an error adding the product.");
            exit;
        }
    }

}

?>