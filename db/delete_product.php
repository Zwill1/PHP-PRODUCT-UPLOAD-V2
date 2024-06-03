<?php include "dbcon-pdo.php" ?>

<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

    $query = "delete from `products` where `prodid` = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if($stmt->execute(['id' => $id])){
        header("location:../index.php?delete_msg=The product has been deleted to the database.");
    }else{
        echo "Something went wrong. Please try again.";
    }
    
?>