<?php
    $passed=$_COOKIE["passed"];
    //若cookie中的變數passed不等於true，表示尚未登入網站，就導向至首頁
    if($passed!="TRUE"){
        header("location:index.html");
        exit();
    }else{
        //否則從資料庫取得會員資料
        require_once("dbtools.inc.php");
        $id=$_COOKIE["id"];
        //建立資料連接
        $link=create_connection();
        //執行SELECT陳述式取得會員資料
        $sql="SELECT * FROM member WHERE id=$id";
        $result= execute_sql($link,"alan",$sql);
        $row=mysqli_fetch_assoc($result);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>修改會員資料</title>
        <script type="text/javascript">
            function check_data(){
                if(document.myForm.password.value.length==0){
                    alert("使用者密碼一定要填寫!!!!");
                    return false;
                }
                if(document.myForm.password.value.length>10){
                    alert("使用者密碼不得超過10個字!!!!");
                    return false;
                }
                if(document.myForm.re_password.value.length==0){
                    alert("密碼確認欄要記得填寫!!!!");
                    return false;
                }
                if(document.myForm.password.value!=document.myForm.re_password.value){
                    alert("使用者密碼與密碼確認欄不同!!!!");
                    return false;
                }
                if(document.myForm.name.value.length==0){
                    alert("要填寫名子!!!!");
                    return false;
                }
                if(document.myForm.year.value.length==0){
                    alert("出生年份!!!!");
                    return false;
                }
                if(document.myForm.year.value>2022){
                    alert("大哥大姊別鬧了,今年才2022");
                    return false;
                }
                if(document.myForm.year.value<1900){
                    alert("大哥大姊別鬧了!!你是我曾曾曾祖父了!");
                    return false;
                }
                if(document.myForm.month.value.length==0){
                    alert("出生月份!!!!");
                    return false;
                }
                if(document.myForm.month.value>12 || document.myForm.month.value<1){
                    alert("出生月份是1-12月之間!!!!");
                    return false;
                }
                if(document.myForm.day.value.length==0){
                    alert("出生日!!!!");
                    return false;
                }
                if(document.myForm.month.value==2 && document.myForm.day.value>29){
                    alert("2月只有28天,最多29天!!!!");
                    return false;
                }
                if(document.myForm.month.value==4 || document.myForm.month.value==6
                || document.myForm.month.value==9|| document.myForm.month.value==11){
                    if(document.myForm.day.value>30){
                        alert("4月,6月,9月,11月只有30天!!!!!");
                        return false;
                    }
                }else{
                    if(document.myForm.day.value>31){
                        alert("1月,3月,5月,7月,8月,10月,12月只有31天!!!!!");
                        return false;
                    }
                }
                if(document.myForm.day.value>31||document.myForm.day.value<1){
                    alert("出生日是1-31號之間!!!!!");
                        return false;
                }
                myForm.submit();
            }
        </script>
        <style>
            body{
                background-image:url(jpg/modify.jpg);
                background-repeat: no-repeat; /*repeat*/
                background-position: center center ;
                background-attachment: fixed; /*scroll*/
                background-size: cover;
            }
        </style>
    </head>
    <body>
        <form name="myForm" method="post" action="update.php">
            <table border="2" align="center" bordercolor="#6666FF">
                <tr>
                    <td colspan="2" bgcolor="#6666FF" align="center">
                        <font #FFFFFF>請填入以下資料<br>"*"請務必填寫</font>
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">*使用者帳號:</td>
                    <td><?php echo $row["account"] ?></td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">*使用者密碼:</td>
                        <td>
                        <input type="password" name="password" size="15"
                        value="<?php echo $row["password"];?>">
                        (請使用英文或數字，請勿使用特殊字元!!)
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">*密碼確認:</td>
                    <td>
                        <input type="password" name="re_password" size="15"
                        value="<?php echo $row["password"];?>">
                        (請再次輸入密碼，並記下自己的帳號密碼!)
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">*名字:</td>
                    <td>
                        <input type="text" name="name" size="8"
                        value="<?php echo $row["name"];?>">
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">*性別:</td>
                    <td>
                        <input type="radio" name="sex"  value="男" checked>男
                        <input type="radio" name="sex"  value="女" >女
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">*生日:</td>
                    <td>西元
                        <input type="text" name="year" size="2"
                        value="<?php echo $row["year"];?>">年
                        <input type="text" name="month" size="2"
                        value="<?php echo $row["month"];?>">月
                        <input type="text" name="day" size="2"
                        value="<?php echo $row["day"];?>">日
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">電話:</td>
                    <td>
                        <input type="text" name="telephone" size="20"
                        value="<?php echo $row["telephone"];?>">
                        (依照(03)444-4444格式!)
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">手機:</td>
                    <td>
                        <input type="text" name="cellphone" size="20"
                        value="<?php echo $row["cellphone"];?>">
                        (依照(09)111-11111格式!)
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">地址:</td>
                    <td>
                        <input type="text" name="address" size="45"
                        value="<?php echo $row["address"];?>">
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">*email帳號:</td>
                    <td>
                        <input type="text" name="email" size="30"
                        value="<?php echo $row["email"];?>">
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">個人網站:</td>
                    <td>
                        <input type="text" name="url" size="40"
                        value="<?php echo $row["url"];?>">
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="right">備註:</td>
                    <td>
                        <textarea type="text" name="comment" rows="4" cols="45"
                        value="<?php echo $row["comment"];?>"></textarea>
                    </td>
                </tr>
                <tr bgcolor="#99FF99">
                    <td align="CENTER" colspan="3">
                        <input type="button" value="修改資料" onClick="check_data()">
                        <input type="reset" value="重新填寫">
                        <a href="main.php"><input type="button" value="回上一頁" ></a>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
    mysqli_free_result($result);
    mysqli_close($link);
?>