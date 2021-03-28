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
    
    $result = $db->query("select * from member ");
    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //print_r($row['name']);
            $name = urlencode($row['name']);
            $dep = urlencode($row['dep']);
            $num = urlencode($row['number']);
            $new = array('name'=>$name,'dep'=>$dep,'number'=>$num);
            array_push($data,$new);
            
        }
        echo urldecode(json_encode([
            'success' => true,
            'data'=> $data,
        ]));
        exit;
    } else {
        echo json_encode([
            'success' => false
        ]);
        exit;
    }
    
    
}catch(\Exception $e){
    echo json_encode([
        'success' => false
    ]);
}
?>