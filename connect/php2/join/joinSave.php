<?php

//회원가입
include "../connect/connect.php";

$youEmail = $_POST['memberID'];
$youName = $_POST['youName'];
$youPass = $_POST['youPass'];
$youPhone = $_POST['youPhone'];
$youBirth = $_POST['youBirth'];
$nickName = $_POST['nickName'];
$regTime = time();

    // 데이터 입력하기
    $sql = "INSERT INTO members2 (youEmail, youName, youPass, youPhone, regTime, nickName, youBirth, youImgSrc, youImgSize, youGender) VALUES('$youEmail', '$youName', '$youPass', '$youPhone', '$regTime', '$nickName', '$youBirth', 'profile.jpeg', 'null', 'null')";
    
    $result = $connect -> query($sql);
?>