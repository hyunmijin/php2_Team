<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    // $type = "isPwUpdate";
    // $youPass = 'qweqwe123!!';    
    // $youEmail= 'admin@admin.com';
    
    $jsonResult = "bad";
    $type = $_POST['type'];

    if( $type == "isPwChk"){
        $youPass = $_POST['youPass'];    
        $youEmail= $_POST['youEmail'];
        $sql = "SELECT youPass FROM members2 WHERE youPass = '{$youPass}' AND youEmail = '{$youEmail}'";
        $result = $connect -> query($sql);
        if( $result -> num_rows == 1 ){
            $jsonResult = "good";
        }
        echo json_encode(array("result" => $jsonResult));

    }else if( $type == "isPwUpdate"){
        $youPass = $_POST['youPass'];    
        $youEmail= $_POST['youEmail'];
        $sql = "SELECT youPass FROM members2 WHERE youPass = '{$youPass}' AND youEmail = '{$youEmail}'";
        $result = $connect -> query($sql);

        if( $result -> num_rows == 1 ){

            $youPass = $_POST['newPass'];
            $sql = "UPDATE members2 SET youPass = '{$youPass}'WHERE youEmail = '{$youEmail}'";
            $result = $connect -> query($sql);
            if ($connect->query($sql) === TRUE) {
                echo json_encode(array("result" => "비밀번호가 변경되었습니다."));
            } else {
                echo json_encode(array("result" => "오류가 발생하였습니다. 관리자에게 문의하세요"));
            }
        }else{
            echo json_encode(array("result" => "기존 비밀번호가 틀렸습니다."));
        }

    }else if($type =="isPhoneChk"){
        $youPhone= $_POST['youPhone'];

        $sql = "SELECT youPhone FROM members2 WHERE youPhone = '{$youPhone}'";
        $result = $connect -> query($sql);

        if( $result -> num_rows == 0 ){
            $jsonResult = "good";
        }
        echo json_encode(array("result" => $jsonResult));
        
    }else if($type =="isInfoupdate"){
        $youPhone = $_POST['youPhone'];
        $gender = $_POST['gender'];
        $youBirth = $_POST['youBirth'];
        $youEmail= $_POST['youEmail'];
        // data : {"youBirth" : youBirth, "gender" : gender, "gender" : youBirth, "youBirth" : ', "type" : "isInfoupdate"},

        $sql = "UPDATE members2 SET youPhone = '{$youPhone}', youGender = '{$gender}', youBirth = '{$youBirth}' WHERE youEmail = '{$youEmail}'";
        $result = $connect -> query($sql);
        // echo json_encode(array("result" => "success"));
        if ($connect->query($sql) === TRUE) {

            echo json_encode(array("result" => "회원정보가 변경되었습니다."));
        } else {
            echo json_encode(array("result" => "오류가 발생하였습니다. 관리자에게 문의하세요"));
        }
    }else if($type =="isKakaoUpdate"){
        $KakaoTalk = $_POST['KakaoTalk'];
        $youEmail= $_POST['youEmail'];
        $KakaoTalk = $_POST['KakaoTalk'];
        if ($KakaoTalk == 'y') {
            $resultKakaoTalk = '연동';
        } else if ($KakaoTalk == 'n') {
            $resultKakaoTalk = '해제';
        }
        // data : {"youBirth" : youBirth, "gender" : gender, "gender" : youBirth, "youBirth" : ', "type" : "isInfoupdate"},

        $sql = "UPDATE members2 SET KakaoTalk = '{$KakaoTalk}' WHERE youEmail = '{$youEmail}'";
        $result = $connect -> query($sql);
        // echo json_encode(array("result" => "success"));
        if ($connect->query($sql) === TRUE) {
            echo json_encode(array("result" => "카카오톡정보가 ".$resultKakaoTalk." 되었습니다."));
        } else {
            echo json_encode(array("result" => "오류가 발생하였습니다. 관리자에게 문의하세요"));
        }
    }else if($type =="isAgreeUpdate"){
        // data : {"SNSSub" : SNSSub, "KakaoSub" : KakaoSub, "youEmail" : 


        $SNSSub = $_POST['SNSSub'];
        $KakaoSub = $_POST['KakaoSub'];
        $youEmail= $_POST['youEmail'];
        
        // data : {"youBirth" : youBirth, "gender" : gender, "gender" : youBirth, "youBirth" : ', "type" : "isInfoupdate"},

        $sql = "UPDATE members2 SET KakaoSub = '{$KakaoSub}',SNSSub = '{$SNSSub}' WHERE youEmail = '{$youEmail}'";
        $result = $connect -> query($sql);
        if ($connect->query($sql) === TRUE) {
            echo json_encode(array("result" => "회원님의 수신정보가 변경되었습니다."));
        } else {
            echo json_encode(array("result" => "오류가 발생하였습니다. 관리자에게 문의하세요"));
        }
    }
    
?>