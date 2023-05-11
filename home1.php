<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $isbn= $_POST['product_isbn'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $seller_name = $_POST['seller_name'];


   

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `contact` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
      
      mysqli_query($conn, "INSERT INTO `contact`(user_id, name, isbn, price, qty, seller) VALUES('$user_id', '$product_name', '$isbn', '$product_price', '$product_quantity', '$seller_name')") or die('query failed');
      header('location:contact_seller.php');
      

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!--favicon -->
   <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
   <link rel="manifest" href="favicon/site.webmanifest">

</head>
<body>

<?php include 'header1.php'; ?>

<section class="home">

   <div class="content">
   <h3>
  <span>A</span>
  <span>Book</span>
  <span>is</span>
  <span>a</span>
  <span>dream</span>
  <span>that</span>
  <span>you</span>
  <span>hold</span>
  <span>in</span>
  <span>your</span>
  <span>hands.</span>
</h3>
      <p>The Used Volumes team works hard to bring you the widest
       selection of the <strong>best</strong> books at the <strong>lowest</strong> prices you've ever seen.</p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>

</section>
<section class="categories">
<h1 class="title">book categories</h1>
<div class="achievements">
<a href="shop_eng.php">
<div class="work">
      <img src="images/004-engineering.png"/>
      <p class="work-heading">Engineering</p>
    </div> </a>

    <a href="shop_med.php">
    <div class="work">
    <img src="images/005-stethoscope.png"/>
   <p class="work-heading">Medical</p>
      
    </div></a>
    
   <a href="shop_sci.php">
  <div class="work">
  <img src="images/006-atom.png"/>
      <p class="work-heading">Science</p>
    
    </div></a>
    
   <a href="shop_lit.php">
    <div class="work">
    <img src="images/001-poetry.png"/>
      <p class="work-heading">Literature</p>
   
    </div></a>
   <a href="shop_pharmacy.php">
    <div class="work">
    <img src="images/002-medicine.png"/>
    <p class="work-heading">Pharmacy</p>
    </div></a>
    <a href="shop_arch.php">
  <div class="work">
  <img src="images/003-architect.png"/>
      <p class="work-heading">Architecture</p>
    
    </div></a>
   <a href="shop_other.php">
    <div class="work">
    <img src="images/007-ellipsis.png"/>
      <p class="work-heading">Others</p>
    </div></a>
  </div>
</section>

<section class="products">

   <h1 class="title">newly&ensp;added&ensp;books</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` ORDER BY id DESC LIMIT 8;") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
      <label for="product_quantity" class="qty-label">Quantity :</label>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      
      <div class="isbn">ISBN <?php echo $fetch_products['isbn']; ?></div>
      <div class="name">Seller : <span style="text-decoration:underline"><?php echo $fetch_products['seller_name']; ?></span></div>
      
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="hidden" name="product_isbn" value="<?php echo $fetch_products['isbn']; ?>">
      <input type="hidden" name="seller_name" value="<?php echo $fetch_products['seller_name']; ?>">
      <input type="submit" value="contact seller" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>Used Volumes team bridges the gap between resellers and book buyers by providing an all inclusive platform to buy used books at the best prices.</p>
         <a href="about1.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Become a seller !</h3>
      <p>Used Volumes provides sellers all inclusive store to sell their inventory of refurbished books. We 
         connect you with the best customer base to market your volumes.
      </p>
      <a href="seller_register.php" class="white-btn">Register with us</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
