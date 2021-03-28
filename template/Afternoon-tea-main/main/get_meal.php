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

    $today = $_POST['today'];
    
    $result = $db->query("select id, store, type, date, memo from meal_info ");
    $today_meal = $db->query("select id, store, type, date, memo, status from meal_info where date='".$today."' and status='open' ");
    
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //print_r($row['name']);
            $id = urlencode($row['id']);
            $store = urlencode($row['store']);
            $type = urlencode($row['type']);
            $memo = urlencode($row['memo']);
            $new = array('id'=>$id, 'store'=>$store,'type'=>$type, 'memo'=> $memo );
            array_push($data,$new);   
        }
    } 
    $data2 = [];
    if ($today_meal->num_rows > 0) {
        while ($row = $today_meal->fetch_assoc()) {
            //print_r($row['name']);

            $id = urlencode($row['id']);
            $store = urlencode($row['store']);
            $type = urlencode($row['type']);
            $memo = urlencode($row['memo']);
            $date = urlencode($row['date']);
            // picture
            $new = array('id'=>$id, 'store'=>$store,'type'=>$type, 'memo'=>$memo, 'date'=> $date);
            array_push($data2,$new);   
        }
    } 


    echo urldecode(json_encode([
        'success' => true,
        'data'=> $data,
        'today_meal'=>$data2
    ]));
    exit;


    // else {
    //     echo json_encode([
    //         'success' => false
    //     ]);
    //     exit;
    // }
    
    
}catch(\Exception $e){
    echo json_encode([
        'success' => false
    ]);
}
?>