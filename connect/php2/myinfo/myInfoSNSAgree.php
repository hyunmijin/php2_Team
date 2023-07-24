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

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>알람 설정</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
</head>
<style>
    
</style>
<body id="scroll">
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
                            <li><a href="myInfoModifyPass.php" >회원정보 수정</a></li>
                        </ul>
                    </div>
                    <div class="aside2 aside__bmStyle">
                        <span>나의정보</span>
                        <ul>
                            <li><a href="myinfoMywrite.php" class="active">내가 쓴 게시물</a></li>
                            <li><a href="myinfoMyComment.php" >내가 쓴 댓글</a></li>
                            <li><a href="../mainCate/writeList.php" >내 제품 기록</a></li>
                        </ul>
                    </div>
                    <div class="aside3 ">
                        <span>알림</span>
                        <ul>
                            <li><a href="myInfoSNSAgree.php" class="active">알림설정</a></li>
                        </ul>
                    </div>
                </div>
                <div class="info__view"  id="scrollInfo">
                    <div class="info__view__title">
                        <h2>알람설정 </h2>
                    </div>
                    
                    <div class="info__form" >
                        <div>
                            <ul>
                                <li>· 알람설정을 하시면 내가 등록한 제품의 유통기한을 받아보실수 있습니다.</li>
                                <li>· 알람설정을위해 계정연동 & 핸드폰 등록을 해주세요.</li>
                            </ul>
                        </div>
                        <div class="">
                            <form action="#" name="#" method="post"></form>
                                <fieldset>
                                    <legend class="blind">카카오&sns </legend>        
                                    <div class="inputStyleAgree agreeInner">
                                        <div class="snsDiv">
                                            <p>SNS 알림</p>
                                            <input type="checkbox" id="toggleSns" hidden <?php if ($Info['SNSSub'] === 'y') echo 'checked'; ?>>
                                            <label for="toggleSns" class="toggleSwitchSns" id="snsAgree">
                                                <span class="toggleButton" id="snsAgree"></span>
                                            </label>
                                        </div>
                                        <div class="kakaoDiv">
                                            <p>KAKAO 알림</p>
                                            <input type="checkbox" id="toggle" hidden  <?php if ($Info['KakaoSub'] === 'y') echo 'checked'; ?>>
                                            <label for="toggle" class="toggleSwitch " id="kakaoAgree">
                                                <span class="toggleButton" id="kakaoAgree"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="inputStyleKakao">
                                         
                                    </div>

                                </fieldset>
                            </form>
                            
                            <button type="button" class="btnConf infoBtnStyle1" onclick="kakaoUpdate()">확인</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        
        function kakaoUpdate(){
            let SNSSubCheckbox = document.getElementById('toggleSns');
            let SNSSub = SNSSubCheckbox.checked ? 'y' : 'n';

            let KakaoSubCheckbox = document.getElementById('toggle');
            let KakaoSub = KakaoSubCheckbox.checked ? 'y' : 'n';
            
            $.ajax({
                type : "POST",
                url : "myInfoModifyChk.php",
                data : {"SNSSub" : SNSSub, "KakaoSub" : KakaoSub, "youEmail" : '<?=$youEmail?>', "type" : "isAgreeUpdate"},
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
        
    </script>
</body>
</html> 