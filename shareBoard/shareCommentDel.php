<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $commentID = $_GET['commentID'];
    $commentID = $connect -> real_escape_string($commentID);

    $sql = "DELETE FROM blogcomment  WHERE commentID = {$commentID}";
    $connect -> query($sql);
?>

<script>
    location.href = "../myinfo/myinfoMyComment.php";
</script>
