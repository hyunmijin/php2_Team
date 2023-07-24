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
            width: calc(100% - 35vw);
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
        .list__img .img__box{
            /* border-radius: 15px;
            padding: 10px */
            cursor: pointer;
            background-size: cover;
            width: 100;        
        }
        .list__text {
            /* height: 170px; */
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .list__name {
            display: flex;
            justify-content: space-between;
            align-items: end;
            margin-bottom: 35px;
            border-bottom: 1px solid #CCCCCC;
        }
        .list__name b {
            padding-right: 0px;
            /* position: relative; */
        }
        .list__name b img {
            width: 25px;
            height: 25px;
            /* top: -3px; */
            right: 0;
            background-size: 150%;
            border-radius: 50px;
        }
        .list__text .title {
            width: 100%;
            font-size: 1.25em;
            font-weight: 700;
            margin-bottom: 20px;
            height: 30px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .list__text .content {
            font-weight: 300;
            font-size: 0.88em;
            height: 20px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .list__each {
            display: inline-block;
            width: 15vw;
            min-width: 251px;
            height: 250px;
            margin: 0px 0.5vw 250px 0.4vw;
            background-color: rgba(247, 151, 162, 0.07);
            /* border: 1px solid #F797A2; */
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
<body id="scroll">
    <div id="board__header" class="mt100">
            <div><a href="trendsBoard.php">뷰티트렌드</a></div> <!-- news-->
            <div class="active"><a href="shareBoard.php">공유게시판</a></div> <!-- share-->
            <div><a href="../notice/boardNotice.php">공지사항</a></div> <!-- notice-->
            <div><a href="../FAQ/FAQ.php">FAQ</a></div> <!-- faq-->
    </div>
    <!-- board__header -->
    <main id="main" class=" mt80">
        <?php include "../include/abbHeader.php" ?>
        
    <div class="list__inner">
        <div class="section__img">
            <img src="../html/assets/img/boardimg_02.png" alt="">
        </div>
        <div class="notice__search">
                    <div class="left">
                    *총<em><?=$boardTotalCount?></em>건의 게시물이 등록되어 있습니다.
                    </div>
                    <div class="right">
                        <form action="shareBoardSearch.php" name="shareBoard" mmethod="get">
                            <fieldset>
                                <legend class="blind">게시판 검색영역</legend>
                                <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!" required>
                                <button type="submit" class="btnStyle4">검색</button>
                                <?php if(isset($_SESSION['memberID'])){ ?>
                                    <button type="submit" class="btnStyle4"><a href="shareBoardWrite.php">글쓰기</a></button>
                                <?php } ?>
                                <!-- <button type="submit " class="btnStyle4"><a href="boardWrite.php">글쓰기</a></button> -->
                                
                                <!-- <button type="submit" class="btnStyle3">글쓰기 </button> -->
                                <!-- <a class="btnStyle3" href="boadWrite.html"> 글쓰기</a> -->
                            </fieldset>
                        </form>
                    </div>
                </div>

        <!-- <h2>공유 게시판</h2> -->
        <div class="list">
            <!-- list__each -->

<?php
    // $sql = "SELECT * FROM blog WHERE blogDElete = 0 ORDER BY blogID DESC";
    // $result = $connect -> query($sql);

    
    // echo $sql;
    // // $sql = "SELECT b.blogContents, b.blogTitle, m.youName, b.regTime, b.blogView ,m.nickName FROM blog b JOIN members2 m ON(m.memberID = b.memberID) WHERE b.blogID = {$blogID}";
    // echo $result;
    ?>
    <?php 

if(isset($_GET['page'])){
    $page = (int) $_GET['page'];
} else {
    $page = 1;
}

$viewNum = 16;
$viewLimit = ($viewNum * $page) - $viewNum; 

//   1~20 DESC LIMIT 0, 20 -> page1 (viewNum * 1) - viewNum
// 21~40 DESC LIMIT 20, 20 -> page2 (viewNum * 2) - viewNum
// 40~60 DESC LIMIT 40, 20 -> page3 (viewNum * 3) - viewNum
// 60~80 DESC LIMIT 60, 20 -> page4 (viewNum * 4) - viewNum

$sql = "SELECT b.blogID, b.blogContents, b.blogImgFile, m.youImgSrc, b.blogTitle, m.youName, b.blogRegTime, b.blogView ,m.nickName FROM blog b JOIN members2 m ON b.memberID = m.memberID ORDER BY blogID DESC LIMIT {$viewLimit}, {$viewNum};";
$result = $connect -> query($sql);

// $sql = "SELECT boardID, boardTitle, regTime FROM board ORDER BY boardID DESC LIMIT {$viewLimit}, {$viewNum}";
// $result = $connect -> query($sql);


                
        foreach($result as $blog){?>
        
            <div class="list__each">
                <div class="list__img">
                    <a href="shareBoardView.php?blogID=<?=$blog['blogID']?>">
                        <img src="../html/assets/blog/<?=$blog['blogImgFile']?>" alt="<?=$blog['blogTitle']?>">
                    </a>
                </div>

                <div class="list__text">

                    <div class="list__name"><b><img src="../html/assets/profile/<?=$blog['youImgSrc']?>" alt="프로필사진"><?=$blog['nickName']?></b><small><?=date('Y-m-d', $blog['blogRegTime'])?></small></div>

                    <h3 class="title"><?=$blog['blogTitle']?></h3>
                    <p class="content"><?=$blog['blogContents']?></p>
                    
                </div>

            </div>
        <?php } ?>

            <!-- //list__each -->
        </div>
    </div>
    <div class="notice__pages mb100">
        <ul>
            <?php
            $viewNum = 16;
            $viewLimit = ($viewNum * $page) - $viewNum;

            $sql = "SELECT blogID, blogTitle, regTime FROM blog ORDER BY blogID DESC LIMIT {$viewLimit}, {$viewNum}";
            $result = $connect -> query($sql);

            
    //게시글 총 갯수

    //총 페이지 갯수
    $boardTotalCount = ceil($boardTotalCount/$viewNum);

    // echo $boardTatalCount;
    //1 2 3 4 5 6 7 8 9 10 11 12 13 ...
    $pageView = 5;
    $startPage = $page - $pageView;
    $endPage = $page + $pageView;

    //처음 페이지 초기화/ 마지막 페이지
    if($startPage < 1) $startPage =1;
    if($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

    // 첫 페이지로 가기/ 이전 페이지로 가기
    if($page !== 1 && $boardTotalCount !=0 && $page <= $boardTotalCount){
        echo "<li><a href='shareBoard.php?page=1'>처음으로</a></li>";
        $prevPage = $page - 1;
        echo "<li><a href='shareBoard.php?page={$prevPage}'>이전</a></li>";
    }

    //페이지
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='shareBoard.php?page={$i}'>{$i}</a></li>";
    }
    // 마지막 페이지로/ 다음 페이지로
    if($page != $boardTotalCount && $page <= $boardTotalCount){
        $nextPage = $page + 1;
        echo "<li><a href='shareBoard.php?page={$nextPage}'>다음</a></li>";
        echo "<li><a href='shareBoard.php?page={$boardTotalCount}'>마지막으로</a></li>";
    }
?>
            <!-- <li><a href="#"><</a></li>
            <li class="active"> <a  href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">></a></li> -->
        
        </ul>
    </div>

    <!-- //skip -->



    </main>

<?php include "../include/footer.php" ?>
    
</body>
</html> 