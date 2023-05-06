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


    
    <section class="flex">
        <!-- Logo -->
        <a href=""><img src="images/Logo.png" alt="logo" class="pot"></a>

        
        <!-- Główne menu strony -->
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="menu.php">menu</a>
            <a href="orders.php">zamówienia</a>
            <a href="about.php">placówki</a>
            <a href="contact.php">kontakt</a>
            <a href="/food/admin/dashboard.php" target="_blank">admin</a>
        </nav>

        
        <div class="icons">
        <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span> <?= $total_cart_items; ?> </span></a>
            <div id="user-btn" class="fas fa-user"></div>
           
            
        </div>

        <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="account">
            <a href="profile.php" class="btn" >profil</a>
            <a href="components/user_logout.php" onclick="return confirm('Wylogować ze strony?');" class="btn" >wyloguj</a>
         </div>
         <p class="account">
            
         </p> 
         <?php
            }else{
         ?>
            <p class="name">proszę zaloguj się!</p>
            <a href="login.php" class="btn">zaloguj się</a>
            <p class="name">Lub zarejestruj!</p>
            <a href="register.php" class="btn">zarejestruj się</a>
         <?php
          }
         ?>
      
        </div>

    </section>
</header>