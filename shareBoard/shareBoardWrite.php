<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // $sql = "SELECT count(boardID) FROM board";
    // $result = $connect -> query($sql);

    // $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    // $boardTotalCount = $boardTotalCount['count(boardID)'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>
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
        /* .list__img1 {background: url(../html/assets/img/shareboardview1.png) 30%; width: 100%; height: 100%;}
        .list__img2 {background: url(../html/assets/img/community11.png) 50%; width: 100%; height: 100%;}
        .list__img3 {background: url(../html/assets/img/community12.png) 40%; width: 100%; height: 100%;}
        .list__img4 {background: url(../html/assets/img/community13.png) 70%; width: 100%; height: 100%;}
        .list__img5 {background: url(../html/assets/img/community14.png) 30%; width: 100%; height: 100%;}
        .list__img6 {background: url(../html/assets/img/community15.png) 30%; width: 100%; height: 100%;}
        .list__img7 {background: url(../html/assets/img/community16.png) 30%; width: 100%; height: 100%;}
        .list__img8 {background: url(../html/assets/img/community17.png) 60%; width: 100%; height: 100%;}
        .list__img9 {background: url(../html/assets/img/community18.png) 40%; width: 100%; height: 100%;}
        .list__img10 {background: url(../html/assets/img/community19.png) 70%; width: 100%; height: 100%;}
        .list__img11 {background: url(../html/assets/img/community20.png) 80%; width: 100%; height: 100%;} */
       
        .list:nth-last-child(1) {
            /* margin-bottom: 100px; */
        }
        
    </style>
    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
</head>
<body>
    <div id="board__header" class="mt100">
            <div><a href="trendsBoard.php">뷰티트렌드</a></div> <!-- news-->
            <div class="active"><a href="shareBoard.php">공유게시판</a></div> <!-- share-->
            <div><a href="../notice/boardNotice.php">공지사항</a></div> <!-- notice-->
            <div><a href="../FAQ/FAQ.php">FAQ</a></div> <!-- faq-->
    </div>
    <!-- board__header -->


    <!-- //skip -->
    <main id="main" class=" mt80">
    <?php include "../include/abbHeader.php" ?>

        <div class="notice__inner mt100">
            <div class="intro__inner center">
                <h2>게시글 작성하기</h2>
            </div>
            <!-- intro__text -->

            <div class="board__inner">
                <div class="board__write">
                    <form action="shareBoardWriteSave.php" name="shareBoardWriteSave" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <legend class="blind">게시글 작성하기</legend>
                            <div>
                                <label for="boardTitle">제목</label>
                                <input type="text" id="board__title" name="blogTitle" class="inputStyle1 board__title">
                            </div>
                            <div>
                                <label for="blogContents">내용</label>
                                <textarea name="blogContents" id="boardContents" rows="20" class="inputStyle2 board__contents"></textarea>
                            </div>
                            <div class="mt30">
                                <label for="blogFile">파일</label>
                                <input type="file" name="blogFile" id="blogFile" accept=".jpg, .jpeg, .phg, .gif" placeholder="jpg, gif, png 파일만 넣을 수 있습니다. 이미지 용량은 1메가를 넘길 수 없습니다.">
                                <button type="submit" class="btnStyle3">저장하기</button>
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