<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if (isset($_POST['cartno'])) {
	$_SESSION['cartno'] = filter_var($_POST['cartno'], FILTER_SANITIZE_NUMBER_INT);
	header('Location:process-add-to-cart.php');
}

include 'components/wishlist_cart.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>



<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/1775600.png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>Latest Products</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/basketball-basket-png-39939.png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>Latest Products</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/tennis-png-1790.png" alt="">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3>Latest Products</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>




</div>

<section class="category" style="margin-top:40px">

   

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="soccer.php" class="swiper-slide slide">
      <img src="images/1775600.png" alt="">
      <h3>Soccer</h3>
   </a>

   <a href="basketball.php" class="swiper-slide slide">
      <img src="images/basketball-basket-png-39939.png" alt="">
      <h3>Basketball</h3>
   </a>

   <a href="vollyball.php" class="swiper-slide slide">
      <img src="images/hit-jump-spike-sport-volley-volleyball-icon--5.png" alt="">
      <h3>Vollyball</h3>
   </a>

   <a href="tennis.php" class="swiper-slide slide">
      <img src="images/tennis-png-1790.png" alt="">
      <h3>Tennis</h3>
   </a>

   <a href="table-tennis.php" class="swiper-slide slide">
      <img src="images/table-tennis.png" alt="">
      <h3>Table Tennis</h3>
   </a>


   </div>

   <!-- <div class="swiper-pagination"></div> -->

   </div>

</section>





</div>









<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>