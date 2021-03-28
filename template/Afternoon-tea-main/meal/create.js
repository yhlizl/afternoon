var d = new Date() ;


var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
if (dd < 10) { dd = '0' + dd; }
if (mm < 10) { mm = '0' + mm; }
today = yyyy + '-' + mm + '-' + dd;
document.getElementById('input_date').valueAsDate = new Date(today);
document.getElementById("input_date").disabled = true;
console.log(d.getTimezoneOffset());

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


function insertdb1(event) {


    event.preventDefault();
    var store = $('#input_store').val();
    var date = $('#input_date').val();
    var type = $('#input_type').val();
    var memo = $('#input_memo').val();
    var imagestring = $("input[name='imagestring']").val();

    var r = confirm("確定送出?");
    if (r) {

        if (store != '' && date != '' && type != '' && memo != "" && imagestring != "") {
            $.ajax({
                type: "POST",
                crossDomain: true,
                cache: false,
                data: {
                    store: store,
                    date: date,
                    type: type,
                    memo: memo,
                    con:'1',
                    imagestring: imagestring,
                    status: 'close'
                },
                url: '/meal/create',
                dataType: "json",
                success: function (result) {
                    
                          //  window.location.href = '/meal/';
                        }
                    

                ,
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });

        }else if (imagestring==""){
            alert(" image empty!!");
            console.log(store, memo, date, type, imagestring);
        }
        else {
            alert(" Empty input !");
            console.log(store, memo, date, type, imagestring);
        }

    }
}


function insertdb2(event) {


    event.preventDefault();
    var store = $('#input_store').val();
    var date = $('#input_date').val();
    var type = $('#input_type').val();
    var memo = $('#input_memo').val();
    var imagestring = $("input[name='imagestring']").val();

    var r = confirm("確定送出?");
    if (r) {

        if (store != '' && date != '' && type != '' && memo != "" && imagestring != "") {
            $.ajax({
                type: "POST",
                crossDomain: true,
                cache: false,
                data: {
                    store: store,
                    date: date,
                    type: type,
                    memo: memo,
                    con:'1',
                    imagestring: imagestring,
                    status: 'open'
                },
                url: '/meal/create',
                dataType: "json",
                success: function (result) {
                    
                          //  window.location.href = '/meal/';
                        }
                    

                ,
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });

        }else if (imagestring==""){
            alert(" image empty!!");
            console.log(store, memo, date, type, imagestring);
        }
        else {
            alert(" Empty input !");
            console.log(store, memo, date, type, imagestring);
        }

    }
}

$('#submit1').on('click', function (event) {


    event.preventDefault();
    var store = $('#input_store').val();
    var date = $('#input_date').val();
    var type = $('#input_type').val();
    var memo = $('#input_memo').val();
    var imagestring = $("input[name='imagestring']").val();

    var r = confirm("確定送出?");
    if (r) {

        if (store != '' && date != '' && type != '' && memo != "" && imagestring != "") {
            $.ajax({
                type: "POST",
                crossDomain: true,
                cache: false,
                data: {
                    store: store,
                    date: date,
                    type: type,
                    memo: memo,
                    imagestring: imagestring,
                    status: 'close'
                },
                url: '/meal/create',
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    if (result['success']) {
                       // window.location.href = '/meal/';
                    }
                    else {
                        var c = confirm(result['status']);
                        if (c) {
                            console.log(result.data);
                            // window.location.href = "district.php?dist=" + dist;
                           insertdb1(event);
                        }
                        else {
                            window.location.href = '/meal/';
                        }
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });

        }else if (imagestring==""){
            alert(" image empty!!");
            console.log(store, memo, date, type, imagestring);
        }
        else {
            alert(" Empty input !");
            console.log(store, memo, date, type, imagestring);
        }

    }
});

$('#submit2').on('click', function (event) {
    event.preventDefault();
    var store = $('#input_store').val();
    var date = $('#input_date').val();
    var type = $('#input_type').val();
    var memo = $('#input_memo').val();
    var imagestring = $("input[name='imagestring']").val();
    var r = confirm("確定送出?");
    if (r) {

        if (store != '' && date != '' && type != '' && memo != "" && imagestring != "") {
            $.ajax({
                type: "POST",
                crossDomain: true,
                cache: false,
                data: {
                    store: store,
                    date: date,
                    type: type,
                    memo: memo,
                    imagestring: imagestring,
                    status: 'open'
                },
                url: '/meal/create',
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    if (result['success']) {
                       // window.location.href = '/meal/';
                    }
                    else {
                        var c = confirm(result['status']);
                        if (c) {
                            console.log(result.data);
                            insertdb2(event);
                        }
                        else {
                            window.location.href = '/meal/';
                        }
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });

        }else if (imagestring==""){
            alert(" image empty!!");
            console.log(store, memo, date, type, imagestring);
        }
        else {
            alert(" Empty input !")
        }

    }




});

$('#homePage').on('click', function (event) {
    event.preventDefault();
    window.location.href = '/'; //換成操作頁面


});


