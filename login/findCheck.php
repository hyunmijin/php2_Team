<?php
    include "../connect/connect.php";
    $type = $_POST['type'];
    $jsonResult = "bad";
    
    if( $type == "isIDCheck"){
        $youName = $connect -> real_escape_string(trim($_POST['youName']));
        $youPhone = $connect -> real_escape_string(trim($_POST['youPhone']));
        $sql = "SELECT youName FROM members2 WHERE youName = '{$youName}' and youPhone = '{$youPhone}'";
    }

    if( $type == "isPWCheck"){
        $youEmail = $connect -> real_escape_string(trim($_POST['youEmail']));
        $youPhone = $connect -> real_escape_string(trim($_POST['youPhone']));
        $sql = "SELECT youName FROM members2 WHERE youEmail = '{$youEmail}' and youPhone = '{$youPhone}'";
    }
    $result = $connect -> query($sql);
    if( $result -> num_rows == 0 ){
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>