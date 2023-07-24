<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>아이디 찾기</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
</head>
<body id="scroll">
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->
    <main id="main" class="container mt70">
        <?php include "../include/abbHeader.php" ?>
        <!-- //header -->
<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youName = $_POST['youName'];
    $youPhone = $_POST['youPhone'];

    // echo $youPass, $youEmail;
    
    // 데이터 출력
    
    // 유효성검사
    $sql = "SELECT youEmail from members2 where youName = '$youName' and youPhone = '$youPhone'";
    $result = $connect ->query($sql);
    
    if($result){
        $count  = $result -> num_rows;
        if($count ==0){
        echo "<script>alert('잘못된경로로 접근하셨습니다.');window.history.back();</script>";
        }else{
            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
        }
    }
?>
        <div class="join__inner mt70">
            <h2>아이디 찾기</h2>
            <div class="findID">
                <p>회원님의 아이디는 <?=$memberInfo['youEmail']?> 입니다.</p>
            </div>
            <button type="button" class="btnStyle3" onclick="window.location.href='loginFindPw.php'">비밀번호 찾기</button>
        </div> 
        <div class="find">
            <a href="login.php">로그인</a>
            <a href="../join/jointos.php">회원가입</a>
        </div>
    </main>
    <!-- main -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        
       
    </script>
</body>
</html> 