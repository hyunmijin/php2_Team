<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youEmail = $_POST['youEmail'];
    $youPass = $_POST['youPass'];

    echo $youEmail, $youPass;
    echo $youEmail, $youPass;
    echo $youEmail, $youPass;
    echo $youEmail, $youPass;
    
    // 데이터 출력
    
    
    $sql = "update members2 set youPass = '{$youPass}' where youEmail = '{$youEmail}'";
        
    $connect ->query($sql);
    
    // if($result){
    //     $count  = $result -> num_rows;
    //     if($count ==0){
    //     // echo "<script>alert('잘못된경로로 접근하셨습니다.');window.history.back();</script>";
    //     }else{
    //         $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
    //     }
    // }
?>
<script>
    location.href="../login/login.php";
</script>