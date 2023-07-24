<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    $blogID = $_POST['blogID'];
    $blogTitle = $_POST['blogTitle'];
    $blogContents = $_POST['blogContents'];
    $blogPass = $_POST['blogPass'];
    $blogTitle = $connect -> real_escape_string($blogTitle);
    $blogContents = $connect -> real_escape_string($blogContents);
    $blogPass = $connect -> real_escape_string($blogPass);
    $memberID = $_SESSION['memberID'];
    $sql = "SELECT * FROM members2 WHERE memberID = {$memberID}";
    $result = $connect -> query($sql);
    
    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        if($info['memberID']== $memberID && $info['youPass'] == $blogPass){
            $sql = "UPDATE blog SET blogTitle = '{$blogTitle}', blogContents = '{$blogContents}'WHERE blogID = '{$blogID}'";
            $connect -> query($sql);
        } else {
            echo "<script>alert('비밀번호가 틀렸습니다. 다시한번 확인해주세요!')</script>";
            echo "<script>location.href = 'shareBoardModify.php?blogID=$blogID'</script>";
        }
    }else {
        echo "<script>alert('관리자 에러!!')<script>";
    }
    // $sql = "UPDATE blog SET blogTitle = '{$blogTitle}', blogContents = '{$blogContents}'WHERE blogID = '{$blogID}'";
    // $connect -> query($sql);
    //echo $blogID, $blogTitle, $blogContents;
?>
<script>
    location.href = "shareBoardView.php?blogID=<?=$blogID?>";    
</script>