$("#place_order").on("click", function (e) {
    e.preventDefault();
    var payment_type = $("input[name='payment']:checked").val();
    var adress_id = $("input[name='adress']:checked").val();
    var _token = $("input[name='token']").val();

    if (adress_id == null) {
        $(".err").html("An Adress Is Required Please Add an Adress");
    } else {
        $(".err").html("");
        var form = new FormData();
        form.append("payment_type", payment_type);
        form.append("adress_id", adress_id);
        form.append("_token", _token);
        




        $.ajax({
            type: "post",
            url: "/place_order",
            data: form,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == "un_autherized") {
                    window.location.href = "/cart";
                } else if (response.status == "success") {
                    //order placed successfully
                     window.location.href = "/my-orders";
                } else if (response.status == "online_payment") {
                 razorpay_payment(response,adress_id);





                }else if(response.status =='failed'){
                    swal("Ooops",response.message, "error").then(function(){
                        window.location.reload();
                    })
                } else {
                    window.location.href("/");
                }
            },
        });
    }
});

function  razorpay_payment(order,adrs_id){

    var options = {
        "key": "rzp_test_dRxAcV5ODZoT1J", // Enter the Key ID generated from the Dashboard
        "amount": order.order_details.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Fashi",
        "description": "Test Transaction",
        "image": "https://media-exp1.licdn.com/dms/image/C560BAQHggYLcXxs78w/company-logo_200_200/0/1592541089153?e=2159024400&v=beta&t=TXj5qgG0ZC50B6dQcnQPZ-4P-t3EkIHTD2mZ83HE8bw",
        "order_id": order.order_details.id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function (response){
             verify_payment(response,order,adrs_id)
        },
        "prefill": {
            "name": "Rashid",
            "email": "rashidpvr444@gmail.com",
            "contact": "9656146577"
        },
        "notes": {
            "address": "Razorpay Corporate Office"
        },
        "theme": {
            "color": "#3399cc"
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.open();
//handle here if payment is failed
    rzp1.on('payment.failed', function (response){
        // alert(response.error.code);
        // alert(response.error.description);
        // alert(response.error.source);
        // alert(response.error.step);
        // alert(response.error.reason);
        //alert(response.error.metadata.order_id);
        // alert(response.error.metadata.payment_id);


        payment_failed(order,response.error);

});
}

function verify_payment(response,order,adrs_id) { 

    console.log(adrs_id);
    $.ajax({
        type: "get",
        url: "/verify_payment",
        data: {
            response,
            order,
            adrs_id
        },
      
        success: function (response) {
            window.location.href = '/my-orders'
        }
    });
 }

 //order failed handling
 function payment_failed(order,response){
     
    $.ajax({
        type: "get",
        data:response,
        url: "/payment-failed/",
     
        
        success: function (response) {
           
        }
    });
 }
