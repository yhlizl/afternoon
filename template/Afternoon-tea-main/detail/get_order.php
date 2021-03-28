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

// order list
$id = $_POST['id'];
$store = $_POST['store'];
$type = $_POST['type'];
$date = $_POST['date'];

    // $sql = "select name,food_name,drink_name,drink_size from order_info where store_id = ".$id." and store='".$store."' and type='".$type."' and date='".$date."'";
    $result = $db->query("select * from order_info where store_id = ".$id." and store='".$store."' and type='".$type."' and date='".$date."' order by food_name,drink_name");
    $data = [];
    if($type=="食物"){
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //print_r($row['name']);
                $id_ = urlencode($row['id']);
                $name = urlencode($row['name']);
                $food_name = urlencode($row['food_name']);
                $price = urlencode($row['price']);
                $memo = urlencode($row['memo']);
                // $test = urlencode($row['drink_name'].','.$row['drink_ice']);
                // $test = urlencode('青茶'.','.'M'.','.'去冰'.'半糖');
                // $drink_name = urlencode($row['drink_name']);
                // $drink_size = urlencode($row['drink_size']);
                $new = array('order_id'=>$id_,'type'=>$type, 'name'=>$name,'food'=>$food_name,'price'=>$price,'memo'=>$memo);
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
                'data'=> $sql
            ]);
            exit;
        }
    }
    if($type=="飲料"){
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //print_r($row['name']);
                $id_ = urlencode($row['id']);
                $name = urlencode($row['name']);
                $food_name = urlencode($row['drink_name']);
                $sugar_ice = urlencode($row['drink_size'].','.$row['drink_ice'].','.$row['drink_sugar']);
                $price = urlencode($row['price']);
                $memo = urlencode($row['memo']);
                $new = array('order_id'=>$id_,'type'=>$type, 'name'=>$name,'food'=>$food_name,'sugar_ice'=>$sugar_ice,'price'=>$price,'memo'=>$memo);
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
                'data'=> $sql
            ]);
            exit;
        }
    }
    
?>