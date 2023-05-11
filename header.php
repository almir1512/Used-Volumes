
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

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <p> new <a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="home1.php" class="logo"><img src="images/logo-pr.png">Used Volumes.</a>

         <nav class="navbar">
            <a href="home.php">home</a>
            <a href="about.php">about</a>
            <a href="shop1.php">shop</a>
            <a href="contact1.php">contact</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
         
         </div>
         <div class="icons">
            <span><a href="search_page1.php" class="fas fa-search"></a></span>
            
         
         
            <?php
            ?>
            <!-- <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a> -->
         </div>
<!-- 
         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div> -->
      </div>
   </div>

</header>
