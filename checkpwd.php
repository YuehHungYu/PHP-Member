<?php
require_once("dbtools.inc.php");
header("Content-type:text/html;charset=utf-8");

//取得表單資料
$account= $_POST["account"];
$password=$_POST["password"];
//建立資料連接
$link=create_connection();
//將帳號與密碼與資料庫做比對
$sql="SELECT * FROM  member WHERE account='$account' AND password='$password'";
$result= execute_sql($link,"alan",$sql);
//若帳號密碼有誤，顯示對話框要求查明後再登入
if(mysqli_num_rows($result)==0){
    //釋放記憶體空間
    mysqli_free_result($result);
    //關閉資料連接
    mysqli_close($link);
    echo "<script type='text/javascript'>";
    echo"alert('帳號密碼錯誤，請查明後再登入');";
    echo"history.back()";
    echo"</script>";
}
//否則將資料寫入COOKIE，然後導向到會員專區網頁
else{ 
    //取得ID欄位
    $id=mysqli_fetch_object($result)->id;

    //釋放記憶體空間
    mysqli_free_result($result);
    //關閉資料連接
    mysqli_close($link);

    //將資料寫入COOKIE，然後導向到會員專區網頁
    setcookie("id",$id);
    setcookie("passed","TRUE");
    header("location:main.php");
}
?>
