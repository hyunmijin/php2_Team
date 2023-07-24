<?php
    include "../connect/connect.php";
    $type = $_POST['type'];
    $jsonResult = "bad";
    
    if( $type == "isLoginCheck"){
        $memberID = $connect -> real_escape_string(trim($_POST['memberID']));
        $youPass = $connect -> real_escape_string(trim($_POST['youPass']));
        $sql = "SELECT memberID, youPass FROM members2 WHERE memberID = '{$memberID}' and youPass = '{$youPass}'";
    }
    
    $result = $connect -> query($sql);
    if( $result -> num_rows == 0 ){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>