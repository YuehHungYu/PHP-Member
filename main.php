<?php
$passed=$_COOKIE["passed"];
//若COOKIE中的變數passed不等於TRUE，表示尚未登入網站，就導向到首頁
if($passed!="TRUE"){
    header("location:index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員管理</title>
    <style>
        body{
            background-image:url(jpg/main.jpg);
            background-repeat: no-repeat; /*repeat*/
            background-position: center center ;
            background-attachment: fixed; /*scroll*/
            background-size: cover;
        }
        p{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>
        <p>
            <a href="modify.php">修改會員資料</a><br>
            <a href="delete.php">刪除會員資料</a><br>
            <a href="logout.php">登出</a>
        </p>
    </h1>
</body>
</html>