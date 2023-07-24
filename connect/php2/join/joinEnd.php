<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">

    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>

    <?php

    //회원가입
    include "../connect/connect.php";

    $youEmail = $_POST['memberID'];
    $youName = $_POST['youName'];
    $youPass = $_POST['youPass'];
    $youPhone = $_POST['youPhone'];
    $youBirth = $_POST['youBirth'];
    $nickName = $_POST['nickName'];
    $regTime = time();

        // 데이터 입력하기
        $sql = "INSERT INTO members2 (youEmail, youName, youPass, youPhone, regTime, nickName, youBirth, youImgSrc, youImgSize, youGender) VALUES('$youEmail', '$youName', '$youPass', '$youPhone', '$regTime', '$nickName', '$youBirth', 'null', 'null', 'null')";
        
        $result = $connect -> query($sql);
    ?>
</head>

<body id="scroll">

    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <?php include "../include/abbHeader.php" ?>
        <!-- //header -->

    <main id="main" class="container">

        <div calss="joinEnd__inner">
            <h2 class="joinEnd__h2 mt120">회원가입 완료</h2>
            <p class="joinEnd__p mt20"><?= $youName?>님 반갑습니다.
<?php
    include "../connect/connect.php"

?>
            </p>
            
            <div class="joinEnd__form">
                <p>ABB는 화장품 유통기한을 확인 하는 공간입니다.<br>
                    화장품의 유통기한을 간편하게 확인한 후<br>
                    당신의 피부와 아름다움을 지켜주세요. <br>
                    이제는 당신의 화장품을 쌓아두지 마세요<br>
                    과감히 버릴 수 있도록 ABB가 도와드립니다.</p>
                <a href="../login/login.php"><button type="submit" class="btnStyle3">로그인하러 가기</button></a>
            </div>
        </div>
    </main>
    <!-- //main -->
    

</body>

</html>