<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $sql = "SELECT count(blogID) FROM blog";
    $result = $connect -> query($sql);

    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(blogID)'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공유게시판</title>
    <style>
        .list__inner {
            width: calc(100% - 34vw);
            margin: 80px auto 0px auto;
            /* background-color: #fff; */
        }
        .list__inner > h2 {
            margin-bottom: 40px;
            font-size: 30px;
            font-weight: 700;
            text-align: center;
            color: #F06171;
        }
        .section__img {
            min-width: 1000px;
            margin-bottom: 80px;
        }
        .list {
            width: 100%;
            /* padding-bottom: 100px; */
            margin: 0 auto 0 auto;
            /* background-color: #fff; */
            display: flex;
            flex-wrap: wrap;
            box-sizing: border-box;
        }
        .list__img img{
            /* border-radius: 15px;
            padding: 10px */
            cursor: pointer;
        }
        .list__each {
            display: inline-block;
            min-width: 251px;
            width: 20vw;
            margin: 0px 0.6vw 60px 0.6vw;
            background-color: rgba(247, 151, 162, 0.07);
            /* border: 1px solid #000000; */
        }
       
        .list:nth-last-child(1) {
            /* margin-bottom: 100px; */
        }
        
    </style>
        
    </style>
    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
</head>
<body>
    <div id="board__header" class="mt100">
            <div class="active"><a href="trendsBoard.php">뷰티트렌드</a></div> <!-- news-->
            <div><a href="shareBoard.php">공유게시판</a></div> <!-- share-->
            <div><a href="../notice/boardNotice.php">공지사항</a></div> <!-- notice-->
            <div><a href="../FAQ/FAQ.php">FAQ</a></div> <!-- faq-->
    </div>
    <!-- board__header -->
    <main id="main" class=" mt80">
        <?php include "../include/abbHeader.php" ?>
        <div class="list__inner">
        <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
        <div class="elfsight-app-41e3e7dd-8823-49c2-9813-230419b4977a"></div>
        </div>



    </main>

<?php include "../include/footer.php" ?>
    
</body>
</html> 