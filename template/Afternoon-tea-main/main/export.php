<?php

session_start();
ob_start();

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


$sql = "select * from order_info where store_id='".$id."' and store='".$store."' and type='".$type."' and date='".$date."'";
$result = mysqli_query($db, $sql);
$output = '';

if(mysqli_num_rows($result) > 0)
{
    $output .= '<table class="table" bordered="1">
    <tr>
    <th>store</th>
    <th>name</th>
    <th>food_name</th>
    <th>price</th>
    <th>memo</th>
    </tr>
    ';
//Store table records into an array
while($row = mysqli_fetch_array($result)){
    $output .= '<tr>
    <td>'.$row["store"].'</td>
    <td>'.$row["name"].'</td>
    <td>'.$row["food_name"].'</td>  
    <td>'.$row["price"].'</td>  
    <td>'.$row["memo"].'</td>
    </tr>
    ';
  }
}
$output .= '</table>';
//header('Content-Type: application/xls');
//   header('Content-Disposition: attachment; filename=download.xls');
    downloadxls($output);
    die();

function downloadxls($output){
    $filename="test.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-disposition: filename=".date("Y-m-d")."".$filename);
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    echo $output;
}




// echo urldecode(json_encode([
//     'success' => true
// ]));


exit;




// $fileName = "order-".$store."-".date('d-m-Y').".xls";

// //Set header information to export data in excel format
// header('Content-Type: application/vnd.ms-excel');
// header('Content-Disposition: attachment; filename='.$fileName);

// //Set variable to false for heading
// $heading = false;

// //Add the MySQL table data to excel file
// if(!empty($items)) {
// foreach($items as $item) {
// if(!$heading) {
// echo implode("\t", array_keys($item)) . "\n";
// $heading = true;
// }
// echo implode("\t", array_values($item)) . "\n";
// }
// }


?>