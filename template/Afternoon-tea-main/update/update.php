<?php

    
    $id = $_GET['id'];
    $store = $_GET['store'];
    $type = $_GET['type'];
    $memo = $_GET['memo'];

    //連接資料庫
    $db = mysqli_connect('localhost', 'jy', 'fungjeiui97', 'afternoon_tea');
    if(mysqli_connect_errno()){
        exit;
    }
    $stmt = $db->query("select image from meal_info where id = '".$id."'"); 
    $result = mysqli_fetch_array($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>下午茶系統</title>
    <link rel="stylesheet" href="./update.css">
    <link href="../api/icon.css"
    rel="stylesheet">
</head>

<body>
    <input type="hidden" name="id" value= <?php echo $id ?>>
    <div class="toolbar" id="homePage">
        <i class="material-icons">home</i>
        <div class="mem_txt">首頁</div>
    </div>

    <div class="box">
        <div class="subbox left">
            <form class="choose">
                <div class="input_box picture">
                    <input type="hidden" name="imagestring">
                    <input accept="image/*" id="previewImage" type="file">
                </div>
                <hr>

                <div class="input_box">
                    <div class="input_txt date">日期 ：</div>
                    <input class="input_" type="date" name="date" id="input_date" ></input>
                </div>

                <div class="input_box">
                    <div class="input_txt shop">店名 ：</div>
                    <input class="input_" name="store" id="input_store" value = <?php echo $store ?> ></input>
                </div>

                <div class="input_box">
                    <div class="input_txt date">類型 ：</div>
                    <select class="input_ type" name="type" id="input_type" value = <?php echo $type ?>>
                        <option>食物</option>
                        <option>飲料</option>
                    </select>
                </div>

                <div class="input_box">
                    <div class="input_txt shop">備註 ：</div>
                    <input class="input_" name="memo" id="input_memo" placeholder="善化店09XXXXXXXX" value = <?php echo $memo ?>></input>
                </div>

                <div class="input_box">
                    <!-- <input type="submit" name="submit" id="submit" /> -->
                    <div class="subBtn" id="submit1"> 儲存/關閉 </div>
                    <div class="subBtn" id="submit2"> 開單 </div>
                </div>
                
                <br />

            </form>
        </div>
        <div class="subbox right">
            <?php echo '<img id="show_image" src="data:image/jpeg;base64,'.base64_encode($result['image']).'"/>' ?>
        </div>


    </div>
    <!-- partial -->
    <script src='../api/jquery.min.js'></script>
    <script src='../api/vue.min.js'></script>
    <script src="./update.js"></script>
</body>

</html>


