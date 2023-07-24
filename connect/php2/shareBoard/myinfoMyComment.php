<?php 
    include "../connect/connect.php";
    include "../connect/session.php";
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";echo "<pre>";
    // var_dump($_SESSION);
    $youName=$_SESSION['youName'];
    $youEmail=$_SESSION['youEmail'];
    $memberID=$_SESSION['memberID'];
    $sql = "SELECT * FROM blogComment WHERE  memberID = '{$memberID}'";
    $Result = $connect -> query($sql);
    $Info = $Result->fetch_array(MYSQLI_ASSOC);
    
    $sql = "SELECT count(memberID) FROM blogComment WHERE memberID = '{$memberID}'";
    $result = $connect -> query($sql);
    
    $blogTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $blogTotalCount = $blogTotalCount['count(memberID)'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내가 쓴 댓글</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
    <style>
        th{
            background-color: #F06171;
            color: #ffff;
            font-size: 16px;
            font-weight: normal;
            border: 1px solid #000;
            padding: 10px 0;
        }
        tr {
            border: 1px solid;
        }
        td {
            border: 1px solid;
            text-align: center;
            padding: 5px 0;
            font-size: 13px;
        }
        .info__subtitle{
            display: flex;
            position: relative;
        }
        .info__subtitle h3{
            border-top: 1px solid #9d9d9d;
            border-left: 1px solid #9d9d9d;
            border-right: 1px solid #9d9d9d;
            padding: 12px 0;
            width: 50%;
            text-align: center;
            position: relative;
            margin: 40px 0;
        }
        .info__subtitle h3 em {
            color: red;
        }
        .info__subtitle::after{
            position: absolute;
            content: '';
            width: 50%;
            right: 0px;
            top: 88px;
            border-bottom: 1px solid #9d9d9d;
        }
        .mywrite__table .removeBtn, 
        .mywrite__table .modifyBtn {
            display: inline-block;
            border-radius: 5px;
            background-color: #F8AAB3;
            padding: 2px 8px;
        }
        .saveBtn {
            display: block;
            margin: 0 auto;
            cursor: pointer;
        }
         /* scroll start */
         #scroll::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 5px;
            background-color: #FAFAFA;
        }
        #scroll::-webkit-scrollbar
        {
            width: 8px;
            background-color: #F5F5F5;
        }
        #scroll::-webkit-scrollbar-thumb
        {
            border-radius: 5px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #EAAFC8;
        }
        
        /* scroll end */
    </style>
