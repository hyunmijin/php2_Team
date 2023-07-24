<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    
    if(isset($_GET['memberID'])){
        $memberID = $_GET['memberID'];
    } else {
        $memberID =0;;
    }
    if(isset($_SESSION['memberID'])){
        $memberID =$_SESSION['memberID'];
    }


    if(isset($_GET['blogID'])){
        $blogID = $_GET['blogID'];
    } else {
        Header("Location: shareBoard.php");
    }

    $blogSql = "SELECT b.*,m.nickName, m.youImgSrc FROM blog b JOIN members2 m ON b.memberID = m.memberID  WHERE blogID  = '$blogID' ORDER BY blogID DESC;";
    $blogResult = $connect -> query($blogSql);
    $blogInfo = $blogResult -> fetch_array(MYSQLI_ASSOC);

    //하나의 값만 불러옴
    //셰어보드값불러오는 걸 보면서 수정해야됨

    //아래도 같음

    $sql = "UPDATE blog SET blogView = blogView + 1 WHERE blogID = {$blogID}";
    $connect -> query($sql);

    $sql = "SELECT b.blogID, b.blogContents, b.blogImgFile,  b.blogTitle, m.youName, b.blogRegTime, b.blogView ,m.nickName ,m.youImgSrc FROM blog b JOIN members2 m ON b.memberID = m.memberID ORDER BY blogID DESC";
    $Result = $connect -> query($sql);
    $blog = $Result -> fetch_array(MYSQLI_ASSOC);
    $commentSql = "SELECT * FROM blogComment WHERE blogID = '$blogID' AND commentDelete = '0' ORDER BY commentID DESC";
    $commentResult = $connect -> query($commentSql);
    $commentInfo = $commentResult -> fetch_array(MYSQLI_ASSOC);

    // echo "<pre>";
    // var_dump($blog);
    // echo "<pre>";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공유 게시글 보기</title>

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

        /* .btn__inner {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn__inner img {
            display: block;
            padding-top: 6px;
            width: 50px;
            height: 50px;
        } */
    </style>
</head>

<body class="white" id= "scroll">
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
            <div class="active"><a href="../shareBoard/shareBoard.php">공유게시판</a></div> <!-- share-->
            <div><a href="../notice/boardNotice.php">공지사항</a></div> <!-- notice-->
            <div><a href="../FAQ/FAQ.php">FAQ</a></div> <!-- faq-->
        </div>
    <!-- board__header -->

    
        <div class="notice__inner mt100">
            <div class="intro__inner center">
                <h2>공유 게시판</h2>
            </div>
            <!-- intro__text -->

            <div class="shareboard__inner">
                <div class="shareboard">
                    <div class="shareboard__view" id="comment<?=$comment['commentID']?>">
                        <div class="img">
                            <img src="../html/assets/blog/<?=$blogInfo['blogImgFile']?>">
                        </div>
                        <div class="text">
                            <div class="profile">
                                <div class="sec1">
                                <img src="../html/assets/profile/<?=$blogInfo['youImgSrc']?>" alt="프로필사진">
                                    <p><?= $blogInfo['nickName']?></p>
                                </div>
                                <div class="sec2">
                                    <p><?=date('Y-m-d', $blogInfo['blogRegTime'])?></p>
                                </div>
                            </div>
                            <div class="title">
                                <h2><?=$blogInfo['blogTitle']?></h2>
                            </div>
                            <div class="desc">
                                <p><?=$blogInfo['blogContents']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="view__num">
                        <div class="num">
                            <h3>조회수<span><?=$blogInfo['blogView']?></span></h3>
                            <h4>좋아요 💜 <span> 10명이 좋아합니다</span> </h4>
                        </div>
                        <div class="edit">
                            <a href="shareBoardModify.php?blogID=<?=$_GET['blogID']?>">수정</a>
                            <?php
                        if (isset($_SESSION['memberID'])) {
                            if($_SESSION['memberID'] == $blogInfo['memberID']){
                            ?>
                            <a href="shareBoardRemove.php?blogID=<?=$_GET['blogID']?>" onclick="return confirm('정말 삭제하시겠습니까?')"> / 삭제</a>
                        <?php
                            }
                        }
                        ?>
                            <!-- <a href="">삭제</a> -->
                        </div>
                    </div>

    

                    <div class="shareboard_list">
                        <div class="list">
                        <?php
    // $sql = "SELECT * FROM blog WHERE blogDElete = 0 ORDER BY blogID DESC";
    // $result = $connect -> query($sql);

    $sql = "SELECT b.blogID, b.blogContents, b.blogImgFile,  b.blogTitle, m.youName, b.blogRegTime, b.blogView ,m.nickName FROM blog b JOIN members2 m ON b.memberID = m.memberID ORDER BY blogID DESC;";
            
    // echo $sql;
    // // $sql = "SELECT b.blogContents, b.blogTitle, m.youName, b.regTime, b.blogView ,m.nickName FROM blog b JOIN members2 m ON(m.memberID = b.memberID) WHERE b.blogID = {$blogID}";
    $result = $connect -> query($sql);

