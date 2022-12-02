<?php
function create_connection(){
    $link = mysqli_connect("主機位置", "資料庫帳號", "資料庫密碼")
    or die("無法建立資料連接: " . mysqli_connect_error());
    mysqli_query($link, "SET NAMES utf8");
    return $link;
}
/*定義 create_connection() 函式，用來建立資料連接，第 05 行可
以解決資料庫中文亂碼問題。*/

function execute_sql($link, $database, $sql){
    mysqli_select_db($link, $database)
    or die("開啟資料庫失敗: " . mysqli_error($link));
    $result = mysqli_query($link, $sql);
    return $result;
}
/*定義 execute_sql() 函式，用來執行指定的 SQL 查詢，此函式包
含 3 個參數，link 用來指定欲使用的資料連接，database 用來指定資料庫
名稱，sql 用來指定欲執行的 SQL 查詢。舉例來說，假設您要對 prodcut
資料庫的 price 資料表執行「SELECT * FROM price WHERE category =
'主機板'」查詢，可以寫成如下：
execute_sql($link, "prodcut", " SELECT * FROM price WHERE category = '主機板'");*/
?>