<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    
    // include "../connect/joinCheck.php";
    
    // if(!isset($_SESSION['memberID'])){

    //     echo "<script>alert('로그인이 필요한 페이지 입니다.')</script>";
    //     echo "<script>location.href='../login/login.php'</script>";

    //     // Header("Location:../login/login.php");
    // }
    
    $memberID = $_SESSION['memberID'];

    // $nickName = $_SESSION['nickName'];

    $sql = "SELECT * FROM categorie WHERE memberID = '$memberID' ORDER BY productDday ASC";
    $result = $connect -> query($sql);
    $resultInfo = $result -> fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내가 등록한 제품 목록</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <style>
        body {
            font-family: sans-serif;
        }

        #list__wrap {
            width: calc(100% - 30vw);
            margin: 160px auto 100px;
            /* background-color: #fff; */
        }

        .filters-button-group {
            width: 100%;
            display: flex;
            justify-content: space-between;
            /* margin: 0 auto; */
            margin-bottom: 80px;

        }
        
        .filters-button-group img {
            border: 1px solid #F797A2;
            border-radius: 10px;
            background-color: #fff;
            width: 100px;
            height: 100px;
            transition: all 0.2s;
            cursor: pointer;
        }
        .filters-button-group img:hover {
            transform: scale(1.15);
            border: 2px solid #F06171;
        }
        .filters-button-group .active {
            /* border: 3px solid #F06171; */
            box-shadow: 0 0 4px 3px #F797A2;
            border-radius: 15px;
        }
        .button {
            cursor: pointer;
        }
        #sorts {
            /* background-color: #000; */
            height: 100px;
        }
        #sorts button {
            /* display: inline-block; */
            background: none;
            /* margin: 0px 5px 50px 15px; */
            padding: 5px;
            color: #F06171;
            /* border-bottom: 3px solid #F06171; */
            box-shadow: 0 2px 2px -2px #F06171;
            transition: all 0.2s ease;
        }
        #sorts .button.active {
            box-shadow: 0px 5px 5px -5px #F06171;
        }

        /* ---- isotope ---- */

        .grid {
            /* border: 1px solid #333; */
            width: 92%;
            margin: 0 auto;
            /* background-color: #000; */
        }

        /* clear fix */
        .grid:after {
            content: '';
            display: block;
            clear: both;
        }

        /* ---- .element-item ---- */

        .element-item {
            /* position: relative; */
            /* float: left; */
            display: inline-block;
            width: 12vw;
            min-width: 220px;
            height: 330px;
            min-height: 330px;
            margin: 0px 0.35vw 40px 0.35vw;
            /* background-color: rgba(247, 151, 162, 0.07); */
            background-color: #fff;
            border: 1px solid #cacaca;
            
        }

        .element-item > * {
            margin: 0;
            padding: 0;
        }

        /* list */
        .list__img {
            height: 45%;
        }
        .list__img img{
            border-radius: 15px;
            padding: 10px 10px 0px 10px;
        }
        .list__text {
            /* margin-top: 20px; */
            height: 55%;
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            
        }

        #plus {
            background-color: #F797A2;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100%; */
            overflow: hidden;
            
        }
        .plusList {
            display: inline-block;
            text-align: center;
            width: 80px;
            height: 50px;
            line-height: 50px;
            border-radius: 15px;
            color: #fff;
            position: relative;
            font-weight: 700;
            background-color: #F06171;
            padding-right: 6px;
        }
        .plusList:hover {
            background-color: #ed475b;

        }
        .plusList::before {
            position: absolute;
            content: '+';
            top: 0;
            left: 53px;
            font-size: 20px;
            transition: all 0.4s
        }
        .plusList:hover::before {
            transform : rotate(360deg);

        }
        .list__text div .plusList:hover {
            
        }
        .list__text h5 {
            padding-top: 10px;
            width: 100%;
            height: 30%; 
            word-break: keep-all;
        }
        .list__text span {
            width: 100%;
            height: 30%;
            font-size: 30px;
            font-weight: 700;
            color: #F06171;
        }
        .list__text p {
            width: 100%;
            font-size: 15px;
            padding: 5px;
            color: #fff;
            text-align: left;
        }
        .list__bottom {
            background-color: #F797A2;
            width: 100%;
            display: flex;
            
        }
        .date {
            width: 60%;

        }
        .list__active {
            width: 40%;
            text-align: right;
            margin-top: 40px;
            /* background-color: #fff; */
            position: relative;
        }
        
        .list__active a {
            color: #fff;
            padding: 5px;
            transition: all 0.2s;
        }
        
        .list__active a:hover {
            background-color: #F06171;
        }
        .modal__Modify {
            position: fixed;
            width: 500px;
            height: 280px;
            left: 50%;
            top: 50%;
            transform : translate(-50%, -50%);
            border: 1px solid #eeeeee;
            background-color: #fff;
        }
        .modal__close {
            width: 100%;
            height: 50px;
            background-color: #F797A2;
            border-bottom: 1px solid #F797A2;
            display: flex;
            justify-content: right;
            color: #fff;
            align-items: center;
            font-size: 25px;
        }
        .modal__top {
            /* display: block; */
            width: 90%;
            text-align: center;
            margin-left: 50px;
        }
        .modal__btn {
            width: 10%;
            height: 100%;
            background-color: #F797A2;
            color : #fff;
            font-size: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-left: 1px solid #fcbfc6;
        }
        .modal__btn:hover {
            background-color: #eb7684;
        }
        .modal__main {
            display: flex;
            justify-content: space-between;
            padding: 50px 25px 60px 25px;
        }
        .modal__option {
            width: 20%;

        }
        .modal__option select {
            height: 30px;
        }
        .modal__name {
            width: 45%;
            border: 1px solid #666;
            height: 30px;

        }
        #modalName {
            height: 20px;
            padding-left: 10px;
            color: #000;
        }
        
        .modal__date {
            width: 30%;
            height: 30px;
            
        }
        .modal__footer {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        #editModal {
            background-color: #F797A2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal__Plus {
            position: fixed;
            width: 500px;
            height: 280px;
            left: 50%;
            top: 50%;
            transform : translate(-50%, -50%);
            border: 1px solid #eeeeee;
            background-color: #fff;
        }
        .plus__Modal__close {
            width: 100%;
            height: 50px;
            background-color: #F797A2;
            border-bottom: 1px solid #F797A2;
            display: flex;
            justify-content: right;
            color: #fff;
            align-items: center;
            font-size: 25px;
        }
        .plus__Modal__top {
            /* display: block; */
            width: 90%;
            text-align: center;
            margin-left: 50px;
        }
        .plus__Modal__btn {
            width: 10%;
            height: 100%;
            background-color: #F797A2;
            color : #fff;
            font-size: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-left: 1px solid #fcbfc6;
        }
        .plus__Modal__btn:hover {
            background-color: #eb7684;
        }
        .plus__Modal__main {
            display: flex;
            justify-content: space-between;
            padding: 50px 25px 60px 25px;
        }
        .plus__Modal__option {
            width: 20%;

        }
        .plus__Modal__option select {
            height: 30px;
        }
        .plus__Modal__name {
            width: 45%;
            border: 1px solid #666;
            height: 30px;

        }
        #plus__ModalName {
            height: 20px;
            padding-left: 10px;
            color: #000;
        }
        
        .plus__Modal__date {
            width: 30%;
            height: 30px;
            
        }
        .plus__Modal__footer {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }


    </style>
    <!-- CSS -->
    <link rel="stylesheet" href="../html/assets/css/style.css">
    <!-- SCRIPT -->
    <script defer src="../html/assets/js/common.js"></script>
