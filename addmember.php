<?php
require_once("dbtools.inc.php");
//取得表單資料
$account=$_POST["account"];
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
//將使用者帳號(account)與資料庫的account欄位做比對
$sql="SELECT * FROM member WHERE account='$account'";
$result=execute_sql($link,"alan",$sql);

//若該帳號有人使用，就顯示訊息要求更換帳號並返回上一頁
if(mysqli_num_rows($result)!=0){
    //釋放記憶體空間
    mysqli_free_result($result);

    echo "<script type='text/javascript'>";
    echo"alert('您輸入的帳號已經有人使用，請使用其他帳號');";
    echo"history.back()";
    echo"</script>";
}
//否則資料寫入資料庫中
else{ 
    //釋放記憶體空間
    mysqli_free_result($result);

    //將會員資料寫入資料庫中
    $sql="INSERT INTO member (account,password,
    name,sex,year,month,day,telephone,cellphone,
    address,email,url,comment) VALUES('$account',
    '$password','$name','$sex','$year','$month',
    '$day','$telephone','$cellphone','$address',
    '$email','$url','$comment')";
    $result=execute_sql($link,"alan",$sql);
}
//關閉資料庫
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增帳號成功</title>
    <style>
        body{
            background-image:url(jpg/success.jpg);
            background-repeat: no-repeat; /*repeat*/
            background-position: center center ;
            background-attachment: fixed; /*scroll*/
            background-size: cover;
        }
        h1{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>
        恭喜你註冊成功，您的資料如下:(請勿按重新整理)<br>
        帳號:<font color="#FF0000"><?php echo $account ?></font><br>
        密碼:<font color="#FF0000"><?php echo $password ?></font><br>
        請記下你的帳號密碼，然後<a href="index.html">登入網頁</a>
    </h1>
</body>
</html>