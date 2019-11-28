<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=db10";
$pdo=new PDO($dsn,"root","iamdoris19930303");
session_start();

// 查詢及取得特定條件的單筆資料
// select * from table where id=xxx
// select * from table where acc=xxx && pw=yyy
// ...$arg 陣列(可放多個變數)
function find($table,...$arg) {
    global $pdo;
    
    $sql="select * from $table where ";

    if(is_array($arg[0])) {
        
        foreach($arg[0] as $key => $value) {  // ["acc"=>"mack","pw"=>"1234"];
            $tmp[]=sprintf("`%s`='%s'", $key, $value);  // tmp=["`acc`='mack'","`pw`='1234'"]
        }
        
        $sql=$sql . implode(" && ",$tmp);

    }else {

        // 不是陣列的話預設是id
        $sql=$sql . "id='".$arg[0]."'";

    }

    // echo $sql;
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

// 測試
// print_r( find("admin",2) );
// echo "<br>";
// print_r( find("admin",["acc"=>"aaa","pw"=>"123"]) );


// find進階版(可加入限制條件，例如:limit/group by等)
function all($table,...$arg) {
    global $pdo;

    $sql="select * from $table";

    if( !empty($arg[0]) ) {
        foreach($arg[0] as $key => $value) {
            $tmp[]=sprintf("`%s`='%s'", $key, $value);
        }
        $sql=$sql . " where " . implode(" && ",$tmp);
    }

    if( !empty($arg[1]) ) {
        $sql=$sql . $arg[1];
    }

    echo $sql;
    return $pdo->query($sql)->fetchAll();
}

//測試
// echo "<br>查詢整張資料<br>";
// $rows=all("admin");
// print_r($rows);

// echo "<br>查詢整張資料前兩筆<br>";
// $limit=all("admin",[]," limit 2");
// print_r($limit);

// echo "<br>加入條件查詢<br>";
// $limit=all("admin",["acc"=>"aaa","pw"=>"123"]);
// print_r($limit);

// echo "<br>加入限制條件<br>";
// $limit=all("admin",["pw"=>"123"]," limit 1");
// print_r($limit);


// 計算幾筆資料
function nums($table,...$arg) {
    global $pdo;

    $sql="select count(*) from $table";

    if( !empty($arg[0]) ) {
        foreach($arg[0] as $key => $value) {
            $tmp[]=sprintf("`%s`='%s'", $key, $value);
        }
        $sql=$sql . " where " . implode(" && ",$tmp);
    }

    if( !empty($arg[1]) ) {
        $sql=$sql . $arg[1];
    }

    echo $sql;
    // fetchColumn() 選取欄，預設為第一欄
    return $pdo->query($sql)->fetchColumn();
}

//測試
// echo "<br>資料筆筆數<br>";
// echo nums("admin");
// echo "<br>資料筆筆數加條件<br>";
// echo nums("admin",["pw"=>"123"]);


// 以下為自訂function

// 查詢資料 SELECT * FROM table WHERE id=xxx
function q($sql) {
    global $pdo;
    return $pdo->query($sql)->fetchAll();
}

// 刪除資料 DELETE FROM table WHERE id=xxx
function del($table,...$arg) {
    global $pdo;
    $sql="delete from $table where ";
    
    if(is_array($arg[0])){
        foreach($arg[0] as $key => $value){
            $tmp[]=sprintf("`%s`='%s'",$key,$value);
        }
        $sql=$sql . implode(" && ",$tmp);
    }else{
        $sql=$sql . " id='".$arg[0]."'";
    }
    return $pdo->exec($sql); // 如果執行成功$pdo回傳1(如果執行2筆成功會回傳2), 如果失敗$pdo回傳0
}

// echo del("admin",7); //測試


// 導向頁面
function to($path) {
    header("location:".$path);
}

// to("index.php");


// 更新及新增資料
function save($table,$data) {
    global $pdo;

    if(!empty($data['id'])) {
        //更新 UPDATE table SET `acc`='aaa',`pw`='bbb' WHERE id=xxx

        foreach($data as $key => $value) {
            if($key!="id") {
                $tmp[]=sprintf("`%s`='%s'",$key,$value);
            }
        }

        $sql="update $table set ".implode(",",$tmp)." where `id`='".$data['id']."'";
    }else {
        //新增 INSERT INTO table(`acc`,`pw`) VALUES ('acc','pw')
        $keys=array_keys($data);
        $keys_str="`" . implode("`,`",$keys) . "`";
        $value_str="'" . implode("','",$data) . "'";
        
        $sql="insert into $table ($keys_str) values($value_str)";
    }

    return $pdo->exec($sql);
}


?>