
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

    // 接收前端傳來的 DataURL 字串
    $imagestring = trim($_POST["imagestring"]);
    $id = $_POST['id'];
    $store = $_POST['store'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $memo = $_POST['memo'];
    $status = $_POST['status'];


    // 只更新 儲存並關閉

    if($imagestring==""){
        if($status=="close"){
            $sql = "update meal_info set store='".$store."', date='".$date."', type='".$type."', memo='".$memo."',status='".$status."' where id= '".$id."'";

        }else{
            $sql = "update meal_info set store='".$store."', date='".$date."', type='".$type."', memo='".$memo."',status='".$status."', order_count = order_count + 1 where id= '".$id."'";

        }
        $stmt = mysqli_prepare($db, $sql);
        $success = $stmt->execute();
        $stmt->close();

    }else{
        $token = explode(',', $imagestring);
        $image = base64_decode($token[1]);
        $null = NULL;
        if($status=="close"){
            $sql = "update meal_info set image=?,store='".$store."', date='".$date."', type='".$type."', memo='".$memo."',status='".$status."' where id= '".$id."'";
        }else{
            $sql = "update meal_info set image=?,store='".$store."', date='".$date."', type='".$type."', memo='".$memo."',status='".$status."', order_count = order_count + 1 where id= '".$id."'";
        }
        $stmt = mysqli_prepare($db, $sql);
        $stmt->bind_param('b', $null);
        $stmt->send_long_data(0, $image);
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