</head>
<body >
    <main id="main" class="mt70">
        <?php include "../include/abbHeader.php" ?>
        <!-- //header -->
        <div class="info__logo">
            <h1>Abide By Beauty</h1>
        </div>
        <!-- //header -->
        
        <div id="list__wrap">
            <div class="button-group filters-button-group">
                <div class="slider__img active" data-filter="*"><img src="../html/assets/img/beauty_icon08.png" data-filter-value=".all" alt="아이콘8"></div>
                <div class="slider__img" data-filter=".lipstick"><img src="../html/assets/img/beauty_icon01.png" data-filter-value=".lipstick" alt="아이콘1"></div>
                <div class="slider__img" data-filter=".shampoo"><img src="../html/assets/img/beauty_icon02.png" data-filter-value=".shampoo" alt="아이콘2"></div>
                <div class="slider__img" data-filter=".sunscreen"><img src="../html/assets/img/beauty_icon03.png" data-filter-value=".sunscreen" alt="아이콘3"></div>
                <div class="slider__img" data-filter=".cleansing"><img src="../html/assets/img/beauty_icon04.png" data-filter-value=".cleansing" alt="아이콘4"></div>
                <div class="slider__img" data-filter=".makeup"><img src="../html/assets/img/beauty_icon05.png" data-filter-value=".makeup" alt="아이콘5"></div>
                <div class="slider__img" data-filter=".mask"><img src="../html/assets/img/beauty_icon06.png" data-filter-value=".mask" alt="아이콘6"></div>
                <div class="slider__img" data-filter=".cream"><img src="../html/assets/img/beauty_icon07.png" data-filter-value=".cream" alt="아이콘7"></div>
            </div>
            <div id="sorts" class="button-group">
                <button class="button" data-sort-by="name">이름순</button>
                <button class="button active" data-sort-by="number">남은시간</button>
                <button class="button" data-sort-by="date">등록일</button>
            </div>
            <div class="grid">

            <?php foreach($result as $categorie){ ?>
                <div class="element-item transition <?=$categorie['productFilter']?>" id="<?=$categorie['productID']?>" data-category="<?=$categorie['productFilter']?>">
                    <div class="list__img">
                        <img src="../html/assets/img/list__<?=$categorie['productFilter']?>.png" alt="<?=$categorie['productType']?>">
                    </div>
                    <div class="list__text">
                        <h5 class="name"><?=$categorie['productName']?></h5>
                        <?php
                            // 1년 후의 날짜 계산
                            $oneYearLater = date('Y-m-d', strtotime('+1 year', strtotime($categorie['productRegist'])));
                            
                            // 현재 날짜
                            $currentDate = date('Y-m-d');
                            
                            // 남은 일 수 계산
                            $interval = date_diff(date_create($currentDate), date_create($oneYearLater));
                            $remainingDays = $interval->format('%r%a');
                        ?>
                        <span class="number"><?=$remainingDays-1?> Day</span>
                        <div class="list__bottom">
                            <div class="date">
                                <p class="regist"><?=$categorie['productRegist']?> ~</p>
                                <?php
                                    // 1년 후의 날짜 계산
                                    $oneYearLater = date('Y-m-d', strtotime('+1 year', strtotime($categorie['productRegist'])));
                                ?>
                                <p class="regist__before"><?=$oneYearLater?></p>
                            </div>
                            <div class="list__active">
                                <a href="#" onclick="modifyItem(<?=$categorie['productID']?>)">수정</a>
                                <a href="#" onclick="deleteItem(<?=$categorie['productID']?>)">삭제</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- 추가 박스 -->
            <div id="editModal" class="element-item lipstick shampoo sunscreen cleansing makeup mask cream" id="plus" data-category="plus">
                    <div>
                        <a href="#" class="plusList" onclick="plusItem()">add</a>
                    </div>
                    <!-- <span class="number"></span> -->
                </div>
            </div>
            <!-- //추가 박스 -->

            <!-- 수정 모달 -->
            <div class="modal__Modify blind">
                <div class="modal__close">
                    <p class="modal__top">수정</p>
                    <a href="#" class="modal__btn">X</a>
                </div>
                <div class="modal__main">
                    <div class="modal__option">
                        <select>
                            <option value="lipstick">립스틱</option>
                            <option value="shampoo">샴푸</option>
                            <option value="sunscreen">선크림</option>
                            <option value="cleansing">클렌징</option>
                            <option value="makeup">메이크업</option>
                            <option value="mask">마스크</option>
                            <option value="cream">크림</option>
                        </select>
                    </div>
                    <div class="modal__name">
                        <input type="text" id="modalName" name="modalName" class="inputStyle" placeholder="제품명" required>
                    </div>
                    <div class="modal__date">
                        <input class="input" type="date" id="modalDate" name="modalDate">
                    </div>
                </div>
                <div class="modal__footer">
                    <a href="#" class="btnStyle4" id="modifyButton">수정완료</a>
                </div>
            </div>
            <!-- //수정 모달 -->

            <!-- 리스트 추가 모달 -->
            <div class="modal__Plus blind">
                <div class="plus__Modal__close">
                    <p class="plus__Modal__top">추가</p>
                    <a href="#" class="plus__Modal__btn">X</a>
                </div>
                <div class="plus__Modal__main">
                    <div class="plus__Modal__option">
                        <select>
                            <option value="lipstick">립스틱</option>
                            <option value="shampoo">샴푸</option>
                            <option value="sunscreen">선크림</option>
                            <option value="cleansing">클렌징</option>
                            <option value="makeup">메이크업</option>
                            <option value="mask">마스크</option>
                            <option value="cream">크림</option>
                        </select>
                    </div>
                    <div class="plus__Modal__name">
                        <input type="text" id="plus__ModalName" name="plus__ModalName" class="inputStyle" placeholder="제품명" required>
                    </div>
                    <div class="plus__Modal__date">
                        <input class="input" type="date" id="plus__ModalDate" name="plus__ModalDate">
                    </div>
                </div>
                <div class="plus__Modal__footer">
                    <a href="#" class="btnStyle4" id="plusButton">추가하기</a>
                </div>
            </div>
            <!-- //리스트 추가 모달 -->
                
            </div>     
        </div>
    </main>
    <!-- //main -->


    <script>
        // 삭제 기능
        function deleteItem(productID) {
            event.preventDefault();
            if (confirm(productID+"정말로 삭제하시겠습니까?")) {
                $.ajax({
                    url: "listDelete.php",  // 삭제 요청을 처리하는 PHP 파일의 경로를 수정해야 합니다.
                    method: "POST",
                    dataType: "json",
                    data: {
                        "productID": productID
                    },
                    success: function(response) {
                        var element = document.getElementById(productID);
                        if (element) {
                            element.parentNode.removeChild(element);
                        }
                        var $grid = $('.grid').isotope({
                            itemSelector: '.element-item',
                            layoutMode: 'fitRows'
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        }

        function modifyItem(productID) {
            event.preventDefault();
            // 수정 클릭시 열기,닫기 토글
            document.querySelector('.modal__Modify').classList.toggle('blind');
            $("#modalName").val('');
            $("#modalDate").val('');

            // 수정모달창 X 누르면 닫기
            $('.modal__btn').off('click').on('click', function() {
                event.preventDefault();
                $("#modalName").val('');
                $("#modalDate").val('');
                $('.modal__Modify').addClass('blind');
            });

            // 수정완료 버튼 클릭 이벤트 처리
            $('#modifyButton').off('click').on('click', function(event) {
                event.preventDefault();
                if ($("#modalName").val() == '' || $("#modalDate").val() == '') {
                    alert("제품명 혹은 달력을 체크해주세요.")
                } else {
                    // 선택한 옵션, 이름, 날짜 값 가져오기
                    var option = $('.modal__option select').val();
                    var name = $('#modalName').val();
                    var date = $('#modalDate').val();

                    // 1년 후의 날짜 계산
                    var oneYearLater = new Date(date);
                    oneYearLater.setFullYear(oneYearLater.getFullYear() + 1);
                    var formattedDate = oneYearLater.toISOString().split('T')[0];

                    // 현재 날짜
                    var currentDate = new Date();
                    var remainingDays = Math.floor((oneYearLater - currentDate) / (1000 * 60 * 60 * 24));

                    // Dday는 date의 1년 더한 날짜에서 현재 날짜까지 남은 일 수
                    var Dday = remainingDays;
                    console.log(option)
                    console.log(name)
                    console.log(date)

                    // AJAX 요청
                    $.ajax({
                        url: "listModify.php", // 수정 요청을 처리하는 PHP 파일의 경로를 수정해야 합니다.
                        method: "POST",
                        dataType: "json",
                        data: {
                            "option": option,
                            "name": name,
                            "date": date,
                            "productID": productID,
                            "Dday": Dday,
                        },
                        success: function(response) {
                            // 데이터 변경된 부분을 페이지에 업데이트
                            var modifiedElement = $("#" + productID); // 수정된 요소의 식별자를 사용하여 해당 요소를 선택
                            modifiedElement.find('.name').text(name); // 제품명 업데이트
                            modifiedElement.find('.element-item').text(option); // 옵션 업데이트
                            modifiedElement.find('.regist').text(date + " ~"); // 등록날짜 업데이트
                            modifiedElement.find('.number').text(Dday+" Day"); // 남은 일수
                            // 1년 후의 날짜 계산
                            var oneYearLater = new Date(date);
                            oneYearLater.setFullYear(oneYearLater.getFullYear() + 1);
                            var formattedDate = oneYearLater.toISOString().split('T')[0];
                            modifiedElement.find('.regist__before').text(formattedDate);
                            modifiedElement.find('.list__img img').attr('src', "../html/assets/img/list__" + option + ".png"); // 사진 업데이트

                            // 요청이 성공적으로 처리되었을 때의 동작
                            var $grid = $('.grid').isotope({
                                itemSelector: '.element-item',
                                layoutMode: 'fitRows'
                            });

                            // 모달 닫기
                            $('.modal__Modify').addClass('blind');
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });
        }

        // 리스트 add 기능
        function plusItem(productID) {
            event.preventDefault();
            // add 클릭시 열기,닫기 토글
            document.querySelector('.modal__Plus').classList.toggle('blind');

            // add모달창 X 누르면 닫기
            $('.plus__Modal__btn').off('click').on('click',function() {
                event.preventDefault();
                $('.modal__Plus').addClass('blind');
            });

            // 추가완료 버튼 클릭 이벤트 처리
            $('#plusButton').off('click').on('click', function(event) {
                event.preventDefault();
                if ($("#plus__ModalName").val() == '' || $("#plus__ModalDate").val() == '') {
                    alert("제품명 혹은 달력을 체크해주세요.");
                } else {
                    // 선택한 옵션, 이름, 날짜 값 가져오기
                    var option = $('.plus__Modal__option select').val();
                    var name = $('#plus__ModalName').val();
                    var date = $('#plus__ModalDate').val();
                    console.log(option)
                    console.log(name)
                    console.log(date)

                    // AJAX 요청
                    $.ajax({
                        url: "listPlus.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "option": option,
                            "name": name,
                            "date": date,
                        },
                        success: function(response) {
                            // 모달 닫기
                            $('.modal__Plus').addClass('blind');

                            
                             // 새로운 데이터의 HTML 요소 생성
                            var newDataHTML = `
                                <div class="element-item transition ${response.data.productFilter}" id="${response.data.productID}" data-category="${response.data.productFilter}">
                                    <div class="list__img">
                                        <img src="../html/assets/img/list__${response.data.productFilter}.png" alt="${response.data.productType}">
                                    </div>
                                    <div class="list__text">
                                        <h5 class="name">${response.data.productName}</h5>
                                        <span class="number">${response.data.productDday} Day</span>
                                        <div class="list__bottom">
                                            <div class="date">
                                                <p class="regist">${response.data.productRegist} ~</p>
                                                <p>2024/03/05</p>
                                            </div>
                                            <div class="list__active">
                                                <a href="#" onclick="modifyItem(${response.data.productID})">수정</a>
                                                <a href="#" onclick="deleteItem(${response.data.productID})">삭제</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            
                            // 새로운 데이터 요소를 페이지에 추가
                            $('.grid').append(newDataHTML);

                            location.reload()
                        },
                        error: function(error) {
                            alert("실패");
                            console.log(error);
                            
                        }
                    });
                }
            });
        }
        
        var $grid = $('.grid').isotope({
            itemSelector: '.element-item',
            layoutMode: 'fitRows',
            getSortData: {
                name: '.name',
                symbol: '.symbol',
                number: '.number parseInt',
                category: '[data-category]',
                date: '.date p parseInt',
            }
        });

        $('#sorts').on('click', 'button', function() {
            var sortByValue = $(this).attr('data-sort-by');
            var sortAscending = true; // 오름차순은 true, 내림차순은 false

            // 현재 정렬 상태 확인
            var currentSortBy = $grid.data('isotope').options.sortBy;
            var currentSortAscending = $grid.data('isotope').options.sortAscending;

            // 현재 정렬 상태와 클릭한 버튼의 정렬 속성이 같으면서 오름차순일 때 내림차순으로 변경
            if (currentSortBy === sortByValue && currentSortAscending) {
                sortAscending = false;
            }

            $grid.isotope({ 
                sortBy: sortByValue, 
                sortAscending: sortAscending 
            });
        });

        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.element-item',
            layoutMode: 'fitRows'
        });
        // filter functions
        var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function() {
            var number = $(this).find('.number').text();
            return parseInt( number, 10 ) > 50;
        },
        // show if name ends with -ium
        ium: function() {
            var name = $(this).find('.name').text();
            return name.match( /ium$/ );
        }
        };
        
        // bind filter button click
        $('.filters-button-group').on( 'click', 'div', function() {
            var filterValue = $( this ).attr('data-filter');
            // use filterFn if matches value
            filterValue = filterFns[ filterValue ] || filterValue;
            $grid.isotope({ filter: filterValue });
        });
        
        // change is-checked class on buttons
        $('.button-group').each( function( i, buttonGroup ) {
            var $buttonGroup = $( buttonGroup );
            $buttonGroup.on( 'click', 'button, div',   function() {
                $buttonGroup.find('.active').removeClass('active');
                $( this ).addClass('active');
            });
        });
        
        
    </script>
</body>
</html>