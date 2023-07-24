<?php
    include "../connect/connect.php";
    $sql = "create table members2(";
    $sql .= "memberID int(10) unsigned auto_increment,";
    $sql .= "youEmail varchar(40) UNIQUE NOT NULL,";
    $sql .= "youName varchar(10) NOT NULL,";
    $sql .= "youPass varchar(20) NOT NULL,";
    $sql .= "youPhone varchar(40),";
    $sql .= "regTime int(40) NOT NULL,";
    $sql .= "nickName varchar(40) NOT NULL,";
    $sql .= "youBirth int(20) NOT NULL,";
    $sql .= "youGender varchar(10) NOT NULL,";
    $sql .= "PRIMARY KEY(memberID)";
    $sql .= ") charset=utf8;";
    $result = $connect -> query($sql);
    if($result){
        echo "create tables Complete";
    } else {
        echo "create tables false";
    }
?>