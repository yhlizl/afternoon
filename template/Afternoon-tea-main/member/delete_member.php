<?php

session_start();
ob_start();
header("Content-type: application/json");
date_default_timezone_set('UTC');

//連接資料庫
$db = mysqli_connect('localhost', 'jy', 'fungjeiui97', 'afternoon_tea');
if(mysqli_connect_errno()){
    exit;
}

try{

    $number = $_POST['number'];

    $sql = "delete from member where number='".$number."' ";
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