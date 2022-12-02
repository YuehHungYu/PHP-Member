<?php
require_once("dbtools.inc.php");
header("Content-type:text/html;charset=utf-8");
//取得表單資料
$account=$_POST["account"];
$email=$_POST["email"];
$show_method=$_POST["show_method"];
//建立資料連接
$link=create_connection();
//根據使用者輸入的email和帳號到資料庫查詢會員資料
$sql="SELECT name,password FROM member WHERE account='$account'AND email='$email'";
$result=execute_sql($link,"alan",$sql);
//若會員資料不存在，顯示對話框表示會員資料不存在
if(mysqli_num_rows($result)==0){
    echo "<script type='text/javascript'>;
    alert('查詢資料不存在，請檢查是否有誤!');
    history.back();
    </script>";
}else{
    //否則根據會員選擇的查詢方式，將帳號密碼顯示在網頁上或用email郵寄給會員
    $row=mysqli_fetch_object($result);
    $name=$row->name;
    $password=$row->password;
    $message="
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv='Content-Type',content='text/html',charset=UTF-8>
        <title></title>
    </head>
    <body>
        $name 您好，您的帳號資料如下:<br><br>
        帳號:$account<br>
        密碼:$password<br><br>
        <a href='index.html'>按此登入本網站</a>
    </body>
    </html>";
    //若選擇網頁顯示，就在網頁上顯示帳號密碼
    if($show_method=="網頁顯示"){
        echo $message;
    }else{
        //否則將帳號密碼寄到會員的email信箱，並顯示通知會員
        $subject="=?utf-8?B?".base64_encode("帳號通知")."?=";
        $header="MIME-Version:1.0\r\n\Content-type:text/html;charset=utf-8\r\n";
        mail($email,$subject,$message,$header);
        echo "$name 您好，您的帳號資料已經寄至 $email<br><br> <a href='index.html'>按此登入網站</a>";
    }
}
 //釋放記憶體空間
mysqli_free_result($result);
//關閉資料庫
mysqli_close($link);
?>