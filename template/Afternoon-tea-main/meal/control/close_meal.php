<?php
session_start();
ob_start();
header("Content-type: application/json");
date_default_timezone_set('UTC');


//連接資料庫
$db = mysqli_connect('localhost', 'jy', 'fungjeiui97', 'afternoon_tea');
if(mysqli_connect_errno()){
    print_r("N");
    exit;
}

mysqli_set_charset($db,"utf8");

try{

    // 接收前端傳來的 variable
    $id = $_POST['id'];

    $sql = "update meal_info set status='close' where id='".$id."'";
    // $result = $db->query("insert into member values(NULL,'".$name."', '".$dep."', '".$number."')");
    $stmt = mysqli_prepare($db, $sql);
    $success = $stmt->execute();
    $stmt->close();
   

    echo json_encode([
        'success' => $success,
        'data' => $sql
    ]);
    exit;

}catch(\Exception $e){
    echo json_encode([
        'success' => false
    ]);
}

?>