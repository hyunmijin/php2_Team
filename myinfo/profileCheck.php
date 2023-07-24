<?php
    include "../connect/connect.php";
    $type = $_POST['type'];
    $jsonResult = "bad";
    
    if( $type == "isNickCheck"){
        $nickName = $connect -> real_escape_string(trim($_POST['nickName']));
        $sql = "SELECT nickName FROM members2 WHERE nickName = '{$nickName}'";
    }

    $result = $connect -> query($sql);
    if( $result -> num_rows == 0 ){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>