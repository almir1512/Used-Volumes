<?php
if(!isset($user_id)){
?>
<section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="shop1.php">shop</a>
         <a href="contact1.php">contact</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="login.php">login</a>
         <a href="register.php">register</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> +9967672747 </p>
         <a href="mailto:usedvolumes@gmail.com"><i class="fas fa-envelope"></i>usedvolumes@gmail.com</a>
         <a href="https://goo.gl/maps/Pi7kGmEyviqZot91A?coh=178571&entry=tt"> <i class="fas fa-map-marker-alt"></i> Mumbai, India</a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

   <p class="credit"> &copy; <?php echo date('Y'); ?> All rights reserved by <a href="home.php"><span>UsedVolumes Inc.</span></a> </p>

</section>

<?php 
}
else{
?>
   <section class="footer">

   <div class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home1.php">home</a>
         <a href="about1.php">about</a>
         <a href="shop.php">shop</a>
         <a href="contact.php">contact</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="login.php">login</a>
         <a href="register.php">register</a>
         
         <a href="orders.php">orders</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> +9967672747 </p>
         <a href="mailto:usedvolumes@gmail.com"><i class="fas fa-envelope"></i>usedvolumes@gmail.com</a>
         <a href="https://goo.gl/maps/Pi7kGmEyviqZot91A?coh=178571&entry=tt"> <i class="fas fa-map-marker-alt"></i> Mumbai, India</a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </div>

   <p class="credit"> &copy; <?php echo date('Y'); ?> All rights reserved by <a href="home.php"><span>UsedVolumes Inc.</span></a> </p>

</section>
<?php
}
?> 
