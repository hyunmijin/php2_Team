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
    <title>FAQ</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
</head>
<body class="pink">
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
            <div><a href="../notice/boardNotice.php">공지사항</a></div> <!-- notice-->
            <div class="active"><a href="../FAQ/FAQ.php">FAQ</a></div> <!-- faq-->
        </div>
        <!-- board__header -->
      
        <div class="faq__inner">
            <h2>FAQ</h2>
            <div class="faq__form">
                <div>
                    <h3>이 사이트는 뭐하는 곳인가요?</h3>
                    <ul>
                        <li>유통 기한은 제조일로부터 일정 기간이 경과한 후에 화장품의 효능과 안전성이 보장되지 않을 수 있음을 나타내는 지표입니다.<br>
                        저희 ABB 사이트는 고객님께서 사이트에 화장품 유통기한을 등록하면 유통 기한에 대한 알림 서비스 사이트 입니다.<br>
                        화장품의 유통 기한은 제품의 품질과 안전성을 보장하기 위해 중요한 요소이므로, 만료일을 확인하고 사용하는 것이 좋습니다.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="faq__form">
                <div>
                    <h3>제 화장품의 남은 유통 기한을 알고 싶어요!</h3>
                    <ul>
                        <li>화장품을 구입한 상점이나 제조사의 고객 서비스에 문의하면 구체적인 제품의 유통 기한을 알 수 있습니다.<br>
                         또한, 일부 제품은 제조일자 또는 유통 기한을 나타내는 심볼이 포함된 바코드를 스캔하여 유통 기한 정보를 확인할 수 있는 스마트폰 애플리케이션도 있습니다.</li>
                    </ul>
                </div>
            </div>
            <div class="faq__form">
                <div>
                    <h3>이 사이트의 유통 기한은 정확한가요?</h3>
                    <ul>
                        <li>유통 기한을 표기하는 방법에 대한 설명. 예를 들어, 제조일자, 유통 기한 만료일, 개봉 후 사용 기한 등이 포함될 수 있습니다.<br>
                        제품에 따라 유통 기한이 다르며 ABB사이트는 해당 종류 화장품에 대한 일반적인 개봉 후 사용 기한을 카운트 하고 있습니다.
                    </li>
                    </ul>
                </div>
            </div>
            <div class="faq__form">
                <div>
                    <h3>화장품의 남은 유통 기한을 알고 싶어요!</h3>
                    <ul>
                        <li> 음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을
                            대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건
                            말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!</li>
                    </ul>
                </div>
            </div>
            <div class="faq__form">
                <div>
                    <h3>화장품의 남은 유통 기한을 알고 싶어요!</h3>
                    <ul>
                        <li> 음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을
                            대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건
                            말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서
                            유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!</li>
                    </ul>
                </div>
            </div>
            <div class="faq__form">
                <div>
                    <h3>화장품의 남은 유통 기한을 알고 싶어요!</h3>
                    <ul>
                        <li> 음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을
                            대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건
                            말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!</li>
                    </ul>
                </div>
            </div>
            <div class="faq__form">
                <div>
                    <h3>화장품의 남은 유통 기한을 알고 싶어요!</h3>
                    <ul>
                        <li> 음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을
                            대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건
                            말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서
                            유통 기한을 잘~ 써보세용!!!음.. 이건 말이죵? 혹시 화장품의 구매영수증이나 기억을 대략 잘 하셔서 유통 기한을 잘~ 써보세용!!!</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

<?php include "../include/footer.php" ?>

<script>
        const faqForm = document.querySelectorAll(".faq__form h3");
        const faqUl = document.querySelectorAll(".faq__form ul li");

        faqForm.forEach((e, i) => {
            e.addEventListener("click", c => {
                faqUl.forEach(f => {
                    const open = faqUl[i].classList.contains("open");
                    open ? faqUl[i].classList.remove("open") : faqUl[i].classList.add("open");
                })
            })
        })
    </script>
    
</body>
</html> 