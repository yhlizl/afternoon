

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>下午茶系統</title>
  <link rel="stylesheet" href="./analyze.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>


<?php

// header("Content-Type: image/jpeg");
// date_default_timezone_set('UTC');

//連接資料庫
$db = mysqli_connect('localhost', 'jy', 'fungjeiui97', 'afternoon_tea');
if(mysqli_connect_errno()){
    exit;
}


    
$stmt = $db->query("select distinct store from order_info"); 
//$result = mysqli_fetch_array($stmt);


?>

<body>
  <!-- partial:index.partial.html -->
  <div class="toolbar" id="homePage">
    <i class="material-icons">home</i>
    <div class="mem_txt">home</div>
  </div>
  <div class="add">
    <!-- <div class="sub"></div> -->
    <div>店名 :</div>
    <div class="blank_10"></div>
    <select id="input_store">
      <!-- <option>麻古茶坊</option>
      <option>小上海鹹酥雞</option> -->
      <?php 
        if ($stmt->num_rows > 0) {
          while ($row = $stmt->fetch_assoc()) {
              echo '<option>'.$row['store'].'</option>';
          }
        }
      ?>
    </select>
    <div class="blank_20"></div>
    <div class="btn_send">分析</div>
    <img class="tail" src="../tail01.png" />
    <img class="image" src="../cat.png" />
  </div>
  <div class="box">
    <div class="subbox pie_box">
      <div class="pie" id="pie"></div>
    </div>
    <div class="subbox list_box">
      <div class="list" v-for="l in top">
        <i class="material-icons icon">${l.icon}</i>
        <div class="text">${l.item} </div>
      </div>
      <!-- <div class="list">
        <i class="material-icons icon">looks_one</i>
        <div class="text">炸蝦</div>
      </div>
      <div class="list">
        <i class="material-icons icon">looks_two</i>
        <div class="text">炸蝦</div>
      </div> -->
    </div>
  </div>


  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js'></script>
  <script src="https://unpkg.com/c3@0.7.11/c3.min.js"></script>
  <script src="https://unpkg.com/d3@5.12.0/dist/d3.min.js"></script>
  <script src="./analyze.js"></script>
</body>

</html>


