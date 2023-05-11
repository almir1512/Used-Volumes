<?php

include 'config.php';

// session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:login.php');
// }

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $seller_name = $_POST['seller_name'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `contact` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
      
      mysqli_query($conn, "INSERT INTO `contact`(user_id, name, price, qty, seller) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$seller_name')") or die('query failed');
      header('location:contact_seller.php');
      

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

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
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>our shop</h3>
   <p> <a href="home.php">home</a> / shop </p>
</div>

<section class="shop">
   <h1 class="title">latest books</h1>
    <div class="empty">Please <a href="login.php">Login</a> to View Entire Shop</div>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>