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
       <img src="/food/images/Logo.png" alt="logo" class="pot">


      <nav class="navbar">
         <a href="dashboard.php">home</a>
         <a href="products.php">dania</a>
         <a href="placed_orders.php">zamówienia</a>
         <a href="admin_accounts.php">administratorzy</a>
         <a href="users_accounts.php">użytkownicy</a>
         <a href="messages.php">wiadomości</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">zaktualizuj profil</a>
         
            <a href="admin_login.php" class="btn">zaloguj</a>
            <a href="register_admin.php" class="btn">zarejestruj</a>
         
         <a href="../components/admin_logout.php" onclick="return confirm('Wylogować ze strony?');" class="delete-btn">wyloguj</a>
      </div>

   </section>

</header>