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
            <h2>로그인 </h2>
            <p>아이디와 비밀번호를 적어 로그인 해주세요.</p>
            
            <div class="join__form">
                <form action="loginSave.php" name="loginFindEnd" method="post" onsubmit="return joinChecks()">
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
                        
                        <button type="submit" class="btnStyle3">로그인</button>
                    </fieldset>
                </form>
            </div>
        </div> 
        <div class="kakao">
            <p>카카오 로그인</p>
        </div>
        <div class="find3">
            <a href="loginFind.php">아이디 찾기</a>
            <a href="loginFindPw.php">비밀번호 찾기</a>
            <a href="../join/jointos.php">회원가입 하기</a>
        </div>
    </main>
    
    <!-- main -->

    <?php include "../include/footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        
        let isEmailCheck = false;
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
            } else {
                $("#memberIDComment").text("");
                isEmailCheck=true;
            }

            
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
                $("#youPassComment").text("");
                isPassCheck=true;
            }
            
        }

        // 윈도우 로드시 window.onload 함수 쓴것과 같음
        // 각 input스타일에서 포커스아웃할때(바깥클릭 and tab클릭)실행되게 해놓은 함수
        $( document ).ready(function() {
            $('#memberID').blur(function(){
                chkMemberId();
            });
            $('#youPass').blur(function(){
                chkYouPass();
            });
        }); 

        function joinChecks(){
            if (!isEmailCheck ||!isPassCheck) {
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
                    default:
                        break;
                } 
                return false;
            } else {
                $.ajax({
                type : "POST",
                url : "findCheck.php",
                data : {"memberID" : $("#memberID").val(),"youPass" : $("#youPass").val(), "type" : "isLoginCheck"},
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
        

        // if(isEmailCheck && isPassCheck){
        // // 데이터 조회
        //     $sql = "SELECT memberID, youEmail, youName, youPass FROM members2 WHERE youEmail = '$youEmail' AND youPass = '$youPass'";
        //     $result = $connect -> query($sql);
            
        //     if($result){
        //         $count = $result -> num_rows;
                
        //         if($count == 0){
        //             msg("이메일 또는 비밀번호가 틀렸습니다. 다시 한번 확인해주세요!<br><div class='intro__btn'><a href='../login/login.php'>로그인</div>");
        //         } else {
        //             // 로그인 성공
        //             $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);

        //             // echo "<pre>";
        //             // var_dump($memberInfo);
        //             // echo("/pre");

        //             // 세선 생성
        //             $_SESSION['memberID'] = $memberInfo['memberID'];
        //             $_SESSION['youEmail'] = $memberInfo['youEmail'];
        //             $_SESSION['youName'] = $memberInfo['youName'];

        //             Header("Location: ../main/main.php");
        //         }
        //     }
        // } 

        
    </script>
</body>
</html> 