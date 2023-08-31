<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header" >

   <section class="flex">

      <a href="../seller/dashboard.php" class="logo">Seller<span> Dashboard</span></a>

      <nav class="navbar">
         <a href="../seller/dashboard.php" style="text-decoration:none">Home</a>
         <a href="../seller/products.php" style="text-decoration:none">Products</a>
         <a href="../seller/add-size.php" style="text-decoration:none">Product Size</a>
         <a href="../seller/placed_orders.php" style="text-decoration:none">Orders</a>
         
         
         <a href="../seller/messages.php" style="text-decoration:none">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         
         <div class="flex-btn">
        <?php
         if(isset($_SESSION['user_id'])){
            
           echo  '<a href="./seller_login.php" class="option-btn">login</a>';
         }
         ?>
         </div>
         <a href="../components/seller-logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
      </div>

   </section>

</header>