</head>
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
                            <li><a href="myInfoProfile.php">프로필 설정</a></li>
                            <li><a href="myInfoModifyPass.php">회원정보 수정</a></li>
                        </ul>
                    </div>
                    <div class="aside2 aside__bmStyle">
                        <span>나의정보</span>
                        <ul>
                            <li><a href="myinfoMywrite.php" >내가 쓴 게시물</a></li>
                            <li><a href="myinfoMyComment.php" class="active">내가 쓴 댓글</a></li>
                            <li><a href="../mainCate/writeList.php" >내 제품 기록</a></li>
                        </ul>
                    </div>
                    <div class="aside3 ">
                        <span>알림</span>
                        <ul>
                            <li><a href="myInfoSNSAgree.php">알림설정</a></li>
                        </ul>
                    </div>
                </div>
                <div class="info__view">
                    <div class="info__view__title">
                        <h2>내가 쓴 댓글 확인</h2>
                    </div>
                    <div class="info__form" >
                        <div class="info__subtitle">
                            <h3>나의 댓글(<em><?=$blogTotalCount?></em>)</h3>
                            <!-- <span class="empty"></span> -->
                        </div>
                        <div class="mywrite__table">
                            <table>
                                <colgroup>
                                    <col style="width :5%">
                                    <col style="width :43.4%">
                                    <col style="width :24.3%">
                                    <col style="width :24.3%">
                                </colgroup>                               
                                <thead>
                                    <tr>
                                        <th>번호</th>
                                        <th>내용</th>
                                        <th>게시날짜</th>
                                        <th>수정/삭제</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    $viewNum = 11;
    $viewLimit = ($viewNum * $page) - $viewNum; 

    $sql = "SELECT * from blogComment where memberID = '{$memberID}' ORDER BY blogID DESC LIMIT {$viewLimit}, {$viewNum};";
    $result = $connect -> query($sql);
    
    if($result){
        $count = $result -> num_rows;

        if($count > 0){
            for($i=0; $i<$count; $i++){
                $info = $result -> fetch_array(MYSQLI_ASSOC);

                echo "<tr>";
                echo "<td>".$info['commentID']."</td>";
                echo "<td><a href='../shareBoard/shareBoardView.php?blogID={$info['blogID']}'>".$info['commentMsg']."</td>";
                echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                echo "<td><a href='../shareBoard/shareBoardView.php?blogID={$info['blogID']}' class='modifyBtn'>수정</a>/<a href='../shareBoard/shareCommentDel.php?commentID={$info['commentID']}' class='modifyBtn' onclick=\"return confirm('정말 삭제하시겠습니까?')\">삭제</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>댓글이 없습니다.</td></tr>";
        }
    }
?>
                                    <!-- <tr>
                                        <td>9</td>

                                        <td><a href="#">유통기한지나버린 내 화장품들ㅜㅜ</a></td>

                                        <td>2023-05-11</td>

                                        <td>
                                            <a href="#" class="modifyBtn">수정</a> / 
                                            <a href="#" class="removeBtn">삭제</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td><a href="#">여드름에 좋은 기초제품 뭐가있을까요?</a></td>
                                        <td>2023-05-11</td>
                                        <td>
                                            <a href="#" class="modifyBtn">수정</a> / 
                                            <a href="#" class="removeBtn">삭제</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td><a href="#">선크림 선물들어와서 나눔합니다</a></td>
                                        <td>2023-05-11</td>
                                        <td>
                                            <a href="#" class="modifyBtn">수정</a> / 
                                            <a href="#" class="removeBtn">삭제</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td><a href="#">피부트러블에 좋은 음식</a></td>
                                        <td>2023-05-11</td>
                                        <td>
                                            <a href="#" class="modifyBtn">수정</a> / 
                                            <a href="#" class="removeBtn">삭제</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><a href="#">퍼스널컬러 진단 후기</a></td>
                                        <td>2023-05-11</td>
                                        <td>
                                            <a href="#" class="modifyBtn">수정</a> / 
                                            <a href="#" class="removeBtn">삭제</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><a href="#">이 섀딩제품 꼭 써보는거 추천해요</a></td>
                                        <td>2023-05-11</td>
                                        <td>
                                            <a href="#" class="modifyBtn">수정</a> / 
                                            <a href="#" class="removeBtn">삭제</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><a href="#">이 제품 불량인가요?</a></td>
                                        <td>2023-05-11</td>
                                        <td>
                                            <a href="#" class="modifyBtn">수정</a> / 
                                            <a href="#" class="removeBtn">삭제</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><a href="#">ABB마스크팩 써본 사람 있나요?</a></td>
                                        <td>2023-05-11</td>
                                        <td>
                                            <a href="#" class="modifyBtn">수정</a> / 
                                            <a href="#" class="removeBtn">삭제</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><a href="#">화장품 남지않게 다쓰는 꿀팁</a></td>
                                        <td>2023-05-11</td>
                                        <td>
                                            <a href="#" class="modifyBtn">수정</a> / 
                                            <a href="#" class="removeBtn">삭제</a>
                                        </td>
                                    </tr> -->
            
                                </tbody>
                            </table>
                        </div> 
                        <div class="notice__pages mb50">
                            <ul>   
                            <?php
    //게시글 총 갯수

    //총 페이지 갯수
    $blogTotalCount = ceil($blogTotalCount/$viewNum);

    // echo $boardTatalCount;
    //1 2 3 4 5 6 7 8 9 10 11 12 13 ...
    $pageView = 5;
    $startPage = $page - $pageView;
    $endPage = $page + $pageView;

    //처음 페이지 초기화/ 마지막 페이지
    if($startPage < 1) $startPage =1;
    if($endPage >= $blogTotalCount) $endPage = $blogTotalCount;

    // 첫 페이지로 가기/ 이전 페이지로 가기
    if($page !== 1 && $blogTotalCount !=0 && $page <= $blogTotalCount){
        echo "<li><a href='myinfoMyComment.php?page=1'>처음으로</a></li>";
        $prevPage = $page - 1;
        echo "<li><a href='myinfoMyComment.php?page={$prevPage}'>이전</a></li>";
    }

    //페이지
    for($i=$startPage; $i<=$endPage; $i++){
        $active = "";
        if($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='myinfoMyComment.php?page={$i}'>{$i}</a></li>";
    }
    // 마지막 페이지로/ 다음 페이지로
    if($page != $blogTotalCount && $page <= $blogTotalCount){
        $nextPage = $page + 1;
        echo "<li><a href='myinfoMyComment.php?page={$nextPage}'>다음</a></li>";
        echo "<li><a href='myinfoMyComment.php?page={$blogTotalCount}'>마지막으로</a></li>";
    }
?>                     
                                <!-- <li><a href="#">&lt;</a></li>
                                <li class="active"> <a  href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">></a></li> -->
                            </ul>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        function commentDelete(){
            var confirmation = confirm('정말 삭제하시겠습니까?');
            if (!confirmation) {
                alert("삭제안해");
                return false;
            }

        }
        

        
    </script>
</body>
</html> 