<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    //총 페이지
    $sql = "SELECT count(boardID) FROM board";
    $result = $connect -> query($sql);

    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(boardID)'];

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 작성하기</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>

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

        input {
            border-radius: 8px;
        }

        textarea {
            border-radius: 8px;
        }

        .notice__inner {
            margin: 0 auto;
            width: 1270px;
        }

        .notice__title h1 {
            font-size: 30px;
            text-align: center;
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
            align-items: center;
            justify-content: right;
        }

    </style>
</head>

<body class="white" id="scroll">
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- //skip -->


    <main id="main" class=" mt80">
    <?php include "../include/abbHeader.php" ?>

    <div id="board__header" class="mt100">
            <div><a href="trendsBoard.php">뷰티트렌드</a></div> <!-- news-->
            <div><a href="shareBoard.php">공유게시판</a></div> <!-- share-->
            <div class="active"><a href="boardNotice.php">공지사항</a></div> <!-- notice-->
            <div><a href="../FAQ/FAQ.php">FAQ</a></div> <!-- faq-->
        </div>
        <!-- //board__header -->

        <div class="notice__inner mt100">
            <div class="intro__inner center">
                <h2>게시글 작성하기</h2>
            </div>
            <!-- intro__text -->

            <div class="board__inner">
                <div class="board__write">
                    <form action="boardWriteSave.php" name="noticeWrite" method="post">
                        <fieldset>
                            <legend class="blind">게시글 작성하기</legend>
                            <div>
                                <label for="boardTitle">제목</label>
                                <input type="text" id="board__title" name="boardTitle" class="inputStyle1 board__title">
                            </div>
                            <div>
                                <label for="boardContents">내용</label>
                                <textarea name="boardContents" id="boardContents" rows="20"
                                    class="inputStyle2 board__contents"></textarea>
                            </div>
                            <div class="btn__inner mb100">                               
                                <button type="submit" class="btnStyle5">작성완료</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- main -->
    <?php include "../include/footer.php" ?>
    <!-- //footer -->
</body>

</html>