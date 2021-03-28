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
    $name = $_POST['name'];
    $number = $_POST['number'];
    $dep = $_POST['dep'];
    
    $result = register($name,$number,$dep);

    // print_r($result);
    if($result[0]){
        
        echo json_encode([
            'success'=> true,
            'status'=> 'Register successfully.'
        ]);
        exit;
        
    }else{
        if($result[1]=='duplicated username'){
            echo json_encode([
                'success'=> false,
                'status'=> 'This user has been existed.'
            ]);
            exit;
        }else{
            echo json_encode([
                'success'=> false,
                'status'=> 'Can not register. Please try again.'
            ]);
            exit;
        }
    }
    
    
}catch(\Exception $e){
    echo json_encode([
        'success' => false
    ]);
}

function register($name,$number,$dep){
    $db = mysqli_connect('localhost', 'jy', 'fungjeiui97', 'afternoon_tea');
    if(mysqli_connect_errno()){
        exit;
    }
    
    //檢查使用者是否唯一
    $result = $db->query("select * from member where number = '".$number."'");
    if($result->num_rows>0){
        return [false,'duplicated username'];
    }
    
    // OK -> 放進資料庫
    $result = $db->query("insert into member values(NULL,'".$name."', '".$dep."', '".$number."')");
    //INSERT INTO `member` (`id`, `name`, `dep`, `number`) VALUES (NULL, '方芳', 'F18-MITD', '112022')
    if(!$result){
        return [false,'error'];
    }
    else{
        return [true,'success'];
    }

}
?>