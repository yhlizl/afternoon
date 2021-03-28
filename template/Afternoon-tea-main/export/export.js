$('#homePage').on('click', function (event) {
    event.preventDefault();
    window.location.href = '/'; //換成操作頁面


});


var vm = new Vue({
    el: "#completedTable",
    delimiters: ['${', '}'],
    data: {
        rows: [],
        total: 0
    }
});

var id = $("input[name='id']").val();
var store = $("input[name='store']").val();
var type = $("input[name='type']").val();
var date = $("input[name='date']").val();
console.log(id,store,type,date);
get_order();



function get_order(){
    $.ajax({
        type: "POST",
        crossDomain: true,
        cache: false,
        data: {
            id: id,
            store: store,
            type: type,
            date: date
        },
        url: '/detail/getinit/',
        dataType: "json",
        success: function (result) {
            console.log(result)
            vm.rows = result;
            vm.total = calculateMoney(vm);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
    
}

function calculateMoney(vm){
    let money = 0;
    vm.rows.forEach(element => {
        money += parseInt(element.price);
    });

    return money;
};


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
