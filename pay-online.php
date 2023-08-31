<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


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
                        "name": "SportsShop",
                        "description": "Test Transaction",
                        // "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
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



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <section class="orders">

        <h1 class="heading">placed orders</h1>

        <div class="box-container">

            <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
            <div class="box">
                <div class="wrapper mb-5 contact">
                    
                    <form>
                        <!--Account Information Start-->
                        <h1>Online Payment</h1>
                        

                        <div class="input_group">
                            <div class="input_box">
                                <input type="textbox" name="amount" id="amount" value="<?= $fetch_orders['total_price']*100/100; ?>" class="box"
                                    disabled />

                                <i class="fa fa-money icon" aria-hidden="true"></i>
                            </div>
                        </div>

                        <!--Account Information End-->


                        <!--DOB & Gender Start-->



                        <div class="input_group">
                            <div class="input_box">
                            <input type="button" id="button" class="btn" value="Pay Using RazorPay" onclick="PayNow()" name="button">

                            </div>
                        </div>

                    </form>
                </div>
              
               
                </p>
            </div>
            <?php
      }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      }
   ?>

        </div>

    </section>













    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>