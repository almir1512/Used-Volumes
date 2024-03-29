<?php

include 'config.php';

session_start();

$seller_name = $_SESSION['seller_name'];

if(!isset($seller_name)){
   header('location:login.php');
};

$pattern = "/^(?=(?:[^0-9]*[0-9]){10}(?:(?:[^0-9]*[0-9]){3})?$)[\\d-]+$/i";

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
   $isbn_match =  preg_match($pattern, $isbn); 
   if($isbn_match){

   $price = $_POST['price'];
   $category = $_POST['category'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name' AND seller_name='$seller_name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price,isbn, category, image, seller_name) VALUES('$name', '$price','$isbn','$category', '$image','$seller_name')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}else{
   $message[]='invalid isbn no';
}
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id' and seller_name='$seller_name'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id' AND seller_name='$seller_name'") or die('query failed');
   header('location:seller_products.php');
}

if(isset($_POST['update_product'])){
   
   $isbn1 = mysqli_real_escape_string($conn, $_POST['update_isbn']);
   $isbn_match1 =  preg_match($pattern, $isbn1); 
   if($isbn_match1){
   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $updated_category = $_POST['upd_category'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name',isbn='$isbn1', price = '$update_price',category='$updated_category' WHERE id = '$update_p_id' AND seller_name='$seller_name'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:seller_products.php');
   }
   else{
      $message[]='invalid isbn no';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>inventory</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   
   <!-- favicon -->
   <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
   <link rel="manifest" href="favicon/site.webmanifest">


</head>
<body>
   
<?php include 'seller_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">Inventory</h1>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" name="name" class="box" placeholder="enter product name" required>
      <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
      <input type="text" name="isbn" class="box" placeholder="enter ISBN number (only digits and hyphen)" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <select placeholder="Register as" name="category" class="box">
         <option value="" disabled selected>Select Book Category</option>
         <option value="engineering">Engineering</option>
         <option value="medical">Medical</option>
         <option value="science">Science</option>
         <option value="pharmacy">Pharmacy</option>
         <option value="literature">Literature</option>
         <option value="architecture">Architecture</option>
         <option value="other">Other</option>
      </select>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE seller_name='$seller_name'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
         <div class="isbn" style="font-family:Rubik;padding:1rem 0;font-size: 1.4rem;color:#000000">ISBN: <?php echo $fetch_products['isbn']; ?></div>
         <div class="isbn" style="font-family:Rubik;padding:0rem 0;font-size: 1.6rem;color:#000000">Category : <?php echo $fetch_products['category']; ?></div>
         <a href="seller_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="seller_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
      <input type="text" name="update_isbn" value="<?php echo $fetch_update['isbn']; ?>" class="box" placeholder="enter ISBN number (only digits and hyphen)" required>
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <select placeholder="Register as" name="upd_category" class="box">
         <option value="" disabled selected>Select Book Category</option>
         <option value="engineering">Engineering</option>
         <option value="medical">Medical</option>
         <option value="science">Science</option>
         <option value="pharmacy">Pharmacy</option>
         <option value="literature">Literature</option>
         <option value="other">Other</option>
      </select>
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>