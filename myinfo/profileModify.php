<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $memberID = $_SESSION['memberID'];
    $nickName = $_SESSION['nickName'];
    $nickNameModify = $_POST['nickName'];
    $skinType = $_POST['skinType'];
    
    // 데이터 출력
    $sql = "update members2 set nickName = '{$nickNameModify}', skinType = '{$skinType}'  where memberID = '{$memberID}'";
    $result = $connect -> query($sql);

    echo $sql;
    $sql2 = "SELECT memberID, youEmail, youName, youPass, nickName, skinType FROM members2 WHERE memberID = '{$memberID}'";
    $result2 = $connect -> query($sql2);
    $memberInfo = $result2 -> fetch_array(MYSQLI_ASSOC);

    unset($_SESSION['memberID']);
    unset($_SESSION['youEmail']);
    unset($_SESSION['youName']);
    unset($_SESSION['nickName']);

    $_SESSION['memberID'] = $memberInfo['memberID'];
    $_SESSION['youEmail'] = $memberInfo['youEmail'];
    $_SESSION['youName'] = $memberInfo['youName'];
    $_SESSION['nickName'] = $memberInfo['nickName'];
        

    Header("Location: myInfoProfile.php");

?>