
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
    $store = $_POST['store'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $memo = $_POST['memo'];
    $status = $_POST['status'];

    // 店家是否重複？
    $result = $db->query("select * from meal_info where store = '".$store."'");
    
    $data = [];
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()) {

            $id = urlencode($row['id']);
            $store = urlencode($row['store']);
            $type = urlencode($row['type']);
            $memo = urlencode($row['memo']);

            $new = array('id'=>$id,'type'=>$type,'store'=>$store,'memo'=>$memo);
            array_push($data,$new);    
        }
        echo urldecode(json_encode([
            'success' => false,
            'status' => '此店家已存在，是否修改店家資訊？',
            'data' => $data
        ]));
        exit;
    }

    // print_r($store,$date,$type,$imagestring);
    // 解析 DataURL
    $token = explode(',', $imagestring);
    // 取出圖片的資料並將 base64 還原成二進位格式
    $image = base64_decode($token[1]);
    // print_r($image);
    // // 以下為 PHP 將 Blob 放入Mysql的方法
    $null = NULL;
    if($status=='close'){
        $sql = "insert into meal_info(image,date,type,store,memo) values(?,'".$date."','".$type."','".$store."','".$memo."')";
    }else{
        $sql = "insert into meal_info(image,date,type,store,memo,status,order_count) values(?,'".$date."','".$type."','".$store."','".$memo."','open',1)";
    }
    // $result = $db->query("insert into member values(NULL,'".$name."', '".$dep."', '".$number."')");
    $stmt = mysqli_prepare($db, $sql);
    $stmt->bind_param('b', $null);
    $stmt->send_long_data(0, $image);
    $success = $stmt->execute();
    $stmt->close();


    echo json_encode([
        'success' => $success,
        'data' => $store
    ]);
    exit;

}catch(\Exception $e){
    echo json_encode([
        'success' => false
    ]);
}

?>