<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $memberID = $_SESSION['memberID'];

    $option = $_POST['option'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $Dday = $_POST['Dday'];

    // 1년 후의 날짜 계산
    $oneYearLater = date('Y-m-d', strtotime('+1 year', strtotime($date)));
    
    // 현재 날짜
    $currentDate = date('Y-m-d');

    // 남은 일 수 계산
    $interval = date_diff(date_create($currentDate), date_create($oneYearLater));
    $remainingDays = $interval->format('%r%a');

    $Dday = $remainingDays;
    $regTime = time();

    
    $sql = "INSERT INTO categorie (memberID, productName, productFilter, productType, productDday, productRegist, regtime) VALUES ('$memberID', '$name', '$option', '$option', '$Dday', '$date', '$regTime')";
    $result = $connect->query($sql);

    $LAST_INSERT_ID = $connect -> insert_id;

    $sql2 = "SELECT * FROM categorie WHERE productID = $LAST_INSERT_ID";
    $newDataResult = $connect->query($sql2);
    $newData = $newDataResult->fetch_assoc();

    // 응답 데이터로 새로운 데이터 정보를 보냄
    echo json_encode(array("result" => "success", "data" => $newData));
?>