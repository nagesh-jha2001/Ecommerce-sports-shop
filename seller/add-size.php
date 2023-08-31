<?php

include '../components/db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_size'])){

   $product = $_POST['product'];

   $size = $_POST['size'];

    $sql="INSERT INTO `product_size` (`product`,`size`) VALUES ('$product','$size')";
    $result=mysqli_query($conn,$sql);

    if($result){
        $message[] = 'Saved';
    }
    else{
        $message[] = 'Failed';
    }

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>product size</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/seller-header.php'; ?>

<section class="add-products">

   <h1 class="heading">add product Size</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         
         
         <div class="inputBox">
         <span>Select Product (required)</span>
         <select name="product"  class="box">
               <?php 
               $size = $conn->query("select * from products");
               while($row=$size->fetch_assoc()){?>
               <option value="<?php echo $row['id']?>"><?php echo $row['name']; ?></option>
               <?php } ?>
         </select>
         </div>
         <div class="inputBox">
            <span>Enter Size (required)</span>
            <input type="text" class="box" placeholder="enter product Size" name="size">
         </div>
      </div>
      
      <input type="submit" value="add size" class="btn" name="add_size">
   </form>

</section>










<script src="../js/admin_script.js"></script>
   
</body>
</html>