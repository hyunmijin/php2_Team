<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 찾기</title>
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
        <div class="join__inner">
            <h2>비밀번호 찾기</h2>
            <p>가입시 입력한 정보를 입력하세요.</p>
            
            <div class="join__form">
            <form action="loginFindPWNum.php" name="loginFindEnd" method="post">
                    <fieldset>
                        <legend class="blind">회원가입 영역</legend>
                        <div>
                            <label for="youEmail"></label>
                            <input type="text" id="youEmail" name="youEmail" class="inputStyle" placeholder="아이디 입력" required>
                            <p class="joinChkmsg" id="youEmailComment"></p>
                            
                        </div>
                        <div>
                            <label for="youPhone"></label>
                            <input type="text" id="youPhone" name="youPhone" class="inputStyle" placeholder="전화번호 입력" required>
                            <p class="joinChkmsg" id="youPhoneComment"></p>
                        </div>
                        <button type="button" class="btnStyle3" onclick="joinChecks()">비밀번호 찾기</button>
                    </fieldset>
                </form>
            </div>
        </div> 
        <div class="find">
            <a href="../login/loginFindPw.php">비밀번호 찾기</a>
            <a href="../join/jointos.php">회원가입</a>
        </div>
    </main>
    <!-- main -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        let isPhoneCheck = false;
        let isEmailCheck = false;
        let chkInfo = true;

        // 이름
        function chkYouEmail(){
             isEmailCheck = false;
            let getyouEmail =  RegExp(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([\-.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i);
            $("#youEmailComment").addClass("red");
            if($("#youEmail").val() == ''){
                $("#youEmailComment").text("* 아이디를 입력해주세요!");
                $("#youEmail").focus();
                return false;
            }else if(!getyouEmail.test($("#youEmail").val())){
                $("#youEmailComment").text("* 아이디 형식에 맞게 작성해주세요! aaa@gmail.com");
                $("#youEmail").val('');
                $("#youEmail").focus();
                return false;
            }else{
                $("#youEmailComment").text('');
                isEmailCheck = true;
            }
        }
        
        // 핸드폰 유효성 
        function chkYouPhone(){
            isPhoneCheck = false;
             $("#youPhoneComment").addClass("red");
            let getYouPhone = RegExp(/01[016789]-[^0][0-9]{3,4}-[0-9]{4}/);
            if($("#youPhone").val() == ''){
                $("#youPhoneComment").text("* 연락처를 입력해주세요!");
                $("#youPhone").focus();
                return false;
            }else if(!getYouPhone.test($("#youPhone").val())){
                $("#youPhoneComment").text("* 휴대폰 번호가 정확하지 않습니다.(000-0000-0000)");
                $("#youPhone").val('');
                $("#youPhone").focus();
                return false;
            }else{
                $("#youPhoneComment").text("");
                isPhoneCheck = true;
            }
        }
            
        

        // 윈도우 로드시 window.onload 함수 쓴것과 같음
        // 각 input스타일에서 포커스아웃할때(바깥클릭 and tab클릭)실행되게 해놓은 함수
        $( document ).ready(function() {
            $('#youEmail').blur(function(){
                chkYouEmail();
            });
            $('#youPhone').blur(function(){
                chkYouPhone();
            });
        }); 

        function joinChecks(){
            if (!isPhoneCheck || !isEmailCheck ) {
            // 위 변수 중 하나라도 false일 때 실행되는 코드
            switch (false) {
                    case isEmailCheck:
                        // isNameCheck가 false일 때 실행되는 코드
                        chkYouEmail();
                        break;
                    case isPhoneCheck:
                        // isPhoneCheck가 false일 때 실행되는 코드
                        chkYouPhone();
                        break;

                    default:
                        break;
                } 
                return false;
            }else{
                $.ajax({
                    type : "POST",
                    url : "findCheck.php",
                    data : {"youEmail" : $("#youEmail").val(),"youPhone" : $("#youPhone").val(), "type" : "isPWCheck"},
                    dataType : "json",
                    success : function(data){
                        if(data.result == "good"){
                            chkInfo = false;
                            console.log(chkInfo + "good");
                            alert('등록된 정보가 없습니다. 다시확인해주세요');
                        }else{
                            // 등록된 정보가 있다면  <form action="loginFindEnd.php" name="loginFindEnd" method="post"> 에 등록되어있는 
                            // form 액션을 실행함 
                            document.loginFindEnd.submit();
                        }
                    },
                    error : function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                });
            }
        
            
        }
    </script>
</body>
</html> 