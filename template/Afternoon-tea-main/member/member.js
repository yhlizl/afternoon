$.ajax({
    type: "POST",
    crossDomain: true,
    cache: false,
    
    url: '/member/getinit',
    dataType: "json",
    success: function (result) {
        console.log(result);
        vm.rows = result;

    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    }
});




var vm = new Vue({
    el: ".list",
    delimiters: ['${', '}'],
    data: {
        rows: [],
    },
    methods: {
        deleted: function (r, $event) {

            let c = confirm("確定刪除"+r.name+"？");
            if(c){
                $.ajax({
                    type: "POST",
                    crossDomain: true,
                    cache: false,
                    data: {
                        number: r.number
                    },
                    url: '/member/deleter',
                    dataType: "json",
                    success: function (result) {
                        console.log(result);
                        
                         window.location.href = '/member/show';
                     
    
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
            
        }
    }
});



$('.btn_send').on('click', function (event) {


    event.preventDefault();
    var name = $('#input_name').val();
    var number = $('#input_num').val();
    var dep = $('#input_dep').val();

    var r = confirm("確定新增 " + name + " " + dep + " " + number + "?");
    if (r) {

        if (number != '' && name != '' && dep != '') {
            $.ajax({
                type: "POST",
                crossDomain: true,
                cache: false,
                data: {
                    name: name,
                    number: number,
                    dep: dep
                },
                url: '/member/register',
                dataType: "json",
                success: function (result) {
                    window.location.href = '/member/show';

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });

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