
var order_id;

var vm = new Vue({
    el: ".left",
    delimiters: ['${', '}'],
    data: {
        rows: []
    },
    methods: {
        modified: function (m, event) {

            show_panel(event);

            document.getElementById('submit').title = "modified";

            document.getElementById('member').value = m.name;
            order_id = m.order_id;


            if (m.type == "食物") {
                document.getElementById('food').value = m.food;
            }
            else {
                var drink_set = m.sugar_ice.split(",");
                document.getElementById('drink').value = m.food;
                document.getElementById('size').value = drink_set[0];
                document.getElementById('ice').value = drink_set[1];
                document.getElementById('sugar').value = drink_set[2];
            }

            document.getElementById('price').value = m.price;
            document.getElementById('memo').value = m.memo;




            var drink_name = $("#drink").val();
            var size = $("#size").val();
            var ice = $("#ice").val();
            var sugar = $("#sugar").val();
            var price = $("#price").val();
            var memo = $("#memo").val();

        },
        ////////////////////////////////////
        deleted: function (m, event) {
            event.preventDefault();
            let flag = confirm("刪除？");
            //console.log(m.order_id);
            if (flag) {
                $.ajax({
                    type: "POST",
                    crossDomain: true,
                    cache: false,
                    data: {
                        
                        id: m.order_id,
                    },
                    url: '/detail/deleter',
                    dataType: "json",
                    success: function (result) {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }

        }
        ////////////////////////////////////
    }
});

var vm_member = new Vue({

    el: "#member",
    delimiters: ['${', '}'],
    data: {
        member: []
    }
});


var typestring = $("input[name='type']").val();
var id = $("input[name='id']").val();
var store = $("input[name='store']").val();
var date = $("input[name='date']").val();



$.ajax({
    type: "POST",
    crossDomain: true,
    cache: false,
    data: {
        number: 1
    },
    url: '/member/getinit',
    dataType: "json",
    success: function (result) {
        console.log(result);
        vm_member.member = result;

    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    }
});


////////////////////////////////////
// GET ORDER LIST  JS -> PHP

function get_order(){
    $.ajax({
        type: "POST",
        crossDomain: true,
        cache: false,
        data: {
            id: id,
            store: store,
            type: typestring,
            date: date
        },
        url: '/detail/getinit',
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
}


get_order();
////////////////////////////////////

if (typestring == "飲料") {
    document.getElementById("food").disabled = true;
    document.getElementById("ice").disabled = false;
    document.getElementById("size").disabled = false;
    document.getElementById("sugar").disabled = false;
    document.getElementById("drink").disabled = false;
}
else {
    document.getElementById("drink").disabled = true;
    document.getElementById("ice").disabled = true;
    document.getElementById("size").disabled = true;
    document.getElementById("sugar").disabled = true;
    document.getElementById("food").disabled = false;
}



var state = 0;
$('#order').on('click', function (event) {
    show_panel(event);
    document.getElementById('member').value = "";
    document.getElementById('food').value = "";
    document.getElementById('drink').value = "";
    document.getElementById('price').value = "";
    document.getElementById('memo').value = "";
    document.getElementById('submit').title = "first";
    order_id = "";
});

function show_panel(event) {
    event.preventDefault();

    if (state % 2 == 0) {
        document.getElementById("order_box").style.zIndex = "200";
        document.getElementById("order_panel").style.transform = "translateX(20%)";
        document.getElementById("order_panel").style.opacity = "1";
        document.getElementById("left").style.opacity = "0";
        document.getElementById("right").style.width = "80%";
        

        // document.getElementById("order").style.transform = "translateX(400px) rotate(360deg)";
        document.getElementById("order").textContent = "X";
        state += 1;
    }
    else {

        document.getElementById("order_panel").style.transform = "translateX(-100%)";
        document.getElementById("order_panel").style.opacity = "0";
        document.getElementById("left").style.opacity = "1";
        document.getElementById("right").style.width = "50%";


        // document.getElementById("order").style.transform = "translateX(0px) rotate(-360deg)";
        document.getElementById("order").textContent = "訂餐";
        document.getElementById("order_box").style.zIndex = "0";



        state -= 1;
    }
}



$('#submit').on('click', function (event) {
    event.preventDefault();

    // var order_type = event.target.title ;
    //var order_type = $('#submit').attr('title');

    // GET order input
    var member = $("#member").val();
    var food_name = $("#food").val();
    var drink_name = $("#drink").val();
    var size = $("#size").val();
    var ice = $("#ice").val();
    var sugar = $("#sugar").val();
    var price = parseInt($("#price").val());
    var memo = $("#memo").val();
    // console.log(food_name, drink_name,size,ice,sugar);
    // console.log(order_type,order_id);

    if (typestring == "食物") {
        size = "";
        ice = "";
        drink_name = "";
        sugar = "";
    }
    else {
        food_name = "";
    }
    show_panel(event);
    //console.log(order_type);

    if ((food_name != "" || drink_name != "") && price != "") {
        $.ajax({
            type: "POST",
            crossDomain: true,
            cache: false,
            data: {
                id: id,
                store: store,
                type: typestring,
                member: member,
                food_name: food_name,
                drink_name: drink_name,
                size: size,
                ice: ice,
                sugar: sugar,
                price: price,
                memo: memo,
                date: date,
       
            },
            url: '/detail/register',
            dataType: "json",
            success: function (result) {
                console.log(result);
                location.reload();


            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }
    else {
        alert("Empty Input !");
    }

});


$('#homePage').on('click', function (event) {
    event.preventDefault();
    window.location.href = '/'; //換成操作頁面


});




