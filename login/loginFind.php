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
<body >
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
            <h2>아이디 찾기</h2>
            <p>가입시 입력한 정보를 입력하세요.</p>
            
            <div class="join__form">
            <form action="loginFindEnd.php" name="loginFindEnd" method="post">
                    <fieldset>
                        <legend class="blind">회원가입 영역</legend>
                        <div>
                            <label for="youName"></label>
                            <input type="text" id="youName" name="youName" class="inputStyle" placeholder="이름 입력" required>
                            <p class="joinChkmsg" id="youNameComment"></p>
                            
                        </div>
                        <div>
                            <label for="youPhone"></label>
                            <input type="text" id="youPhone" name="youPhone" class="inputStyle" placeholder="전화번호 입력" required>
                            <p class="joinChkmsg" id="youPhoneComment"></p>
                        </div>
                        <button type="button" class="btnStyle3" onclick="joinChecks()">아이디 찾기</button>
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
        let isNameCheck = false;
        let chkInfo = true;

        // 이름
        function chkYouName(){
            isNameCheck=false;
            $("#youNameComment").addClass("red");
            let getYouName = RegExp(/^[가-힣]+$/);
            if($("#youName").val() == ''){
                $("#youNameComment").text("* 이름을 입력해주세요!");
                $("#youName").focus();
                return false;
            }else if(!getYouName.test($("#youName").val())){
                $("#youNameComment").text("* 이름은 한글만 사용 가능합니다.");
                $("#youName").val('');
                $("#youName").focus();
                return false;
            }else if($("#youName").val().length < 2 || $("#youName").val().length > 10){
                $("#youNameComment").text("* 이름은 2~10글자까지만 가능합니다.");
                $("#youName").val('');
                $("#youName").focus();
                return false;
            }else{
                $("#youNameComment").text("");
                isNameCheck = true;
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
            $('#youName').blur(function(){
                chkYouName();
            });
            $('#youPhone').blur(function(){
                chkYouPhone();
            });
        }); 

        function joinChecks(){
            if (!isPhoneCheck || !isNameCheck ) {
            // 위 변수 중 하나라도 false일 때 실행되는 코드
            switch (false) {
                    case isNameCheck:
                        // isNameCheck가 false일 때 실행되는 코드
                        chkYouName();
                        break;
                    case isPhoneCheck:
                        // isPhoneCheck가 false일 때 실행되는 코드
                        chkYouPhone();
                        break;

                    default:
                        break;
                } 
                return false;
            }
        
            $.ajax({
                type : "POST",
                url : "findCheck.php",
                data : {"youName" : $("#youName").val(),"youPhone" : $("#youPhone").val(), "type" : "isIDCheck"},
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
    </script>
</body>
</html> 