<?php 

include 'components/db.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

 $dlscno=$_SESSION['dlscno'];

//  print_r($user_id);die;


?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<form>
    
    <input type="text" name="amount" id="amount" placeholder="Amount">
    <input type="button" id="button" value="Pay Using RazorPay" onclick="PayNow()" name="button">
</form>  

<script>

function PayNow(){

   var amount = $("#amount").val();

   var options = {
    "key": "rzp_test_vM7qOaJ5HKAnCT", 
    "amount": amount*100,
    "currency": "INR",
    "name": "PartinX",
    "description": "Test Transaction",
    "image": "https://example.com/your_logo",
    
    "handler": function (response){
       jQuery.ajax({
        type:"POST",
        url:"payment-process.php",
        data:"pay_id="+response.razorpay_payment_id+"&amt="+amt+"&name="+name,
        success:function(response){
           console.log(response);
        }

       });
    },
};
var rzp1 = new Razorpay(options);

rzp1.open();


}


</script>