<?php
    include "../connect/connect.php";

    $productID = $_POST['productID'];
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
    
    $sql = "UPDATE categorie SET productName = '$name', productFilter = '$option', productType = '$option', productDday = '$oneYearLater', productRegist = '$date' WHERE productID = $productID";
    $result = $connect -> query($sql);
    if ($result) {
        $jsonResult = "success";
    } else {
        $jsonResult = "error";
    }
    echo json_encode(array("result" => $jsonResult));
?>