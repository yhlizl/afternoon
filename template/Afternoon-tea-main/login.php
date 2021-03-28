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
    
    $result = $db->query("select * from member where number = '".$number."'");
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //print_r($row['name']);
            $name = urlencode($row['name']);

            echo urldecode(json_encode([
                'success' => true,
                'name'=> $name,
            ]));
            exit;
        }
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