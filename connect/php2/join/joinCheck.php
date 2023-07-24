<?php
    include "../connect/connect.php";
    $type = $_POST['type'];
    $jsonResult = "bad";
    
    if( $type == "isMemberIdChk"){
        $youEmail = $connect -> real_escape_string(trim($_POST['youEmail']));
        $sql = "SELECT youEmail FROM members2 WHERE youEmail = '{$youEmail}'";
    }
    if( $type == "isNickCheck"){
        $nickName = $connect -> real_escape_string(trim($_POST['nickName']));
        $sql = "SELECT nickName FROM members2 WHERE nickName = '{$nickName}'";
    }
    if( $type == "isPhoneCheck"){
        $youPhone = $connect -> real_escape_string(trim($_POST['youPhone']));
        $sql = "SELECT youPhone FROM members2 WHERE youPhone = '{$youPhone}'";
    }
    $result = $connect -> query($sql);
    if( $result -> num_rows == 0 ){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>