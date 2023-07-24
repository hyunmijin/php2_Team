<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $memberID = $_SESSION['memberID'];
    $file = $_FILES['file'];
    $type = $_FILES['file']['type'];
    $fileSize = $file['size'];

    if($type){
        $fileTypeExtension = explode("/", $type);
        $fileType = $fileTypeExtension[0];  //image
        $fileExtension = $fileTypeExtension[1];  //jpeg , png, gif

        // 이미지 타입 확인
        if($fileType == "image"){
            if($fileExtension == "jpg" || $fileExtension == "jpeg" || $fileExtension == "png" || $fileExtension == "gif"){
                $blogImgDir = "../html/assets/profile/";
                $blogImgName = "profile_"."{$memberID}". "." . "{$fileExtension}";

                echo "이미지 파일이 맞습니다.";
                $sql = "UPDATE members2 SET youImgSrc = '{$blogImgName}', youImgSize = '{$fileSize}' WHERE memberID = '{$memberID}'";
            } else {
                echo "<script>alert('이미지 파일이 아닙니다.')</script>";
            }

        } else {
            echo "<script>alert('이미지 파일이 아닙니다.')</script>";
        }
    } else {
        echo "이미지 파일을 첨부하지 않았습니다.";
    }


    

    // 데이터베이스 업데이트
    
    $result = $connect->query($sql);
    $result = move_uploaded_file($file['tmp_name'], $blogImgDir.$blogImgName);
    $response = array(
        'fileName' => $fileName,
        'fileSize' => $fileSize
    );

    echo json_encode($response);
?>