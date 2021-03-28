<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fang</title>
    
    <link rel="stylesheet" href="../api/c3.css">
    <!-- <link rel="stylesheet" href="../api/c3.min.css" type="text/css"> -->
    <link href="../api/poppins-font.css" rel="stylesheet">
    <link href="../api/icon.css" rel="stylesheet">
    <link href="../api/jquery.dataTables.css" rel="stylesheet">
    <link rel="stylesheet" href="./export.css">
    
</head>


<?php

// header("Content-Type: image/jpeg");
// date_default_timezone_set('UTC');

//連接資料庫
$db = mysqli_connect('localhost', 'jy', 'fungjeiui97', 'afternoon_tea');
if(mysqli_connect_errno()){
    exit;
}


mysqli_query("SET NAMES UTF8");

// order list
$id = $_POST['id'];
$store = $_POST['store'];
$type = $_POST['type'];
$date = $_POST['date'];
$memo = $_POST['memo'];
?>

<body>
    <div class="toolbar" id="homePage">
        <i class="material-icons home">home</i>
        <div class="mem_txt">首頁</div>
    </div>
    <div class="toolbar download" id="download">
      <form method="post" action="../detail/detail.php">
        <i class="material-icons home" >reply</i>
        <input type="hidden" name="id" value=<?php echo $id?>>
        <input type="hidden" name="store" value=<?php echo $store ?>>
        <input type="hidden" name="type" value=<?php echo $type ?>> 
        <input type="hidden" name="date" value=<?php echo $date ?>>
        <input type="hidden" name="memo" value=<?php echo $memo ?>>
        <input class="dl_txt" type="submit" name="submit" value="上一頁"></input>
      </form>
    </div>

    <div class="box" id="box">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="store" value= "<?php echo $store ?>">
        <input type="hidden" name="type" value= "<?php echo $type ?>">
        <input type="hidden" name="date" value= "<?php echo $date ?>">
        <input type="hidden" name="memo" value=<?php echo $memo ?>>
        <H1 class="cardTitle" id="cardTitle" ><?php echo $store ?></H1>
        <p class="p" id="memoStr" ><?php echo $memo ?></p>

        <div class="subject" >

            <!-- <h4 style="margin-bottom: 0px; margin-top: 50px;">COMPLETED</h4> -->
            <div class="completedTableBox" style="margin-bottom: 30px;">
                <table id="completedTable" class="display" data-page-length='1'>
                    <thead>
                        <tr>
                            <!-- <th></th> -->
                            <th>姓名</th>
                            <th>食物</th>
                            <th>糖冰</th>
                            <th>備註</th>
                            <th>價錢</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="r in rows"> 
                            <td>${r.name}</td>
                            <td>${r.food}</td>
                            <td>${r.sugar_ice}</td>
                            <td>${r.memo}</td>
                            <td>${r.price}</td>
                        </tr> 
                    </tbody>
                    <tbody>
                        <tr> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>總額</td>
                            <th>${total} $</th>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>


    <div class="footer"></div>
    <!-- partial -->
    <!-- <script src='../api/jquery.min.js'></script> -->
    <script src='../api/jquery-3.5.1.js'></script>
    <script src='../api/c3.min.js'></script>
    <script src='../api/d3.min.js'></script>
    <script src='../api/vue.min.js'></script>
    <script src='../api/jquery.dataTables.min.js'></script>
    <script src='../api/dataTables.buttons.min.js'></script>
    <script src='../api/dataTables.select.min.js'></script>
    <script src='../api/dataTables.editor.min.js'></script>
    <!-- <script type="text/javascript" src="../Editor-1.9.6/js/dataTables.editor.js"></script> -->
    <script src='./export.js'></script>
</body>

</html>