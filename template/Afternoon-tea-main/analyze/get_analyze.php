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
    
    $store = $_POST['store'];

    $type_result = $db->query("select distinct type from order_info where store = '".$store."' ");
    if ($type_result->num_rows > 0) {
        while ($row = $type_result->fetch_assoc()) {
            $type = $row['type'];
        }
    }
    
    if($type=="食物"){
        $sql = "select store, food_name, count(*) from order_info where store ='".$store."' group by food_name order by count(*) desc";
        $result = $db->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //print_r($row['name']);
                $store = urlencode($row['store']);
                $food = urlencode($row['food_name']);
                $count = urlencode($row['count(*)']);
                $new = array('store'=>$store,'item'=>$food,'count'=>$count);
                array_push($data,$new);
            
            }
            echo urldecode(json_encode([
                'success' => true,
                'data'=> $data,
            ]));
            exit;
        } else {
            echo json_encode([
                'success' => false,
                'data' => $sql
            ]);
            exit;
        }
    }
    else{
        // $sql = "select distinct drink_name from order_info where type='".$type."' and store='".$store."'";
        // $sql = "SELECT store, drink_name,count(*) from order_info where store = '".$store."' GROUP by drink_name";
        $sql = "select store, drink_name, count(*) from order_info where store ='".$store."' group by drink_name order by count(*) desc";
        $result = $db->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //print_r($row['name']);
                $store = urlencode($row['store']);
                $drink = urlencode($row['drink_name']);
                $count = urlencode($row['count(*)']);
                $new = array('store'=>$store,'item'=>$drink,'count'=>$count);
                array_push($data,$new);
            
            }
            echo urldecode(json_encode([
                'success' => true,
                'data'=> $data,
            ]));
            exit;
        } else {
            echo json_encode([
                'success' => false,
                'data' => $sql
            ]);
            exit;
        }
    }
    
    
    
}catch(\Exception $e){
    echo json_encode([
        'success' => false
    ]);
}
?>