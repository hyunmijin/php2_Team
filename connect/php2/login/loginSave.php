<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youEmail = $_POST['memberID'];
    $youPass = $_POST['youPass'];
    
    // echo $youEmail, $youPass;


    // 데이터 조회
    $sql = "SELECT memberID, youEmail, youName, youPass FROM members2 WHERE youEmail = '$youEmail' AND youPass = '$youPass'";
    $result = $connect -> query($sql);

    
    if($result){
        $count = $result -> num_rows;
        if($count == 0){
            echo "<script>alert('아이디 혹은 비밀번호가 틀렸습니다.');</script>";
            echo "<script>setTimeout(function() { window.location.href = '../login/login.php'; }, 10);</script>";
        } else {
            // 로그인 성공
            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

            // echo "<pre>";
            // var_dump($memberInfo);
            // echo("/pre");

            // 세선 생성
            $_SESSION['memberID'] = $memberInfo['memberID'];
            $_SESSION['youEmail'] = $memberInfo['youEmail'];
            $_SESSION['youName'] = $memberInfo['youName'];

            Header("Location: ../main/main.php");
        }
    }
            
?>