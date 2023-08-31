<?php

include 'db.php';


session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

 $dlscno=$_SESSION['dlscno'];
// print_r($_SESSION);die; 


?>

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

<a style="background-color:'red',padding:20px;display:flex;align-items:center,text-decoration:none"  href="../index.php">Go Home</a>


   
    <section class="orders" style="margin-tio:20px;text-align:center">

        <h1 class="heading">placed orders</h1>

        <div class="box-container">

            <?php
      $query = $con->query("select * from orders where id= '$dlscno' ");
      while ($row = $query->fetch_assoc()) { ?>
   
            <div class="box">
                <p>placed on : <span><?= $row['placed_on']; ?></span></p>
                <p>name : <span><?= $row['name']; ?></span></p>
                <p>email : <span><?= $row['email']; ?></span></p>
                <p>number : <span><?= $row['number']; ?></span></p>
                <p>address : <span><?= $row['address']; ?></span></p>
                <!-- <p>payment method : <span><?= $row['method']; ?></span></p> -->
                <p>your orders : <span><?= $row['total_products']; ?></span></p>
                <p>total price : <span>Rs<?= $row['total_price']; ?>/-</span></p>
                
            </div>
            <?php
      }

   ?>

<div class="row no-print d-flex">
                                <div class="col-12">
                                    <a href="" target="_blank" class="btn btn-success"><i class="fas fa-print"></i>
                                        Print</a>
                                    <script type="text/javascript">
                                    window.addEventListener("load", window.print());
                                    </script>


                                </div>
                            </div>

        </div>

    </section>












    

    <script src="js/script.js"></script>

</body>

</html>