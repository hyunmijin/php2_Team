<?php
    include "../../connect/connect.php";
    $nickName = $_POST["memberID"];
    // $youName = $_POST["youName"];
    // $youPass = $_POST["youPass"];
    // $youPassC = $_POST["youPassC"];
    // $youPhone = $_POST["youPhone"];
    // $regTime = time();
    
    
        $sql = "SELECT memberID FROM members2 WHERE memberID = '$memberID'";
        // echo $sql;
        $result = $connect -> query($sql);
        if($result){
            $count = $result -> num_rows;
            if($count==1){
                echo ("사용중인 아이디 입니다.");
            }else{
                echo ("사용가능한 아이디 입니다.");
            }
        }else{
            msg("에러발생1111");
        }
    
?> 
<script>
    console.log(<?= $count ?>)
</script>
