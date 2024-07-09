<?php include "dbcon-pdo.php" ?>

<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $query = "delete from `products` where `prodid` = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if($stmt->execute()){
        header("location:../admin/account.php?delete_msg=The product has been deleted to the database.");
        exit;
    }else{
        header("location:../admin/account.php?message=Their was an error deleting the product.");
        exit;
    }
    
?>