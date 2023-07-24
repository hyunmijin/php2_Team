<?php
    include "../connect/connect.php";
    $productID = $_POST['productID'];
    
    
    $sql = "DELETE FROM categorie WHERE productID = $productID";
    $result = $connect -> query($sql);
    if ($result) {
        $jsonResult = "success";
    } else {
        $jsonResult = "error";
    }
    echo json_encode(array("result" => $jsonResult));
?>