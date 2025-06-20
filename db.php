<?php
$dsn = "mysql:host=localhost;dbname=habit_tracker_db;charset:utf8;";
$pdo = new PDO($dsn, 'root', '');

// $tmpText = [
//     'id'=>0,
//     'name'=>"bob",
//     'tel'=>'123'
// ];

// 印出array 
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
// dd($tmpText);

// array to string
// $array: 欲轉換的條件或資料陣列 (array)
// 回傳: 轉換成SQL語法片段的陣列 (array)
function array2sql($array)
{
    $tmp = [];
    foreach ($array as $key => $value) {
        $tmp[] = "`$key`='$value'";
    }
    return $tmp;
}

/*
q($sql)
$sql: 欲執行的SQL語法 (string)
回傳: 查詢結果的關聯式陣列
*/
function q($sql)
{
    $dsn = "mysql:host=localhost;dbname=habit_tracker_db;charset:utf8;";
    $pdo = new PDO($dsn, 'root', '');

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

/*
all($table, $array = null, $str = null)
$table: 資料表名稱 (string)
$array: 條件陣列 (array|null)，可選，若為陣列則產生 WHERE 條件
$str: 其他SQL語法 (string|null)，可選，附加在SQL語句後
回傳: 查詢結果的關聯式陣列

口訣: 開表選全，陣化條件，續接神句，接q成陣
*/

function all($table, $array=null, $str=null) {
    $sql = "SELECT * FROM $table";
    // 先判斷是不是array
    if(is_array($array)){
        $tmp=array2sql($array);
        $sql = $sql . " WHERE ". join(" AND ", $tmp);
    } else {
        $sql .= $array;
    }

    $sql .= $str;
    // echo $sql;
    $rows = q($sql);
    return $rows;
}
