<?php

include 'db.php';


session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

$dlscno=$_SESSION['dlscno'];


?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form style="display:flex;justify-content:center;margin:50px;">
<?php
      $query = $con->query("select * from users where id= '$user_id' ");
      while ($row = $query->fetch_assoc()) { ?>
    <input type="textbox" name="name" id="name" value="<?php  $row["email"]; ?>" placeholder="Enter your name" required/><br/><br/>
    <?php } ?>
    <?php
      $query = $con->query("select * from orders where id= '$dlscno' ");
      while ($row = $query->fetch_assoc()) { ?>
    <input class="mx-5" type="textbox" name="amt" id="amt" placeholder="Enter amt" value="<?php echo $row['total_price'] ?>" disabled/><br/><br/>
    <br>
    <?php } ?>
    <input  type="button" name="btn" id="btn" value="Pay Using RazorPay" onclick="pay_now()"/>
</form>

<script>
    function pay_now(){
        var name=jQuery('#name').val();
        var amt=jQuery('#amt').val();
        
         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&name="+name,
               success:function(result){
                   var options = {
                        "key": "rzp_test_vM7qOaJ5HKAnCT", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "PartinX",
                        "description": "Test Transaction",
                        "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id,
                               success:function(result){
                                   window.location.href="thank_you.php";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    }
</script>