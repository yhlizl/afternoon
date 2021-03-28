

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
if (dd < 10) { dd = '0' + dd; }
if (mm < 10) { mm = '0' + mm; }
today = yyyy + '-' + mm + '-' + dd;
console.log(today);


$.ajax({
    type: "POST",
    crossDomain: true,
    cache: false,
    data: {
        number: 1,
        today: today
    },
    url: '/meal/getmeal',
    dataType: "json",
    success: function (result) {
        console.log(result);
        vm.rows = result['data'];
        vm.today_meal = result['today_meal']
        // console.log(vm.today);

    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    }
});




var vm = new Vue({
    el: ".box",
    delimiters: ['${', '}'],
    data: {
        rows: [],
        today: today,
        today_meal: []
    },
    methods: {
        showdetail(t) {
            console.log(t);
           
        }
    }
});


$('.createBtn').on('click', function(event){
    event.preventDefault();
    window.location.href='/meal/index'; //換成操作頁面
      
    
});

$('#addMember').on('click', function(event){
    event.preventDefault();
    window.location.href='/member/show'; //換成操作頁面
      
    
});

$('#control').on('click', function (event) {
    event.preventDefault();
    window.location.href = '../control/control.html'; //換成操作頁面


});
$('#logout').on('click', function (event) {
    event.preventDefault();
    window.location.href = '/logout'; //換成操作頁面


});

// $('.download').on('click', function(event){
//     event.preventDefault();

//     // var id = $("input[name='id']").val();
//     // var store = $("input[name='store']").val();
//     // var date = $("input[name='date']").val();
//     // var type = $("input[name='type']").val();
//     // alert("id, store, date, type");

//     var target = vm.today_meal[0];

//     $.ajax({
//         type: "POST",
//         crossDomain: true,
//         cache: false,
//         data: {
//             id: target.id,
//             store: target.store,
//             date: target.date,
//             type: target.type
//         },
//         url: './export.php',
//         dataType: "text",
//         success: function (result) {
//             console.log(result);
//             // vm.rows = result['data'];
//             // vm.today_meal = result['today_meal']
//             // console.log(vm.today);
    
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             console.log(jqXHR);
//             console.log(textStatus);
//             console.log(errorThrown);
//         }
//     });
    
// });