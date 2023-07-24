<?php
include "../connect/connect.php";

for ($i = 1; $i < 200; $i++) {
    $regTime = time();
    $sql = "insert into board(memberID, boardTitle, boardContents, boardView, regtime) values ( 1, '게시판타이틀입니다${i}' ,'게시판내용입니다.게시판내용입니다.게시판내용입니다.게시판내용입니다.게시판내용입니다.${i}', '1',  ${regTime} )";
    $connect -> query($sql);
}
