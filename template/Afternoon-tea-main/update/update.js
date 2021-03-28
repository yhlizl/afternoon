


document.getElementById('input_date').valueAsDate = new Date();
document.getElementById('input_date').disabled = true;

// var typestring = $("input[name='type']").val();
// var id = $("input[name='id']").val();
// var store = $("input[name='store']").val();
// var date = $("input[name='date']").val();



function readImage(input) {
    if (input.files && input.files[0]) {
        // 建立一個 FileReader 物件
        var reader = new FileReader();
        // 當檔案讀取完後，所要進行的動作
        reader.onload = function (e) {
            // 顯示圖片
            $('#show_image').attr("src", e.target.result).css("height", "98%").css("width", "98%");
            // 將 DataURL 放到表單中
            $("input[name='imagestring']").val(e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function () {
    // 綁定事件
    $("#previewImage").change(function () {
        readImage(this);
    });
});


$('#submit1').on('click', function (event) {


    event.preventDefault();
    var id = $("input[name='id']").val();
    var store = $('#input_store').val();
    var date = $('#input_date').val();
    var type = $('#input_type').val();
    var memo = $('#input_memo').val();
    var imagestring = $("input[name='imagestring']").val();
    console.log(id,store,date,type,memo,imagestring);

    var r = confirm("確定送出?");
    if (r) {

        if (store != '' && date != '' && type != '') { //&& imagestring != ""
            $.ajax({
                type: "POST",
                crossDomain: true,
                cache: false,
                data: {
                    id: id,
                    store: store,
                    date: date,
                    type: type,
                    memo: memo,
                    imagestring: imagestring,
                    status: 'close'
                },
                url: './updateInfo.php',
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    if (result['success']) {
                        window.location.href = '../main/main.html';
                    }
                    else {
                        alert(result['status']);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });

        }
        else {
            alert(" Empty input !");
            console.log(id,store,date,type,memo,imagestring);
        }

    }




});

$('#submit2').on('click', function (event) {


    event.preventDefault();
    var id = $("input[name='id']").val();
    var store = $('#input_store').val();
    var date = $('#input_date').val();
    var type = $('#input_type').val();
    var memo = $('#input_memo').val();
    var imagestring = $("input[name='imagestring']").val();
    console.log(id,store,date,type,memo,imagestring);

    var r = confirm("確定送出?");
    if (r) {

        if (store != '' && date != '' && type != '') { //&& imagestring != ""
            $.ajax({
                type: "POST",
                crossDomain: true,
                cache: false,
                data: {
                    id: id,
                    store: store,
                    date: date,
                    type: type,
                    memo: memo,
                    imagestring: imagestring,
                    status: 'open'
                },
                url: './updateInfo.php',
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    if (result['success']) {
                        window.location.href = '../main/main.html';
                    }
                    else {
                        alert(result['status']);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });

        }
        else {
            alert(" Empty input !");
            console.log(id,store,date,type,memo,imagestring);
        }

    }

});

$('#homePage').on('click', function(event){
    event.preventDefault();
    window.location.href='../main/main.html'; //換成操作頁面
      
    
});


