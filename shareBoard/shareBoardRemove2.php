<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $blogID = $_GET['blogID'];
    $blogID = $connect -> real_escape_string($blogID);

    $sql = "DELETE FROM blog WHERE blogId = {$blogID}";
    $connect -> query($sql);
?>

<script>
    location.href = "../myinfo/myinfoMywrite.php";
</script>
