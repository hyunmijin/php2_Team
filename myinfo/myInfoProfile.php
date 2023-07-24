<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/joinCheck.php";
    
    // if(!isset($_SESSION['memberID'])){

    //     echo "<script>alert('로그인이 필요한 페이지 입니다.')</script>";
    //     echo "<script>location.href='../login/login.php'</script>";

    //     // Header("Location:../login/login.php");
    // }
    
    $memberID = $_SESSION['memberID'];
    $nickName = $_SESSION['nickName'];

    $sql = "SELECT * FROM members2 WHERE memberID = '$memberID'";
    $skinType = "SELECT skinType FROM members2 WHERE memberID = '$memberID'";

    $result = $connect -> query($sql);
    $resultInfo = $result -> fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>개인정보- 닉네임변경</title>
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
    <main id="main" class="mt70">
        <?php include "../include/abbHeader.php" ?>
        <!-- //header -->
        <div class="info__logo">
            <h1>Abide By Beauty</h1>
        </div>
        <!-- //header -->
        <div class="info__wrap">
            
            <div class="info__title mt30 info__bmStyle">
                <h1><?= $resultInfo['youName'] ?>님></h1>
            </div>
            <div class="info__sec mt100">
                <div class="info__list">
                    <div class="aside1 aside__bmStyle">
                        <span>나의정보</span>
                        <ul>
                            <li><a href="#" class="active">프로필 설정</a></li>
                            <li><a href="#">회원정보 수정</a></li>
                        </ul>
                    </div>
                    <div class="aside2 aside__bmStyle"> 
                        <span>나의정보</span>
                        <ul>
                            <li><a href="#" >내가 쓴 게시물</a></li>
                            <li><a href="#" >내가 쓴 댓글</a></li>
                            <li><a href="#" >내 제품 기록</a></li>
                        </ul>
                    </div>
                    <div class="aside3 ">
                        <span>알림</span>
                        <ul>
                            <li><a href="#">알림설정</a></li>
                        </ul>
                    </div>
                </div>

                <div class="info__view">
                    <div class="info__view__title">
                        <h2>프로필 설정</h2>
                    </div>
                    <form action="profileModify.php" name="myInfoSavephp" method="post">
                        <div class="nick__form">
                        <?php if($resultInfo['youImgSrc'] == 'null'){ ?>
                            <a href="#" id="profile-link">
                            <img id="profile-image" src="../html/assets/profile/profile.png" alt="프로필사진등록">
                        </a>
                        <?php } else { ?>
                            <a href="#" id="profile-link">
                                <img id="profile-image" src="../html/assets/profile/<?= $resultInfo['youImgSrc'] ?>" alt="프로필사진등록">
                            </a>
                        <?php } ?>
                        
                        <input type="file" id="profile-upload" style="display: none;">
                            <p class="nick__tag">닉네임설정</p>
                                <fieldset>
                                    <legend class="blind">닉네임설정</legend>        
                                    <div class="inputNickStyleInfo">
                                        <label for="nickName" class=""></label>
                                        <input type="text" id="nickName" name="nickName" class="nickInput inputStyle" placeholder="<?= $resultInfo['nickName']?>" required>
                                        <p class="joinChkmsg" id="nickNameComment"></p>
                                    </div>
                                </fieldset>
                            <button type="button" class="nickBtn infoBtnStyle1" onclick="joinChecks()">중복확인</button>
                        </div>
                        <div class="skinType__inner">
                            <input type="hidden" id="skinType" name="skinType" class="nickInput inputStyle" placeholder="<?= $resultInfo['nickName']?>" required value="<?=$resultInfo['skinType']?>">

                            <div class="skinType__title"><span>피부타입</span></div>
                            <div class="skinType__cont">
                                <label class="toggle__type">
                                    <input type="checkbox" value="민감성">
                                    <span class="toggle__info">민감성</span>
                                </label>
                                <label class="toggle__type">
                                    <input type="checkbox"value="건성">
                                    <span class="toggle__info">건성</span>
                                </label>
                                <label class="toggle__type">
                                    <input type="checkbox" value="지성">
                                    <span class="toggle__info">지성</span>
                                </label>
                                <label class="toggle__type">
                                    <input type="checkbox" value="중성">
                                    <span class="toggle__info">중성</span>
                                </label>
                                <label class="toggle__type">
                                    <input type="checkbox" value="복합성">
                                    <span class="toggle__info">복합성</span>
                                </label>
                                <label class="toggle__type">
                                    <input type="checkbox" value="약건성">
                                    <span class="toggle__info">약건성</span>
                                </label>
                                <label class="toggle__type">
                                    <input type="checkbox" value="트러블성">
                                    <span class="toggle__info">트러블성</span>
                                </label>
                            </div>
                        </div>
                    <button type="button" class="btnConf infoBtnStyle1" onclick="myInfoSave()">저장</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- //main -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        let isNickCheck = false;
        let myInfoSaveNum = 0;
        let skinTypeSaveNum = 0;

        let chkInfo = true;

        // 닉네임 변경 확인
        function myInfoSave(){
            if(myInfoSaveNum === 1){
                // joinChecks();
                document.myInfoSavephp.submit();
            } else if(skinTypeSaveNum === 1){
                $("#nickName").val("<?=$nickName?>");
                document.myInfoSavephp.submit();
            }
        }
        
        
        // 닉네임 유효성
        function chkNickName(){
            isNickCheck = false;
            // 닉네임 유효성 검사
            $("#nickNameComment").addClass("red");
            let getnickName = RegExp(/^[가-힣|0-9]+$/);
            if($("#nickName").val() == ''){
                $("#nickNameComment").text("* 닉네임을 입력해주세요!");
                $("#nickName").focus();
                myInfoSaveNum = 0;
                return false;
            }else if(!getnickName.test($("#nickName").val())){
                $("#nickNameComment").text("* 닉네임은 한글 또는 숫자만 사용 가능합니다.");
                $("#nickName").val('');
                $("#nickName").focus();
                myInfoSaveNum = 0;
                return false;
            }else{
                $("#nickNameComment").text("");
                
                isNickCheck = true;
            }
            
            
        }
        
        // 윈도우 로드시 window.onload 함수 쓴것과 같음
        // 각 input스타일에서 포커스아웃할때(바깥클릭 and tab클릭)실행되게 해놓은 함수
        $( document ).ready(function() {
            $('#nickName').blur(function(){
                chkNickName();
            });
        });
        function joinChecks(){
            if (!isNickCheck) {
            // 위 변수 중 하나라도 false일 때 실행되는 코드
            switch (false) {
                    case isNameCheck:
                        // isNameCheck가 false일 때 실행되는 코드
                        chkNickName();
                        break;

                    default:
                        break;
                }
                return false;
            } else {
                $.ajax({
                type : "POST",
                url : "profileCheck.php",
                data : {"nickName" : $("#nickName").val(), "type" : "isNickCheck"},
                dataType : "json",
                success : function(data){
                    if(data.result == "good"){
                        $("#nickNameComment").text("* 사용 가능한 닉네임 입니다");
                        $("#nickNameComment").removeClass("red");
                        $("#nickNameComment").addClass("green");
                        //  isNickCheck = true;
                         myInfoSaveNum = 1;
                    }else {
                        $("#nickName").val('');
                        $("#nickNameComment").text("* 사용 중인 닉네임 입니다");
                        $("#nickNameComment").removeClass("green");
                        $("#nickNameComment").addClass("red");
                         isNickCheck = false;
                         myInfoSaveNum = 0;
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
        }

        
        // 모든 체크박스 요소를 가져옵니다.
        const checkboxes = document.querySelectorAll('.toggle__type input[type="checkbox"]');

        // 체크박스 요소가 변경될 때 실행되는 함수
        function handleCheckboxChange(event) {
            if (event.target.checked) {
                // 모든 체크박스를 반복하면서 현재 체크된 체크박스 이외의 체크박스를 체크해제합니다.
                checkboxes.forEach((checkbox) => {
                    if (checkbox !== event.target) {
                        checkbox.checked = false;
                    } else {
                        $("#skinType").val(event.target.value);
                        skinTypeSaveNum = 1;
                        console.log($("#skinType").val());
                    }
                });
            }
        }
        

        // 각 체크박스 요소에 이벤트 리스너를 추가합니다.
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', handleCheckboxChange);
        });

        // 페이지 로드 시 이전에 선택된 체크박스 값 복원
        window.addEventListener('load', () => {
            const selectedSkinType = $("#skinType").val();
            if (selectedSkinType) {
                checkboxes.forEach((checkbox) => {
                    if (checkbox.value === selectedSkinType) {
                        checkbox.checked = true;
                    } else {
                        checkbox.checked = false;
                    }
                });
            }
        });

        $(document).ready(function() {
            $('#profile-upload').change(function() {
                var file = $(this).prop('files')[0];
                var formData = new FormData();
                formData.append('file', file);

                $.ajax({
                    url: 'uploadProfile.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // 성공적으로 업로드되었을 때 수행할 작업
                        // response 변수에는 서버에서 받은 응답이 들어있습니다.
                        console.log(response);
                        location.reload();
                    },
                    error: function() {
                        // 업로드 중 오류가 발생했을 때 수행할 작업
                        console.log('오류가 발생했습니다.');
                    }
                });
            });

            $('#profile-link').click(function(e) {
                e.preventDefault();
                $('#profile-upload').click();
            });
        });

    
        
    </script>
</body>
</html>