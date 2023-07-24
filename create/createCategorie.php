<?php
    include "../connect/connect.php";
    $sql = "create table categorie(";
    $sql .= "productID int(5) unsigned auto_increment,";
    $sql .= "memberID int(10) NOT NULL,";
    $sql .= "productName varchar(40) NOT NULL,";
    $sql .= "productFilter varchar(20) NOT NULL,";
    $sql .= "productType varchar(20) NOT NULL,";
    $sql .= "productDday varchar(20) NOT NULL,";
    $sql .= "productRegist varchar(20) NOT NULL,";
    $sql .= "regTime int(40) NOT NULL,";
    $sql .= "PRIMARY KEY(productID)";
    $sql .= ") charset=utf8;";
    $result = $connect -> query($sql);
    if($result){
        echo "create tables Complete";
    } else {
        echo "create tables false";
    }
?>