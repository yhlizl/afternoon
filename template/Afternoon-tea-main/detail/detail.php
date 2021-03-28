
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>下午茶系統</title>
    <link rel="stylesheet" href="./detail.css">
    <link href="../api/icon.css"
      rel="stylesheet">
      
</head>

<?php

// header("Content-Type: image/jpeg");
// date_default_timezone_set('UTC');

//連接資料庫
$db = mysqli_connect('localhost', 'jy', 'fungjeiui97', 'afternoon_tea');
if(mysqli_connect_errno()){
    exit;
}



// meal_info
$id = $_POST['id'];
$store = $_POST['store'];
$type = $_POST['type'];
$date = $_POST['date'];
$memo = $_POST['memo'];
    
$stmt = $db->query("select image from meal_info where id = '".$id."'"); 
$result = mysqli_fetch_array($stmt);


?>

<body>

    <div class="toolbar" id="homePage">
        <i class="material-icons home">home</i>
        <div class="mem_txt">首頁</div>
    </div>

    <div class="toolbar download" id="download">
      <form method="post" action="../export/export.php">
        <i class="material-icons home" >view_list</i>
        <input type="hidden" name="id" value=<?php echo $id?>>
        <input type="hidden" name="store" value=<?php echo $store ?>>
        <input type="hidden" name="type" value=<?php echo $type ?>> 
        <input type="hidden" name="date" value=<?php echo $date ?>>
        <input type="hidden" name="memo" value=<?php echo $memo ?>>
        <input class="dl_txt" type="submit" name="submit" value="清單"></input>
      </form>
    </div>
  
  
    <input type="hidden" name="type" value= <?php echo $type ?>>
    <input type="hidden" name="id" value= <?php echo $id ?>>
    <input type="hidden" name="date" value= <?php echo $date ?>>
    <input type="hidden" name="store" value= <?php echo $store ?>>
    <input type="hidden" name="memo" value= <?php echo $memo ?>>
    
    <H1 style="position: absolute; top: 0px; left: 6%;" ><?php echo $store?></H1>
    <div class="box">
        <div class="order_box" id="order_box">
            <div class="order" id="order">訂餐</div>
            <div class="order_panel" id="order_panel">
                <div class="order_form">
                    <div class="food_box">*姓名
                        <select class="input_m_size" id="member">
                            <option v-for="m in member">${m.name}</option>
                        </select>
                    </div>
                    <div class="bar"></div>
                    <div class="food_txt">*食物</div>
                    <div class="food_box">
                        <input class="input_d" id="food"></input>
                    </div>
                    <div class="bar"></div>
                    <div class="food_txt">*飲料</div>
                    <div class="food_box">
                        <input class="input_d" id="drink"></input>
                        <select class="input_d_size" id="size">
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                        </select>
                        <select class="input_d_size" id="ice">
                            <option>熱飲</option>
                            <option>常溫</option>
                            <option>去冰</option>
                            <option>微冰</option>
                            <option>少冰</option>
                            <option>正常</option>
                        </select>
                        <select class="input_d_size" id="sugar">
                            <option>無糖</option>
                            <option>一分</option>
                            <option>三分</option>
                            <option>半糖</option>
                            <option>少糖</option>
                            <option>正常</option>
                        </select>
                    </div>
                    <div class="bar"></div>
                    <div class="memo_box">
                        *價錢：
                        <input class="input_d" id="price"></input>
                    </div>
                    <div class="memo_box">
                        備註：
                        <input class="input_d" id="memo"></input>
                    </div>
                    <div class="input_box">
                        <div id="submit" title="first">訂餐！</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="subbox left" id="left">
            
            <div class="pattern_t">
                <!-- --------------------------------------------- -->
                <i class=" mod material-icons" style="opacity: 0;"></i>
                <i class=" mod del material-icons" style="opacity: 0;"></i>
                <div class="block  block_t">姓名</div>
                <div class="block  block_t Order F">食物</div>
                <div class="block  block_t price">價錢</div>
            </div>
            <div class="pattern" v-for="m in rows">
                <i class=" mod material-icons" v-on:click="modified(m,$event)">edit</i>
                <i class=" mod del material-icons" v-on:click="deleted(m,$event)">delete</i>
                <div class="block ">${m.name}</div>
                <div class="block Order F">${m.food} ${m.sugar_ice}</div>
                <div class="block price">${m.price} $</div>
                <!-- --------------------------------------------- -->
            </div>
        </div>
        <div class="subbox right" id="right">
            <!-- <img class="image_cat" src="../cat.png"/> -->
            <?php echo '<img class="image" src="data:image/jpeg;base64,'.base64_encode($result['image']).'"/>' ?>
        </div>
    </div>
    <!-- partial -->
    <script src='../api//jquery.min.js'></script>
    <script src='../api/vue.min.js'></script>
    <script src="./detail.js"></script>
</body>

</html>
    




