<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공지사항 글보기</title>
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
        <!-- //board__header -->

        <div class="notice__inner mt100">
        </div>
        <div class="board__inner">
            <h2>공지사항</h2>
            <div class="bord__view">
                <table>
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 80%;">
                    </colgroup>
                    <tbody>
                        <!-- <tr>
                            <th>제목</th>
                            <td>게시판 제목입니다.</td>
                        </tr>
                        <tr>
                            <th>등록자</th>
                            <td>관리자</td>
                        </tr>
                        <tr>
                            <th>등록일</th>
                            <td>2023.03.03</td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td>프이벤트 및 프로모션: 이벤트나 프로모션을 진행할 때는 이를 화장품 사이트에서 소개하고 참여 방법 및 이벤트 기간 등을 안내하는 공지사항을 게시할 수
                                있습니다.

                                재고 소진 상품 판매 중단: 일부 인기 상품의 경우 재고가 소진될 수 있습니다. 이 경우 해당 상품의 판매 중단을 알리는 공지사항을 게시할 수 있습니다.

                                배송 지연 공지: 상황에 따라 주문 제품의 배송이 지연될 수 있습니다. 이 경우 지연 사유와 예상 배송 일정을 안내하는 공지사항을 게시할 수 있습니다.

                                리뉴얼 및 개선 제품 출시: 기존 제품을 개선하여 새로운 제품을 출시할 때는 이를 화장품 사이트에서 소개하고 제품의 개선된 내용과 효과를 설명하는 공지사항을
                                게시할 수 있습니다.

                                유통 기한 및 사용 방법 안내: 화장품 제품의 유통 기한이나 사용 방법 등 중요한 정보를 안내하는 공지사항을 게시할 수 있습니다.</td>
                        </tr> -->
<?php
    if(isset($_GET['boardID'])) {
        $boardID = $_GET['boardID'];
        //보드뷰
        $sql = "UPDATE board SET boardView = boardView + 1 WHERE boardID = {$boardID}";
        $connect -> query($sql);
        // echo $boardID;
        $sql = "SELECT b.boardContents, b.boardTitle, m.youName, b.regTime, b.boardView FROM board b JOIN members2 m ON(m.memberID = b.memberID) WHERE b.boardID = {$boardID}";
        $result = $connect -> query($sql);
        if($result){
            $info = $result -> fetch_array(MYSQLI_ASSOC);
            echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
            echo "<tr><th>등록일</th><td>".date('Y-m-d', $info['regTime'])."</td></tr>";
            echo "<tr><th>내용</th><td>".$info['boardContents']."</td></tr>";
        } else {
            echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
        }
    }
?>
                    </tbody>
                </table>
            </div>
            <div class="board__btn mb100">
            <?php 
                if(isset($_SESSION['memberID'])){
                    if($_SESSION['memberID']=='1'){ ?>
                <a href="boardModify.php?boardID=<?=$_GET['boardID']?>" class="btnStyle4">수정하기</a>
                <!-- <a href="boardRemove.php?boardID=<?=$_GET['boardID']?>" class="btnStyle4" onclick="confirm('정말 삭제할거니?', '')">삭제하기</a> -->
                <a href="boardRemove.php?boardID=<?=($_GET['boardID'])?>" class="btnStyle4" onclick="return confirm('정말 삭제할거니?')">삭제하기</a>
                    <?php } 
                }?>

                <a href="boardNotice.php" class="btnStyle4">목록보기</a>
            </div>
        </div>
    </main>

    <?php include "../include/footer.php" ?>
    
</body>
</html> 