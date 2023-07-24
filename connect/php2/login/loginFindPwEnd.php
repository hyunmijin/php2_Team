<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 재설정 찾기</title>
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
    
?>
        <div class="join__inner mt70">
            <h2>비밀번호 재설정</h2>
            <p>비밀번호를 재설정 해주세요.</p>
            
            <div class="join__form">
                <form action="loginFindPwUpdate.php" name="loginFindPwUpdate" method="post">
                    <fieldset>
                        <legend class="blind">비밀번호 재설정 영역</legend>
                        <div>
                            <label for="youPass"></label>
                            <input type="password" id="youPass" name="youPass" class="inputStyle" placeholder="비밀번호">
                            <p class="joinChkmsg" id="youPassComment"></p>
                        </div>
                        <div>
                            <label for="youPassC"></label> 
                            <input type="password" id="youPassC" name="youPassC" class="inputStyle" placeholder="비밀번호 확인">
                            <p class="joinChkmsg" id="youPassCComment"></p>
                            <input type="hidden" id="youEmail" name="youEmail" value="<?= $youEmail ?>">

                        </div>
                    </fieldset>
                    <button type="button" class="btnStyle3" onclick="joinChecks()">비밀번호 변경하기</button>
                </form>
            </div>
        </div> 
        <div class="find">
            <a href="loginFind.php">아이디찾기</a>
            <a href="../join/jointos.php">회원가입</a>
        </div>
    </main>
    <!-- main -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        let isPassCheck = false;
        
        // 비밀번호 유효성 검사
        function chkYouPass(){
            isPassCheck=false;

            let getYouPass = $("#youPass").val();
            let getYouPassNum = getYouPass.search(/[0-9]/g);
            let getYouPassEng = getYouPass.search(/[a-z]/ig);
            let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

            $("#youPassComment").addClass("red");
            if($("#youPass").val() == ''){
                $("#youPassComment").text("* 비밀번호를 입력해주세요!");
                $("#youPass").focus();
                return false;
                // 8~20자이내, 공백X, 영문, 숫자, 특수문자
            }else if(getYouPass.length < 8 || getYouPass.length > 20){
                $("#youPassComment").text(" * 8자리 ~ 20자리 이내로 입력해주세요");
                $("#youPass").focus();
                return false;
            } else if (getYouPass.search(/\s/) != -1){
                $("#youPassComment").text("* 비밀번호는 공백없이 입력해주세요!");
                $("#youPass").focus();
                return false;
            } else if (getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0 ){
                $("#youPassComment").text("* 영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
                $("#youPass").focus();
                return false;
            }else{
                $("#youPassComment").removeClass("red");
                $("#youPassComment").addClass("green");
                $("#youPassComment").text("");
            }
            // 비밀번호 확인 유효성 검사
            $("#youPassCComment").addClass("red");
            if($("#youPassC").val() == ''){
                $("#youPassCComment").text("* 확인 비밀번호를 입력해주세요!");
                $("#youPassC").focus();
                return false;
                // 비밀번호 동일한지 체크
            }else if($("#youPass").val() !== $("#youPassC").val()){
                $("#youPassCComment").text("* 비밀번호가 일치하지 않습니다.");
                return false;
            }else{
                $("#youPassCComment").text("");
                isPassCheck = true;
            }
        }

        // 윈도우 로드시 window.onload 함수 쓴것과 같음
        // 각 input스타일에서 포커스아웃할때(바깥클릭 and tab클릭)실행되게 해놓은 함수
        $( document ).ready(function() {
            $('#youPass, #youPassC').blur(function(){
                chkYouPass();
            });
        }); 


        function joinChecks(){
            if (!isPassCheck) {
                chkYouPass();
                console.log("first");
                return false;
            }else{
                console.log("sec");
                document.loginFindPwUpdate.submit();
            }
        }
    </script>
</body>
</html> 