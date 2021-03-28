// $.ajax({
//     type: "POST",
//     crossDomain: true,
//     cache: false,
//     data:{
//       number: 1
//     },
//     url: './member.php',
//     dataType: "json",
//     success: function(result){
//         console.log(result['data']);
//         vm.rows = result['data'];

//     },
//     error: function(jqXHR, textStatus, errorThrown) {
//         console.log(jqXHR);
//         console.log(textStatus);
//         console.log(errorThrown);
//     }
// });




var vm = new Vue({
    el: ".box",
    delimiters: ['${', '}'],
    data: {
        rows: [],
        icon:['looks_one','looks_two','looks_3'],
        top: []
    },
    methods:{
        selectIcon: function(n){
            return this.icon[n];
        }
    }
});


var data = {};
var pie_data = [];


$('.btn_send').on('click', function (event) {


    event.preventDefault();
    var store = $('#input_store').val();
    console.log(store);


    if (store != '') {
        $.ajax({
            type: "POST",
            crossDomain: true,
            cache: false,
            data: {
                store: store
            },
            url: './get_analyze.php',
            dataType: "json",
            success: function (result) {
                console.log(result);
                vm.rows = result['data'];
                vm.top = result['data'].slice(0,3);

                for(var i=0; i<vm.top.length;i++){
                    vm.top[i]['icon'] =  vm.icon[i];
                }

                console.log(vm.top);
                data = {};
                pie_data = [];
                vm.rows.forEach(function (e) {
                    pie_data.push(e.item);
                    data[e.item] = e.count;
                })

                var chart = c3.generate({
                    bindto: ".pie",
                    data: {
                        json: [
                            data
                        ],
                        keys: {
                            value: pie_data,
                        },
                        type: 'pie',
                        onclick: function (d, i) { console.log("onclick", d, i); },
                    
                    },
                    // tooltip: {
                    //     position: function (data, width, height, element) {
                    //         // in this case, tooltip will appear x,30 and y:20
                    //         return {
                    //             width: 200, height: 30
                    //         };
                    //     }
                    // },
                    zoom: {
                        enabled: true
                    },
                    transition: {
                        duration: 1000
                    }
                });


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

});

$('#homePage').on('click', function (event) {
    event.preventDefault();
    window.location.href = '../main/main.html'; //換成操作頁面


});




