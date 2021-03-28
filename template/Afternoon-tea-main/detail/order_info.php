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
    $store = $_POST['store'];
    $type = $_POST['type'];
    $member = $_POST['member'];
    $food_name = $_POST['food_name'];
    $drink_name = $_POST['drink_name'];
    $size = $_POST['size'];
    $ice = $_POST['ice'];
    $sugar = $_POST['sugar'];
    $price = intval($_POST['price']);
    $memo = $_POST['memo'];
    $date = $_POST['date'];
    $order_type = $_POST['orderType'];
    $order_id = $_POST['order_id'];

    // if(!is_int($price)){
    //     $msg = "wrong price input: ".$price;
    //     echo json_encode([
    //         'success' => false,
    //         'data' => $msg
    //     ]);
    //     exit;
    // }
    

    if($order_type=="first"){
        $sql = "insert into order_info values(NULL,'".$id."','".$store."','".$type."','".$member."','".$food_name."','".$drink_name."','".$size."','".$ice."','".$sugar."',".$price.",'".$memo."','".$date."')";
        // $result = $db->query("insert into member values(NULL,'".$name."', '".$dep."', '".$number."')");
        $stmt = mysqli_prepare($db, $sql);
        $success = $stmt->execute();
        $stmt->close();
    }
    else{
        $sql = "update order_info set name='".$member."',food_name='".$food_name."',drink_name='".$drink_name."',drink_size='".$size."',drink_ice='".$ice."',drink_sugar='".$sugar."',price=".$price.",memo='".$memo."' where id='".$order_id."'";
        $stmt = mysqli_prepare($db, $sql);
        $success = $stmt->execute();
        $stmt->close();
    }
    

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