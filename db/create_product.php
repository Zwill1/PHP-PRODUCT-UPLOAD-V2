<?php include "dbcon.php" ?>

<?php 

// Checks the POST method from INPUT button to pass info to SQL query.
if(isset($_POST["create_product"])){
    $pname = $_POST["pname"];
    $pbrand = $_POST["pbrand"];
    $pprice = $_POST["pprice"];
    $pquantity = $_POST["pquantity"];
    $pimage = $_POST["pimage"];
    $pshortdescription = $_POST["pshortdescription"];
    $plongdescription = $_POST["plongdescription"];

    // Checks to see if name is empty as a STRING or NULL - NOT WORKING AS INTENDED JUST YET
    if($pname == "" || empty($pname)){
        header("location:../index.php?message=You need fill in the product name");
    }
    if($pbrand == "" || empty($pname)){
        header("location:../index.php?message=You need fill in the product brand");
    }
    if($pprice == "" || empty($pprice)){
        header("location:../index.php?message=You need fill in the product price");
    }
    if($pquantity == "" || empty($pquantity)){
        header("location:../index.php?message=You need fill in the product quantity");
    } 
    if($pimage == "" || empty($pimage)){
        header("location:../index.php?message=You need fill in the product image link");
    } 
    if($pshortdescription == "" || empty($pshortdescription)){
        header("location:../index.php?message=You need fill in the product short description");
    } 
    if($plongdescription == "" || empty($plongdescription)){
        header("location:../index.php?message=You need fill in the product long description");
    } 
    else {
        $query = "insert into `products` (`prodname`,`prodbrand`,`prodprice`,`prodquantity`, `prodimage`, `prodshortdescription`, `prodlongdescription`) values ('$pname', '$pbrand', '$pprice', '$pquantity', '$pimage', '$pshortdescription', '$plongdescription')";

        $result = mysqli_query($connection, $query);

        if(!$result){
            die("Query Failed".mysqli_error($connection));
        }else{
            // Redirects to index page with row data
            header("location:../index.php?insert_msg=The product has been added to the database.");
        }
    }

}

?>