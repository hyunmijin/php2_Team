<?php
    include "../../connect/connect.php";
    $nickName = $_POST["nickName"];
    // $youName = $_POST["youName"];
    // $youPass = $_POST["youPass"];
    // $youPassC = $_POST["youPassC"];
    // $youPhone = $_POST["youPhone"];
    // $regTime = time();
    
    
        $sql = "SELECT nickName FROM members2 WHERE nickName = '$nickName'";
        // echo $sql;
        $result = $connect -> query($sql);
        if($result){
            $count = $result -> num_rows;
            if($count==1){
                echo ("false");
            }else{
                echo ("true");
            }
        }else{
            msg("에러발생1111");
        }
    
?> 
<script>
    console.log(<?= $count ?>)
</script>
