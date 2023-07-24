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
        <div class="join__inner ">
            <h2>회원가입</h2>
            <p>회원가입을 위해 아이디와 비밀번호를 등록해주세요.</p>
            <div class="join__form">
                <form action="joinEnd.php" name="#" method="post" onsubmit="return joinChecks()">
                    <fieldset>
                        <legend class="blind">회원가입 영역</legend>
                        <div>
                            <label for="memberID"></label>
                            <input type="text" id="memberID" name="memberID" class="inputStyle" placeholder="아이디">
                            <p class="joinChkmsg" id="memberIDComment"></p>
                        </div>
                        <div>
                            <label for="youPass"></label>
                            <input type="password" id="youPass" name="youPass" class="inputStyle" placeholder="비밀번호">
                            <p class="joinChkmsg" id="youPassComment"></p>
                        </div>
                        <div>
                            <label for="youPassC"></label> 
                            <input type="password" id="youPassC" name="youPassC" class="inputStyle" placeholder="비밀번호 확인">
                            <p class="joinChkmsg" id="youPassCComment"></p>
                        </div>
                        <div>
                            <label for="youName"></label>
                            <input type="text" id="youName" name="youName" class="inputStyle" placeholder="이름">
                            <p class="joinChkmsg" id="youNameComment"></p>
                        </div>
                        <div>
                            <label for="youPhone"></label>
                            <input type="text" id="youPhone" name="youPhone" class="inputStyle" placeholder="휴대폰번호">
                            <span id="chkPhone"></span>
                            <p class="joinChkmsg" id="youPhoneComment"></p>
                        </div>
                        <div>
                            <label for="nickName"></label>
                            <input type="text" id="nickName" name="nickName" class="inputStyle" placeholder="닉네임">
                            <span id="chkNickName"></span>
                            <p class="joinChkmsg" id="nickNameComment"></p>
                        </div>
                        <div>
                            <label for="youBirth"></label>
                            <input type="text" id="youBirth" name="youBirth" class="inputStyle" placeholder="생년월일">
                            <p class="joinChkmsg" id="youBirthComment"></p>
                        </div>
                        <div>
                            <label for="youGender"></label>
                            <select type="text" id="youGender" name="youGender" class="inputStyle" placeholder="성별">
                                <option value="">성별 선택</option>
                                <option value="1">남</option>
                                <option value="2">여</option>
                            </select>
                        </div>
                        <button type="submit" class="btnStyle3">회원가입 완료</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </main>
    <!-- main -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        
        let isEmailCheck = false;
        let isNickCheck = false;
        let isPhoneCheck = false;
        let isNameCheck = false;
        let isBirthCheck = false;
        let isPassCheck = false;

        
        // 아이디 유효성 검사
        function chkMemberId(){
            isEmailCheck = false;
            let getmemberID =  RegExp(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([\-.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i);
            $("#memberIDComment").addClass("red");
            if($("#memberID").val() == ''){
                $("#memberIDComment").text("* 아이디를 입력해주세요!");
                return false;
            }else if(!getmemberID.test($("#memberID").val())){
                $("#memberIDComment").text("* 아이디 형식에 맞게 작성해주세요! aaa@gmail.com");
                $("#memberID").val('');
                return false;
            }
            
            $.ajax({
                type : "POST",
                url : "joinCheck.php",
                data : {"youEmail" : $("#memberID").val(), "type" : "isMemberIdChk"},
                dataType : "json",
                success : function(data){
                    if(data.result == "good"){
                        $("#memberIDComment").text("* 사용 가능한 아이디 입니다");
                        $("#memberIDComment").removeClass("red");
                        $("#memberIDComment").addClass("green");
                         isEmailCheck = true;
                    }else {
                        $("#memberIDComment").text("* 사용 중인 아이디 입니다");
                        $("#memberID").val('');
                         isEmailCheck = false;
                         return false;           
                    }
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            });

            
        }
        // 닉네임 유효성
        function chkNickName(){
            isNickCheck = false;
            // 닉네임 유효성 검사
            $("#nickNameComment").addClass("red");
            let getnickName = RegExp(/^[가-힣|0-9]+$/);
            if($("#nickName").val() == ''){
                $("#nickNameComment").text("* 닉네임을 입력해주세요!");
                return false;
            }else if(!getnickName.test($("#nickName").val())){
                $("#nickNameComment").text("* 닉네임은 한글 또는 숫자만 사용 가능합니다.");
                $("#nickName").val('');
                return false;
            }else{
                $("#nickNameComment").removeClass("red");
                $("#nickNameComment").addClass("green");
                $("#nickNameComment").text("* 사용가능한 닉네임 입니다.");
            }
            $.ajax({
                type : "POST",
                url : "joinCheck.php",
                data : {"nickName" : $("#nickName").val(), "type" : "isNickCheck"},
                dataType : "json",
                success : function(data){
                    if(data.result == "good"){
                        $("#nickNameComment").text("* 사용 가능한 닉네임 입니다");
                        $("#nickNameComment").removeClass("red");
                        $("#nickNameComment").addClass("green");
                         isNickCheck = true;
                    }else {
                        $("#nickName").val('');
                        $("#nickNameComment").text("* 사용 중인 닉네임 입니다");
                        $("#nickNameComment").removeClass("green");
                        $("#nickNameComment").addClass("red");
                         isNickCheck = false;
                         return false;  
                    }
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            });
            
        }
        // 핸드폰 유효성
        function chkYouPhone(){
            isPhoneCheck = false;
             $("#youPhoneComment").addClass("red");
            let getYouPhone = RegExp(/01[016789]-[^0][0-9]{3,4}-[0-9]{4}/);
            if($("#youPhone").val() == ''){
                $("#youPhoneComment").text("* 연락처를 입력해주세요!");
                return false;
            }else if(!getYouPhone.test($("#youPhone").val())){
                $("#youPhoneComment").text("* 휴대폰 번호가 정확하지 않습니다.(000-0000-0000)");
                $("#youPhone").val('');
                return false;
            }
            $.ajax({
                type : "POST",
                url : "joinCheck.php",
                data : {"youPhone" : $("#youPhone").val(), "type" : "isPhoneCheck"},
                dataType : "json",
                success : function(data){
                    if(data.result == "good"){
                        $("#youPhoneComment").text("* 사용 가능한 전화번호 입니다");
                        $("#youPhoneComment").removeClass("red");
                        $("#youPhoneComment").addClass("green");
                        isPhoneCheck = true;
                    }else {
                        $("#youPhone").val('');
                        $("#youPhoneComment").removeClass("green");
                        $("#youPhoneComment").addClass("red");
                        $("#youPhoneComment").text("* 사용 중인 전화번호 입니다");
                        isPhoneCheck = false;
                        return false;  
                    }
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            });
            
            
        }
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
                return false;
                // 8~20자이내, 공백X, 영문, 숫자, 특수문자
            }else if(getYouPass.length < 8 || getYouPass.length > 20){
                $("#youPassComment").text(" * 8자리 ~ 20자리 이내로 입력해주세요");
                return false;
            } else if (getYouPass.search(/\s/) != -1){
                $("#youPassComment").text("* 비밀번호는 공백없이 입력해주세요!");
                return false;
            } else if (getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0 ){
                $("#youPassComment").text("* 영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
                return false;
            }else{
                $("#youPassComment").removeClass("red");
                $("#youPassComment").addClass("green");
                $("#youPassComment").text("* 사용가능합니다");
            }
            // 비밀번호 확인 유효성 검사
            $("#youPassCComment").addClass("red");
            if($("#youPassC").val() == ''){
                $("#youPassCComment").text("* 확인 비밀번호를 입력해주세요!");
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
        //이름 유효성 검사
        function chkYouName(){
            isNameCheck=false;
            $("#youNameComment").addClass("red");
            let getYouName = RegExp(/^[가-힣]+$/);
            if($("#youName").val() == ''){
                $("#youNameComment").text("* 이름을 입력해주세요!");
                return false;
            }else if(!getYouName.test($("#youName").val())){
                $("#youNameComment").text("* 이름은 한글만 사용 가능합니다.");
                $("#youName").val('');
                return false;
            }else if($("#youName").val().length < 2 || $("#youName").val().length > 10){
                $("#youNameComment").text("* 이름은 2~10글자까지만 가능합니다.");
                $("#youName").val('');
                return false;
            }else{
                $("#youNameComment").removeClass("red");
                $("#youNameComment").addClass("green");
                $("#youNameComment").text("* 사용가능합니다");
                isNameCheck = true;
            }
        }
        // 생년월일 유효성 검사
        function chkYouBirth(){
            isBirthCheck = false;
            $("#youBirthComment").addClass("red");
            let getYouBirth = RegExp(/^(19[0-9][0-9]|20\d{2})-(0[0-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/);
            if($("#youBirth").val() == ''){
                $("#youBirthComment").text("* 생년월일을 입력해주세요!");
                return false;
            }else if(!getYouBirth.test($("#youBirth").val())){
                $("#youBirthComment").text("* 생년월일 형식이 정확하지 않습니다.(YYYY-MM-DD)");
                $("#youBirth").val('');
                return false;
            }else{
                $("#youBirthComment").removeClass("red");
                $("#youBirthComment").addClass("green");
                $("#youBirthComment").text("* 사용가능합니다 !");
                isBirthCheck = true;
            }
        }

        // 윈도우 로드시 window.onload 함수 쓴것과 같음
        // 각 input스타일에서 포커스아웃할때(바깥클릭 and tab클릭)실행되게 해놓은 함수
        $( document ).ready(function() {
            $('#memberID').blur(function(){
                chkMemberId();
            });
            $('#youPass, #youPassC').blur(function(){
                chkYouPass();
            });
            $('#youName').blur(function(){
                chkYouName();
            });
            $('#youPhone').blur(function(){
                chkYouPhone();
            });
            $('#nickName').blur(function(){
                chkNickName();
            });
            $('#youBirth').blur(function(){
                chkYouBirth();
            });
        }); 


        function joinChecks(){
            if (!isEmailCheck || !isNickCheck || !isPhoneCheck || !isNameCheck || !isBirthCheck || !isPassCheck) {
            // 위 변수 중 하나라도 false일 때 실행되는 코드
            switch (false) {
                    case isEmailCheck:
                        // isEmailCheck가 false일 때 실행되는 코드
                        chkMemberId();
                        break;
                    case isPassCheck:
                        // isPassCheck가 false일 때 실행되는 코드
                        chkYouPass();
                        break;
                    case isNameCheck:
                        // isNameCheck가 false일 때 실행되는 코드
                        chkYouName();
                        break;
                    case isPhoneCheck:
                        // isPhoneCheck가 false일 때 실행되는 코드
                        chkYouPhone();
                        break;
                    case isNickCheck:
                        // isNickCheck가 false일 때 실행되는 코드
                        chkNickName();
                        break;
                    case isBirthCheck:
                        // isBirthCheck가 false일 때 실행되는 코드
                        chkYouBirth();
                        break;
                    default:
                        break;
                } 
                return false;
            }
        }
    </script>
</body>
</html> 