<?php
    include "../connect/connect.php";
    include "../connect/session.php";

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
    <title>공지사항</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
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

        <!-- //header -->
        <div id="board__header" class="mt100">
            <div><a href="../shareBoard/trendsBoard.php">뷰티트렌드</a></div> <!-- news-->
            <div><a href="../shareBoard/shareBoard.php">공유게시판</a></div> <!-- share-->
            <div class="active"><a href="../notice/boardNotice.php">공지사항</a></div> <!-- notice-->
            <div><a href="../FAQ/FAQ.php">FAQ</a></div> <!-- faq-->
        </div>
        <!-- board__header -->
        <div class="notice__inner mt100 ">
            <div class="notice__inner">
                <div class="notice__search">
                    <div class="left">
                    *총<em><?=$boardTotalCount?></em>건의 게시물이 등록되어 있습니다.
                    </div>
                    <div class="right">
                        <form action="boardSearch.php" name="boardSearch" mmethod="get">
                            <fieldset>
                                <legend class="blind">게시판 검색영역</legend>
                                <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!" required>
                                <button type="submit" class="btnStyle4">검색</button>
                                <?php 
                                if(isset($_SESSION['memberID'])){
                                    if($_SESSION['memberID']=='1'){ ?>
                                    <button type="submit" class="btnStyle4"><a href="boardWrite.php">글쓰기</a></button>
                                    <?php } 
                                }?>
                                <!-- <button type="submit " class="btnStyle4"><a href="boardWrite.php">글쓰기</a></button> -->
                                
                                <!-- <button type="submit" class="btnStyle3">글쓰기 </button> -->
                                <!-- <a class="btnStyle3" href="boadWrite.html"> 글쓰기</a> -->
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="notice__tables">
                    <table>
                        <colgroup>
                            <col style="width :5%">
                            <col>
                            <col style="width :15%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>번호</th>
                                <th>제목</th>
                                <th>등록일</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>10</td>
                                <td><a href="boardView.html">게시판 제목 영역입니다. 아직 제목이 없어요!</a></td>
                                <td>2022-02-02</td>
                            </tr>
                                -->
<?php
    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $viewNum = 10;
    $viewLimit = ($viewNum * $page) - $viewNum; 

    //   1~20 DESC LIMIT 0, 20 -> page1 (viewNum * 1) - viewNum
    // 21~40 DESC LIMIT 20, 20 -> page2 (viewNum * 2) - viewNum
    // 40~60 DESC LIMIT 40, 20 -> page3 (viewNum * 3) - viewNum
    // 60~80 DESC LIMIT 60, 20 -> page4 (viewNum * 4) - viewNum

    $sql = "SELECT boardID, boardTitle, regTime FROM board ORDER BY boardID DESC LIMIT {$viewLimit}, {$viewNum}";
    $result = $connect -> query($sql);

    if($result){
        $count = $result -> num_rows;

        if($count > 0){
            for($i=0; $i<$count; $i++){
                $info = $result -> fetch_array(MYSQLI_ASSOC);

                echo "<tr>";
                echo "<td>".$info['boardID']."</td>";
                echo "<td><a href='boardView.php?boardID={$info['boardID']}'>".$info['boardTitle']."</td>";
                echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
        }
    }
?>
                        </tbody>
                    </table>
                </div>
                <div class="notice__pages mb100">
                    <ul>
                        <!-- <li><a href="#"><</a></li>
                        <li class="active"> <a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">></a></li> -->
<?php
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
        echo "<li><a href='boardnotice.php?page=1'>처음으로</a></li>";
        $prevPage = $page - 1;
        echo "<li><a href='boardnotice.php?page={$prevPage}'>이전</a></li>";
    }

    //페이지
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='boardnotice.php?page={$i}'>{$i}</a></li>";
    }
    // 마지막 페이지로/ 다음 페이지로
    if($page != $boardTotalCount && $page <= $boardTotalCount){
        $nextPage = $page + 1;
        echo "<li><a href='boardnotice.php?page={$nextPage}'>다음</a></li>";
        echo "<li><a href='boardnotice.php?page={$boardTotalCount}'>마지막으로</a></li>";
    }
?>
                    </ul>
                </div>
            </div>
        </div>
    </main>

<?php include "../include/footer.php" ?>
    
</body>
</html> 