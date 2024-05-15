<?php include "dbcon.php" ?>

<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

    $query = "delete from `products` where `prodid` = '$id'";

    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Query Failed".mysqli_error($connection));
    }else{
        header("location:../index.php?delete_msg=The product has been deleted to the database.");
    }

?>