<?php

include 'config.php';

// session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:login.php');
// }

if(isset($_POST['add_to_cart'])){
   if(!isset($user_id)){
      header('location:login.php');
      }else{

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `contact` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   mysqli_query($conn, "INSERT INTO `contact`(user_id, name,isbn, price, qty, seller) VALUES('$user_id', '$product_name','$isbn', '$product_price', '$product_quantity', '$seller_name')") or die('query failed');
   header('location:contact_seller.php');
      }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>medical book</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!-- favicon -->
   <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
   <link rel="manifest" href="favicon/site.webmanifest">
</head>
<body>
   
<?php 
if(!isset($user_id)){
   
   include 'header.php'; 
   }
else{

   include 'header1.php'; 
}

?>

<div class="heading">
   <h3>our shop</h3>
   <p> <a href=<?php 
if(!isset($user_id)){
   
   echo 'home.php'; 
   }
else{

   echo 'home1.php'; 
}

?>>home</a> / <a href="shop.php">shop</a> / medical</p>
</div>

<section class="products">

   <h1 class="title">medical books</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category='medical' ORDER BY id DESC") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
      <label for="product_quantity" class="qty-label">Quantity :</label>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <div class="name">Seller : <span style="text-decoration:underline"><?php echo $fetch_products['seller_name']; ?></span></div>

      
      <div class="isbn">ISBN <?php echo $fetch_products['isbn']; ?></div>
      <!-- check whether the item is already added to the cart or not -->
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="hidden" name="product_isbn"  value="<?php echo $fetch_products['isbn']; ?>">>
      <input type="submit" value="Contact Seller" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>