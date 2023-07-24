<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionChk.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공지사항 글보기</title>
    <style>
        #board__header {
            width: 100%;
            display: flex;
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            justify-content: space-between;
            font-size: 25px;
        }

        #board__header .active a {
            padding: 5px 30px;
            background-color: #F06171;
            color: #fff;
            border-radius: 10px;
            /* padding:  0px 40px; */

        }

        .notice__inner {
            margin: 0 auto;
            width: 1270px;
        }

        .notice__title h1 {
            font-size: 30px;
            text-align: center;
        }

        input {
            border-radius: 8px;
        }

        textarea {
            border-radius: 8px;
        }

        .intro__inner h2 {
            font-size: 30px;
            text-align: center;
            margin-bottom: 50px;
        }

        .board__title {
            margin-bottom: 30px;
        }

        .btn__inner {
            width: 100%;
            display: flex;
            justify-content: right;
        }

        .btn__inner img {
            display: block;
            padding-top: 6px;
            width: 50px;
            height: 50px;
        }
    </style>
    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
</head>
<body class="white">
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->

    <main id="main" class=" mt80">
        <?php include "../include/abbHeader.php" ?>

        <!-- //header -->
        <div id="board__header" class="mt100">
            <div><a href="trendsBoard.php">뷰티트렌드</a></div> <!-- news-->
            <div class="active"><a href="shareBoard.php">공유게시판</a></div> <!-- share-->
            <div><a href="boardNotice.php">공지사항</a></div> <!-- notice-->
            <div><a href="../FAQ/FAQ.php">FAQ</a></div> <!-- faq-->
        </div>
        <!-- //board__header -->

        <div class="notice__inner mt100">
            <div class="intro__inner center">
                <h2>공유게시글 수정하기</h2>
            </div>
            <!-- intro__text -->

            <div class="board__inner">
                <div class="board__write">
                    <form action="shareBoardModifySave.php" name="boardWrite" method="post">
                        <fieldset>
                            <legend class="blind">공유게시글 수정하기</legend>
<?php
    $blogID = $_GET['blogID'];
    // echo $blogID;

    $blogSql = "SELECT * FROM blog WHERE blogID = '$blogID'";
    $blogResult = $connect -> query($blogSql);
    $blogInfo = $blogResult -> fetch_array(MYSQLI_ASSOC);
    // $blogContents = html_entity_decode($blogInfo['blogContents']);


    $sql = "SELECT b.blogID, b.blogContents, b.blogImgFile,  b.blogTitle, m.youName FROM blog b JOIN members2 m ON b.memberID = m.memberID ORDER BY blogID DESC;";
    $Result = $connect -> query($sql);
    $blog = $Result -> fetch_array(MYSQLI_ASSOC);
    

    if($Result){
        $blog = $Result -> fetch_array(MYSQLI_ASSOC);
        
        echo "<div style='display:none'><label for='blogID'>번호</label><input type='text' id='blogID' name='blogID' class='inputStyle' value='".$blogInfo['blogID']."'></div>";
        echo "<div><label for='blogTitle'>제목</label><input type='text' id='blog__title' name='blogTitle' class='inputStyle1 blog__title' value='".$blogInfo['blogTitle']."'></div>";
        echo "<div><label for='blogContents'>내용</label><textarea name='blogContents' id='blogContents' rows='20' class='inputStyle2 blog__content'>".$blogInfo['blogContents']."</textarea></div>";

        echo "<div class='mt50'><label for='blogPass'>비밀번호</label><input type='passWord' id='blogPass' name='blogPass' class='inputStyle1 blog__title' autocomplete='off' requied placeholder='글을 수정하려면 로그인 비밀번호를 입력해야 합니다.'></div>";

    }
?>
                            <!-- <div>
                                <label for="boardTitle">제목</label>
                                <input type="text" id="board__title" name="boardTitle" class="inputStyle1 board__title">
                            </div>
                            <div>
                                <label for="boardContents">내용</label>
                                <textarea name="boardContents" id="boardContents" rows="20"
                                    class="inputStyle2 board__contents"></textarea>
                            </div> -->

                            <div class="btn__inner mb100">
                                <button type="submit" class="btnStyle5">수정완료</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include "../include/footer.php" ?>
    
</body>
</html> 