<?php
    $passed=$_COOKIE["passed"];
    //若cookie中的變數passed不等於true，表示尚未登入網站，就導向至首頁
    if($passed!="TRUE"){
        header("location:index.html");
        exit();
    }else{
        require_once("dbtools.inc.php");
        //取得modify.php傳出來的資料
        $id=$_COOKIE["id"];
        $password=$_POST["password"];
        $name=$_POST["name"];
        $sex=$_POST["sex"];
        $year=$_POST["year"];
        $month=$_POST["month"];
        $day=$_POST["day"];
        $telephone=$_POST["telephone"];
        $cellphone=$_POST["cellphone"];
        $address=$_POST["address"];
        $email=$_POST["email"];
        $url=$_POST["url"];
        $comment=$_POST["comment"];
        //建立資料連接
        $link=create_connection();
        //執行UPDATE陳述式來更新會員資料
        $sql="UPDATE member SET password='$password',name='$name',
        sex='$sex',year='$year',month='$month',day='$day',
        telephone='$telephone',cellphone='$cellphone',
        address='$address',email='$email',url='$url',
        comment='$comment'WHERE id=$id";
        $result=execute_sql($link,"alan",$sql);
        //關閉資料庫
        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>修改會員成功</title>
        <style>
        body{
            background-image:url(jpg/update.jpg);
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
            <p><?php echo $name ?>恭喜修改成功!!</p>
            <p><a href="main.php">回會員專屬網頁!!</a></p>
        </h1>
    </body>
</html>