$('#homePage').on('click', function (event) {
    event.preventDefault();
    window.location.href = '/'; //換成操作頁面


});


var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
if (dd < 10) { dd = '0' + dd; }
if (mm < 10) { mm = '0' + mm; }
today = yyyy + '-' + mm + '-' + dd;


get_order();

var vm = new Vue({
    el: "#completedTable",
    delimiters: ['${', '}'],
    data: {
        rows: [],
        today_meal: []
    },
    methods:{
        deleted: function (r, event) {
            let c = confirm("確定刪除？");
            if(c){
                console.log(r);
                let data = {
                    id: r.id,
                    date:r.date,
                };
                function successFunc(result) {
                    get_order();
                }
                Ajax(data,'/control/close',successFunc);
                

            }
        }
    }
});

function get_order(){

    let data = {
        
        today: today
    };
    function successFunc(result) {
        vm.rows = result['data'];
        vm.today_meal = result['today_meal'];
        console.log(vm.today_meal);
    }
    Ajax(data,'/meal/getmeal',successFunc);
}


function Ajax(data,url,successFunc){
    $.ajax({
        type: "POST",
        crossDomain: true,
        cache: false,
        data: data,
        url: url,
        dataType: "json",
        success: function (result) {
            successFunc(result);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}



$(document).ready(function () {
    $('#completedTable').DataTable(
        {
            "paging": false,
            "ordering": false,
            paging: false,

            // "scrollX": true,
            "searching": false,
            info: false
        }
    );
    $(".dataTables_empty").empty();


});
