<?php 
    include "../connect/connect.php";
    include "../connect/session.php";
    
    $youName=$_SESSION['youName'];
    $youEmail=$_SESSION['youEmail'];
    // 초기 회원정보 세팅
    $sql = "SELECT * FROM members2 WHERE  youEmail = '{$youEmail}'";
    $Result = $connect -> query($sql);
    $Info = $Result -> fetch_array(MYSQLI_ASSOC);

    
    // 생년월일 세팅
    $oldYouBirth = $Info['youBirth'];
    $youBirth = explode("-", $Info['youBirth']);


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
<style>
    
</style>
<body id ="scroll">
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->
    <main id="main" class="mt70 mb20">
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
                            <li><a href="#">프로필 설정</a></li>
                            <li><a href="myInfoModifyPass.php" class="active">회원정보 수정</a></li>
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
                            <p class="info__title">비밀번호 수정</p>
                        </div>
                        <div class="info__bmStyle2">
                            <form action="#" name="#" method="post"></form>
                                <fieldset>
                                    <legend class="blind">회원정보 수정 비밀번호입력창</legend>        
                                    <div class="inputStyleInfo">
                                        <label for="youPass"></label>
                                        <input type="password" id="youPass" name="youPass" class="inputStyle" placeholder="기존 비밀번호를 입력해 주세요" required>
                                    </div>
                                    <div class="inputStyleInfo">
                                        <label for="newYouPass"></label>
                                        <input type="password" id="newYouPass" name="newYouPass" class="inputStyle" placeholder="신규 비밀번호를 입력해 주세요" required>
                                        <p class="joinChkmsg" id="newYouPassComment"></p>
                                    </div>
                                    <div class="inputStyleInfo">
                                        <label for="newYouPassC"></label>
                                        <input type="password" id="newYouPassC" name="newYouPassC" class="inputStyle" placeholder="신규 비밀번호를 한번더 입력해 주세요" required>
                                        <p class="joinChkmsg" id="newYouPassCComment"></p>
                                    </div>
                                    

                                </fieldset>
                            </form>
                            <p class="info__desc">· 신규 비밀번호는 대소문자, 숫자, 특수문자를 포함해 주세요</p>
                            <button type="button" class=" btnStyle3" onclick="passUpdateChk()">비밀번호 수정</button>
                        </div>
                    </div>
                    <div class="info__form userinfo__form" >
                        <div>
                            <p class="info__title">개인정보 수정</p>
                        </div>
                        <div class="info__bmStyle2">
                            <form action="#" name="#" method="post"></form>
                                <fieldset>
                                    <legend class="blind">회원정보 수정 비밀번호입력창</legend>        
                                    <div class="inputStyleInfo">
                                        <label for="youName"></label>
                                        <input type="text" id="youName" name="youName" class="inputStyle" placeholder="이름" value="<?=$Info['youName']?>" readonly >
                                        
                                    </div>
                                    <div class="user__birth__inner">
                                        <div class="inputStyleInfo user__birth">
                                            <label for="youYear"></label>
                                                <select type="text" id="youYear" name="youYear" class="inputStyle" required>
                                                </select>
                                            </div>
                                            <div class="inputStyleInfo user__birth">
                                                <label for="youMonth"></label>
                                                <select type="text" id="youMonth" name="youMonth" class="inputStyle" required>
                                                </select>
                                            </div>
                                            <div class="inputStyleInfo user__birth">
                                                <label for="youDay"></label>
                                                <select type="text" id="youDay" name="youDay" class="inputStyle" required>
                                                </select>
                                            </div>
                                        <input type="hidden" id="oldYouBirth" name="oldYouBirth" class="inputStyle" value="<?=$oldYouBirth?>">
                                    </div>
                                    <div class="inputStyleInfoRadio">
                                        <label for="male" class="rad-label">
                                            <input type="radio" class="rad-input" name="gender" id="male"  value="male" <?if($Info['youGender']=='male'){ echo "checked";}?>>
                                            <div class="rad-design"></div>
                                            <div class="rad-text">남성</div>
                                        </label>
                                        <label for="female" class="rad-label">
                                            <input type="radio" class="rad-input" name="gender" id="female"  value="female" <?if($Info['youGender']=='female'){ echo "checked";}?>>
                                            <div class="rad-design"></div>
                                            <div class="rad-text">여성</div>
                                        </label>
                                    </div>
                                    <div class="user__phone__inner ">
                                        <div  class="inputStyleInfo youPhone mb10"> 
                                                <label for="youPhone"></label>
                                                <input type="text" id="youPhone" name="youPhone" class="inputStyle" placeholder="전화번호" value="<?=$Info['youPhone']?>">
                                                <p class="joinChkmsg" id="youPhoneComment"></p>
                                        </div>
                                        <button type="button" class="phonekBtn update infoBtnStyle1 " onclick="chkYouPhone()">변경</button>
                                    </div>
                                    <div class="user__phone__inner__chk">
                                        <div  class="inputStyleInfo chkNumber"> 
                                                <label for="changePhoneChk"></label>
                                                <input type="text" id="changePhoneChk" name="changePhoneChk" class="inputStyle" placeholder="인증번호를 입력해주세요" >
                                        </div>
                                        <div  class="inputStyleInfo chkNumberTimer"> 
                                                <label for="changePhoneChk"></label>
                                                <input type="text" id="changePhoneChkTime" name="changePhoneChk" class="inputStyle" value="3:00">
                                        </div>
                                        <button type="button" class="phonekBtn infoBtnStyle1 " onclick="phoneChkEnd()">입력하기</button>
                                    </div>
                                    <div class="inputStyleInfo">
                                        <label for="memberID"></label>
                                        <input type="text" id="memberID" name="memberID" class="inputStyle" placeholder="닉넴" value = "<?=$Info['youEmail']?>" readonly >
                                    </div>
                                </fieldset>
                            </form>
                            
                            <button type="button" class=" btnStyle3 " onclick="infoUpdateChk()">회원정보 수정</button>
                        </div>
                    </div>
                    <div class="info__form" >
                        <div>
                            <p class="info__title">sns 계정연동 관리</p>
                        </div>
                        <div class="info__bmStyle2">
                            <form action="#" name="#" method="post"></form>
                                <fieldset>
                                    <legend class="blind">카카오 </legend>        
                                    <div class="inputStyleToggle">
                                        <div class="kakaoDiv">
                                            <p>카카오</p>
                                            <input type="checkbox" id="toggle" hidden <?php if ($Info['KakaoTalk'] == 'y') echo 'checked'; ?>> 
                                            <label for="toggle" class="toggleSwitch" id="kakaoLink">
                                                <span class="toggleButton" id="kakaoLink"></span>
                                            </label>
                                        </div>
                                    </div>

                                </fieldset>
                            </form>
                            
                            <button type="button" class=" btnStyle3" onclick="kakaoUpdate()">카카오연동 수정</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        let isPassCheck = false;
        let isPhoneCheck = false;
        let isPhoneCheck2 = false;
        
        let minutes = 3;
        let seconds = 0;
        //생년월일 쪼개기
        const oldYouBirth = document.getElementById('oldYouBirth');
        const [oldyear, oldmonth, oldday] = oldYouBirth.value.split('-');
        
        // 비밀번호 업뎃 start
        function chkYouPass(){
            isPassCheck=false;

            let getYouPass = $("#newYouPass").val();
            let getYouPassNum = getYouPass.search(/[0-9]/g);
            let getYouPassEng = getYouPass.search(/[a-z]/ig);
            let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

            $("#newYouPassComment").addClass("red");
            if($("#newYouPass").val() == ''){
                $("#newYouPassComment").text("* 비밀번호를 입력해주세요!");
                $("#newYouPass").focus();
                return false;
                // 8~20자이내, 공백X, 영문, 숫자, 특수문자
            }else if(getYouPass.length < 8 || getYouPass.length > 20){
                $("#newYouPassComment").text(" * 8자리 ~ 20자리 이내로 입력해주세요");
                $("#newYouPass").focus();
                return false;
            } else if (getYouPass.search(/\s/) != -1){
                $("#newYouPassComment").text("* 비밀번호는 공백없이 입력해주세요!");
                $("#newYouPass").focus();
                return false;
            } else if (getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0 ){
                $("#newYouPassComment").text("* 영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
                $("#newYouPass").focus();
                return false;
            }else{
                $("#newYouPassComment").removeClass("red");
                $("#newYouPassComment").addClass("green");
                $("#newYouPassComment").text("* 사용가능합니다");
            }
            // 비밀번호 확인 유효성 검사
            $("#newYouPassCComment").addClass("red");
            if($("#newYouPassC").val() == ''){
                $("#newYouPassCComment").text("* 확인 비밀번호를 입력해주세요!");
                $("#newYouPassC").focus();
                return false;
                // 비밀번호 동일한지 체크
            }else if($("#newYouPass").val() !== $("#newYouPassC").val()){
                $("#newYouPassCComment").text("* 비밀번호가 일치하지 않습니다.");
                $("#newYouPassC").focus();

                return false;
            }else{
                isPassCheck = true;
                $("#newYouPassCComment").text("");
                $("#newYouPassComment").text("");
                // isPassCheck 체크후 다시 실행
                passUpdate();
            }
        }
        function passUpdateChk(){
            
                if($("#youPass").val() == ''){
                    alert(' 비밀번호를 입력해주세요');
                    $("#youPass").focus();
                
                }else if($("#youPass").val() == $("#newYouPass").val()){
                    $("#newYouPass").focus();
                    alert('변경하려는 비밀번호가 이전과 동일합니다 다시입력해주세요.');
                }else if (!isPassCheck) {
                    chkYouPass();
                }else{
                    passUpdate();
                }
        }
        function passUpdate(){
            
            $.ajax({
                type : "POST",
                url : "myInfoModifyChk.php",
                data : {"newPass" : $("#newYouPass").val(), "youPass" : $("#youPass").val(), "youEmail" : '<?=$youEmail?>', "type" : "isPwUpdate"},
                dataType : "json",
                success : function(data){
                    // location.reload();
                    alert(data.result);
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            });
        }
        // 비밀번호 업뎃 end

        // 휴대번호 로직 start
        function chkYouPhone(){
            isPhoneCheck = false;
             $("#youPhoneComment").addClass("red");
            let getYouPhone = RegExp(/^01[016789]-[^0][0-9]{3,4}-[0-9]{4}$/);

            if($("#youPhone").val() == ''){
                $("#youPhoneComment").text("* 연락처를 입력해주세요!");
                $("#youPhone").focus();
                return false;
            }else if(!getYouPhone.test($("#youPhone").val())){
                $("#youPhoneComment").text("* 휴대폰 번호가 정확하지 않습니다.(000-0000-0000)");
                $("#youPhone").focus();
                return false;
            }else{
                $("#youPhoneComment").text("");
                isPhoneCheck = true;

                phoneChk();
            }
        }
        function phoneChk(){
            $.ajax({
                type : "POST",
                url : "myInfoModifyChk.php",
                data : {"youPhone" : $("#youPhone").val(), "type" : "isPhoneChk"},
                dataType : "json",
                success : function(data){
                    if(data.result =="good"){
                        document.querySelector('.user__phone__inner__chk').style.display = 'flex';
                        document.querySelector("#youPhone").readOnly = true;
                        
                        $('#changePhoneChk').val(generateRandomNumber()) ; 
                        $("#youPhoneComment").addClass("green");
                        $("#youPhoneComment").removeClass("red");

                        $("#youPhoneComment").text("휴대폰으로 발송된 인증번호를 입력해주세요.");

                        // 시작 시간을 3분 00초로 설정합니다.
                        // minutes = 3;
                        // seconds = 0;
                        displayTime(minutes, seconds);

                    }else if(data.result =="bad"){
                        alert("사용중인 휴대번호입니다.");
                    }else{
                        alert("잘못된 접근입니다.");
                    };
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            });
        }
        function phoneChkEnd(){
            document.querySelector('.user__phone__inner__chk').style.display = 'none';
            document.querySelector('.phonekBtn.update').innerText='인증완료';
            document.querySelector('.phonekBtn.update').disabled = true;
            $("#youPhoneComment").text("휴대번호가 인증되었습니다.");
            isPhoneCheck2 =true;
            
        }
        function generateRandomNumber() {
            let randomNumber = Math.floor(Math.random() * 9000) + 1000;
            return randomNumber.toString();
        }
        // 휴대폰인증시간
        function displayTime(minutes, seconds) {
            let timeString = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
            $("#changePhoneChkTime").val(timeString);

            if (minutes === 0 && seconds === 0) {
                $("#changePhoneChkTime").val("핸드폰인증을 다시해주세요");
                return;
            }

            if (seconds === 0) {
                minutes--;
                seconds = 59;
            } else {
                seconds--;
            }

            setTimeout(function () {
                displayTime(minutes, seconds);
            }, 1000);
        }

        // 휴대번호 인증 end
        function infoUpdateChk(){
            
            if($("#youPhone").val() =="<?=$Info['youPhone']?>"){
                infoUpdate()
            }else{
            //폰인증 값이 하나라도 false 일떄 실행되는 코드 
                if (!isPhoneCheck||!isPhoneCheck2){
                switch (false) {
                        case isPhoneCheck:
                            // isPhoneCheck가 false일 때 실행되는 코드
                            
                            alert("휴대폰인증을 완료해 주세요");
                            break;
                        case isPhoneCheck2:
                            // isPhoneCheck가 false일 때 실행되는 코드
                            alert("휴대폰인증을 완료해 주세요");

                        break;
                        default:
                            break;
                    } 
                    return false;
                }
                infoUpdate();
            }
            
        }
        function infoUpdate(){
            // 생일변경 로직
            let youDay = $('#youDay').val();
            if (youDay >= 1 && youDay <= 9) {
                youDay = '0' + youDay;
            }

            let youBirth = ($('#youYear').val()+'-'+$('#youMonth').val()+'-'+youDay);
            let gender = $('input[name="gender"]:checked').val();
            let youPhone = $("#youPhone").val();

            $.ajax({
                type : "POST",
                url : "myInfoModifyChk.php",
                data : {"youPhone" : youPhone, "gender" : gender, "youBirth" : youBirth, "youEmail" : '<?=$youEmail?>', "type" : "isInfoupdate"},
                dataType : "json",
                success : function(data){
                    // location.reload();
                    alert(data.result);
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            });
            
        }
        function kakaoUpdate(){
            let toggleCheckbox = document.getElementById('toggle');
            let KakaoTalk = toggleCheckbox.checked ? 'y' : 'n';
            
            $.ajax({
                type : "POST",
                url : "myInfoModifyChk.php",
                data : {"KakaoTalk" : KakaoTalk, "youEmail" : '<?=$youEmail?>', "type" : "isKakaoUpdate"},
                dataType : "json",
                success : function(data){
                    // location.reload();
                    alert(data.result);
                },
                error : function(request, status, error){
                    console.log("request" + request);
                    console.log("status" + status);
                    console.log("error" + error);
                }
            });
        }
        // 윈도우 로드시 window.onload 함수 쓴것과 같음
        // 각 input스타일에서 포커스아웃할때(바깥클릭 and tab클릭)실행되게 해놓은 함수
        $(document).ready(function() {

            //상단에서 선언한 oldyear, oldmonth, oldday을 기준으로 옵션을 설정해줌 
            //

            // 연도 select box 만들기
            let yearSelect = $('#youYear');
            let currentYear = new Date().getFullYear();
            for (let i = currentYear; i >= 1950; i--) {
                yearSelect.append($('<option>', {value: i, text: i + '년'}));
            }

            // 월 select box 만들기
            let monthSelect = $('#youMonth');
            for (let i = 1; i <= 12; i++) {
                monthSelect.append($('<option>', {value: i, text: i + '월'}));
            }

            // 일 select box 만들기
            let daySelect = $('#youDay');
                     
            let year = $('#youYear').val();
            let month = $('#youMonth').val();
            let daysInMonth = new Date(oldyear, oldmonth, 0).getDate(); // 해당 월의 일 수 계산

            for (let i = 1; i <= daysInMonth; i++) {
                let option = $('<option>', { value: i, text: i + '일' });
                if (i == parseInt(oldday)) {
                    option.prop('selected', true);
                }
                daySelect.append(option);
            }


            //유저 생일값 가져오기
            $('#youYear').val(parseInt(oldyear)); // oldyear에 해당하는 연도 옵션 선택
            $('#youMonth').val(parseInt(oldmonth)); // oldmonth에 해당하는 월 옵션 선택
            $('#youDay').val(parseInt(oldday)); // oldmonth에 해당하는 월 옵션 선택

            //월을 변경하면 일값도 초기화 변경되게 설정
            function updateDayOptions() {
                daySelect.empty(); // 기존 옵션 제거

                let year = $('#youYear').val();
                let month = $('#youMonth').val();
                let daysInMonth = new Date(year, month, 0).getDate(); // 해당 월의 일 수 계산

                for (let i = 1; i <= daysInMonth; i++) {
                    let option = $('<option>', { value: i, text: i + '일' });
                    daySelect.append(option);
                }
            }

            // 월을 변경하면 일 값도 동적으로 변경되도록 설정
            $('#youMonth').on('change', function() {
                updateDayOptions();
            });
        });

        
    </script>
</body>
</html> 