?>
<?php
$count = 0;
$currentIndex = 0; // 현재 게시물의 인덱스
$targetIndex = -1; // 현재 게시물의 인덱스를 찾기 위한 변수
$currentBlogID = $_GET['blogID'];

// 현재 게시물의 인덱스를 찾습니다
foreach ($result as $index => $blogInfo) {
    if ($blogInfo['blogID'] == $currentBlogID) {
        $targetIndex = $index;
        break;
    }
}


$result = $connect -> query($sql);
// 현재 게시물 앞뒤로 2개씩 게시물을 가져옵니다
foreach ($result as $index => $blogInfo) {
    // 현재 게시물의 앞뒤 2개를 가져옵니다

    if ($index >= $targetIndex - 2 && $index <= $targetIndex + 2) {
        // 현재 게시물은 건너뜁니다
        if ($index == $targetIndex) {
            continue;
        }
        
        // 게시물을 표시합니다
        if ($count >= 5) {
            break;
        }
        
        $count++;
        ?>
                            <a href="ShareboardView.php?blogID=<?=$blogInfo['blogID']?>">
                                <img src="../html/assets/blog/<?=$blogInfo['blogImgFile']?>" alt="<?=$info['blogTitle']?>">
                            </a>
                            <?php 
    }
}
?>
                        </div>
                        <div class="btn">
                            <a href="shareBoard.php" class="btnStyle6">목록보기</a>
                        </div>                    
                    </div>
                    <div class="blog__comment" id="blogComment">
                        <h3>댓글</h3>
                        <?php
                            foreach($commentResult as $comment){ ?>
                                <div class="comment__view" id="comment<?=$comment['commentID']?>">
                                    <div class="avatar">
                                        <img src="https://t1.daumcdn.net/tistory_admin/blog/admin/profile_default_06.png" alt="">
                                    </div>
                                    <div class="info">
                                        <span class="nickname"><?=$comment['commentName']?></span>
                                        <span class="date"><?=date('Y-m-d', $comment['regTime'])?></span>
                                        <p class="msg"><?=$comment['commentMsg']?></p>

                                        <div class="del">
                                            <a href="#" class="comment__del__del">삭제</a>
                                            <a href="#" class="comment__del__mod">수정</a>
                                        </div>
                                    </div>
                                </div>
                        <?php }?>

                        <!-- 삭제 -->
                        <div class="comment__delete" style="display: none">
                            <label for="commentDeletePass" class="blind">비밀번호</label>
                            <input type="password" id="commentDeletePass" name="commentDeletePass" placeholder="비밀번호">
                            <button id="commentDeleteCancel">취소</button>
                            <button id="commentDeleteButton">삭제</button>
                        </div>
                        <!-- //삭제 -->
                        <!-- 수정 -->
                        <div class="comment__modify" style="display: none">
                            <label for="commentModifyMsg" class="blind">수정 내용</label>
                            <textarea name="commentModifyMsg" id="commentModifyMsg" cols rows="4" placeholder="수정할 내용을 적어주세요!" maxlength="255" required></textarea>
                            <label for="commentModifyPass" class="blind">비밀번호</label>
                            <input type="password" id="commentModifyPass" name="commentModifyPass" placeholder="비밀번호" rqeuired>
                            <button id="commentModifyCancel">취소</button>
                            <button id="commentModifyButton">수정</button>
                        </div>
                        <!-- //수정 -->

                        <div class="comment__write">
                            <form action="#">
                                <fieldset>
                                    <legend class="blind">댓글 쓰기</legend>
                                    <label for="commentPass">비밀번호</label>
                                    <input type="password" id="commentPass" name="commentPass" placeholder="비밀번호" required>
                                    <label for="commentName">이름</label>
                                    <input type="text" id="commentName" name="commentName" placeholder="이름" required>
                                    <label for="commentWrite">댓글쓰기</label>
                                    <textarea id="commentWrite" name="commentWrite" rows="4" placeholder="댓글을 써주세요!" maxlength="255" required></textarea>
                                    <button type="button" id="commentWriteBtn" class="btnStyle5 mt10">댓글쓰기</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <!-- bolg__comment -->
                </div>

            </div>
        </div>
    </main>
    <!-- main -->

    <?php include "../include/footer.php" ?>

    <!-- //footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        let commentID = "";
        // 댓글 수정 버튼
        $(".comment__del__mod").click(function(e){
            e.preventDefault();
            //alert("댓글 수정 버튼 누름");
            $(this).parent().before($(".comment__modify"));
            $(".comment__modify").show();
            $(".comment__delete").hide();
            commentID = $(this).parent().parent().parent().attr("id");
        });
        // 댓글 수정 버튼 --> 취소 버튼
        $("#commentModifyCancel").click(function(){
            $(".comment__modify").hide();
        });
        // 댓글 수정 버튼 --> 수정 버튼
        $("#commentModifyButton").click(function(){
            let number = commentID.replace(/[^0-9]/g, "");
            if($("#commentModifyPass").val() == ""){
                alert("댓글 작성시 비밀번호를 작성해주세요!");
                $("#commentModifyButton").focus();
            } else {
                $.ajax({
                    url: "blogCommentModify.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentMsg": $("#commentModifyMsg").val(),
                        "commentPass": $("#commentModifyPass").val(),
                        "commentID": number,
                    },
                    success: function(data){
                        console.log(data);
                        if(data.result == "bad"){
                            alert("비밀번호가 틀렸습니다.!");
                        } else {
                            alert("댓글이 수정되었습니다.");
                        }
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        });
        // 댓글 삭제 버튼
        $(".comment__del__del").click(function(e){
            e.preventDefault();
            //alert("댓글 삭제 버튼 누름");
            $(this).parent().before($(".comment__delete"));
            $(".comment__delete").show();
            $(".comment__modify").hide()
            commentID = $(this).parent().parent().parent().attr("id");
        });
        // 댓글 삭제 버튼 -> 취소 버튼
        $("#commentDeleteCancel").click(function(){
            $(".comment__delete").hide();
        });
        // 댓글 삭제 버튼 -> 삭제 버튼
        $("#commentDeleteButton").click(function(){
            let number = commentID.replace(/[^0-9]/g, "");
            if($("#commentDeletePass").val() == ""){
                alert("댓글 작성시 비밀번호를 작성해주세요!");
                $("#commentDeletePass").focus();
            } else {
                $.ajax({
                    url: "blogCommentDelete.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentPass": $("#commentDeletePass").val(),
                        "commentID": number,
                    },
                    success: function(data){
                        console.log(data);
                        if(data.result == "bad"){
                            alert("비밀번호가 틀렸습니다.!");
                        } else {
                            alert("댓글이 삭제되었습니다.");
                        }
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        });
        // 댓글 쓰기 버튼
        $("#commentWriteBtn").click(function(){
            $("#blogComment").focus();
            if($("#commentWrite").val() == ""){
                alert("댓글을 작성해주세요!");
                $("#commentWrite").focus();
            } else {
                $.ajax({
                    url: "blogCommentWrite.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "blogID": <?=$blogID?>,
                        "memberID": <?=$memberID?>,
                        "name": $("#commentName").val(),
                        "pass": $("#commentPass").val(),
                        "msg": $("#commentWrite").val(),
                    },
                    success: function(data){
                        console.log(data);
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                });
            }
        });
    </script>
</body>

</html>