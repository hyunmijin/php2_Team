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

    $youEmail = $_POST['youEmail'];
    $youPhone = $_POST['youPhone'];

    // 유효성검사
    $sql = "SELECT youEmail from members2 where youEmail = '$youEmail' and youPhone = '$youPhone'";
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
            <h2>비밀번호찾기</h2>
        </div> 
        
        <div class="join__form">
            <form action="loginFindPwEnd.php" name="loginFindPwEnd.php" method="post">
                <fieldset>
                    <legend class="blind">비 영역</legend>
                    <div>
                        <label for="youPhone"></label>
                        <input type="text" id="youPhone" name="youPhone" class="inputStyle" placeholder="인증번호를 입력해주세요." required>
                        <!-- 히든타입으로 Email을 가져가서 로그인시킴 -->
                        <input type="hidden" id="youEmail" name="youEmail" value="<?= $memberInfo['youEmail'] ?>">
                    </div>
                </fieldset>
                <button type="submit" class="btnStyle3">비밀번호 찾기</button>
            </form>
        </div>
        <div class="find">
            <a href="loginFind.php">아이디찾기</a>
            <a href="../join/jointos.php">회원가입</a>
        </div>
    </main>
    <!-- main -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        
       
    </script>
</body>
</html> 