<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    
    if (!isset($_SESSION['memberID'])) {
        // echo "<script>alert('로그인한 사용자만 입력할 수 있습니다.');</script>";
        echo json_encode(array("result" => "로그인한 사용자만 입력할 수 있습니다"));
    }else{
        $regTime = time();

        $memberID = $_SESSION['memberID'];
        $productName = $_POST['productName'];
        $productFilter = $_POST['productFilter'];
        $productType = $_POST['productType'];
        $productDday = $_POST['productDday'];
        $productRegist= $_POST['productRegist'];
        $regTime = time();
        

        // $productName =  'ggg';
        // $productFilter =  '스킨';
        // $productType =  'Skincare';
        // $productDday =  '2024-05-04';
        // $productRegist =  '2023-05-04';

        $sql = "insert into categorie(memberID, productName, productFilter, productType, productDday, productRegist, regtime) value ('$memberID', '$productName', '$productType', '$productFilter', '$productDday', '$productRegist','$regTime')";
        $result = $connect -> query($sql);
        
        echo json_encode(array("result" => "입력이 완료 되었습니다."));
            // $KakaoTalk = $_POST['KakaoTalk'];
            // if ($KakaoTalk == 'y') {
            //     $resultKakaoTalk = '연동';
            // } else if ($KakaoTalk == 'n') {
            //     $resultKakaoTalk = '해제';
            // }
            // // data : {"youBirth" : youBirth, "gender" : gender, "gender" : youBirth, "youBirth" : ', "type" : "isInfoupdate"},
    
            // $sql = "UPDATE members2 SET KakaoTalk = '{$KakaoTalk}' WHERE youEmail = '{$youEmail}'";
            // $result = $connect -> query($sql);
            // // echo json_encode(array("result" => "success"));
            // if ($connect->query($sql) === TRUE) {
            //     echo json_encode(array("result" => "카카오톡정보가 ".$resultKakaoTalk." 되었습니다."));
            // } else {
            //     echo json_encode(array("result" => "오류가 발생하였습니다. 관리자에게 문의하세요"));
            // }
            // if ($youGender == "male"){
            //     $sql = "INSERT INTO members2 (youEmail, youName, youPass, youPhone, regTime, nickName, youBirth, youImgSrc, youImgSize, youGender) VALUES('$youEmail', '$youName', '$youPass', '$youPhone', '$regTime', '$nickName', '$youBirth', 'null', 'null', '$youGender')";
            // } else if ($youGender == "female"){
            //     $sql = "INSERT INTO members2 (youEmail, youName, youPass, youPhone, regTime, nickName, youBirth, youImgSrc, youImgSize, youGender) VALUES('$youEmail', '$youName', '$youPass', '$youPhone', '$regTime', '$nickName', '$youBirth', 'null', 'null', '$youGender')";
            // } else {
            //     $sql = "INSERT INTO members2 (youEmail, youName, youPass, youPhone, regTime, nickName, youBirth, youImgSrc, youImgSize, youGender) VALUES('$youEmail', '$youName', '$youPass', '$youPhone', '$regTime', '$nickName', '$youBirth', 'null', 'null', 'null')";
            // }
    }
    
?>