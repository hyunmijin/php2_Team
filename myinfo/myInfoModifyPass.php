<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    if(!isset($_SESSION['memberID'])){
        Header("Location:../login/login.php");
    }

    $youName=$_SESSION['youName'];
    $youEmail=$_SESSION['youEmail'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내정보 변경</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
</head>
<body id ="scroll">
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->
    <main id="main" class="mt70">
        <?php include "../include/abbHeader.php" ?>
        <!-- //header -->
        <div class="info__logo">
            <h1>Abide By Beauty</h1>
        </div>
        <!-- //header -->
        <div class="info__wrap">
            <div class="info__title mt30 info__bmStyle">
                <h1><?=$youName ?>님></h1>
            </div>
            <div class="info__sec mt100">
                <div class="info__list">
                    <div class="aside1 aside__bmStyle">
                        <span>나의정보</span>
                        <ul>
                            <li><a href="myInfoProfile.php">프로필 설정</a></li>
                            <li><a href="#" class="active">회원정보 수정</a></li>
                        </ul>
                    </div>
                    <div class="aside2 aside__bmStyle">
                        <span>나의정보</span>
                        <ul>
                            <li><a href="myinfoMywrite.php" >내가 쓴 게시물</a></li>
                            <li><a href="myinfoMyComment.php" >내가 쓴 댓글</a></li>
                            <li><a href="#" >내 제품 기록</a></li>
                        </ul>
                    </div>
                    <div class="aside3 ">
                        <span>알림</span>
                        <ul>
                            <li><a href="myInfoSNSAgree.php">알림설정</a></li>
                        </ul>
                    </div>
                </div>
                <div class="info__view">
                    <div class="info__view__title">
                        <h2>회원정보 수정</h2>
                    </div>
                    <div class="info__form" >
                            <div>
                                <p>비밀번호 확인</p>
                                <ul>
                                    <li>· ABB는 회원님의 개인정보를 신중하게 취급하며, 회원님의 동의 없이는 기재하신 회원 정보가 공개 되지 않습니다.</li>
                                    <li>· 공공장소에서 PC를 사용중일 경우, 비밀번호가 타인에게 노출되지 않도록 주의해 주시기 바랍니다.</li>
                                </ul>
                            </div>
                            <div>
                                <p>아이디 : <em class="user__id"><?=$youEmail ?></em></p>
                                <form action="myInfoModifyinfo.php" name="myInfoModifyinfo" method="post"></form>
                                    <fieldset>
                                        <legend class="blind">회원정보 수정 비밀번호입력창</legend>        
                                        <div class="inputStyleInfo">
                                            <label for="youPass"></label>
                                            <input type="password" id="youPass" name="youPass" class="inputStyle" placeholder="본인확인을 위한 비밀번호를 입력해 주세요" required>
                                            <p class="joinChkmsg" id="youPassComment"></p>
                                        </div>
                                        <input type="hidden" id="youEmail" name="youEmail" class="inputStyle" value="<?=$youEmail?>">
                                    </fieldset>
                                </form>
                            </div>
                    </div>
                    <button type="button" class="btnConf infoBtnStyle1" onclick="joinChecks()">확인</button>
                </div>
            </div>
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
                $("#youPassComment").text(" ");
                isPassCheck = true;
            }
        }        
        

        // 윈도우 로드시 window.onload 함수 쓴것과 같음
        // 각 input스타일에서 포커스아웃할때(바깥클릭 and tab클릭)실행되게 해놓은 함수
        $( document ).ready(function() {
            $('#youPass').blur(function(){
                chkYouPass();
            });
        }); 

        
        function joinChecks(){
            if (!isPassCheck) {
            // 위 변수 중 하나라도 false일 때 실행되는 코드
            switch (false) {
                    case isPassCheck:
                        // isNameCheck가 false일 때 실행되는 코드
                        chkYouPass();
                        break;
                    
                    default:
                        break;
                } 
                return false;
            }
            
            $.ajax({
                type : "POST",
                url : "myInfoModifyChk.php",
                data : {"youPass" : $("#youPass").val(),"youEmail" : $("#youEmail").val(), "type" : "isPwChk"},
                dataType : "json",
                success : function(data){
                    if(data.result == "bad"){
                        chkInfo = false;
                        console.log(chkInfo + "good");
                        alert('비밀번호를 다시확인해주세요');
                    }else{
                        // 등록된 정보가 있다면  <form action="loginFindEnd.php" name="loginFindEnd" method="post"> 에 등록되어있는 
                        // form 액션을 실행함 
                        document.myInfoModifyinfo.submit();
                        
                    }
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            });
        }
    </script>
</body>
</html> 