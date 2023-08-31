<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="heading">quick view</h1>

   <?php
   

   if(isset($_POST['send'])){
      $pid = $_GET['pid'];
      $approve=0;
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $email = $_POST['email'];
      $email = filter_var($email, FILTER_SANITIZE_STRING);
      $number = $_POST['number'];
      $number = filter_var($number, FILTER_SANITIZE_STRING);
      $msg = $_POST['msg'];
      $msg = filter_var($msg, FILTER_SANITIZE_STRING);
   
      $select_message = $conn->prepare("SELECT * FROM `review` WHERE name = ? AND email = ? AND number = ? AND message = ? AND pid = ? AND approve=?");
      $select_message->execute([$name, $email, $number, $msg, $pid,$approve]);
   
      if($select_message->rowCount() > 0){
         $message[] = 'already sent message!';
      }else{
   
         $insert_message = $conn->prepare("INSERT INTO `review`(user_id, name, email, number, message,pid,approve) VALUES(?,?,?,?,?,?,?)");
         $insert_message->execute([$user_id, $name, $email, $number, $msg,$pid,$approve]);
   
         $message[] = 'sent message successfully!';
   
      }
   
   }

   
   ?>

   <?php
     $pid = $_GET['pid'];
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
              
            </div>
         </div>
         
         <div class="content">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
               <div class="price"><span>Rs</span><?= $fetch_product['price']; ?><span></span></div>
               <!-- <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1"> -->
            </div>
            
            <div class="details"><?= $fetch_product['details']; ?></div>
            <div class="flex-btn">
              <a class="btn " style="width:30%" href="shop.php">Go Back</a>
            </div>

         </div>

      </div>

   </form>



      </section>

   <section class="contact" style="height:20">

<form action="" method="post">
   <h3>Review This Product</h3>
   <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
   <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
   <input type="number" name="number" min="0" max="9999999999" placeholder="enter your number" required onkeypress="if(this.value.length == 10) return false;" class="box">
   <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
   <input type="submit" value="send message" name="send" class="btn">
</form>

</section>
   
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>






<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>