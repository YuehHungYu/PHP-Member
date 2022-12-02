<?php
    $passed=$_COOKIE["passed"];
    //若cookie中的變數passed不等於true，表示尚未登入網站，就導向至首頁
    if($passed!="TRUE"){
        header("location:index.html");
        exit();
    }else{
        //否則刪除會員資料
        require_once("dbtools.inc.php");
        $id=$_COOKIE["id"];
        //建立資料連接
        $link=create_connection();
        //執行SELECT陳述式取得會員資料
        $sql="DELETE FROM member WHERE id=$id";
        $result= execute_sql($link,"alan",$sql);
        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>刪除會員成功</title>
        <style>
            body{
                background-image:url(jpg/delete.jpg);
                background-repeat: no-repeat; /*repeat*/
                background-position: center center ;
                background-attachment: fixed; /*scroll*/
                background-size: cover;
            }
            h1,p{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>您的資料已經刪除<br>若要再使用本網頁服務<br>請重新申請謝謝!<br></h1>
        <p><a href="index.html">回首頁</a></p>
    </body>
</html>