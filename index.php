<?php
    $imageDirectory = './images';  //路径 var/www/html 相对路径
    if (!is_readable($imageDirectory)) {
        die('目录不可读!');
    }
    // 获取目录中所有图片的文件名
    $images = scandir($imageDirectory);
    $images = array_filter($images, function($image) {
        return pathinfo($image, PATHINFO_EXTENSION) === 'jpg' ||
            pathinfo($image, PATHINFO_EXTENSION) === 'jpeg' ||
            pathinfo($image, PATHINFO_EXTENSION) === 'png';
    });
    // 如果没有图片，则返回错误
    if (empty($images)) {
        echo $imageDirectory;
        die(' 目录中没有图片文件。');
    }
    // 随机选择一张图片
    $imageToDisplay =$images[array_rand($images)];
    $imagePath = $imageDirectory . DIRECTORY_SEPARATOR .$imageToDisplay;
    // 确保图片文件存在
    if (!file_exists($imagePath)) {
        die('随机选择的图片文件不存在。');
    }
    $filename = basename($file);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));
    switch( $file_extension ) {
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpeg"; break;
        case "svg": $ctype="image/svg+xml"; break;
        default:
    }
    header('Content-type: ' . $ctype);
    echo file_get_contents($imagePath);
    exit;
?>
